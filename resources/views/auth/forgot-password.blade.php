<x-guest-layout :bodyClass="'login'">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Forgot Password Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <x-jet-authentication-card-logo />
                    </x-slot>
                </x-jet-authentication-card>
            </div>
            <!-- END: Forgot Password Info -->
            <!-- BEGIN: Forgot Password Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 bg-layout">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <div class="xl:hidden">
                        <x-jet-authentication-card-logo />
                    </div>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-center text-sm text-theme-18">
                            {{ session('status') }}
                        </div>
                    @elseif(!session('status'))
                        <div class="intro-x mt-2 text-sm text-gray-500 text-left xl:max-w-md">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                        <x-jet-validation-errors class="mt-4 mb-4 xl:max-w-sm" />

                        <form method="POST" action="{{ route('password.email') }}" class="from-theme-18">
                            @csrf
                            <div class="intro-x mt-8">
                                <x-jet-input id="email" class="login__input form-control py-3 px-4 border-gray-300 block mt-1 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" type="email" name="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus />
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center">
                                <x-jet-button class="text-center py-3 px-4 w-full xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18">
                                    {{ __('Email Password Reset Link') }}
                                </x-jet-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <!-- END: Forgot Password Form -->
        </div>
    </div>
</x-guest-layout>
