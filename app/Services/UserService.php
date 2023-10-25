<?php

namespace App\Services;

use App\Events\UserProfileEvent;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserFollow;
use App\Traits\UploadFileTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use UploadFileTrait;

    public function create($validated)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'role_id' => 3,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'username' => $validated['username'],
                'phone_number' => $validated['phone_number'],
                'voucher' => $validated['voucher'],
                'password' => Hash::make($validated['password']),
            ]);

            $details = UserDetails::create([
                'user_id' => $user->id,
                'gender' => isset($validated['gender']) ? $validated['gender'] : null,
                'birthdate' => isset($validated['birthdate']) ? ( $validated['birthdate'] ? date('Y-m-d', strtotime($validated['birthdate'])) : null ) : null,
                'phone_no' => isset($validated['phone_no']) ? $validated['phone_no'] : null,
                'about_me' => isset($validated['my_bio']) ? $validated['my_bio'] : null,
                'website_link' => isset($validated['link']) ? $validated['link'] : null,
            ]);

            if (isset($validated['is_remove_profile'])) {
                if($validated['is_remove_profile'])
                    $user->details()->update(['profile' => null]);
            }

            if (isset($validated['background_image'])) {
                if($validated['background_image'])
                    $user->details()->update(['background_image' => null]);
            }

            if (isset($validated['profile_image'])) {
                if($validated['profile_image']) {
                    $user->details()->updateOrCreate(['user_id' => $user->id], [
                        'profile' => $this->uploadFile($validated['profile_image'], 'profiles'),
                    ]);
                }
            }

            if (isset($validated['background_image'])) {
                if($validated['background_image']) {
                    $user->details()->updateOrCreate(['user_id' => $user->id], [
                        'background_image' => $this->uploadFile($validated['background_image'], 'backgrounds'),
                    ]);
                }
            }

            if(auth()->check()) {
                if(auth()->user()->hasRole('superadmin')) {
                    event(new Registered($user));
                    event(new UserProfileEvent(auth()->user(), $user, "Profile Created", "Profile has been created"));
                }
            }

            DB::commit();

            return response_success('Created Successfully!', ['user' => $user]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    public function update($user_id, $validated)
    {
        try {

            DB::beginTransaction();

            $user = User::find($user_id);

            $user->update([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
          
                
            ]);

            if ($validated['password']) {
                $user->update([
                    'password' => Hash::make($validated['password'])
                ]);
            }

            $user->details()->updateOrCreate(['user_id' => $user_id], [
                'gender' => $validated['gender'],
                'birthdate' => $validated['birthdate'] ? date('Y-m-d', strtotime($validated['birthdate'])) : null,
                'phone_no' => $validated['phone_no'],
                'about_me' => $validated['my_bio'],
                'website_link' => $validated['link'],
            ]);

            if ($validated['is_remove_profile']) {
                $user->details()->update(['profile' => null]);
            }

            if ($validated['background_image']) {
                $user->details()->update(['background_image' => null]);
            }

            if ($validated['profile_image']) {
                $user->details()->updateOrCreate(['user_id' => $user_id], [
                    'profile' => $this->uploadFile($validated['profile_image'], 'profiles'),
                ]);
            }

            if ($validated['background_image']) {
                $user->details()->updateOrCreate(['user_id' => $user_id], [
                    'background_image' => $this->uploadFile($validated['background_image'], 'backgrounds'),
                ]);
            }

            event(new UserProfileEvent($user, auth()->user(), "Profile Update", "Profile has been updated"));

            DB::commit();

            return response_success('Successfully Updated!');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_error($e->getMessage());
        }
    }

    public function follow($user_id, $following_id)
    {
        try {
            DB::beginTransaction();

            if ($this->isFollowed($user_id, $following_id)) {
                return response_success('Already Followed this user');
            }

            $inactive_following = UserFollow::where('user_id', $user_id)
                ->where('following_id', $following_id)
                ->where('status_id', STATUS_INACTIVE)
                ->first();

            if ($inactive_following) {
                $update = $inactive_following->update(['status_id' => STATUS_ACTIVE]);
            } else {
                $follow = UserFollow::create([
                    'user_id' => $user_id,
                    'following_id' => $following_id,
                ]);
            }

            // send following notification
            $following = User::find($following_id);
            $follower = User::find($user_id);
            $message = $follower->name . " has followed you.";

            event(new UserProfileEvent($following, $follower, "Follow", $message));

            DB::commit();

            return response_success('Followed Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_error($e->getMessage());
        }
    }

    public function unfollow($user_id, $following_id)
    {
        try {
            DB::beginTransaction();

            if (!$this->isFollowed($user_id, $following_id)) {
                return response_success('Already Unfollowed this user.');
            }

            $update = UserFollow::where('user_id', $user_id)
                ->where('following_id', $following_id)
                ->update(['status_id' => STATUS_INACTIVE]);

            // send unfollowing notification
            $following = User::find($following_id);
            $follower = User::find($user_id);
            $message = "You unfollow " . $following->name;

            event(new UserProfileEvent($follower, $following, "Unfollow", $message));

            DB::commit();

            return response_success('Successfully Unfollowed user');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_error($e->getMessage());
        }
    }

    public function changeStatus($user_id, $status)
    {
        try {
            
            DB::beginTransaction();

            $user = User::find($user_id);

            if(!$user) {
                return response_error('Invalid User');
            }

            if($status > 2) { // delete
                $user->update([
                    'status_id' => STATUS_INACTIVE,
                    'deleted_at' => now()
                ]);
            }
            else
            {
                $user->update([
                    'status_id' => $status
                ]);
            }

            DB::commit();

            return response_success('Status has been changed');

        } catch (\Exception $e) {
            DB::rollBack();
            return response_error($e->getMessage());
        }
    }

    public function updateRole($user_id, $is_premium)
    {
        try {
            DB::beginTransaction();

            $user = User::find($user_id);

            if(!$user) {
                return response_error('Invalid User');
            }

            $subscription = new SubscriptionService;
            
            $plan = Subscription::where('user_id', $user_id)
            ->whereIn('status_id', $is_premium ? [SUBS_STATUS_PENDING, SUBS_STATUS_CANCELLED, SUBS_STATUS_EXPIRED] : [SUBS_STATUS_ACTIVE])
            ->orderBy('id', 'desc')
            ->first();

            if(!$plan) {
                return response_error("Does not have any subscription or user is already in this state.");
            }

            if($is_premium) {
                $response = $subscription->subscribe($user_id, $plan->plan_id, true);
            }
            else {
                $response = $subscription->unsubscribe($user_id, $plan->plan_id);
            }

            if($response['status'] == 404) {
                return response_error($response['message']);
            }

            DB::commit();

            return response_success('Role has been updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_error($e->getMessage());
        }
    }

    public function isFollowed($user_id, $following_id)
    {
        $user = User::with('following')->find($user_id);
        $followings = $user->following->pluck('following_id')->toArray();

        return in_array($following_id, $followings);
    }
}
