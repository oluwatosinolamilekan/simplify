<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <h3 class="guest-layout-form-title">Sign In</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="mt-9">
                <x-jet-button>
                    {{ __('Log in') }}
                </x-jet-button>
            </div>

            <div class="divider mt-8">
                <p>or</p>
            </div>

            <div class="mt-8">
                <a href="{{ route('register') }}" class="register-button">
                    {{ __('Sign up') }}
                </a>
                <span class="terms-link">By signin up, you agree to our <a href="#">Terms and Conditions</a></span>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
