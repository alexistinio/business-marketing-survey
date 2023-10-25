<div>
    <x-loading />

    <div class="flex flex-row sm:flex-col md:flex-row  gap-4">

        <div class="md:w-6/12 lg:w-6/12 sm:w-full">
            <div class="card card-compact w-full bg-base-100 shadow-xl p-0" x-data="{ show_group: false }">
                <div class="card-body">
    
                    <div>
                        <x-label for="title" class="font-bold" :value="__('Title')" />
                        <x-input id="title" 
                            wire:model.defer='title'
                            placeholder="Enter Title" 
                            class="block mt-1 input input-bordered input-md w-full" 
                            type="text" 
                            name="title"/>
                        <x-input-error for="title" />
                    </div>
    
                    <div>
                        <x-label for="description" class="font-bold" :value="__('Description')" />
                        <x-input wire:model.defer='description' id="description" 
                            placeholder="Enter Description" 
                            class="block mt-1 input input-bordered input-md w-full" 
                            type="text" 
                            name="description"/>
                        <x-input-error for="description" />
                    </div>
    
                    <div class="flex flex-row gap-4">
    
                        <div class="w-6/12">
                            <x-label for="start_date" class="font-bold" :value="__('Start Date')" />
                            <x-input id="start_date" 
                                value="{{ $start_date ?  date('M d, Y', strtotime($start_date)) : '' }}"
                                placeholder="Start Date" 
                                class="block mt-1 input input-bordered input-md w-full" 
                                type="text" 
                                name="start_date"
                                autocomplete="off"/>
                            <x-input-error for="start_date" />
                        </div>
    
                        <div class="w-6/12">
                            <x-label for="end_date" class="font-bold" :value="__('End Date')" />
                            <x-input id="end_date" 
                                value="{{ $end_date ?  date('M d, Y', strtotime($end_date)) : '' }}"
                                placeholder="End Date" 
                                class="block mt-1 input input-bordered input-md w-full" 
                                type="text" 
                                name="end_date"
                                autocomplete="off"/>
                            <x-input-error for="end_date" />
                        </div>
    
                    </div>
    
                    <div class="mt-2">
                        <div class="flex justify-start items-start " >
                            <div class="bg-white border-2 rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500 ">
                                <input @click="show_group = ! show_group" wire:model.defer='is_private_post' type="checkbox" class="checkbox checkbox-sm">
                                <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                            </div>
                            <div class="select-none text-sm ml-2">Private Post</div>
                        </div>
                        <div class="text-sm text-gray-400 mt-1 italic">
                            If you want to make this post as private, please check the checkbox above otherwise this will be posted as public
                        </div>
                    </div>
                    
                    <div class="w-full mt-4" x-show="show_group">
                        <label for="groups">
                            Select Category/s
                            <select id="groups" class="" multiple="multiple" style="width: 100%">
                                @forelse ($category_refs as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @empty
                                @endforelse
                            </select>
                        </label>
                    </div>
    
                    <div class="card-actions justify-end">
                        <button id="publish-survey" class="btn btn-sm btn-primary normal-case">
                            Publish Survey
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="md:w-6/12 lg:w-6/12 sm:w-full">
            <div class="card card-compact w-full bg-base-100 shadow-xl p-0">
                <div class="card-body">
                    <div class="card-title justify-between">
                        <div>Questionaire</div>
                        <div>
                            <label id="add-question-modal-btn" class="btn btn-primary btn-sm normal-case gap-2 modal-button" for="add-question-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm4 14c0 2.206-1.794 4-4 4H4V8c0-2.206 1.794-4 4-4h8c2.206 0 4 1.794 4 4v8z"></path><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path></svg>
                                Add Question
                            </label>
                        </div>
                    </div>
                    <div class="overflow-y-scroll mt-4 pb-8">
                        @php
                            $question_number = 0;   
                        @endphp
                        @forelse ($questions as $k => $question)
                            @if($question['is_deleted'])
                                @continue
                            @endif
                            @php
                                $question_number++;
                            @endphp

                            <div class="flex flex-col mt-8 border-l-4 pl-4 border-green-500 shadow-xl">
                                <div class="flex justify-between">
                                    <div>
                                        <span>{{ $question_number }}</span>
                                        <span>{{ $question['question'] }}</span>
                                    </div>
                                    
                                    <div class="mr-8 flex items-center">
                                   
                                        <svg wire:click="editQuestion('{{$k}}')" class="w-4 h-4 hover:cursor-pointer hover:fill-blue-500"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <title>Edit</title>
                                            <path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/>
                                        </svg>
                                        
    
                                        <svg wire:click="removeQuestion('{{$k}}')" class="w-4 ml-2 hover:cursor-pointer hover:fill-red-500"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <title>Delete</title>
                                            <path d="M160 400C160 408.8 152.8 416 144 416C135.2 416 128 408.8 128 400V192C128 183.2 135.2 176 144 176C152.8 176 160 183.2 160 192V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V192C208 183.2 215.2 176 224 176C232.8 176 240 183.2 240 192V400zM320 400C320 408.8 312.8 416 304 416C295.2 416 288 408.8 288 400V192C288 183.2 295.2 176 304 176C312.8 176 320 183.2 320 192V400zM317.5 24.94L354.2 80H424C437.3 80 448 90.75 448 104C448 117.3 437.3 128 424 128H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V128H24C10.75 128 0 117.3 0 104C0 90.75 10.75 80 24 80H93.82L130.5 24.94C140.9 9.357 158.4 0 177.1 0H270.9C289.6 0 307.1 9.358 317.5 24.94H317.5zM151.5 80H296.5L277.5 51.56C276 49.34 273.5 48 270.9 48H177.1C174.5 48 171.1 49.34 170.5 51.56L151.5 80zM80 432C80 449.7 94.33 464 112 464H336C353.7 464 368 449.7 368 432V128H80V432z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="pl-8">
                                    @forelse ($question['choices'] as $key => $choice)
    
                                        @if($choice['is_deleted'])
                                            @continue
                                        @endif
    
                                        <div class="flex items-center mb-4">
                                            @if($question['type'] == 'multiple_choice_single')
                                                <input type="radio" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300" disabled>
                                            @elseif($question['type'] == 'multiple_choice_multiple')
                                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 " disabled>
                                            @endif
                                            <label class="block ml-2 text-sm font-medium text-gray-900">
                                              {{ $choice['choice'] }}
                                            </label>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            
                        @empty
                        @endforelse
    
                        @if($questions_counter < 1)
                            <div class="flex items-center justify-center text-gray-500 mt-8 mb-8">
                                No Question Added yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>


    <input type="checkbox" id="add-question-modal" class="modal-toggle" />
    <div class="modal modal-middle">
        <div class="modal-box relative w-7/12 max-w-5xl">
            <label wire:click='resetQuestionForm' for="add-question-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="font-bold text-2xl">Add Question</h3>
            
            <div class="flex flex-row gap-4">
                <div class="w-6/12">
                    <div class="w-full mt-4">
                        <label for="question_type">
                            Question Type
                            <select wire:model.defer='question_type' id="question_type" class="select select-bordered" style="width: 100%">
                                <option>-- Select --</option>
                                @forelse ($question_type_refs as $question_type)
                                    <option value="{{ $question_type->name }}">{{ $question_type->text }}</option>
                                @empty
                                @endforelse
                            </select>
                            <x-input-error for="question_type" />
                        </label>
                    </div>
                    <div class="form-control w-full mt-4">
                        <label for="">Question</label>
                        <textarea wire:model.defer='question' class="textarea textarea-bordered" placeholder="Enter Question"></textarea>
                        <x-input-error for="question" />
                    </div>
                </div>
                <div class="w-6/12">
                    <div class="card card-compact w-full bg-base-100 shadow-xl p-0 mt-4">
                        <div class="card-body">
                            <h2 class="card-title">Choices</h2>

                            <div class="choices flex flex-col items-center">
                                @forelse ($choice_inputs as $k => $v)
                                    <div class="w-full flex flex-row items-center mb-2">
                                        <div class="w-full">
                                            <input wire:model.defer='choices.{{$k}}.choice' type="text" placeholder="Enter Choice" class="input input-bordered w-full" />
                                            <x-input-error for="choices.{{$k}}.choice" />
                                        </div>
                                        <button wire:key='remove{{$k}}' wire:click="removeChoice('{{$k}}')" class="hover:cursor-pointer" title="remove">
                                            <svg class="w-4 ml-2 hover:fill-red-500"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M160 400C160 408.8 152.8 416 144 416C135.2 416 128 408.8 128 400V192C128 183.2 135.2 176 144 176C152.8 176 160 183.2 160 192V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V192C208 183.2 215.2 176 224 176C232.8 176 240 183.2 240 192V400zM320 400C320 408.8 312.8 416 304 416C295.2 416 288 408.8 288 400V192C288 183.2 295.2 176 304 176C312.8 176 320 183.2 320 192V400zM317.5 24.94L354.2 80H424C437.3 80 448 90.75 448 104C448 117.3 437.3 128 424 128H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V128H24C10.75 128 0 117.3 0 104C0 90.75 10.75 80 24 80H93.82L130.5 24.94C140.9 9.357 158.4 0 177.1 0H270.9C289.6 0 307.1 9.358 317.5 24.94H317.5zM151.5 80H296.5L277.5 51.56C276 49.34 273.5 48 270.9 48H177.1C174.5 48 171.1 49.34 170.5 51.56L151.5 80zM80 432C80 449.7 94.33 464 112 464H336C353.7 464 368 449.7 368 432V128H80V432z"/></svg>
                                        </button>
                                    </div>
                                @empty
                                    <div class="text-gray-500 mt-8 mb-8">
                                        Please Add Choices Here
                                    </div>
                                @endforelse
                            </div>

                            <div class="card-actions justify-end">
                                <button wire:click='addChoice' class="btn btn-primary btn-sm normal-case">Add Choice</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-action">
                <button wire:click='addQuestion' class="btn btn-sm btn-primary normal-case">
                    <span wire:loading.remove wire:target="addQuestion">Save</span>
                    <span wire:loading wire:target="addQuestion">Saving...</span>
                </button>
                <label wire:click='resetQuestionForm' for="add-question-modal" id="close-question-modal-btn" class="btn btn-sm btn-error text-white normal-case">Cancel</ wire:click='resetQuestionForm'>
            </div>
        </div>
    </div>

</div>

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="module">
        
        let cke_description = null;
        let temp_selected_group = [];

        const ckeditorBuild = (selector, value=null) => {

            if(value)
                document.querySelector(selector).value = value;
            

            let editor = ckeditor.create( document.querySelector(selector), )
            .then( (editor) => {
                editor.model.document.on('change:data', () => {
                    cke_description = editor.getData();
                })

                if(value)
                    editor.setData(value);
            })
            .catch( error => {
                console.error( error );
            });
        }

        const startDatePikaday = new Pikaday({
            field: document.getElementById('start_date'),
            format: 'D MMM YYYY',
            onSelect: function(v, k){
                @this.start_date = v.toLocaleString();
            }
        });

        const endDatePikaday = new Pikaday({
            field: document.getElementById('end_date'),
            format: 'D MMM YYYY',
            onSelect: function(v, k){
                @this.end_date = v.toLocaleString();
            }
        });

        const select_groups = $('#groups');

        const initializeSelectGroups = () => {
            select_groups.select2();
        }

        const setSelectedGroups = () => {
            @this.categories = temp_selected_group;
        }

        const setSurveyDescription = () => {
            @this.description = cke_description;
        }

        const appendFormDatas = () => {
            setSelectedGroups();
            setSurveyDescription();
        }

        select_groups.on('change', function(){
            temp_selected_group = select_groups.select2("val");
        });

        document.addEventListener('livewire:update', () => {
            initializeSelectGroups();
            select_groups.val(temp_selected_group).trigger('change');
            ckeditorBuild("#description", cke_description);
        });

        document.addEventListener('addQuestion', () => {
            $('#close-question-modal-btn').trigger('click');
        });

        document.addEventListener('editQuestion', () => {
            $('#add-question-modal-btn').trigger('click');
        });

        document.getElementById('publish-survey').addEventListener("click", () => {
            appendFormDatas();
            @this.publish()
        });

        ckeditorBuild("#description");
        initializeSelectGroups();

    </script>
@endpush