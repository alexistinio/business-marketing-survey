<?php

namespace App\Http\Livewire\UserManagement;

use App\Services\UserService;
use App\Traits\Profile\ProfileTrait;
use App\Traits\SweetAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules;

class Create extends Component
{
    use SweetAlert, WithFileUploads, ProfileTrait;

    public $user;
    public $validated;

    protected $listeners = [ 'confirmSave' ];

    public function render()
    {
        return view('livewire.user-management.create');
    }

    public function save()
    {
        $this->validated = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:dim_users,email',
            'link' => 'nullable',
            'gender' => 'required|string',
            'phone_no' => 'required|digits:11',
            'birthdate' => 'required|date',
            'username' => 'required|unique:dim_users,username',
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

        $response = $user->create($this->validated);

        if ($response['status'] == 404) {
            $this->error("Something wen't wrong", $response['message']);
            return;
        }

        $this->flashSuccess('Created', $response['message']);
        
        return redirect(route('user-management.index'));
    }
}
