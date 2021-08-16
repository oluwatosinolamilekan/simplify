<x-slot name="header">
    {{ __('User Details') }}
</x-slot>
<div class="md:grid md:grid-cols-3 md:gap-6 mt-6">
    <x-jet-section-title>
        <x-slot name="title">{{ __('Account Details') }}</x-slot>
        <x-slot name="description">{{ __('Account\'s profile details and basic info.') }}</x-slot>
    </x-jet-section-title>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- First Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$user->first_name}}
                        </span>
                </div>

                <!-- Last Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$user->last_name}}
                        </span>
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <a href="mailto:{{$user->email}}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{$user->email}}
                    </a>
                </div>

                <!-- Role -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="role" value="{{ __('Role') }}" />
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$user->role->description}}
                        </span>
                </div>

                <!-- Email verified at -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="role" value="{{ __('Email verified') }}" />

                    @if($user->email_verified_at)
                        <x-icons.circle-check class="text-green-600 mx-0 inline" />
                        <span>{{$user->email_verified_at->format('d M, Y H:i:s')}}</span>
                    @else
                        <x-icons.circle-x class="text-red-300 mx-0 inline" />
                    @endif
                </div>

                <!-- Status -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="status" value="{{ __('Status') }}" />
                    @if($user->status->is(\App\Enums\Status::Active))
                        <x-icons.circle-check class="text-green-600 mx-0 inline" />
                    @else
                        <x-icons.circle-x class="text-red-300 mx-0 inline" />
                    @endif
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{$user->status->description}}
                    </span>
                </div>

                <!-- Two Factor Enabled -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="role" value="{{ __('Two Factor Enabled') }}" />
                    @if($user->two_factor_secret)
                        <x-icons.circle-check class="text-green-600 mx-0 inline" />
                    @else
                        <x-icons.circle-x class="text-red-300 mx-0 inline" />
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-dark-2 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <x-success-anchor href="{{route('users.update', $this->user->id)}}">
                {{ __('Update') }}
            </x-success-anchor>
            <x-jet-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </div>
    </div>
</div>

