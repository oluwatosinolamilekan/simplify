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
                            <div x-data="{ show: true }">
                                <div class="relative">
                                    <input id="password" :type="show ? 'password' : 'text'" class="form-control py-3 px-4 border-gray-300 block mt-4 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18 focus:ring-opacity-50" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">

                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                        <svg id="show_password_icon" class="h-6 text-gray-600" fill="none" @click="show = !show"
                                             :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                             viewbox="0 0 576 512">
                                            <path fill="currentColor"
                                                  d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                            </path>
                                        </svg>
                                        <svg id="hide_password_icon" class="h-6 text-gray-600" fill="none" @click="show = !show"
                                             :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                             viewbox="0 0 640 512">
                                            <path fill="currentColor"
                                                  d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
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
