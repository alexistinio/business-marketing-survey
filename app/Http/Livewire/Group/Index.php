<?php

namespace App\Http\Livewire\Group;

use App\Services\GroupService;
use App\Traits\SweetAlert;
use Livewire\Component;

class Index extends Component
{
    use SweetAlert;

    protected $listeners = ['confirmLeaveGroup'];

    public function render()
    {
        $groupService = new GroupService;

        $datas = [
            'groups' => $groupService->getAllGroups(),
            'my_groups' => $groupService->getUserGroups(auth()->user()->id)->pluck('group_id'),
        ];

        return view('livewire.group.index', $datas);
    }

    public function leaveGroup($group_id)
    {
        $this->confirm('Leave Group?', 'You will be leaving to this group', [
            'onConfirm' => 'confirmLeaveGroup',
            'params' => ['group_id' => $group_id],
        ]);
    }

    public function confirmLeaveGroup($params)
    {
        extract($params);

        $groupService = new GroupService;
        $response = $groupService->leaveGroup($group_id, auth()->user()->id);

        if ($response['status'] == 404) {
            return $this->error("Somthine wen't wrong", $response['message']);
        }

        $this->flashSuccess('Leave Group', $response['message']);

        return redirect(route('group'));
    }
}
