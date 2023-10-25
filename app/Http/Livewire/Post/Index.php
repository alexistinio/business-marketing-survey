<?php

namespace App\Http\Livewire\Post;


use App\Models\Survey;
use App\Models\GraphTypes;
use App\Charts\SurveyChart;
use App\Services\SurveyService;
use Livewire\Component;
use Illuminate\Http\Request;

class Index extends Component
{
    public $survey;
    public $graphtype = '';

    public function mount($id)
    {

       
        $surveyService = new SurveyService;
        if (!$surveyService->isSurveyExists($id)) {
            abort(404);
        }

        $this->survey = Survey::with('groups', 'questions')
            ->where('status_id', STATUS_ACTIVE)
            ->where('deleted_at', null)
            ->find($id);


        $this->survey->answered_users = $surveyService->getDistinctAnsweredUsers($this->survey->id);
        $this->survey->total_answered_users = $surveyService->getSurveyAnswerCount($this->survey);
        $this->survey->choice_percentage = $surveyService->getSurveyAnswersPercentage($this->survey->answers, $this->survey->total_answered_users);
  

    }

    public function render()
    {
       
        $graphs = GraphTypes::all();
        $surveyChart = new SurveyChart;

        foreach($this->survey->questions as $questions){
            $surveyChart->title($questions->question);
            foreach($questions->choices as $showChoices){
            
                $labels[] = $showChoices->choice;
                $surveyChart->labels($labels);
                
                }
        } 

        if($this->graphtype=='bar'){
        $surveyChart->dataset('Graph', 'bar', [1, 5, 5])->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']));
        }
        else{
            $surveyChart->dataset('Graph', 'line', [1, 5, 5])->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']));
        }
    
        return view('livewire.post.index', [ 'surveyChart' => $surveyChart, 'graphs' => $graphs ]);   
    }

   
}
