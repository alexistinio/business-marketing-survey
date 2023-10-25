<div class="navbar bg-base-100 relative">
    <div class="flex-1">
    <a href="{{ route('home') }}" class="flex justify-between text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
           <img class="ml-5 pt-2" src="/images/logo.png" height="160" width="160" alt="">
           
        </a>
    </div>

    <div class="flex-none gap-2">
        
    
        <div class="form-control font-bold">
            {{ auth()->user()->name }}
        </div>
        

        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="{{  (auth()->user()->details ?? null)->profile ?? null ? asset('storage/' . auth()->user()->details->profile) : asset('images/default-profile-2.svg')  }}" />
                </div>
            </label>
            <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                <li>
                    <a href="{{ route('profile.index') }}" class="justify-between">
                        Profile
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

