<x-guest-layout :bodyClass="'login'">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <x-jet-authentication-card-logo />
                    </x-slot>
                </x-jet-authentication-card>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 bg-layout">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <div class="xl:hidden">
                        <x-jet-authentication-card-logo />
                    </div>
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-left">
                        Sign In
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-left xl:text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                    @if (session('status'))
                        <div class="mt-4 mb-4 font-medium text-sm text-theme-18">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-jet-validation-errors class="mt-4 mb-4" />

                    <form method="POST" action="{{ route('login') }}" class="from-theme-18">
                        @csrf
                        <div class="intro-x mt-8">
                            <x-jet-input id="email" class="login__input form-control py-3 px-4 border-gray-300 block mt-1 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" type="email" name="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus />
                                <div class="position-relative">
                                <x-jet-input id="password" class="login__input form-control py-3 px-4 border-gray-300 block mt-4 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                                <a href="javascript:;" toggle="#password" class="toggle-password"><i data-feather="eye" data-color="red" class="eye"></i><i data-feather="eye-off" class="eye-off hidden"></i></a>
                            </div>
                        </div>
                        <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <x-jet-checkbox id="remember_me" name="remember" class="form-check-input border mr-2 focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" />
                                <label class="cursor-pointer select-none" for="remember_me">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center">
                            <x-jet-button class="text-center w-full xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18">Log In</x-jet-button>
                        </div>
                        <div class="intro-x mt-10 text-gray-600 dark:text-gray-600 text-center">
                            By signin up, you agree to our
                            <a class="text-theme-18 dark:text-theme-10" href="">Terms and Conditions</a> & <a class="text-theme-18 dark:text-theme-10" href="">Privacy Policy</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
</x-guest-layout>
