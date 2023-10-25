<div>
    <x-loading />

    <div class="flex flex-row items-center">
        <div class="w-full px-4 xl:w-9/12">

            <div class="card  bg-base-100 shadow-xl w-full">
                <div class="w-full relative" style="height: 200px;">
                    <div>
                        <img class="opacity-1 w-full h-[200px] object-cover" 
                        src="{{ method_exists((object)$background_image, "temporaryUrl") ? $background_image->temporaryUrl() : ( $background_image_display ? asset('storage/'.$background_image_display) : asset('images/default-cover-2.png')) }}" 
                        alt="">
                    </div>
                    
                    @if ($is_edit_profile)
                        <div class="absolute z-5 h-[200px] w-full top-0 flex items-center opacity-0 bg-gray-900 bg-opacity-60 hover:opacity-100  duration-500">
                            <div class="flex justify-center w-full">
                                <div class="flex justify-between">
                                    <label class="p-2 mx-1 bg-blue-400 hover:bg-blue-500 text-blue cursor-pointer rounded-lg flex items-center text-white">
                                        <svg class="w-5 h-5" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-alt-to-top" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path fill="currentColor" d="M153.1 448c-8.8 0-16-7.2-16-16V288H43.3c-7.1 0-10.7-8.6-5.7-13.6l143.1-143.5c6.3-6.3 16.4-6.3 22.7 0l143.1 143.5c5 5 1.5 13.6-5.7 13.6h-93.9v144c0 8.8-7.2 16-16 16h-77.8m0 32h77.7c26.5 0 48-21.5 48-48V320h61.9c35.5 0 53.5-43 28.3-68.2L226 108.2c-18.8-18.8-49.2-18.8-68 0L14.9 251.8c-25 25.1-7.3 68.2 28.4 68.2h61.9v112c-.1 26.5 21.5 48 47.9 48zM0 44v8c0 6.6 5.4 12 12 12h360c6.6 0 12-5.4 12-12v-8c0-6.6-5.4-12-12-12H12C5.4 32 0 37.4 0 44z"></path>
                                        </svg>
                                        <input accept="image/png, image/jpeg" type='file' wire:model='background_image' class="hidden"  />
                                    </label>

                                    <button wire:click='removeBackground' type="button" class="p-2 mx-1 bg-red-400 hover:bg-red-500 text-blue cursor-pointer rounded-lg flex items-center text-white">
                                        <svg class="w-5 h-5" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <x-input-error for="cover" />
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <!-- Avatar -->
                    <div class="relative w-full">
                        <div class="flex flex-1 justify-between">
                            <div style="margin-top: -6rem;">
                                <div style="height:9rem; width:9rem;" class="md rounded-full relative avatar">
                                    <img style="height:9rem; width:9rem;" class="md object-cover rounded-full relative border-2 border-gray-700" 
                                    src="{{ method_exists((object)$profile_image, 'temporaryUrl') ? $profile_image->temporaryUrl() : ($profile_image_display ? asset('/storage/'.$profile_image_display) : asset('/images/default-profile-2.svg')) }}" alt="">
                                </div>

                                @if($is_edit_profile)
                                    <div style="height: 9rem; width:9rem;" class="absolute z-10 flex items-center opacity-0 bg-gray-900 bg-opacity-60 hover:opacity-100 -top-24 duration-500 rounded-full">
                                        <div class="flex justify-center w-full">
                                            <div class="flex justify-between">
                                                <label class="p-2 mx-1 bg-blue-400 hover:bg-blue-500 text-blue cursor-pointer rounded-lg flex items-center text-white">
                                                    <svg class="w-5 h-5" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-alt-to-top" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                        <path fill="currentColor" d="M153.1 448c-8.8 0-16-7.2-16-16V288H43.3c-7.1 0-10.7-8.6-5.7-13.6l143.1-143.5c6.3-6.3 16.4-6.3 22.7 0l143.1 143.5c5 5 1.5 13.6-5.7 13.6h-93.9v144c0 8.8-7.2 16-16 16h-77.8m0 32h77.7c26.5 0 48-21.5 48-48V320h61.9c35.5 0 53.5-43 28.3-68.2L226 108.2c-18.8-18.8-49.2-18.8-68 0L14.9 251.8c-25 25.1-7.3 68.2 28.4 68.2h61.9v112c-.1 26.5 21.5 48 47.9 48zM0 44v8c0 6.6 5.4 12 12 12h360c6.6 0 12-5.4 12-12v-8c0-6.6-5.4-12-12-12H12C5.4 32 0 37.4 0 44z"></path>
                                                    </svg>
                                                    <input accept="image/png, image/jpeg" wire:model='profile_image' type='file' class="hidden"  />
                                                </label>
        
                                                <button wire:click='removeProfile' type="button" class="p-2 mx-1 bg-red-400 hover:bg-red-500 text-blue cursor-pointer rounded-lg flex items-center text-white">
                                                    <svg class="w-5 h-5" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                        <path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <x-input-error for="profile" />
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col text-right">
                                @if($is_edit_profile)
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="$set('is_edit_profile', false)" class="btn btn-error btn-sm normal-case text-white">Cancel</button>
                                        <button wire:click="save" class="btn btn-primary btn-sm normal-case">Save</button>
                                    </div>
                                @else
                                    <div class="flex justify-between gap-2">
                                        @if(auth()->user()->id === $user->id)
                                            <div>
                                                <button wire:click="$set('is_edit_profile', true)" class="btn btn-sm normal-case">Edit Profile</button>
                                            </div>
                                        @elseif((auth()->user()->hasRole('premium_user') || auth()->user()->hasRole('superadmin')) && auth()->user()->id !== $user->id)
                                            
                                            @if($is_followed)
                                                <button wire:click="unfollow" class="btn btn-sm normal-case btn-primary btn-outline">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"/></svg>
                                                    <span>Unfollow</span>
                                                </button>
                                            @else
                                                <button wire:click="follow" class="btn btn-sm normal-case btn-primary">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
                                                    <span>Follow</span>
                                                </button>
                                            @endif
                                        
                                        @endif

                                        @if(auth()->user()->id !== $user->id)
                                            <a href="{{ route('message', ['id' => $user->id]) }}" class="btn btn-sm normal-case btn-primary btn-outline">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z"/></svg>
                                                <span>Message</span>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                    </div>

                    <div class="space-y-1 justify-center w-full mt-3">
                        <!-- User basic-->
                        <div class="w-full">
                            @if($is_edit_profile)
                                <div class="flex flex-row gap-2">
                                    <div class="w-full">
                                    <div class="flex flex-col gap-2">
                                        <div class="relative ">
                                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M272 304h-96C78.8 304 0 382.8 0 480c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32C448 382.8 369.2 304 272 304zM48.99 464C56.89 400.9 110.8 352 176 352h96c65.16 0 119.1 48.95 127 112H48.99zM224 256c70.69 0 128-57.31 128-128c0-70.69-57.31-128-128-128S96 57.31 96 128C96 198.7 153.3 256 224 256zM224 48c44.11 0 80 35.89 80 80c0 44.11-35.89 80-80 80S144 172.1 144 128C144 83.89 179.9 48 224 48z"/></svg>
                                            </div>
                                            <x-input wire:model.defer='name' id="name" placeholder="Name" class="block mt-1 input input-bordered input-md w-full pl-10" type="text" name="name" required />
                                            <x-input-error for="name"/>
                                        </div>
                                        <div class="relative">
                                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                            </div>
                                            <x-input wire:model.defer='email' id="email" placeholder="Email" class="block mt-1 input input-bordered input-md w-full pl-10" type="email" name="email" required />
                                            <x-input-error for="email"/>
                                        </div>
    
                                        <div class="relative">
                                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                <svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon"><g><path d="M11.96 14.945c-.067 0-.136-.01-.203-.027-1.13-.318-2.097-.986-2.795-1.932-.832-1.125-1.176-2.508-.968-3.893s.942-2.605 2.068-3.438l3.53-2.608c2.322-1.716 5.61-1.224 7.33 1.1.83 1.127 1.175 2.51.967 3.895s-.943 2.605-2.07 3.438l-1.48 1.094c-.333.246-.804.175-1.05-.158-.246-.334-.176-.804.158-1.05l1.48-1.095c.803-.592 1.327-1.463 1.476-2.45.148-.988-.098-1.975-.69-2.778-1.225-1.656-3.572-2.01-5.23-.784l-3.53 2.608c-.802.593-1.326 1.464-1.475 2.45-.15.99.097 1.975.69 2.778.498.675 1.187 1.15 1.992 1.377.4.114.633.528.52.928-.092.33-.394.547-.722.547z"></path><path d="M7.27 22.054c-1.61 0-3.197-.735-4.225-2.125-.832-1.127-1.176-2.51-.968-3.894s.943-2.605 2.07-3.438l1.478-1.094c.334-.245.805-.175 1.05.158s.177.804-.157 1.05l-1.48 1.095c-.803.593-1.326 1.464-1.475 2.45-.148.99.097 1.975.69 2.778 1.225 1.657 3.57 2.01 5.23.785l3.528-2.608c1.658-1.225 2.01-3.57.785-5.23-.498-.674-1.187-1.15-1.992-1.376-.4-.113-.633-.527-.52-.927.112-.4.528-.63.926-.522 1.13.318 2.096.986 2.794 1.932 1.717 2.324 1.224 5.612-1.1 7.33l-3.53 2.608c-.933.693-2.023 1.026-3.105 1.026z"></path></g></svg> 
                                            </div>
                                            <x-input wire:model.defer='link' id="link" placeholder="Link" class="block mt-1 input input-bordered input-md w-full pl-10" type="url" name="link" required />
                                            <x-input-error for="link"/>
                                        </div>
    
                                        <div class="flex flex-row gap-2 w-full">
                                            <div class="w-6/12">
                                                <select wire:model.defer='gender' class="w-full select select-bordered mt-1">
                                                    <option value="">Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <x-input-error for="gender"/>
                                            </div>
                                            <div class="w-6/12">
                                                <x-input value="{{ $birthdate ? date('M d, Y', strtotime($birthdate)) : '' }}" id="birthdate" placeholder="Birthdate" class="block mt-1 input input-bordered input-md w-full" type="text" name="birthdate" required autocomplete="off"/>
                                                <x-input-error for="birthdate"/>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
    
                                    <div class="w-full">
                                        <div class="flex flex-col gap-2">
                                            <div class="relative">
                                                <x-input wire:model.defer='phone_no' id="phone_no" placeholder="Phone Number (09123456789)" class="block mt-1 input input-bordered input-md w-full" type="number" name="phone_no" required />
                                                <x-input-error for="phone_no"/>
                                            </div>
                                            <div class="relative">
                                                <x-input wire:model.defer='username' id="username" placeholder="Username" class="block mt-1 input input-bordered input-md w-full" type="text" name="username" required />
                                                <x-input-error for="username"/>
                                            </div>
                                            <div class="relative">
                                                <x-input wire:model.defer='password' id="password" placeholder="Password" class="block mt-1 input input-bordered input-md w-full" type="password" name="password" required />
                                                <x-input-error for="password"/>
                                            </div>
                                            <div class="relative">
                                                <x-input wire:model.defer='confirmpassword' id="confirmpassword" placeholder="Confirm Password" class="block mt-1 input input-bordered input-md w-full" type="password" name="confirmpassword" required />
                                                <x-input-error for="confirmpassword"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex flex-col gap-2 mt-2">
                                    <div class="relative">
                                        <textarea wire:model.defer='my_bio' placeholder="My Bio" class="w-full textarea textarea-bordered"></textarea>
                                        <x-input-error for="my_bio"/>
                                    </div>
                                </div>
                            @else
                                <h2 class="text-xl leading-6 font-bold text-gray-600">
                                    {{ ucwords($user->name) }}
                                </h2>
                                <p class="text-sm leading-5 font-medium text-gray-600">
                                    {{ $user->email }}
                                </p>
                            @endif
                        </div>
                        <!-- Description and others -->
                        @if(!$is_edit_profile)
                            @if(($user->details ?? null)->website_link ?? null)
                                <div class="mt-3">
                                    <div class="text-gray-600 flex">
                                        <span class="flex mr-2"><svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon"><g><path d="M11.96 14.945c-.067 0-.136-.01-.203-.027-1.13-.318-2.097-.986-2.795-1.932-.832-1.125-1.176-2.508-.968-3.893s.942-2.605 2.068-3.438l3.53-2.608c2.322-1.716 5.61-1.224 7.33 1.1.83 1.127 1.175 2.51.967 3.895s-.943 2.605-2.07 3.438l-1.48 1.094c-.333.246-.804.175-1.05-.158-.246-.334-.176-.804.158-1.05l1.48-1.095c.803-.592 1.327-1.463 1.476-2.45.148-.988-.098-1.975-.69-2.778-1.225-1.656-3.572-2.01-5.23-.784l-3.53 2.608c-.802.593-1.326 1.464-1.475 2.45-.15.99.097 1.975.69 2.778.498.675 1.187 1.15 1.992 1.377.4.114.633.528.52.928-.092.33-.394.547-.722.547z"></path><path d="M7.27 22.054c-1.61 0-3.197-.735-4.225-2.125-.832-1.127-1.176-2.51-.968-3.894s.943-2.605 2.07-3.438l1.478-1.094c.334-.245.805-.175 1.05.158s.177.804-.157 1.05l-1.48 1.095c-.803.593-1.326 1.464-1.475 2.45-.148.99.097 1.975.69 2.778 1.225 1.657 3.57 2.01 5.23.785l3.528-2.608c1.658-1.225 2.01-3.57.785-5.23-.498-.674-1.187-1.15-1.992-1.376-.4-.113-.633-.527-.52-.927.112-.4.528-.63.926-.522 1.13.318 2.096.986 2.794 1.932 1.717 2.324 1.224 5.612-1.1 7.33l-3.53 2.608c-.933.693-2.023 1.026-3.105 1.026z"></path></g></svg> 
                                            <a href="{{($user->details ?? null)->website_link ?? null}}" target="#" class="leading-5 ml-1 text-blue-400">
                                                {{ ($user->details ?? null)->website_link ?? null }}
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            @endif
                        
    
                        <div class="mt-4">
                            <div class="border border-gray-200 bg-gray-100 p-4 rounded-lg text-sm">
                                {{ ($user->details ?? null)->about_me ?? null ? ($user->details ?? null)->about_me ?? null : 'Bio is not set' }}
                            </div>
                        </div>
                        @endif
    
                        <div class="pt-3 flex justify-start items-start w-full divide-x divide-gray-800 divide-solid">
                            <div class="text-center pr-3">
                                <span class="font-bold text-gray-600">{{ $user->following->count() }}</span>
                                <span class="text-gray-600"> Following</span>
                            </div>
                            @if($user->hasRole('premium_user') || $user->hasRole('superadmin'))
                                <div class="text-center px-3">
                                    <span class="font-bold text-gray-600">{{ $user->followers->count() }}</span>
                                    <span class="text-gray-600"> Followers</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-compact bg-base-100 shadow-xl w-full mt-2 mb-5">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h1 class="font-bold text-gray-700 text-xl">Posted Surveys</h1>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <x-input id="search" placeholder="Search..." class="block mt-1 input input-bordered input-sm w-full pl-10" type="text" name="search" required />
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- posts --}}
            <div class="w-full">
                @forelse ($surveys as $survey)
                    <div class="card card-compact w-full bg-base-100 shadow-xl mb-5  overflow-visible">
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
                    </div>
                @empty
                    <x-empty-state title="No Current Post by this user" description="There is no current post at this moment" />
                @endforelse
            </div>

        </div>
    </div>
</div>


@push('js')
    <script type="module">
        window.addEventListener('editing-profile', () => {
            const birthdate = new Pikaday({
                field: document.getElementById('birthdate'),
                format: 'D MMM YYYY',
                yearRange: [1900, new Date().getFullYear()],
                onSelect: function(v, k){
                    @this.birthdate = v.toLocaleString();
                }
            });
        });
    </script>
@endpush