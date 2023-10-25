<?php

namespace App\Http\Livewire\Group;

use App\Models\Category;
use App\Services\GroupService;
use App\Services\SurveyService;
use App\Traits\SweetAlert;
use Livewire\Component;

class View extends Component
{
    use SweetAlert;

    public $group;

    public $is_joined_group = false;

    public $comments = [];

    protected $listeners = [
        'confirmJoinGroup',
        'confirmLeaveGroup',
        'confirmDelete'
    ];

    public function mount($id)
    {
        $this->group = Category::active()->where('id', $id)->first();
        abort_if(! $this->group, 404);

        $groupService = new GroupService;

        $this->is_joined_group = $groupService->isJoined($id, auth()->user()->id);
    }

    public function render()
    {
        $surveyService = new SurveyService;
        $surveys = [];
        $survey_answers_count = null;
        $my_answered_surveys = null;

        if ($this->is_joined_group) {
            $surveys = $surveyService->getSurveysByGroup($this->group->id);
            $survey_answers_count = $surveyService->getAllSurveyAnswerCount($surveys);
            $my_answered_surveys = $surveyService->getUserSurveys(auth()->user()->id);
        }

        return view('livewire.group.view', [
            'surveys' => $surveys,
            'survey_answers_count' => $survey_answers_count,
            'my_answered_surveys' => $my_answered_surveys,
        ]);
    }

    public function joinGroup()
    {
        $this->confirm('Join Group?', 'You will be joining to this group', [
            'onConfirm' => 'confirmJoinGroup',
        ]);
    }

    public function confirmJoinGroup()
    {
        $groupService = new GroupService;
        $response = $groupService->joinGroup($this->group->id, auth()->user()->id);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->flashSuccess('Joined Group', $response['message']);

        return redirect(route('group.view', ['id' => $this->group->id]));
    }

    public function leaveGroup()
    {
        $this->confirm('Leave Group?', 'You will be leaving to this group', [
            'onConfirm' => 'confirmLeaveGroup',
        ]);
    }

    public function confirmLeaveGroup()
    {
        $groupService = new GroupService;
        $response = $groupService->leaveGroup($this->group->id, auth()->user()->id);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->flashSuccess('Leave Group', $response['message']);

        return redirect(route('group.view', ['id' => $this->group->id]));
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

    public function postComment($survey_id)
    {
        $comment = $this->comments[$survey_id];

        $surveyService = new SurveyService;
        $response = $surveyService->addComment($survey_id, auth()->user()->id, $comment);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->comments[$survey_id] = null;
    }
}
