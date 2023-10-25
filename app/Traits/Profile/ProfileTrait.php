<?php

namespace App\Traits\Profile;

trait ProfileTrait {

    public $is_edit_profile;

    public $background_image;
    public $profile_image;
    public $background_image_display;
    public $profile_image_display;
    public $is_remove_profile = false;
    public $is_remove_background = false;

    public $name;
    public $email;
    public $link;
    public $birthdate;
    public $phone_no;
    public $username;
    public $password;
    public $confirmpassword;
    public $gender;
    public $my_bio;

    // for own profile only
    public function updatedIsEditProfile($value)
    {
        $user = auth()->user();

        if(!$value) {

            if($user->details) {
                $this->background_image_display = $user->details->background_image;
                $this->profile_image_display = $user->details->profile;
            }

            return false;
        }
        
        $this->name = $user->name;
        $this->email = $user->email;
        $this->link = ($user->details ?? null)->website_link ?? null;
        $this->gender = ($user->details ?? null)->gender ?? null;
        $this->birthdate = ($user->details ?? null)->birthdate ?? null;
        $this->phone_no = ($user->details ?? null)->phone_no ?? null;
        $this->username = $user->username;
        $this->my_bio = ($user->details ?? null)->about_me ?? null;

        $this->dispatchBrowserEvent('editing-profile');
    }

    public function removeProfile()
    {
        if($this->profile_image){
            $this->reset('profile_image');
        }
        else
        {
            $this->is_remove_profile = true;
            $this->reset('profile_image_display');
        }
    }

    public function removeBackground()
    {
        if($this->background_image) {
            $this->reset('background_image');
        }
        else
        {
            $this->is_remove_background = true;
            $this->reset('background_image_display'); 
        }
    }
}