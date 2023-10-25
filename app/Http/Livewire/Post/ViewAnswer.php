<?php

namespace App\Http\Livewire\Post;


use App\Models\Survey;
use App\Charts\SurveyChart;
use App\Services\SurveyService;
use Livewire\Component;
use Illuminate\Http\Request;

class ViewAnswer extends Component
{
  
public $survey;
  
    
    public function render(Request $request)
    {

        $id = $request->id;
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
        $this->survey->answer_count_per_choice = $surveyService->getSurveyAnswersPerChoice($this->survey->answers, $this->survey->total_answered_users);


   
           
         return view ('livewire.post.view-answer'); 
    }


    public function index(Request $request, $post_id)
    {
        $surveyService = new SurveyService;
        if (!$surveyService->isSurveyExists($post_id)) {
            abort(404);
        }

        $this->survey = Survey::with('groups', 'questions')
            ->where('status_id', STATUS_ACTIVE)
            ->where('deleted_at', null)
            ->find($post_id);


        $this->survey->answered_users = $surveyService->getDistinctAnsweredUsers($this->survey->id);
        $this->survey->total_answered_users = $surveyService->getSurveyAnswerCount($this->survey);
        $this->survey->choice_percentage = $surveyService->getSurveyAnswersPercentage($this->survey->answers, $this->survey->total_answered_users);
        $this->survey->answer_count_per_choice = $surveyService->getSurveyAnswersPerChoice($this->survey->answers, $this->survey->total_answered_users);

       
        // Bar Graph

        $surveyChart = new SurveyChart;
       
           
            foreach($this->survey->questions as $questions){
                $surveyChart->title($questions->question);
                foreach($questions->choices as $showChoices){
                
                    $labels[] = $showChoices->choice;
                    $surveyChart->labels($labels);

                   
                    }
                  
                    foreach($questions->choices as $showChoices){
                        $dataSet[] = $this->survey->answer_count_per_choice[$questions->id][$showChoices->id] ?? 0;
                        }
                        $surveyChart->dataset('Graph', 'bar', $dataSet)->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']))->color('dodgerblue');
  
            } 
          

           /* @forelse ($survey->questions as $question)
            <div class="flex flex-col mb-4 border-l-4 pl-4 border-green-500">
                <div>
                    <span>{{$loop->iteration.'.'}}</span>
                    <span>{{ $question->question }}</span>
                </div>
                <div class="pl-8">
                    @forelse ($question->choices as $choice)
                    <div class="flex gap-4 items-center mb-4 mt-2">
                        <div class="w-4/12 bg-gray-200 rounded-full">
                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width:{{ $survey->choice_percentage[$question->id][$choice->id] ?? 0 }}%">
                                
                                @if(($survey->choice_percentage[$question->id][$choice->id] ?? 0) == 0)
                                    <span class="text-gray-700 pl-2">{{ $survey->choice_percentage[$question->id][$choice->id] ?? 0 }}%</span>
                                @else
                                    {{ $survey->choice_percentage[$question->id][$choice->id] ?? 0 }}%
                                @endif
                            </div>
                        </div>
                        <label class="block ml-2 text-sm font-medium text-gray-900">
                            {{ $choice->choice }}
                        </label>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        @empty
        @endforelse

        */
               
     
                
         
        return view('view.post.view-answer', compact('post_id','surveyChart'));
    }

    public function getGraph(Request $request, $post_id, $graph)
    {

        $surveyService = new SurveyService;
        if (!$surveyService->isSurveyExists($post_id)) {
            abort(404);
        }

        $this->survey = Survey::with('groups', 'questions')
            ->where('status_id', STATUS_ACTIVE)
            ->where('deleted_at', null)
            ->find($post_id);


        $this->survey->answered_users = $surveyService->getDistinctAnsweredUsers($this->survey->id);
        $this->survey->total_answered_users = $surveyService->getSurveyAnswerCount($this->survey);
        $this->survey->choice_percentage = $surveyService->getSurveyAnswersPercentage($this->survey->answers, $this->survey->total_answered_users);
        $this->survey->answer_count_per_choice = $surveyService->getSurveyAnswersPerChoice($this->survey->answers, $this->survey->total_answered_users);

        // Line Graph

        $surveyChart1 = new SurveyChart;

        foreach($this->survey->questions as $questions){
            $surveyChart1->title($questions->question);
            foreach($questions->choices as $showChoices){
            
                $labels[] = $showChoices->choice;
                $surveyChart1->labels($labels);

               
                }
              
                foreach($questions->choices as $showChoices){
                    $dataSet[] = $this->survey->answer_count_per_choice[$questions->id][$showChoices->id] ?? 0;
                }
                    if($graph == 'line'){

                        $surveyChart1->dataset('Graph', 'line',  $dataSet)->color('dodgerblue');
                    }
                    else if($graph == 'doughnut'){
                        $surveyChart1->dataset('Graph', 'doughnut',  $dataSet)->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']));
                    }
                    else if($graph == 'pie'){
                        $surveyChart1->dataset('Graph', 'pie',  $dataSet)->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']));
                    }
                    else if($graph == 'radar'){
                        $surveyChart1->dataset('Graph', 'radar',  $dataSet)->color('dodgerblue');
                    }
                    
                    else{
                        $surveyChart1->dataset('Graph', 'bar',  $dataSet)->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']))->color('dodgerblue');
                    }
        } 
        
         return view('view.post.view-answer', compact('post_id','surveyChart1'));

    }


}
