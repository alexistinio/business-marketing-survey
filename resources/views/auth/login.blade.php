<x-guest-layout>
    <x-auth-card>
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}

        <div class="mb-2 w-full flex justify-center">
            <h1 class="text-2xl font-bold">Login to your Account</h1>
        </div>
        <div class="mt-4 mb-4">
            <hr class="py-1" />
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4 alert alert-error shadow-lg flex-col text-white" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email or Username')" />
                <x-input id="email" placeholder="Email or Username" class="block mt-1 input input-bordered input-md w-full" type="text" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 input input-bordered input-md w-full"
                                type="password"
                                name="password"
                                placeholder="Enter Password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="mt-4 flex justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button class="w-full btn btn-md">
                    {{ __('Log in') }}
                </x-button>
            </div>

            <div class="mt-6">
                <hr class="py-1" />
            </div>
            <div class="flex items-center justify-center ">
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __("Don't have an account?") }}
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
