<?php

namespace App\Http\Livewire\Post;

use App\Services\SurveyService;
use App\Traits\SurveyFormTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use SurveyFormTrait, AuthorizesRequests;

    public $is_private;

    public $validated;

    protected $listeners = [
        'confirmPublish',
    ];

    /**
     * Initialize datas
     */
    public function mount()
    {
        $this->loadCategoryRefs();
        $this->loadQuestionTypeRefs();
    }

    public function render()
    {
        return view('livewire.post.create');
    }

    public function publish()
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

        $this->confirm('Publish this survey?', 'This survey will be published', [
            'onConfirm' => 'confirmPublish',
        ]);
    }

    public function confirmPublish(SurveyService $survey)
    {
        $response = $survey->create($this->validated);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->flashSuccess('Posted', 'Your survey has been successfully posted');

        return redirect(route('home'));
    }
}
