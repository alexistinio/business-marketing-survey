<div class="w-full px-4">
    <x-loading />
    <div class="container mx-auto">
        <div class="min-w-full border rounded-xl lg:grid lg:grid-cols-3 bg-white h-auto min-h-[75vh] shadow-xl">
          <div class="border-r border-gray-300 lg:col-span-1">
            <div class="mx-3 my-3">
              <div class="relative text-gray-600">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                </span>
                <input wire:model.debounce.500ms='search_name' type="search" class="block w-full py-2 pl-10 bg-gray-100 rounded outline-none" name="search"
                  placeholder="Search by Name" required />
              </div>
            </div>
  
            <ul class="overflow-auto h-auto pb-4">
              <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Users</h2>
              <li>
                @forelse ($users_lists as $users_list)
                    @if($search_name)
                        @if($users_list->id !== auth()->user()->id)
                            <a data-id="{{ $users_list->id }}"
                            class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none user-list">
                                <img class="object-cover w-10 h-10 rounded-full"
                                    src="{{ ($users_list->details ?? null )->profile ?? null ? asset('storage/'. ($users_list->details ?? null )->profile ?? null ) : asset('images/default-profile-2.svg') }}" alt="username" />
                                <div class="w-full pb-2">
                                    <div class="flex justify-between">
                                    <span class="block ml-2 font-semibold text-gray-600">{{ $users_list->name }}</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @else
                        @if( ($users_list->user_to ?? $users_list->user_from)->id !== auth()->user()->id)
                            <a data-id="{{ ($users_list->user_to ?? $users_list->user_from)->id }}"
                            class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none user-list">
                                <img class="object-cover w-10 h-10 rounded-full"
                                    src="{{ (($users_list->user_to ?? $users_list->user_from)->details ?? null )->profile ?? null ? asset('storage/'. (($users_list->user_to ?? $users_list->user_from)->details ?? null )->profile ?? null ) : asset('images/default-profile-2.svg') }}" alt="username" />
                                <div class="w-full pb-2">
                                    <div class="flex justify-between">
                                    <span class="block ml-2 font-semibold text-gray-600">
                                        {{ ($users_list->user_to ?? $users_list->user_from)->name }}
                                        <span class="user-message-badge" data-id="{{ ($users_list->user_to ?? $users_list->user_from)->id }}"></span>
                                    </span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endif
                @empty
                    <div class="flex justify-center">
                        No Chats Available
                    </div>
                @endforelse
              </li>
            </ul>

           
          </div>

          <div class="hidden lg:col-span-2 lg:block">
            @if($user_to)
                <div class="w-full" id="user-to-wrapper" data-id="{{ $user_to->id }}">
                <div class="relative flex items-center p-3 border-b border-gray-300">
                    <img class="object-cover w-10 h-10 rounded-full"
                    src="{{ ($user_to->details ?? null )->profile ?? null ? asset('storage/'. ($user_to->details ?? null )->profile ?? null ) : asset('images/default-profile-2.svg') }}" alt="username" />
                    <span class="block ml-2 font-bold text-gray-600">{{ $user_to->name }}</span>
                    {{-- <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3"> --}}
                    </span>
                </div>
                <div class="relative w-full p-6 overflow-y-auto h-[55vh]" id="messages-board-wrapper">
                    <ul class="space-y-2" id="messages-board" data-id="{{ $user_to->id }}">
                        @forelse ($latest_messages as $latest_message)
                            @if($latest_message->user_id_from == auth()->user()->id)
                                <li class="flex justify-end">
                                    <div class="relative max-w-xl px-4 py-2 text-white bg-blue-400 rounded shadow">
                                        <span class="block">{{ $latest_message->message }}</span>
                                    </div>
                                </li>
                            @else
                                <li class="flex justify-start">
                                    <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow">
                                        <span class="block">{{ $latest_message->message }}</span>
                                    </div>
                                </li>
                            @endif
                        @empty
                        @endforelse
                    </ul>
                    <div id='whisper-wrapper' class="flex justify-center">
                    </div>
                </div>
                <form method="POST" id="send-message-form">
                    @csrf
                    <div class="flex items-center justify-between w-full p-3 border-t border-gray-300">
                        
                        <input type="text" placeholder="Message" name="message" id="message-txtbox"
                        class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                        name="message" required />
                        
                        <button type="submit">
                        <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                        </button>
                    </div>
                </form>
                </div>
            @else
                <x-empty-state title="Message" description="Please select user to message" />
            @endif
          </div>
        </div>
      </div>
</div>


@push('js')
<script type="text/javascript">

    document.addEventListener('livewire:load', (e) => {
        scrollTop()
        
        let chat_room_key = @this.chat_room_key
        let channel_instance = null

        if(chat_room_key) {
            channel_instance = initChat(chat_room_key);
            initUserListEvent(channel_instance);
        }
        
        initUserLists();
    });

    document.addEventListener('livewire:update', function() {
        initUserLists();
    });

    document.addEventListener('update_user_to', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        
        chat_room_key = @this.chat_room_key
        channel_instance = initChat(chat_room_key);
        initUserListEvent(channel_instance);
        scrollTop()
    });

    function initUserLists()
    {
        const user_list = document.getElementsByClassName('user-list');
        if(user_list) {
            [...user_list].forEach((evt) => evt.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                let user_id = this.dataset.id;
                
                if(@this.user_to_id == user_id) {
                    return;
                }
                @this.user_to_id = user_id;
            }));            
        }
    }

    function createSentMessageCard(message)
    {
        let li = document.createElement("li");
        li.className = 'flex justify-end';

        let div = document.createElement('div');
        div.className = 'relative max-w-xl px-4 py-2 text-white bg-blue-400 rounded shadow';

        let span = document.createElement('span');
        span.className = 'block';
        span.innerText = message;

        div.appendChild(span);
        li.appendChild(div);

        return li;
    }

    function createRecieveMessageCard(message)
    {
        let li = document.createElement("li");
        li.className = 'flex justify-start';

        let div = document.createElement('div');
        div.className = 'relative max-w-xl px-4 py-2 text-gray-700 rounded shadow';

        let span = document.createElement('span');
        span.className = 'block';
        span.innerText = message;

        div.appendChild(span);
        li.appendChild(div);

        return li;
    }

    function initChat(chat_room_key)
    {
        let channel = null; 
              
        // listen events from other enf
        if(chat_room_key) {
            channel = window.Echo.private(`chat.${chat_room_key}`)
            .listen('.message', (event) => {
                
                let msg_board = document.querySelector('#messages-board[data-id="'+event.user.id+'"]');
                
                if(msg_board) {
                    let message_el = createRecieveMessageCard(event.message);
                    msg_board.append(message_el);
                }

            })
            .listenForWhisper('typing', (e) => {
                let whisper_el = document.getElementById('whisper-wrapper');
                let el = document.createElement('span');
                el.classNmae = 'text-gray-200 italic';
                el.innerText = 'Typing...';
                
                whisper_el.innerHTML='';
                whisper_el.append(el);

                scrollTop();

                setTimeout((e) => {
                    whisper_el.innerHTML='';
                }, 2000);

            });
        }

        return channel;
    }

    function initUserListEvent(channel)
    {
        // send message
        let form_el = document.getElementById('send-message-form');
            
        if(form_el) {
            let message_txtbox = document.getElementById('message-txtbox');

            // send whisper
            message_txtbox.addEventListener('input', function() {
                channel.whisper('typing', {
                    typing: true
                });
            });
            
            form_el.addEventListener('submit', (e) => {
                e.preventDefault();
                e.stopImmediatePropagation();

                if(!message_txtbox.value.trim()) return;

                window.axios.post('/send-message', {
                    user_to: @this.user_to_id,
                    message: message_txtbox.value
                })
                .then((response) => {
                    
                    if(response.status == 200) {
                        let msg_board = document.getElementById('messages-board');
                        let message_el = createSentMessageCard(message_txtbox.value);
                        
                        msg_board.append(message_el);
                        message_txtbox.value= ''

                        scrollTop();
                    }
                })
                .catch((e) => {
                    console.log(e);
                });
            });
        }
    }

    function readMessage(chat_room_id)
    {
        window.axios.post('/read-message', {
            chat_room_id: chat_room_id 
        })
        .then((e) => {})
        .catch((e) => {
            console.log(e);
        });
    }


    function scrollTop()
    {
        let messages_board_wrapper = document.getElementById('messages-board-wrapper');
        if(messages_board_wrapper)
            messages_board_wrapper.scrollTop = messages_board_wrapper.scrollHeight + 10;
    }
    
</script>   
@endpush