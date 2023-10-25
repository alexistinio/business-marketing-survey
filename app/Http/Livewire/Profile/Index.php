<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Services\SurveyService;
use App\Services\UserService;
use App\Traits\Profile\ProfileTrait;
use App\Traits\SweetAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules;

class Index extends Component
{
    use SweetAlert, WithFileUploads, ProfileTrait;

    public $user;
    public $is_followed = false;
    public $validated;

    protected $listeners = ['confirmSave', 'confirmDelete'];

    public function mount($id)
    {
        if (!$id) {
            $this->user = auth()->user();
        } else {
            $this->user = User::with(['details', 'following', 'followers'])->find($id);
        }

        abort_if(!$this->user, 404);

        if ($this->user->details) {
            $this->background_image_display = $this->user->details->background_image;
            $this->profile_image_display = $this->user->details->profile;
        }
    }

    public function render()
    {
        $surveyService = new SurveyService;

        $surveys = $surveyService->getSureysByUser($this->user->id);

        $survey_answers_count = $surveyService->getAllSurveyAnswerCount($surveys);
        $my_answered_surveys = $surveyService->getUserSurveys($this->user->id);

        $this->is_followed = (new UserService)->isFollowed(auth()->user()->id, $this->user->id);

        return view('livewire.profile.index', [
            'surveys' => $surveys,
            'survey_answers_count' => $survey_answers_count,
            'my_answered_surveys' => $my_answered_surveys,
        ]);
    }

    public function save()
    {
        $this->validated = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:dim_users,email,' . auth()->user()->id,
            'link' => 'nullable',
            'gender' => 'nullable|string',
            'phone_no' => 'nullable|digits:11',
            'birthdate' => 'nullable|date',
            'username' => 'required|unique:dim_users,username,' . auth()->user()->id,
            'password' => ['nullable', Rules\Password::defaults()],
            'confirmpassword' => 'required_with:password|same:password',
            'my_bio' => 'nullable',
            'background_image' => 'nullable|image',
            'profile_image' => 'nullable|image'
        ]);

        $this->confirm(
            'Save Changes?',
            'Your changes will be applied',
            [
                'onConfirm' => 'confirmSave'
            ]
        );
    }

    public function confirmSave(UserService $user)
    {

        $this->validated['is_remove_profile'] = $this->is_remove_profile;
        $this->validated['is_remove_background'] = $this->is_remove_background;

        $response = $user->update(auth()->user()->id, $this->validated);

        if ($response['status'] == 404) {
            $this->error("Something wen't wrong", $response['message']);
            return;
        }

        $this->flashSuccess('Updated', $response['message']);
        return redirect(route('profile.index'));
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

    public function follow(UserService $userService)
    {
        $response = $userService->follow(auth()->user()->id, $this->user->id);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->success('Followed', $response['message']);
    }

    public function unfollow(UserService $userService)
    {
        $response = $userService->unfollow(auth()->user()->id, $this->user->id);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->success('Unfollowed', $response['message']);
    }
}
