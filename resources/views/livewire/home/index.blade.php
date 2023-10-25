@if(session()->get('success'))
<div class="mb-5 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
  <div class="flex justify-between">
      <p class="font-bold">Success</p>
      <div id="close_alert" class="cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
      </div>
  </div>
  <p class="text-sm">Claim request has been sent. Please be advised that we will transact payment within <span class="font-bold">24 hours</span> through your registered <span class="font-bold">G-Cash number</span> & send <span class="font-bold">email confirmation</span>. Please note, if your registered number is invalid, payment will not be sent. Thank you.</p>
</div>
@endif
@if(session()->get('error'))
<div class="mb-5" role="alert">
  <div class="flex justify-between bg-red-500 text-white font-bold rounded-t px-4 py-2">
  <div>
  Error:
  </div>
  <div id="close_alert" class="cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
    </div>
  </div>
  <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
    <p>Cannot request for a claim. A user must have at least <span class="font-bold">10 points</span> or higher in order to request a claim.</p>
  </div>
</div>
@endif

<div>
    <x-loading />


    <div class="flex flex-row gap-20 justify-center">
        {{-- Surveys --}}
        
        <div class="w-11/12 xl:w-7/12">
            @forelse ($surveys->sortBy('created_at') as $survey)
          
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
                                @if($survey->postedBy->id == auth()->user()->id || auth()->user()->role_id == 1)
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
                </div>
            @empty
                <x-empty-state title="No Current Post" description="There is no current post at this moment" />
            @endforelse
        </div>

        {{-- Groups --}}

        <div class="w-3/12 hidden xl:block">
            
            <div class="sticky top-0 flex flex-col gap-4">
                
                <h2 class="text-black font-bold ">Top Groups</h2>
                @forelse ($categories as $category)
                    <div class="card h-[160px] rounded-md w-full bg-base-100 shadow-md image-full">
                        <img src="{{ asset('images/'.$category->image) }}" alt="Shoes" />
                        <div class="card-body flex flex-col align-center">
                            <h2 class="card-title justify-center">{{ $category->title }}</h2>
                            <span class="text-center">{{ $category->posts_count }} Survey</span>
                            <div class="card-actions justify-center">
                                <a href="{{ route('group.view', ['id' => $category->id]) }}" class="btn btn-sm btn-primary normal-case">View Group</a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

                <h2 class="text-black font-bold mt-7">Top Users (Most Points)</h2>
                @forelse ($points as $point)
                    <div class="card rounded-md w-full shadow-md" style="background-color: white">
                        <div class="flex justify-center pt-3 pb-3" style="background-color: skyblue">
                            <a href="{{ route('profile.index', ['id' => $point->user->id]) }}">
                                <img style="height:9rem; width:9rem;" class="md object-cover rounded-full relative border-2 border-gray-700" 
                                src="{{ $point->user->details ? asset('storage/'.$point->user->details->profile) : asset('images/default-profile-2.svg') }}"/>
                                </a>
                            </div>
                        <div class="card-body flex flex-col">
                            <div class="flex justify-between">
                            <h2 class="card-title">{{ $point->user->username }}</h2>
                            <div class="card-actions">
                            <a href="{{ route('profile.index', ['id' => $point->user->id]) }}" class="btn btn-sm btn-primary normal-case">View</a>
                            </div>
                            </div>
                            <span>{{ $point->points }} Points</span>                                                                             
                        </div>
                    </div>
                @empty
                @endforelse

                <h2 class="text-black font-bold mt-7">Trending Surveys</h2>

                @forelse ($survey_count->sortByDesc('answers') as $survey)
            
                <div class="card rounded-md w-full bg-base-100" style="border: 1px solid green" >
                  
                        <div class="card-body flex flex-col">
                            <div class="flex justify-between">
                            <h2 class="card-title">{{ $survey->title }}</h2>
                            <div>
                            <a href="{{ route('post.answer', ['id' => $survey->id]) }}" class="btn btn-sm btn-primary normal-case">View</a>
                            </div>
                            </div>
                            
                            <div class="flex items-center">
                            <a href="{{ route('profile.index', ['id' => $survey->user_id]) }}">
                            <img class="h-12 w-12 rounded-full object-cover" 
                                src="{{ $survey->postedBy->details->profile ? asset('storage/'.$survey->postedBy->details->profile) : asset('images/default-profile-2.svg') }}"/>
                                </a>
                            <span class="justify-center ml-2">{{ $survey->postedBy->username }}</span>
                            </div>

                            <div class="flex">
                             <p class="mt-3" style="font-size: 14px"><span class="font-bold" style="font-size: 18px">{{ $survey->answers->count() }}</span> Answer/s</p>
                            </div>
                      
                      
                        </div>
                    </div>
           
                @empty
                @endforelse
            </div>
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#close_alert').click(function (e) { 
            e.preventDefault();
            location.reload()
        });
    });
</script>
@push('css')
<style>
    .card.image-full:before{
        border-radius: 0.375rem !important;
    }
</style>
@endpush
