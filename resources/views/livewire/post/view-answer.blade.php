<div>
    <x-loading />

    <div class="mb-2 mx-2">
        <div class="alert alert-success shadow-2xl flex justify-between">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold">Total Answers: </span>
                <span class="font-bold">{{ $survey->total_answered_users }}</span>
            </div>
            <div>
                <label class="btn btn-dark text-white btn-sm normal-case " for="answered-users-modal">View Users</label>
            </div>
        </div>
    </div>


    <div class="flex">
      

        <div class="w-full px-2">
            <div class="card card-compact w-full bg-base-100 shadow-xl p-0">
                <div class="card-body">
          
                <div class="card-body">
                    <div class="flex items-center">
      
                        {{--  Header--}}
                        <div class="flex items-center">
                            {{-- profile image --}}
                            <a href="{{ route('profile.index', ['id' => $survey->user_id]) }}">
                            <img class="h-12 w-12 rounded-full object-cover" 
                            src="{{ $survey->postedBy->details->profile_image ? asset('storage/'.$survey->postedBy->details->profile_image) : asset('images/default-profile-2.svg') }}"/>
                           
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
                    </div>
                    <div>
                        <p class="card-title mt-4 text-lg">{{ $survey->title }}</p>
                        <div>
                            {!! $survey->description !!}
                        </div>
                    </div>
                </div>
        
                    <div class="card-title px-4 mt-7 pb-2">
                        
                        <div>Questionaire</div>
                    </div>
                    <div class="overflow-y-scroll mt-4 pb-8 px-6">
                        @forelse ($survey->questions as $question)
                            <div class="flex flex-col mb-4 border-l-4 pl-4 border-green-500">
                                <div>
                                    <span>{{$loop->iteration.'.'}}</span>
                                    <span>{{ $question->question }}</span>
                                </div>
                                <div class="pl-5 mt-3">
                                    @forelse ($question->choices as $choice)
                                    <div class="flex gap-4 items-center mb-4 mt-2">
                                    <span class="font-bold">{{ $survey->answer_count_per_choice[$question->id][$choice->id] ?? 0 }}</span> Answer/s
                                        <div class="w-4/12 bg-gray-200 rounded-full">
                                            
                                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width:{{ $survey->choice_percentage[$question->id][$choice->id] ?? 0 }}%">
                                          
                                                @if(($survey->choice_percentage[$question->id][$choice->id] ?? 0) == 0)
                                                    <span class="text-gray-700 pl-2">{{ $survey->choice_percentage[$question->id][$choice->id] ?? 0 }}%</span>
                                                @else
                                                    {{ round($survey->choice_percentage[$question->id][$choice->id] ?? 0) }}%
                                                @endif
                                            </div>
                                        </div>
                                        <label class="block ml-2 text-sm font-medium font-bold text-gray-900" style="font-size: 16px">
                                            {{ $choice->choice }}
                                        </label>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
       

    {{-- Modal --}}
    <input type="checkbox" id="answered-users-modal" class="modal-toggle" />
    <label for="answered-users-modal" class="modal cursor-pointer">
        <label class="modal-box relative" for="">
            <label for="answered-users-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold">Answered Users</h3>
            <div class="flex flex-col mt-4 gap-2">
                @forelse ($survey->answered_users as $answer)
                    <div class="card bg-base-100 shadow-xl mt-2">
                        <div class="card-body">
                            <div class="flex items-center">
                                <a href="">
                                    <img class="h-12 w-12 rounded-full object-cover" src="{{ $answer->user->details->profile_image ? asset('storage/'.$answer->user->details->profile_image ) : asset('images/default-profile-2.svg') }}"/>
                                </a>
                                <div class="ml-2">
                                    <div class="text-sm ">
                                        <a href="{{ route('profile.index', ['id' => $answer->user_id ]) }}">
                                            <span class="font-semibold">{{ $answer->user->name }}</span>
                                        </a>
                                    </div>
                                    <div>
                                        <span>{{ $answer->created_at->diffForHumans(); }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </label>
    </label>
</div>

@push('css')
@endpush

</div>




