<?php

namespace App\Services;

use App\Models\Category;
use App\Models\UserGroup;
use Illuminate\Support\Facades\DB;

class GroupService
{
    public function joinGroup($group_id, $user_id)
    {
        try {
            DB::beginTransaction();

            if ($this->isJoined($group_id, $user_id)) {
                return response_success('Joind Group Successfully!.');
            }

            UserGroup::create([
                'user_id' => $user_id,
                'group_id' => $group_id,
            ]);

            DB::commit();

            return response_success('Joind Group Successfully!.');
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    public function leaveGroup($group_id, $user_id)
    {
        try {
            DB::beginTransaction();
            if (! $this->isJoined($group_id, $user_id)) {
                return response_error('Invalid Transaction, you are not joined in this group');
            }

            UserGroup::where('user_id', $user_id)
            ->where('group_id', $group_id)
            ->update(['status_id' => STATUS_INACTIVE]);

            DB::commit();

            return response_success('Leave Group Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    public function getAllGroups()
    {
        return Category::active()->get();
    }

    public function getUserGroups($user_id)
    {
        return UserGroup::active()->where('user_id', $user_id)->get();
    }

    public function isJoined($group_id, $user_id)
    {
        return UserGroup::active()->where('group_id', $group_id)
        ->where('user_id', $user_id)
        ->exists();
    }
}
