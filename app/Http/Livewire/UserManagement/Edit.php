<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\User;
use App\Services\UserService;
use App\Traits\Profile\ProfileTrait;
use App\Traits\SweetAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules;

class Edit extends Component
{
    use SweetAlert, WithFileUploads, ProfileTrait;

    public $user;
    public $validated;

    protected $listeners = [ 'confirmSave' ];

    public function mount($id)
    {
        $user = User::with('details')->find($id);
        abort_if(!$user, 404);

        if($user->hasRole('superadmin')) {
            abort(404);
        }

        $this->user = $user;

        if($user->details) {
            $this->background_image_display = $user->details->background_image;
            $this->profile_image_display = $user->details->profile;
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->link = ($user->details ?? null)->website_link ?? null;
        $this->gender = ($user->details ?? null)->gender ?? null;
        $this->birthdate = ($user->details ?? null)->birthdate ?? null;
        $this->phone_no = ($user->details ?? null)->phone_no ?? null;
        $this->username = $user->username;
        $this->my_bio = ($user->details ?? null)->about_me ?? null;
    }

    public function render()
    {
        return view('livewire.user-management.edit');
    }

    public function save()
    {
        $this->validated = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:dim_users,email,' . $this->user->id,
            'link' => 'nullable',
            'gender' => 'required|string',
            'phone_no' => 'required|digits:11',
            'birthdate' => 'required|date',
            'username' => 'required|unique:dim_users,username,' . $this->user->id,
            'my_bio' => 'nullable',
            'background_image' => 'nullable|image',
            'profile_image' => 'nullable|image',
            'password' => ['nullable', Rules\Password::defaults()],
            'confirmpassword' => 'required_with:password|same:password',
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

        $response = $user->update($this->user->id, $this->validated);

        if ($response['status'] == 404) {
            $this->error("Something wen't wrong", $response['message']);
            return;
        }

        $this->flashSuccess('Updated', $response['message']);
        return redirect(route('user-management.index'));
    }
}
