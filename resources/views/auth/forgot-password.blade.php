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
                                <x-input id="email" class="w-full" type="email" name="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus />
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center">
                                <x-success-button class="w-full">
                                    {{ __('Email Password Reset Link') }}
                                </x-success-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <!-- END: Forgot Password Form -->
        </div>
    </div>
</x-guest-layout>
