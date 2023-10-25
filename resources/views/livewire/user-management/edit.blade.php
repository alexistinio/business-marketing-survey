<div>
    <x-loading />

    <div class="flex flex-row items-center">
        <div class="w-9/12">

            <div class="card  bg-base-100 shadow-xl w-full">
                <div class="w-full relative" style="height: 200px;">
                    <div>
                        <img class="opacity-1 w-full h-[200px] object-cover" 
                        src="{{ method_exists((object)$background_image, "temporaryUrl") ? $background_image->temporaryUrl() : ( $background_image_display ? asset('storage/'.$background_image_display) : asset('images/default-cover-2.png')) }}" 
                        alt="">
                    </div>

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
                </div>

                <div class="card-body">
                    <!-- Avatar -->
                    <div class="relative w-full">
                        <div class="flex flex-1 justify-between">
                            <div style="margin-top: -6rem;">
                                <div style="height:9rem; width:9rem;" class="md rounded-full relative avatar">
                                    <img style="height:9rem; width:9rem;" class="md object-cover rounded-full relative border-2 border-gray-700" 
                                    src="{{ method_exists((object)$profile_image, 'temporaryUrl') ? $profile_image->temporaryUrl() : ($profile_image_display ? asset('storage/'.$profile_image_display) : asset('images/default-profile-2.svg')) }}" alt="">
                                </div>

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

                            </div>

                            <div class="flex flex-col text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('user-management.index') }}">
                                        <button type="butotn" class="btn btn-error btn-sm normal-case text-white">Cancel</button>
                                    </a>
                                    <button wire:click="save" class="btn btn-primary btn-sm normal-case">Save</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="space-y-1 justify-center w-full mt-3 ml-3 mr-3 pr-4">
                        <!-- User basic-->
                        <div class="w-full">
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
                            </div>
                            <div class="w-full flex flex-col gap-2 mt-2">
                                <div class="relative">
                                    <textarea wire:model.defer='my_bio' placeholder="My Bio" class="w-full textarea textarea-bordered"></textarea>
                                    <x-input-error for="my_bio"/>
                                </div>
                            </div>
                        </div>
                        <!-- Description and others -->
                        
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script type="module">
        const birthdate = new Pikaday({
            field: document.getElementById('birthdate'),
            format: 'D MMM YYYY',
            yearRange: [1900, new Date().getFullYear()],
            onSelect: function(v, k){
                @this.birthdate = v.toLocaleString();
            }
        });
    </script>
@endpush
