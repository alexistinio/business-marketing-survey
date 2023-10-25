<div>
    <div wire:loading >
         <x-loading />
    </div>
    <h2 class="px-12 text-base font-bold text-center md:text-2xl text-blue-700">
         @if(auth()->user()->role_id == ROLE_PREMIUM_USER)
             Upgrade your plan
         @else
             Choose your plan
         @endif
     </h2>
     <p class="py-1 text-sm text-center text-blue-700 mb-10">
         Please see below for our available plans
     </p>
     <div class="flex flex-wrap items-center justify-center py-4 pt-0">
         
         @forelse ($plan_refs as $plan_ref)
             @if(auth()->user()->latestSubscription())
                @if(auth()->user()->latestSubscription()->plan_id== $plan_ref->id)
                    <div  class="w-full p-4 md:w-1/2 lg:w-1/4 plan-card border-2 border-green-500">
                         <div style="border:2px solid red">gfdgfdgfdg</div>
                        <label class="flex flex-col rounded-lg shadow-lg group relative cursor-pointer hover:shadow-2xl">
                        <div class="w-full px-4 py-6 rounded-t-lg card-section-1">
                            <h3 class="mb-2 mx-auto text-base font-semibold text-center underline text-blue-500 group-hover:text-blue-400">
                                Current Subscription
                            </h3>
                            <p class="text-5xl font-bold text-center group-hover:text-blue-400 text-blue-500">
                            P{{ $plan_ref->price }}
                            {{-- <span class="text-3xl"></span> --}}
                            </p>
                            <p class="text-xs text-center uppercase group-hover:text-blue-400 text-blue-500">
                            only
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-full py-6 rounded-b-lg bg-blue-500">
                            <p class="text-xl text-white">
                                {{ $plan_ref->text }}
                            </p>
                            <p class="text-white">
                                Ends On: {{ date('m/d/Y', strtotime(auth()->user()->latestSubscription()->end_timestamp)) }}
                            </p>
                            <button wire:key='{{$loop->index}}' wire:click="cancelPlan('{{$plan_ref->id}}')" class="w-5/6 py-2 mt-2 font-semibold text-center uppercase bg-red-500 border border-transparent rounded text-white">
                                CANCEL PLAN
                            </button>
                        </div>
                        </label>
                    </div>
                @else
                    <div  class="w-full p-4 md:w-1/2 lg:w-1/4 plan-card">
                        <label class="flex flex-col rounded-lg shadow-lg group relative cursor-pointer hover:shadow-2xl">
                        <div class="w-full px-4 py-6 rounded-t-lg card-section-1">
                            <h3 class="mb-2 mx-auto text-base font-semibold text-center underline text-blue-500 group-hover:text-blue-400">
                                Price
                            </h3>
                           
                            <p class="text-5xl font-bold text-center group-hover:text-blue-400 text-blue-500">
                            P{{ $plan_ref->price }}
                            {{-- <span class="text-3xl"></span> --}}
                            </p>
                            <p class="text-xs text-center uppercase group-hover:text-blue-400 text-blue-500">
                            only
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-full py-6 rounded-b-lg bg-blue-500">
                            <p class="text-xl text-white">
                                {{ $plan_ref->text }}
                            </p>
                            <button wire:key='{{$loop->index}}' wire:click="setPlan('{{$plan_ref->id}}')" class="w-5/6 py-2 mt-2 font-semibold text-center uppercase bg-white border border-transparent rounded text-blue-500">
                                SELECT PLAN
                            </button>
                        </div>
                        </label>
                    </div>
                @endif
             @else
                <div  class="w-full p-4 md:w-1/2 lg:w-1/4 plan-card">
                    <label class="flex flex-col rounded-lg shadow-lg group relative cursor-pointer hover:shadow-2xl">
                    <div class="w-full px-4 py-6 rounded-t-lg card-section-1">
                        <h3 class="mb-2 mx-auto text-base font-semibold text-center underline text-blue-500 group-hover:text-blue-400">
                            Price
                        </h3>
                        <p class="text-5xl font-bold text-center group-hover:text-blue-400 text-blue-500">
                        P{{ $plan_ref->price }}
                        {{-- <span class="text-3xl"></span> --}}
                        </p>
                        <p class="text-xs text-center uppercase group-hover:text-blue-400 text-blue-500">
                        only
                       
                    </div>
                    <div class="flex flex-col items-center justify-center w-full h-full py-6 rounded-b-lg bg-blue-500">
                        <p class="text-xl text-white mb-4" style="border-bottom-width: 1px;border-bottom-style: solid; font-weight:bold">
                            {{ $plan_ref->text }}
                        </p>
                        
                        <p class="mt-4 text-white">- Earn Points</p>
                        <p class="text-center text-white py-3" >- Post Surveys</p>
                        <p class="text-center text-white" >- Have access to our dedicated comments section</p>
                        <p class="text-center text-white py-3 mb-4" >- Earn continous reward points</p>
                        
                        <button wire:key='{{$loop->index}}' wire:click="setPlan('{{$plan_ref->id}}')" class="w-5/6 py-2 mt-2 font-semibold text-center uppercase bg-white border border-transparent rounded text-blue-500">
                            SELECT PLAN
                        </button>
                    </div>
                    </label>
                </div>
             @endif
             
         @empty
         @endforelse


     </div>
 
     <div class="flex items-center justify-center mt-4">
         <a href="/" class="text-md flex items-center justify-center group">
             @if(auth()->user()->role_id == ROLE_PREMIUM_USER)
                 <svg class="w-4 h-4 mr-2 group-hover:fill-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z"/></svg>
                 <span class="group-hover:text-blue-500">Back To Home</span>
             @else
                 <span class="group-hover:text-blue-500 mr-2">Continue as Free User</span>
                 <svg class="w-4 h-4 group-hover:fill-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z"/></svg>
             @endif
         </a>
     </div>
 </div>
 