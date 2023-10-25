<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\QuestionType;

trait SurveyFormTrait
{
    use SweetAlert;

    public $title;

    public $description;

    public $start_date;

    public $end_date;

    public $is_private_post = false;

    public $categories = [];

    public $categories_old = []; // old categories from database

    public $categories_old_ids = []; // old category ids from database

    public $question_edit_id = 0;

    public $questions = [];

    public $questions_counter = 0;

    public $question;

    public $question_type;

    public $choice_counter = 0;

    public $choice_inputs = [];

    public $choices = [];

    /**
     * References
     */
    public $category_refs = [];

    public $question_type_refs = [];

    public function loadCategoryRefs()
    {
        $this->category_refs = Category::where('status_id', STATUS_ACTIVE)->get();
    }

    public function loadQuestionTypeRefs()
    {
        $this->question_type_refs = QuestionType::where('status_id', STATUS_ACTIVE)->get();
    }

    public function addChoice()
    {
        if (! $this->question_type) {
            $this->warning('Opps!', 'Please select question type first.');

            return;
        }

        $this->choices[$this->choice_counter] = [
            'id' => null,
            'choice' => null,
            'is_deleted' => false,
        ];

        array_push($this->choice_inputs, $this->choice_counter);
        $this->choice_counter += 1;
    }

    public function removeChoice($k)
    {
        unset($this->choice_inputs[$k]);
        $this->choices[$k]['is_deleted'] = true;
    }

    public function addQuestion()
    {
        $validated = $this->validate([
            'question_type' => 'required',
            'question' => 'required',
            'choices.*.choice' => 'required',
        ], [
            'choices.*.choice.required' => 'This choice field is required',
        ]);

        if (! count($this->choice_inputs)) {
            return $this->warning('Opps!', 'Please add choicecs');
        }

        if (isset($this->questions[$this->question_edit_id])) {
            $this->questions[$this->question_edit_id]['type'] = $validated['question_type'];
            $this->questions[$this->question_edit_id]['question'] = $validated['question'];
            $this->questions[$this->question_edit_id]['choices'] = $this->choices;
        } else {
            $this->questions_counter++;
            $this->questions[$this->questions_counter] = [
                'id' => null,
                'type' => $validated['question_type'],
                'question' => $validated['question'],
                'choices' => $this->choices,
                'is_deleted' => false,
            ];
        }

        $this->resetQuestionForm();
        $this->dispatchBrowserEvent('addQuestion');
    }

    public function removeQuestion($k)
    {
        $this->questions[$k]['is_deleted'] = true;
    }

    public function editQuestion($k)
    {
        $this->resetQuestionForm();
        $question = $this->questions[$k];

        $this->question_edit_id = $k;
        $this->question_type = $question['type'];
        $this->question = $question['question'];
        $this->choices = $question['choices'];

        if ($this->choices) {
            foreach ($this->choices as $choice) {
                if ($choice['is_deleted']) {
                    continue;
                }

                array_push($this->choice_inputs, $this->choice_counter);
                $this->choice_counter += 1;
            }
        }

        $this->dispatchBrowserEvent('editQuestion');
    }

    public function resetQuestionForm()
    {
        $this->reset([
            'question',
            'question_type',
            'choices',
            'choice_inputs',
            'choice_counter',
            'question_edit_id',
        ]);
    }
}
