<div>
    <x-loading />

    @if($is_answered)
    <div class="mb-5">
        <div class="alert alert-success shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>You already Answered this survey</span>
            </div>
        </div>
    </div>
    @endif

    <div class="flex flex-row sm:flex-col md:flex-row  gap-4">
        <div class="md:w-6/12 lg:w-6/12 sm:w-full">
            <div class="card card-compact w-full bg-base-100 shadow-xl p-0">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        {{--  Header--}}
                        <div class="flex items-center">
                            {{-- profile image --}}
                            <a href="{{ route('profile.index', ['id' => $survey->user_id]) }}">
                            <img class="h-12 w-12 rounded-full object-cover" 
                            src="{{ $survey->postedBy->profile_image ? asset('storage/'.$survey->postedBy->profile_image) : asset('images/default-profile-2.svg') }}"/>
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
                    <div class="card-actions justify-end">
                        @if(!$is_answered)
                        <button wire:click="submit" class="btn btn-sm btn-primary normal-case">
                            Submit
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="md:w-6/12 lg:w-6/12 sm:w-full">
            <div class="card card-compact w-full bg-base-100 shadow-xl p-0">
                <div class="card-body">
                    <div class="card-title ">
                        <div>Questionaire</div>
                    </div>
                    <div class="overflow-y-scroll mt-4 pb-8">
                        @forelse ($survey->questions as $question)
                            <div class="flex flex-col mb-4 border-l-4 pl-4 border-green-500">
                                <div>
                                    <span>{{$loop->iteration.'.'}}</span>
                                    <span>{{ $question->question }}</span>
                                </div>
                                <div class="pl-8">
                                    @forelse ($question->choices as $choice)
                                    <div class="flex items-center mb-4 mt-2">
                                        @if($question->questionType->name == 'multiple_choice_single')
                                            <input wire:model.defer='answers.{{$question->id}}' value="{{$choice->id}}" type="radio" name="choices{{$question->id}}" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300" {{ $is_answered ? 'disabled' : '' }} >
                                        @elseif($question->questionType->name == 'multiple_choice_multiple')
                                            <input wire:model.defer='answers.{{$question->id}}.{{$choice->id}}' value="{{$choice->id}}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 " {{ $is_answered ? 'disabled' : '' }} >
                                        @endif
                                        <label class="block ml-2 text-sm font-medium text-gray-900">
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

    </div>

</div>

@push('css')
@endpush

@push('js')
@endpush