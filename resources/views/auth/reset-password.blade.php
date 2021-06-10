<x-guest-layout :bodyClass="'login'">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Reset Password Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <x-jet-authentication-card-logo />
                    </x-slot>
                </x-jet-authentication-card>
            </div>
            <!-- END: Reset Password Info -->
            <!-- BEGIN: Reset Password Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 bg-layout">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <div class="xl:hidden">
                        <x-jet-authentication-card-logo />
                    </div>

                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-left mb-4">
                        Reset Password
                    </h2>

                    <x-jet-validation-errors class="mb-4 xl:max-w-sm" />

                    <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="intro-x">
                            <x-jet-input id="email" class="login__input form-control py-3 px-4 border-gray-300 block mt-1 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" type="email" name="email" :value="old('email', $request->email)" placeholder="{{ __('Email') }}" required autofocus />
                        </div>
                        <div class="intro-x mt-4 position-relative">
                            <x-jet-input id="password" class="login__input form-control py-3 px-4 border-gray-300 block mt-1 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password" />
                            <a href="javascript:;" toggle="#password" class="toggle-password"><i data-feather="eye" data-color="red" class="eye"></i><i data-feather="eye-off" class="eye-off hidden"></i></a>
                        </div>
                        <div class="intro-x mt-4 position-relative">
                            <x-jet-input id="password_confirmation" class="login__input form-control py-3 px-4 border-gray-300 block mt-1 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password" />
                            <a href="javascript:;" toggle="#password_confirmation" class="toggle-password"><i data-feather="eye" data-color="red" class="eye"></i><i data-feather="eye-off" class="eye-off hidden"></i></a>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <x-jet-button class="text-center py-3 px-4 w-full xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18">
                                {{ __('Reset Password') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Reset Password Form -->
        </div>
    </div>
</x-guest-layout>
