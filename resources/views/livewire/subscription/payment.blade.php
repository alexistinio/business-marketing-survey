<div>
    <div class="flex">
        <div class="w-full divide-y-2 divide-black ">
            <div class="flex justify-between">
                <div>
                    <h1>
                        <span class="text-3xl font-bold mb-2 text-blue-500">Payment: </span>
                        <span class="text-3xl font-bold">{{ $subscription ? '₱' . number_format($subscription->plan->price, 2, '.', ',') : 0.00 }}</span>
                    </h1>
                </div>
                <img style="width: 10rem;" src="{{ asset('images/gcash-logo-2.png') }}" alt="Gcash logo">
            </div>
            <hr class="py-4">
        </div>
    </div>
    <div class="flex mt-2"> 
        <div class="w-6/12">
        
            @if( session()->get('status') )
                
            @endif
            <div class="alert shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold">Submitted!</h3>
                        <div class="text-xs">Your subscription has been submitted.</div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning shadow-lg mt-6">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold">Please Scan the qr code to pay, or you can directly send to account number 09664872171</h3>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                Once payment is done, please send the screenshot including your account's <span class="font-bold">Username</span>
                and <span class="font-bold">Email Address</span> to <span class="font-bold">tinioalexis@gmail.com</span>. Once we have validated your
                payment, We'll proceed with the upgrade immediately and we'll let you know
                through notifications.
            </div>
            <div class="mt-6">
                <a href="/" class="text-md flex items-center justify-center group">
                    <span class="group-hover:text-blue-500 mr-2">Continue as Free User</span>
                    <svg class="w-4 h-4 group-hover:fill-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z"/></svg>
                </a>
            </div>
        </div>
        <div class="w-6/12">
            <img style="height: 80vh" src="{{ asset('images/gcash.jpg') }}" alt="">
        </div>
    </div>
</div>
