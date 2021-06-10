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
                        <div x-data="{ show: true }">
                            <div class="intro-x mt-4 relative">
                                <input id="password" :type="show ? 'password' : 'text'" class="login__input form-control py-3 px-4 border-gray-300 block mt-4 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                    <svg class="h-6 text-gray-600" fill="none" @click="show = !show"
                                         :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                         viewbox="0 0 576 512">
                                        <path fill="currentColor"
                                              d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                        </path>
                                    </svg>
                                    <svg class="h-6 text-gray-600" fill="none" @click="show = !show"
                                         :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                         viewbox="0 0 640 512">
                                        <path fill="currentColor"
                                              d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ show: true }">
                            <div class="intro-x mt-4 relative">
                                <input id="password_confirmation" :type="show ? 'password' : 'text'" class="login__input form-control py-3 px-4 border-gray-300 block mt-4 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                    <svg class="h-6 text-gray-600" fill="none" @click="show = !show"
                                         :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                         viewbox="0 0 576 512">
                                        <path fill="currentColor"
                                              d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                        </path>
                                    </svg>
                                    <svg class="h-6 text-gray-600" fill="none" @click="show = !show"
                                         :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                         viewbox="0 0 640 512">
                                        <path fill="currentColor"
                                              d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
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
