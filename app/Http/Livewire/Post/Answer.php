<?php

namespace App\Http\Livewire\Post;

use App\Models\Survey;
use App\Models\Point;
use App\Services\SurveyService;
use App\Traits\SweetAlert;
use Livewire\Component;

class Answer extends Component
{
    use SweetAlert;

    public $survey;

    public $is_answered;

    public $answers = [];

    public $questions_answered = [];

    protected $listeners = [
        'confirmSubmit',
    ];

    public function mount($id)
    {
        $surveyService = new SurveyService();

        if (! $surveyService->isSurveyExists($id)) {
            abort(404);
        }

        $this->is_answered = $surveyService->isSurveyAnswered($id, auth()->user()->id);

        $this->survey = Survey::with('groups', 'questions')
        ->active()
        ->find($id);

        if ($this->survey->is_private) {
            if ($this->survey->groups->whereIn('category_id', auth()->user()->groups->pluck('group_id'))->count() < 1) {
                abort(403);
            }
        }

        if ($this->is_answered) {
            $this->answers = $surveyService->getUserSurveyAnswers($id, auth()->user()->id);
        }
    }

    public function render()
    {
        return view('livewire.post.answer');
    }

    public function submit()
    {
        if ($this->is_answered) {
            return $this->warning('Opps!', 'You already answered this survey.');
        }

        $questions_answered = [];
        if ($this->answers) {
            foreach ($this->answers as $question => $answer) {
                array_push($questions_answered, [
                    'question_id' => $question,
                    'answer_id' => $answer,
                ]);
            }
        }

        if (! count($questions_answered)) {
            return $this->warning('Opps!', 'Please select some answers in the questionaire');
        }

        $this->questions_answered = $questions_answered;

        $this->confirm('Are you sure?', 'Your answers will be submitted', [
            'onConfirm' => 'confirmSubmit',
        ]);
    }

    public function confirmSubmit()
    {
        $surveyService = new SurveyService();
        $response = $surveyService->submitSurvey($this->survey->id, $this->questions_answered, auth()->user()->id);

        if ($response['status'] == 404) {
            return $this->error("Something wen't wrong!", $response['message']);
        }

        if ($response['status'] == 200) {
            $this->flashSuccess('Succeess', $response['message']);

            $id = auth()->user()->id;
            $points = Point::find($id);

            if($points->points<3000){
           
            $data = [
                'user_id' => auth()->user()->id,
                'points' => $points->points+1,
               
            ]; 
            
            $points->update($data);
            return redirect(route('home'));
          }
          else{
            return redirect(route('home'));
          }
        }
    }
}
