<div>
   <x-loading />

   <div class="flex flex-col xl:flex-row gap-4 ">
        <div class="w-11/12 sm:w-11/12 md:w-8/12 xl:w-5/12 sticky top-2 self-center xl:self-start">
            <div class="card w-full h-96 bg-base-100 shadow-xl image-full">
                <figure><img src="{{ asset('images/'.$group->image) }}" alt="Shoes" /></figure>
                <div class="card-body">
                    <h2 class="card-title text-white">{{ $group->title }}</h2>
                    <p class="">{{ $group->description }}</p>
                    
                    <div class="card-actions justify-end">
                        @if ($is_joined_group)
                            <button wire:click='leaveGroup' class="btn btn-error text-white btn-sm normal-case">Leave Group</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mt-8 xl:mt-0 xl:w-6/12">
            @if(!$is_joined_group)
                <div class="flex flex-col items-center justify-center h-full">
                    <svg class="w-34 h-34 fill-gray-700" width="56" height="56" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z"/></svg>
                    <h1 class="mt-4 text-gray-600 font-bold text-2xl">
                        Content Locked
                    </h1>
                    <h3 class="text-gray-500 text-sm text-center">You must join this group first to answer private surveys posted on this group</h3>
                    <button wire:click="joinGroup" class="mt-4 normal-case inline-flex items-center btn btn-primary btn-outline rounded-full">
                        Join Group
                    </button>
                </div>
            @else
                <div class="mb-5">
                    <h1 class="text-xl font-bold">Posts</h1>
                </div>
                @forelse ($surveys as $survey)
                    <div class="card card-compact w-full bg-base-100 shadow-md mb-5 rounded-md overflow-visible">
                        <div class="card-body">
                            <div class="flex items-center justify-between">
                                {{--  Header--}}
                                <div class="flex items-center">
                                    {{-- profile image --}}
                                    <a href="{{ route('profile.index', ['id' => $survey->user_id]) }}">
                                    <img class="h-12 w-12 rounded-full object-cover" 
                                src="{{ $survey->postedBy->details ? asset('storage/'.$survey->postedBy->details->profile) : asset('images/default-profile-2.svg') }}"/>
                                    </a>

                                    <div class="ml-2">
                                        <div class="text-sm ">
                                            <a href="{{ route('profile.index', ['id' => $survey->user_id]) }}">
                                                <span class="font-semibold">{{ $survey->postedBy->name }}</span>
                                            </a>
                                        </div>
                                        <div class="text-gray-500 text-xs ">
                                            Posted {{ $survey->created_at->diffForHumans() }}
                                        </div>
                                        <div class="text-gray-500 text-xs flex">
                                            <span class="inline-block">Until • {{ date('M d, Y', strtotime($survey->end_date)) }} • </span>
                                            @if($survey->is_private)
                                                <svg class="inline-block ml-1 fill-current hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="true">
                                                    <title id="unique-id">Private</title>
                                                    <path d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z"/>
                                                </svg>
                                            @else
                                                <svg class="inline-block ml-1 fill-current hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" class="mercado-match" width="16" height="16" focusable="true">
                                                    <title id="unique-id">Public</title>
                                                    <path d="M8 1a7 7 0 107 7 7 7 0 00-7-7zM3 8a5 5 0 011-3l.55.55A1.5 1.5 0 015 6.62v1.07a.75.75 0 00.22.53l.56.56a.75.75 0 00.53.22H7v.69a.75.75 0 00.22.53l.56.56a.75.75 0 01.22.53V13a5 5 0 01-5-5zm6.24 4.83l2-2.46a.75.75 0 00.09-.8l-.58-1.16A.76.76 0 0010 8H7v-.19a.51.51 0 01.28-.45l.38-.19a.74.74 0 01.68 0L9 7.5l.38-.7a1 1 0 00.12-.48v-.85a.78.78 0 01.21-.53l1.07-1.09a5 5 0 01-1.54 9z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Options --}}
                                <div>
                                    @if($survey->postedBy->id == auth()->user()->id)
                                        <div class="dropdown dropdown-end">
                                            <label tabindex="0" class="hover:cursor-pointer">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                            </label>
                                            <ul tabindex="0" class="dropdown-content border border-slate-200 menu p-2 shadow-xl bg-base-100 rounded-box w-52">
                                                <li><a href="{{ route('post.edit', ['id' => $survey->id]) }}">Edit</a></li>
                                                <li><a href="{{ route('post.view-answers', ['id' => $survey->id]) }}">View Answers</a></li>
                                                <li>
                                                    <button wire:click="delete('{{$survey->id}}')" class="border border-red-400 rounded-md hover:bg-red-400 hover:text-white hover:font-bold mt-2">
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        @if($my_answered_surveys->contains('survey_id', $survey->id))
                                            <a href="{{ route('post.answer', ['id' => $survey->id]) }}" title="View Answers">
                                                <button class="flex gap-2 items-center btn btn-success btn-sm text-white normal-case" title="View Answers">
                                                    <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"/></svg>
                                                    <span class="text-sm">Answered</span>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('post.answer', ['id' => $survey->id]) }}">
                                                <button class="btn btn-outline btn-primary btn-sm normal-case font-bold">Take a Survey</button>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                
                            </div>

                            <p class="card-title mt-4 text-lg">{{ $survey->title }}</p>
                            <div>
                                {!! $survey->description !!}
                            </div>
                            <div class="text-gray-500 text-xs flex items-center mt-3">
                                <img class="mr-0.5" src="https://static-exp1.licdn.com/sc/h/5thsbmikm6a8uov24ygwd914f"/>
                                <span class="ml-1">{{ $survey_answers_count[$survey->id] ?? 0 }} Answers</span>
                            </div>
                        </div>
                        <hr>
                        @if(auth()->user()->role_id != 3)
                        <div class="flex flex-col gap-2 p-4">
                            @forelse ($survey->comments as $comment)
                                <div class="card bg-gray-100 rounded border border-gray-300">
                                    <div class="card-body p-0">
                                        <span class="font-bold" style="font-size: 16px">{{ $comment->user->name }}</span>
                                        <span>{{ $comment->comment }}</span>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        @endif
                        <div class="flex items-center justify-center shadow-lg">
                            <form onsubmit="event.preventDefault()" class="w-full max-w-xl bg-white rounded-lg px-4 pt-2">
                               <div class="flex flex-wrap -mx-3 mb-6">
                                  <h2 class="px-4 pt-3 pb-2 text-gray-800 text-md">Add a new comment</h2>
                                  <div class="w-full md:w-full px-3 mb-2 mt-2">
                                    <x-input wire:model.defer='comments.{{$survey->id}}' id="comment" placeholder="Type your comment" class="block input input-bordered input-md w-full" type="text" name="comment" required />
                                  </div>
                                  <div class="w-full md:w-full flex justify-end  px-3">
                                     <div class="-mr-1">
                                        <button wire:click="postComment('{{$survey->id}}')" class="btn btn-primary btn-outline text-white btn-sm normal-case">Post Comment</button>
                                     </div>
                                  </div>
                               </form>
                            </div>
                         </div>
                    </div>
                @empty
                    <x-empty-state title="No Current Post in this Group" description="There is no current post at this moment" />
                @endforelse
            @endif
        </div>
   </div>
</div>
