<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\User;
use App\Services\UserService;
use App\Traits\SweetAlert;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, SweetAlert;

    protected $listeners = [
        'confirmUpdateStatus',
        'confirmUpdateRole'
    ];

    public $search_key = '';

    public function render()
    {
        $allData = User::all();
        $users = DB::table('dim_users as a')
        ->select([
            'a.*',
            'b.phone_no',
            'c.start_timestamp',
            'c.end_timestamp',
            'c.status_id as subscription_status',
            'd.points',
            'd.request',
        ])
        ->leftJoin('fct_user_details as b', 'a.id', '=', 'b.user_id')
        ->leftJoin('fct_subscriptions as c', 'c.user_id', '=', 'a.id')
        ->leftJoin('points as d', 'd.user_id', '=', 'a.id')
        ->where('a.role_id', '<>', ROLE_ADMIN_USER)
        ->where('a.deleted_at', null)
        ->orderBy('a.created_at', 'desc')
        ->searchMultiple([
            'name',
            'email',
            'phone_no'
        ], $this->search_key)
        ->paginate(10);

        return view('livewire.user-management.index', [
            'users' => $users,
            'allData' => $allData,
        ]);
    }

    public function updateStatus($user_id, $status_id)
    {
        $this->confirm('Are you sure?', $status_id > 2 ? 'Cannot be Undone' : 'Status of the user will be change', 
        [
            'onConfirm' => 'confirmUpdateStatus',
            'params' => [
                'user_id' => $user_id,
                'status_id' => $status_id
            ],
        ]);
    }

    public function confirmUpdateStatus($params, UserService $user)
    {
        $user_id = $params['user_id'];
        $status_id = $params['status_id'];

        $response = $user->changeStatus($user_id, $status_id);

        if ($response['status'] == 404) {
            return $this->error('Oopps!', $response['message']);
        }

        $this->success('Saved Changes', $response['message']);
    }

    public function updateRole($user_id, $is_premium)
    {
        $this->confirm('Are you sure?', "Update user role, previous subscription will be cancelled.", 
        [
            'onConfirm' => 'confirmUpdateRole',
            'params' => [
                'user_id' => $user_id,
                'is_premium' => (bool)$is_premium
            ],
        ]);
    }

    public function confirmUpdateRole($params, UserService $user) 
    {
        $user_id = $params['user_id'];
        $is_premium = $params['is_premium'];

        $response = $user->updateRole($user_id, $is_premium);

        if($response['status'] == 404) {
            return $this->error('Oopps!', $response['message']);
        }

        $this->success('Saved Changes', $response['message']);
    }
}
