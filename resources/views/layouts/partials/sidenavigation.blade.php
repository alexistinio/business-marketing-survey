<div class="md:flex flex-col md:h-screen sticky top-0 md:flex-row md:min-h-screen shadow">
    <div @click.away="open = false" class="flex flex-col w-full md:w-64 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }">
      <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
           
        
        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>

      <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
       
   
    <div class="bg-black bg-opacity-50 absolute inset-0 hidden items-start" id="overlay">
        <div class="bg-gray-200 max-w-sm py-2 px-3 shadow-xl text-gray-800" style="width:300px">
            <div class="flex justify-between items-center">
                <h4 class="text-lg font-bold ml-2">Points</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="mt-2 text-md flex items-center" style="flex-direction: column;">
             
                <p>Current Points: <span class="font-bold">{{ auth()->user()->points->points }}</span></p>
                <p class="mt-3">Current Conversion: </p>
                @if(auth()->user()->role_id == 3 )
                <p style="margin-left:8px" class="mt-1 font-bold">10 points = 1 Peso</p>
                <p class="mt-3">Earnings in Peso = <span class="font-bold" style="font-size:20px">{{ auth()->user()->points->points/10 }}</span></p>
                
                @elseif (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                <p style="margin-left:8px" class="mt-1 font-bold">8 points = 1 Peso</p>
                <p class="mt-3">Earnings in Peso = <span class="font-bold" style="font-size:20px">{{ auth()->user()->points->points/8 }}</span></p>
                
                @else
                <p style="margin-left:8px" class="mt-1 font-bold">6 points = 1 Peso</p>
                <p class="mt-3">Earnings in Peso = <span class="font-bold" style="font-size:20px">{{ auth()->user()->points->points/6 }}</span></p>
                @endif
                
            </div>
            <div class="mt-8 flex justify-center space-x-3">
                <p id="basis" hidden>{{ auth()->user()->points->request }}</p>

               <a href="/claim_points"><button id="claim" class="mb-4 px-3 py-1 bg-blue-600 text-gray-200 hover:bg-blue-700 rounded" style="width:200px; border-radius: 20px; height:40px">Claim</button></a>
            </div>
        </div>
    </div>

      <a style="cursor: pointer"id="delete-btn" class="bg-success flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-green-500 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-gem ms-4" viewBox="0 0 16 16">
                <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
            </svg>
            <h1 class="px-3">{{ auth()->user()->points->points }} / 3000</h1>
            </a>

        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-gray-200' : '' }} mt-5 flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>
                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M511.8 287.6L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L416 100.7V64C416 46.33 430.3 32 448 32H480C497.7 32 512 46.33 512 64V185L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6L511.8 287.6z"/></svg>
            </span>
            <span class="ml-2">Home</span>
        </a>

        <a href="{{ route('message') }}" class="{{ request()->routeIs('messsage') ? 'bg-gray-200' : '' }} flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>
                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M447.1 0h-384c-35.25 0-64 28.75-64 63.1v287.1c0 35.25 28.75 63.1 64 63.1h96v83.98c0 9.836 11.02 15.55 19.12 9.7l124.9-93.68h144c35.25 0 64-28.75 64-63.1V63.1C511.1 28.75 483.2 0 447.1 0zM464 352c0 8.75-7.25 16-16 16h-160l-80 60v-60H64c-8.75 0-16-7.25-16-16V64c0-8.75 7.25-16 16-16h384c8.75 0 16 7.25 16 16V352z"/></svg>
            </span>
            <span class="ml-2">
                Messages
                <span id="new-messages"></span>
            </span>
        </a>

        <a href="{{ route('notification') }}" class="{{ request()->routeIs('notification') ? 'bg-gray-200' : '' }} flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>
                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 32V49.88C328.5 61.39 384 124.2 384 200V233.4C384 278.8 399.5 322.9 427.8 358.4L442.7 377C448.5 384.2 449.6 394.1 445.6 402.4C441.6 410.7 433.2 416 424 416H24C14.77 416 6.365 410.7 2.369 402.4C-1.628 394.1-.504 384.2 5.26 377L20.17 358.4C48.54 322.9 64 278.8 64 233.4V200C64 124.2 119.5 61.39 192 49.88V32C192 14.33 206.3 0 224 0C241.7 0 256 14.33 256 32V32zM216 96C158.6 96 112 142.6 112 200V233.4C112 281.3 98.12 328 72.31 368H375.7C349.9 328 336 281.3 336 233.4V200C336 142.6 289.4 96 232 96H216zM288 448C288 464.1 281.3 481.3 269.3 493.3C257.3 505.3 240.1 512 224 512C207 512 190.7 505.3 178.7 493.3C166.7 481.3 160 464.1 160 448H288z"/></svg>
            </span>
            <span class="ml-2">
                Notifications
                @if (count($unread_notifications) > 0)
                    <span class="badge badge-primary badge-sm">{{ count($unread_notifications) }}</span>
                @endif
            </span>
        </a>

        <a href="{{ route('group') }}" class="{{ request()->routeIs('group') || request()->routeIs('group.view') ? 'bg-gray-200' : '' }} flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>
                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M64 0C90.86 0 113.9 16.55 123.3 40H324.7C334.1 16.55 357.1 0 384 0C419.3 0 448 28.65 448 64C448 90.86 431.5 113.9 408 123.3V228.7C431.5 238.1 448 261.1 448 288C448 323.3 419.3 352 384 352C357.1 352 334.1 335.5 324.7 312H123.3C113.9 335.5 90.86 352 64 352C28.65 352 0 323.3 0 288C0 261.1 16.55 238.1 40 228.7V123.3C16.55 113.9 0 90.86 0 64C0 28.65 28.65 0 64 0V0zM64 80C72.84 80 80 72.84 80 64C80 56.1 74.28 49.54 66.75 48.24C65.86 48.08 64.94 48 64 48C55.16 48 48 55.16 48 64C48 64.07 48 64.14 48 64.21C48.01 65.07 48.09 65.92 48.24 66.75C49.54 74.28 56.1 80 64 80zM384 48C383.1 48 382.1 48.08 381.2 48.24C373.7 49.54 368 56.1 368 64C368 72.84 375.2 80 384 80C391.9 80 398.5 74.28 399.8 66.75C399.9 65.86 400 64.94 400 64C400 55.16 392.8 48 384 48V48zM324.7 88H123.3C116.9 104 104 116.9 88 123.3V228.7C104 235.1 116.9 247.1 123.3 264H324.7C331.1 247.1 343.1 235.1 360 228.7V123.3C343.1 116.9 331.1 104 324.7 88zM400 288C400 287.1 399.9 286.1 399.8 285.2C398.5 277.7 391.9 272 384 272C375.2 272 368 279.2 368 288C368 295.9 373.7 302.5 381.2 303.8C382.1 303.9 383.1 304 384 304C392.8 304 400 296.8 400 288zM64 272C56.1 272 49.54 277.7 48.24 285.2C48.08 286.1 48 287.1 48 288C48 296.8 55.16 304 64 304L64.22 303.1C65.08 303.1 65.93 303.9 66.75 303.8C74.28 302.5 80 295.9 80 288C80 279.2 72.84 272 64 272zM471.3 248C465.8 235.9 457.8 225.2 448 216.4V200H516.7C526.1 176.5 549.1 160 576 160C611.3 160 640 188.7 640 224C640 250.9 623.5 273.9 600 283.3V388.7C623.5 398.1 640 421.1 640 448C640 483.3 611.3 512 576 512C549.1 512 526.1 495.5 516.7 472H315.3C305.9 495.5 282.9 512 256 512C220.7 512 192 483.3 192 448C192 421.1 208.5 398.1 232 388.7V352H280V388.7C296 395.1 308.9 407.1 315.3 424H516.7C523.1 407.1 535.1 395.1 552 388.7V283.3C535.1 276.9 523.1 264 516.7 248H471.3zM592 224C592 215.2 584.8 208 576 208C575.1 208 574.1 208.1 573.2 208.2C565.7 209.5 560 216.1 560 224C560 232.8 567.2 240 576 240C583.9 240 590.5 234.3 591.8 226.8C591.9 225.9 592 224.9 592 224zM240 448C240 456.8 247.2 464 256 464C256.9 464 257.9 463.9 258.8 463.8C266.3 462.5 272 455.9 272 448C272 439.2 264.8 432 256 432C248.1 432 241.5 437.7 240.2 445.2C240.1 446.1 240 447.1 240 448zM573.2 463.8C574.1 463.9 575.1 464 576 464C584.8 464 592 456.8 592 448C592 447.1 591.9 446.2 591.8 445.3L591.8 445.2C590.5 437.7 583.9 432 576 432C567.2 432 560 439.2 560 448C560 455.9 565.7 462.5 573.2 463.8V463.8z"/></svg>
            </span>
            <span class="ml-2">Groups</span>
        </a>

        <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'bg-gray-200' : '' }} flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>
                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M272 304h-96C78.8 304 0 382.8 0 480c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32C448 382.8 369.2 304 272 304zM48.99 464C56.89 400.9 110.8 352 176 352h96c65.16 0 119.1 48.95 127 112H48.99zM224 256c70.69 0 128-57.31 128-128c0-70.69-57.31-128-128-128S96 57.31 96 128C96 198.7 153.3 256 224 256zM224 48c44.11 0 80 35.89 80 80c0 44.11-35.89 80-80 80S144 172.1 144 128C144 83.89 179.9 48 224 48z"/></svg>
            </span>
            <span class="ml-2">Profile</span>
        </a>

        @if(auth()->user()->hasRole('superadmin'))
            <a href="{{ route('user-management.index') }}" class="{{ request()->routeIs('user-management') ? 'bg-gray-200' : '' }} flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <span>
                    <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M319.9 320c57.41 0 103.1-46.56 103.1-104c0-57.44-46.54-104-103.1-104c-57.41 0-103.1 46.56-103.1 104C215.9 273.4 262.5 320 319.9 320zM369.9 352H270.1C191.6 352 128 411.7 128 485.3C128 500.1 140.7 512 156.4 512h327.2C499.3 512 512 500.1 512 485.3C512 411.7 448.4 352 369.9 352zM512 160c44.18 0 80-35.82 80-80S556.2 0 512 0c-44.18 0-80 35.82-80 80S467.8 160 512 160zM183.9 216c0-5.449 .9824-10.63 1.609-15.91C174.6 194.1 162.6 192 149.9 192H88.08C39.44 192 0 233.8 0 285.3C0 295.6 7.887 304 17.62 304h199.5C196.7 280.2 183.9 249.7 183.9 216zM128 160c44.18 0 80-35.82 80-80S172.2 0 128 0C83.82 0 48 35.82 48 80S83.82 160 128 160zM551.9 192h-61.84c-12.8 0-24.88 3.037-35.86 8.24C454.8 205.5 455.8 210.6 455.8 216c0 33.71-12.78 64.21-33.16 88h199.7C632.1 304 640 295.6 640 285.3C640 233.8 600.6 192 551.9 192z"/></svg>
                </span>
                <span class="ml-2">User Management</span>
            </a>
        @endif
       
        <div class="">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    <span>
                        <svg class="w-4" fill="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z"/></svg>
                    </span>
                    <span class="ml-2">Logout</span>
                </button>
            </form>
        </div>
       
        {{-- <div @click.away="open = false" class="relative" x-data="{ open: false }">
          <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>More</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                    About
                </a>
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                    Services
                </a>
            </div>
          </div>
        </div> --}}

        <div class="mt-6">

            @if(!auth()->user()->latestSubscription() && auth()->user()->hasRole('user'))
                <a href="{{ route('subscription') }}">
                    <button type="button" class="btn btn-primary w-full rounded-lg" >
                        <span>
                            <svg fill="#ffd333" class="w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M156.6 384.9L125.7 353.1C117.2 345.5 114.2 333.1 117.1 321.8C120.1 312.9 124.1 301.3 129.8 288H24C15.38 288 7.414 283.4 3.146 275.9C-1.123 268.4-1.042 259.2 3.357 251.8L55.83 163.3C68.79 141.4 92.33 127.1 117.8 127.1H200C202.4 124 204.8 120.3 207.2 116.7C289.1-4.07 411.1-8.142 483.9 5.275C495.6 7.414 504.6 16.43 506.7 28.06C520.1 100.9 516.1 222.9 395.3 304.8C391.8 307.2 387.1 309.6 384 311.1V394.2C384 419.7 370.6 443.2 348.7 456.2L260.2 508.6C252.8 513 243.6 513.1 236.1 508.9C228.6 504.6 224 496.6 224 488V380.8C209.9 385.6 197.6 389.7 188.3 392.7C177.1 396.3 164.9 393.2 156.6 384.9V384.9zM384 167.1C406.1 167.1 424 150.1 424 127.1C424 105.9 406.1 87.1 384 87.1C361.9 87.1 344 105.9 344 127.1C344 150.1 361.9 167.1 384 167.1z"/></svg>
                        </span>
                        <span class="ml-2">Upgrade Your Plan</span>
                    </button>
                </a>
            @else
            <a href="{{ route('post.create') }}">
                <button type="button" class="btn w-full rounded-lg" >
                    <span class="ml-2">Create Post</span>
                </button>
            </a>
            @endif
        </div>
        
      </nav>
    </div>
  </div>

      <script>

        window.addEventListener('DOMContentLoaded', () =>{
            const overlay = document.querySelector('#overlay')
            const delBtn = document.querySelector('#delete-btn')
            const closeBtn = document.querySelector('#close-modal')

            const toggleModal = () => {
                overlay.classList.toggle('hidden')
                overlay.classList.toggle('flex')
            }

            delBtn.addEventListener('click', toggleModal)

            closeBtn.addEventListener('click', toggleModal)
        })

 
   
        $(document).ready(function () {
        
            if($('#basis').html() =='Claiming/Claimed'){

                $("#claim").html("Request claim sent.");
                $('#claim').attr('disabled','disabled');
                $('#claim').css('background-color','gray');
                sessionStorage.setItem("key", "points_alert");
            }

            else {
                // to do
            }
      });
          
    </script>

