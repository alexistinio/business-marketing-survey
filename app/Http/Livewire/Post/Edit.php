<?php

namespace App\Http\Livewire\Post;

use App\Models\Survey;
use App\Services\SurveyService;
use App\Traits\SurveyFormTrait;
use Livewire\Component;

class Edit extends Component
{
    use SurveyFormTrait;

    public $survey_edit_id;

    protected $listeners = [
        'confirmSave',
    ];

    public function mount($id)
    {
        $surveyService = new SurveyService();

        if (! $surveyService->isSurveyExists($id)) {
            abort(404);
        }

        $this->survey_edit_id = $id;

        $this->loadCategoryRefs();
        $this->loadQuestionTypeRefs();

        $survey = Survey::with('groups', 'questions')
            ->where('status_id', STATUS_ACTIVE)
            ->where('deleted_at', null)
            ->find($id);

        $this->title = $survey->title;
        $this->description = $survey->description;
        $this->start_date = date('M d, Y', strtotime($survey->start_date));
        $this->end_date = date('M d, Y', strtotime($survey->end_date));
        $this->is_private_post = $survey->is_private;

        if ($survey->questions) {
            foreach ($survey->questions as $question) {
                $choices = [];
                if ($question->choices) {
                    foreach ($question->choices as $choice) {
                        array_push($choices, [
                            'id' => $choice->id,
                            'choice' => $choice->choice,
                            'is_deleted' => false,
                        ]);
                    }
                }

                $this->questions_counter++;
                $this->questions[$this->questions_counter] = [
                    'id' => $question->id,
                    'type' => $surveyService->getQuestionType($question->question_type_id)['name'],
                    'question' => $question->question,
                    'choices' => $choices,
                    'is_deleted' => false,
                ];
            }
        }

        if ($survey->groups) {
            foreach ($survey->groups as $group) {
                array_push($this->categories, (string) $group->category_id);
                array_push($this->categories_old_ids, $group->category_id);

                array_push($this->categories_old, [
                    'id' => $group->id,
                    'category_id' => $group->category_id,
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.post.edit');
    }

    public function save()
    {
        $this->validated = $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date|lte:end_date',
            'end_date' => 'required|gte:start_date|date',
            'is_private_post' => 'nullable',
        ]);

        if (! count($this->questions)) {
            return $this->warning('Ooopps!', 'The questionaire is empty.');
        }

        if ($this->is_private_post) {
            if (! count($this->categories)) {
                return $this->warning('Ooopps!', 'Please select some categories');
            }
        }

        $this->validated['questions'] = $this->questions;
        $this->validated['categories'] = $this->categories;
        $this->validated['categories_old'] = $this->categories_old;
        $this->validated['categories_old_ids'] = $this->categories_old_ids;

        $this->confirm('Save Changes?', 'Your changes will be saved', [
            'onConfirm' => 'confirmSave',
        ]);
    }

    public function confirmSave(SurveyService $survey)
    {
        $response = $survey->update($this->survey_edit_id, $this->validated);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->success('Save Changes!', 'Saved Changes Successfully!.');
    }
}
