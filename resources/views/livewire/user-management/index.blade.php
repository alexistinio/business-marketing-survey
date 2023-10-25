<div>
    <x-loading />


    <div class="w-full text-2xl mt-8 mb-4 px-4">
        <div class="flex flex-col xl:flex-row justify-between">
            <span>User Management</span>
            <div class="flex gap-2 mt-4 xs:mt-0 align-middle">
                <button class="btn btn-sm btn-primary normal-case" onclick="window.location.href = '{{ route('user-management.create') }}'">Add New</button>
                <x-input wire:model.debounce.600ms='search_key' id="search" placeholder="Search" class="block input input-sm input-bordered input-md w-full" type="text" name="search" />
            </div>
        </div>
    </div>

    <div class="w-full px-4 xs:px-0">
        <table class="table table-compact w-full " >
          <thead>
            <tr>
                <th class="text-center">
                </th> 
                <th>Name</th> 
                <th>Email</th> 
                <th>Phone No</th> 
                <th>Premium</th> 
                <th>Subscription</th> 
                <th>Status</th>
                <th>Created At</th> 
                <th>Points</th> 
                <th>Claim Request</th> 
                <th>Points Reset</th> 
            </tr>
          </thead> 
          <tbody>
            @forelse ($users as $user)
                <tr class="hover hover:cursor-pointer">
                    <td >
                        <div class="flex justify-center gap-1">
                            <a href="{{ route('user-management.edit', ['id' => $user->id]) }}">
                                <button title="Edit" class='btn btn-xs text-center rounded-md'>
                                    <svg class="w-3" fill='white' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg>
                                </button>
                            </a>
                            <button wire:click="updateStatus('{{ $user->id }}', 3)" title="Delete" class='btn btn-error btn-xs text-center rounded-md'>
                                <svg class="w-3" fill="white"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                            </button>
                        </div>
                    </td> 
                    <td>
                        <a href="{{ route('profile.index', ['id' => $user->id]) }}" class="text-blue-600 hover:text-blue-800" >{{ $user->name }}</a>
                    </td> 
                    <td>{{ $user->email }}</td> 
                 
                    <td>{{ ($user->details ?? null)->phone_no ?? null }}</td> 
                    <td>
                        <div @click.away="open_premium = false" class="relative" x-data="{ open_premium: false }">
                            <div>
                                <button @click="open_premium = !open_premium"
                                    class="flex items-center max-w-xs text-sm transition-all duration-300 outline-none focus:outline-none focus:shadow-solid">
                                    @if ($user->role_id == ROLE_PREMIUM_USER)
                                        <span
                                            class="px-2 py-1 text-sm text-green-500 bg-green-100 rounded">Yes</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-sm text-red-500 bg-red-100 rounded">No</span>
                                    @endif
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal"
                                        data-icon="angle-down" class="w-5 h-5" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                        <path fill="currentColor"
                                            d="M119.5 326.9L3.5 209.1c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0L128 287.3l100.4-102.2c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L136.5 327c-4.7 4.6-12.3 4.6-17-.1z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div x-show="open_premium" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-10 w-20 mt-2 -ml-2 origin-center rounded-md shadow-lg">
                                <div class="px-2 py-1 bg-white rounded-md shadow-xs">
                                    <span wire:click="updateRole('{{ $user->id }}', 1)"
                                        class="block px-2 py-1 mb-1 text-sm text-green-500 bg-green-100 rounded cursor-pointer hover:bg-green-200">Yes</span>
                                    <span wire:click="updateRole('{{ $user->id }}', 0)"
                                        class="block px-2 py-1 text-sm text-red-500 bg-red-100 rounded cursor-pointer hover:bg-red-200">No</span>
                                </div>
                            </div>
                        </div>
                    </td> 
                    <td>
                        @if($user->subscription_status == SUBS_STATUS_ACTIVE)
                            {{ date('M d, Y', strtotime($user->start_timestamp)) ." to ". date('M d, Y', strtotime($user->end_timestamp)) }}
                        @elseif($user->subscription_status == SUBS_STATUS_PENDING)
                            <span class="px-2 py-1 text-sm text-orange-500 bg-orange-100 rounded">Pending</span>
                        @endif
                    </td>
                    <td>
                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open"
                                    class="flex items-center max-w-xs text-sm transition-all duration-300 outline-none focus:outline-none focus:shadow-solid">
                                    @if ($user->status_id == 1)
                                        <span
                                            class="px-2 py-1 text-sm text-green-500 bg-green-100 rounded">Active</span>
                                    @elseif($user->status_id == 2)
                                        <span
                                            class="px-2 py-1 text-sm text-red-500 bg-red-100 rounded">Inactive</span>
                                    @endif
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal"
                                        data-icon="angle-down" class="w-5 h-5" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                        <path fill="currentColor"
                                            d="M119.5 326.9L3.5 209.1c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0L128 287.3l100.4-102.2c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L136.5 327c-4.7 4.6-12.3 4.6-17-.1z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-10 w-20 mt-2 -ml-2 origin-center rounded-md shadow-lg">
                                <div class="px-2 py-1 bg-white rounded-md shadow-xs">
                                    <span wire:click="updateStatus('{{ $user->id }}', 1)"
                                        class="block px-2 py-1 mb-1 text-sm text-green-500 bg-green-100 rounded cursor-pointer hover:bg-green-200">Active</span>
                                    <span wire:click="updateStatus('{{ $user->id }}', 2)"
                                        class="block px-2 py-1 text-sm text-red-500 bg-red-100 rounded cursor-pointer hover:bg-red-200">Inactive</span>
                                </div>
                            </div>
                        </div>
                    </td> 
                    <td>{{ date('M d, Y', strtotime($user->created_at)) }}</td>

                    
                    <td class="bg-green-100">{{ $user->points }}</td>
                

                    <td>
                   
                                    @if ($user->request == "Not Claimed")
                                        <span
                                            class="px-2 py-1 text-sm bg-yellow-100 rounded">Not Claimed</span>
                                    @elseif($user->request == "Claiming/Claimed")
                                        <span
                                            class="px-2 py-1 text-sm bg-green-100 rounded">Claiming/Claimed</span>
                                    @endif
                                  
                                    
                        </div>
                </td>
                <td>
                    <a href="/user-management/reset/{{ $user->id }}"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reset</button></a>
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <x-empty-state title="No data" description="No found results" />
                    </td>
                </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    {{ $users->links('livewire.pagination') }}
</div>
