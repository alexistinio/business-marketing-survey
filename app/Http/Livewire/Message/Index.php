<?php

namespace App\Http\Livewire\Message;

use App\Models\Message;
use App\Models\User;
use App\Services\ChatService;
use Livewire\Component;

class Index extends Component
{
    public $search_name = null;

    public $user_to = null;
    public $user_to_id = null;
    public $chat_room_key = null;


    public function mount($id)
    {
        $user_to = User::find($id);

        if ($user_to) {
            $chatService = new ChatService;

            $this->user_to = $user_to;
            $this->user_to_id =  $id;
            $this->chat_room_key = $chatService->getChatRoomKey(auth()->user()->id, $id);

            $chat_room = $chatService->getChatRoom(auth()->user()->id, $this->user_to_id);

            if (!$chatService->chatRoomExists(auth()->user()->id, $this->user_to_id)) {
                $chatroom = $chatService->createRoom(auth()->user()->id, $this->user_to_id);
                $this->chat_room_key = $chatroom->chat_id;
            } else {
                $this->chat_room_key = $chatService->getChatRoomKey(auth()->user()->id, $user_to->id);
            }
        }
    }

    public function render()
    {
        $chatService = new ChatService;

        if ($this->search_name) {
            $users_lists = $this->search_name ? User::where('role_id', '<>', ROLE_ADMIN_USER)
                ->where('id', '<>', auth()->user()->id)
                ->search('name', $this->search_name)
                ->get() : [];
        } else {
            $inbox = Message::select('user_id_from')
                ->orWhere('user_id_to', auth()->user()->id)
                ->groupBy('user_id_from')
                ->get();

            $sent = Message::select('user_id_to')
                ->orWhere('user_id_from', auth()->user()->id)
                ->groupBy('user_id_to')
                ->get();

            $lists = $sent->concat($inbox);

            $users_lists = collect();
            $temp_list = [];
            foreach ($lists as $list) {

                if (in_array($list->user_id_from ?? null, $temp_list) || in_array($list->user_id_to ?? null, $temp_list)) {
                    continue;
                }

                array_push($temp_list, ($list->user_id_from ?? null) ?? $list->user_id_to ?? null);
                $users_lists->push($list);
            }
        }

        $chat_room = $chatService->getChatRoom(auth()->user()->id, $this->user_to_id);
        $latest_messages = $chat_room ? Message::where('chat_room_id', $chat_room->id)->get() : [];

        return view('livewire.message.index', [
            'users_lists' => $users_lists,
            'latest_messages' => $latest_messages
        ]);
    }

    public function updatedUserToId($val)
    {
        $user_to = User::find($val);

        if (!$user_to) return;

        $chatService = new ChatService;

        if (!$chatService->chatRoomExists(auth()->user()->id, $user_to->id)) {
            $chatroom = $chatService->createRoom(auth()->user()->id, $user_to->id);
            $this->chat_room_key = $chatroom->chat_id;
        } else {
            $this->chat_room_key = $chatService->getChatRoomKey(auth()->user()->id, $user_to->id);
        }

        $this->user_to = $user_to ? $user_to : null;
        $this->user_to_id = $user_to ? $val : null;

        $this->dispatchBrowserEvent('update_user_to');
    }
}
