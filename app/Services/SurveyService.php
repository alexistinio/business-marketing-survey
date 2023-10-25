<?php

namespace App\Services;

use App\Events\SurveyEvent;
use App\Models\QuestionType;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyCategory;
use App\Models\SurveyComment;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionChoice;
use Illuminate\Support\Facades\DB;

class SurveyService
{
    /**
     * Create New Survey
     */
    
    public function create($validated)
    {
        try {
            DB::beginTransaction();

            $survey = Survey::create([
                'user_id' => auth()->user()->id,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'start_date' => date('Y-m-d', strtotime($validated['start_date'])),
                'end_date' => date('Y-m-d', strtotime($validated['end_date'])),
                'is_private' => $validated['is_private_post'] ?? 0,
            ]);

            // insert questions and choices
            if ($validated['questions']) {
                foreach ($validated['questions'] as $question) {
                    if ($question['is_deleted']) {
                        continue;
                    }

                    $this->createQuestion(
                        $survey->id,
                        $question['type'],
                        $question['question'],
                        $question['choices'],
                    );
                }
            }

            // send notification to user who posted
            event(new SurveyEvent(auth()->user(), $survey, "Posted", "Your Survey has been posted."));

            // if private post
            if ($validated['is_private_post'] && $validated['categories']) {
                $this->publishToGroupCategory($survey->id, $validated['categories']);

                // send notification to group users
                $category_post = SurveyCategory::with('category')->where('survey_id', $survey->id)->get();

                foreach ($category_post as $post) {
                    $category_users = $post->category->users;

                    if ($category_users) {
                        foreach ($category_users as $category_user) {
                            $message = "New Survey Posted on group " . $post->category->title;
                            event(new SurveyEvent($category_user->user, $survey, "New Post", $message));
                        }
                    }
                }
            }

            DB::commit();

            return response_success('Survey has been published');
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    /**
     * Update Survey
     */
    public function update($survey_id, $validated)
    {
        try {
            DB::beginTransaction();

            $survey = Survey::find($survey_id);
            $survey->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'start_date' => date('Y-m-d', strtotime($validated['start_date'])),
                'end_date' => date('Y-m-d', strtotime($validated['end_date'])),
                'is_private' => $validated['is_private_post'],
            ]);

            // update or insert questions and choices
            if ($validated['questions']) {
                $this->updateQuestion($survey, $validated['questions']);
            }

            // update to group post if private
            if ($validated['is_private_post']) {
                if ($validated['categories']) {
                    foreach ($validated['categories'] as $category) {
                        if (in_array($category, $validated['categories_old_ids'])) {
                            continue;
                        }

                        SurveyCategory::create([
                            'survey_id' => $survey->id,
                            'category_id' => (int) $category,
                        ]);
                    }
                }

                if ($validated['categories_old']) {
                    foreach ($validated['categories_old'] as $old_category) {
                        if (in_array($old_category['category_id'], $validated['categories'])) {
                            continue;
                        }

                        $this->removeFromGroupCategory($old_category['id']);
                    }
                }
            } else {
                $this->removeFromGroupCategory(null, $survey->id);
            }

            event(new SurveyEvent(auth()->user(), $survey, "Updated", "Survey has been updated"));

            DB::commit();

            return response_success('Successfully Updated!');
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    /**
     * Remove Survey
     */
    public function delete($survey_id)
    {
        if (!$this->isSurveyExists($survey_id)) {
            return response_error("Can't proceed with the request");
        }

        try {
            DB::beginTransaction();

            $survey = Survey::find($survey_id);
            $survey->update([
                'deleted_at' => now(),
            ]);

            $message = "Survey " . $survey->title . " has been deleted";
            event(new SurveyEvent(auth()->user(), $survey, "Deleted", $message));

            DB::commit();

            return response_success('Successfully Deleted!');
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    /**
     * Submit Survey Answers
     * 
     */
    public function submitSurvey($survey_id, $answers, $user_id)
    {
        try {
            DB::beginTransaction();

            if ($answers) {
                foreach ($answers as $answer) {
                    if (is_array($answer['answer_id'])) {
                        // for multiple answers
                        foreach ($answer['answer_id'] as $answer_id) {
                            SurveyAnswer::create([
                                'user_id' => $user_id,
                                'survey_id' => $survey_id,
                                'question_id' => $answer['question_id'],
                                'choice_id' => $answer_id,
                            ]);
                        }
                    } else {
                        SurveyAnswer::create([
                            'user_id' => $user_id,
                            'survey_id' => $survey_id,
                            'question_id' => $answer['question_id'],
                            'choice_id' => $answer['answer_id'],
                        ]);
                    }
                }
            }

            $survey = Survey::find($survey_id);
            $message = "You answered Survey. <a href='" . route('post.answer', ['id' => $survey_id]) . "'>View Survey</a>";

            event(new SurveyEvent(auth()->user(), $survey, "Answered", $message));

            DB::commit();

            return response_success('Successfully Submitted!');
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    /**
     * Create Survey Question and Choices
     *
     *
     **/
    public function createQuestion($survey_id, $question_type, $question, $choices)
    {
        $question_type = $this->getQuestionType($question_type);

        if (!$question_type) {
            return false;
        }

        $survey_question = SurveyQuestion::create([
            'survey_id' => $survey_id,
            'question_type_id' => $question_type->id,
            'question' => $question,
        ]);

        if ($choices) {
            foreach ($choices as $choice) {
                if ($choice['is_deleted']) {
                    continue;
                }
                $this->createChoices($survey_question->id, $choice['choice']);
            }
        }

        return $survey_question;
    }

    public function updateQuestion(Survey $survey, $questions)
    {
        foreach ($questions as $k => $question) {
            $question_type = $this->getQuestionType($question['type']);

            if ($question['is_deleted']) {
                $inactive_status = STATUS_INACTIVE;
                $deleted_at = now();
            }

            $questionUpdate = SurveyQuestion::updateOrCreate(
                ['id' => $question['id']],
                [
                    'survey_id' => $survey->id,
                    'status_id' => isset($inactive_status) ? $inactive_status : STATUS_ACTIVE,
                    'question_type_id' => $question_type->id,
                    'question' => $question['question'],
                    'deleted_at' => isset($deleted_at) ? $deleted_at : null,
                ]
            );

            // update or inser choices
            if ($question['choices']) {
                $this->updateChoices($questionUpdate->id, $question['choices']);
            }
        }

        return true;
    }

    /**
     * Create Question Choices
     */
    public function createChoices($question_id, $choice, $status = STATUS_ACTIVE)
    {
        return SurveyQuestionChoice::create([
            'survey_question_id' => $question_id,
            'status_id' => $status,
            'choice' => $choice,
        ]);
    }

    public function updateChoices($question_id, $choices)
    {
        foreach ($choices as $choice) {
            $status = $choice['is_deleted'] ? STATUS_INACTIVE : STATUS_ACTIVE;
            $isUpdateChoice = SurveyQuestionChoice::find($choice['id']);

            if ($isUpdateChoice) {
                $isUpdateChoice->update([
                    'choice' => $choice['choice'],
                    'status_id' => $status,
                ]);
            } else {
                $this->createChoices($question_id, $choice['choice']);
            }
        }

        return true;
    }

    public function publishToGroupCategory($survey_id, array $categories)
    {
        if (!count($categories)) {
            return false;
        }

        foreach ($categories as $category) {
            SurveyCategory::create([
                'survey_id' => $survey_id,
                'category_id' => (int) $category,
            ]);
        }
    }

    public function removeFromGroupCategory($id = null, $survey_id = null, $category_id = null)
    {
        if (!$this->isSurveyExists($survey_id)) {
            return false;
        }

        if (!$id && !$survey_id && !$category_id) {
            return false;
        }

        $categoryPost = SurveyCategory::query();

        if ($id) {
            $categoryPost = $categoryPost->where('id', $id);
        }

        if ($survey_id) {
            $categoryPost = $categoryPost->where('survey_id', $survey_id);
        }

        if ($category_id) {
            $categoryPost = $categoryPost->where('category_id', $category_id);
        }

        $categoryPost->update([
            'deleted_at' => now(),
            'status_id' => STATUS_INACTIVE,
        ]);

        return true;
    }

    public function getQuestionType($type_name_or_id)
    {
        if (is_string($type_name_or_id)) {
            return QuestionType::where('name', $type_name_or_id)->first();
        }

        return  QuestionType::where('id', $type_name_or_id)->first();
    }

    public function getSurveys()
    {
        return Survey::with('groups', 'postedBy', 'answers')
            ->active()
            ->public()
            ->orWhereHas('groups', function ($query) {
                return $query->whereIn('category_id', auth()->user()->groups->pluck('group_id'));
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // get survey id's only
    public function getUserSurveys($user_id)
    {
        return SurveyAnswer::select('survey_id')
            ->with('survey')
            ->where('user_id', $user_id)
            ->groupBy('survey_id')
            ->get();
    }

    public function getSurveysByGroup($group_id)
    {
        return Survey::with('groups', 'postedBy', 'answers', 'comments')
            ->whereHas('groups', function ($query) use ($group_id) {
                return $query->where('category_id', $group_id);
            })
            ->active()
            ->get();
    }

    public function getSureysByUser($user_id)
    {
        $surveys = Survey::with('groups', 'postedBy', 'answers')
            ->where('user_id', $user_id);


        if (auth()->user()->id !== $user_id) {

            $surveys = $surveys->public()
                ->active()
                ->orWhereHas('groups', function ($query) {
                    return $query->whereIn('category_id', auth()->user()->groups->pluck('group_id'));
                });
        }

        $surveys = $surveys
            ->orderBy('created_at', 'desc')
            ->get();

        return $surveys;
    }

    /**
     * Get All Surveys with unique user ids who answered the surveys
     */
    public function getAllSurveyAnswerCount($surveys)
    {
        if (!count($surveys)) {
            return false;
        }

        $answered_users = [];
        foreach ($surveys as $survey) {
            $answered_user = $this->getSurveyAnswerCount($survey);
            $answered_users[$survey->id] = $answered_user;
        }

        return $answered_users;
    }

    /**
     * Get Unique User Ids who answered the given survey
     */
    public function getSurveyAnswerCount($survey)
    {
        if (!$survey) {
            return false;
        }

        $unique_users = [];
        $users = $survey->answers->unique('user_id')->values()->all();

        foreach ($users as $user) {
            array_push($unique_users, $user->id);
        }

        return count($unique_users);
    }

    public function getSurveyAnswersPercentage($answers, $total_answered_users)
    {
        $choice_counts = [];
        if ($answers) {
            foreach ($answers as $answer) {
                if (!isset($choice_counts[$answer->question_id])) {
                    $choice_counts[$answer->question_id] = [];
                }

                $old_value = $choice_counts[$answer->question_id][$answer->choice_id] ?? 0;
                $choice_counts[$answer->question_id][$answer->choice_id] = $old_value + 1;
            }
    

            $choice_percentages = [];
            foreach ($choice_counts as $question_id => $choices) {
                $percentages = [];
                foreach ($choices as $choice_id => $user_count) {
                    $percentages[$choice_id] = ($user_count / $total_answered_users) * 100;
                }

                $choice_percentages[$question_id] = $percentages;
            }

            return $choice_percentages;
        }
    }

    public function getSurveyAnswersPerChoice($answers, $total_answered_users)
    {
        $choice_counts = [];
        if ($answers) {
            foreach ($answers as $answer) {
                if (!isset($choice_counts[$answer->question_id])) {
                    $choice_counts[$answer->question_id] = [];
                }

                $old_value = $choice_counts[$answer->question_id][$answer->choice_id] ?? 0;
                $choice_counts[$answer->question_id][$answer->choice_id] = $old_value + 1;
            }

            return $choice_counts;
        }
    }

    /**
     * Get Survey Answers by user
     */
    public function getUserSurveyAnswers($survey_id, $user_id)
    {
        $answers = SurveyAnswer::where('user_id', $user_id)
            ->where('survey_id', $survey_id)
            ->get();

        $temp_answers = [];
        if ($answers) {
            foreach ($answers as $answer) {
                // mulitple answer
                if (isset($temp_answers[$answer['question_id']])) {

                    // get old value
                    $old_val = $temp_answers[$answer['question_id']];

                    // make choice id as key
                    if (is_array($old_val)) {
                        array_push($old_val, [$answer['choice_id'] => $answer['choice_id']]);
                    } else {
                        $old_val = [$old_val => $old_val, $answer['choice_id'] => $answer['choice_id']];
                    }

                    $temp_answers[$answer['question_id']] = $old_val;
                } else {
                    $temp_answers[$answer['question_id']] = $answer['choice_id'];
                }
            }
        }

        return $temp_answers;
    }

    public function isSurveyExists($survey_id)
    {
        if (!$survey_id) {
            return false;
        }

        return Survey::where('id', $survey_id)
            ->where('deleted_at', null)
            ->where('status_id', STATUS_ACTIVE)
            ->exists();
    }

    public function isSurveyAnswered($survey_id, $user_id)
    {
        $is_answered_already = SurveyAnswer::where('user_id', $user_id)->where('survey_id', $survey_id)->count();

        return $is_answered_already ? true : false;
    }

    public function getDistinctAnsweredUsers($survey_id)
    {
        return SurveyAnswer::select('user_id', 'created_at')
            ->with('user')
            ->where('survey_id', $survey_id)
            ->distinct()
            ->groupBy('user_id', 'created_at')
            ->get();
    }

    public function addComment($survey_id, $user_id, $comment)
    {
        try {
            DB::beginTransaction();

            SurveyComment::create([
                'survey_id' => $survey_id,
                'user_id' => $user_id,
                'comment' => $comment,
            ]);

            DB::commit();

            return response_success('');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_error($e->getMessage());
        }
    }
}
