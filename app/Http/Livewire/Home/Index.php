<?php

namespace App\Http\Livewire\Home;

use App\Models\Category;
use App\Models\Point;
use App\Models\Survey;

use App\Services\SurveyService;
use App\Traits\SweetAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Index extends Component
{
    use SweetAlert, AuthorizesRequests;

    protected $listeners = [
        'confirmDelete',
    ];

    public function render()
    {
        $surveyService = new SurveyService();
      
        $surveys = $surveyService->getSurveys();
        $survey_answers_count = $surveyService->getAllSurveyAnswerCount($surveys);
        $my_answered_surveys = $surveyService->getUserSurveys(auth()->user()->id);

        $points = Point::orderBy('points','desc')->paginate(3);
        $survey_count = Survey::paginate(3);

        $categories = Category::withCount('posts')
            ->limit(3)
            ->orderBy('posts_count', 'desc')
            ->get();

    
        $datas = [
            'surveys' => $surveys,
            'survey_count' => $survey_count,
            'survey_answers_count' => $survey_answers_count,
            'my_answered_surveys' => $my_answered_surveys,
            'categories' => $categories,
            'points' => $points,
        ];

     

        return view('livewire.home.index', $datas);
    }

    public function delete($survey_id = null)
    {
        $this->confirm('Are you sure?', "Once deleted, your post won't recovered", [
            'onConfirm' => 'confirmDelete',
            'params' => ['survey_id' => $survey_id],
        ]);
    }

    public function confirmDelete(SurveyService $surveyService, $params)
    {
        $response = $surveyService->delete($params['survey_id'] ?? null);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->success('Deleted!', 'Successfully Deleted!');
    }
}
