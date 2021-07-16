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
            <!-- END: Email Verification Info -->
            <!-- BEGIN: Email Verification Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 bg-layout">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <div class="xl:hidden">
                        <x-jet-authentication-card-logo />
                    </div>
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-left">
                        Email Verification
                    </h2>
                    <div class="intro-x mt-4 text-sm text-gray-500 text-left xl:max-w-md">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>
                    @if (session('status') == 'verification-link-sent')
                        <div class="mt-4 font-medium text-sm xl:max-w-md text-theme-18">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <x-jet-validation-errors class="mt-4 mb-4" />

                    <form method="POST" action="{{ route('verification.send') }}" class="from-theme-18">
                        @csrf

                        <div class="intro-x mt-4">
                            <x-success-button type="submit" class="w-full">
                                {{ __('Resend Verification Email') }}
                            </x-success-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="from-theme-18">
                        @csrf
                        <div class="intro-x mt-4 text-center">
                            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Log Out') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Email Verification Form -->
        </div>
    </div>
</x-guest-layout>
