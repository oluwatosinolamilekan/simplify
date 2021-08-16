<x-slot name="header">
    {{ __('User Details') }}
</x-slot>
<div class="md:grid md:grid-cols-3 md:gap-6 mt-6">
    <x-jet-section-title>
        <x-slot name="title">{{ __('Account Details') }}</x-slot>
        <x-slot name="description">{{ __('Account\'s profile details and basic info.') }}</x-slot>
    </x-jet-section-title>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- First Name -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$userCompanyAccess->first_name}}
                        </span>
                </div>

                <!-- Last Name -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$userCompanyAccess->last_name}}
                        </span>
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <a href="mailto:{{$userCompanyAccess->user->email}}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{$userCompanyAccess->user->email}}
                    </a>
                </div>
                <!-- Role -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="role" value="{{ __('Role') }}" />
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$userCompanyAccess->role->description}}
                    </span>
                </div>

                <!-- Status -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="status" value="{{ __('Status') }}" />
                    @if($userCompanyAccess->status->is(\App\Enums\Status::Active))
                        <x-icons.circle-check class="text-green-600 mx-0 inline" />
                    @else
                        <x-icons.circle-x class="text-red-300 mx-0 inline" />
                    @endif
                    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{$userCompanyAccess->status->description}}
                    </span>
                </div>

                <!-- Additional Emails -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="email" value="{{ __('Additional Emails') }}" />
                    @foreach($userCompanyAccess->emails ?? [] as $email)
                        <a href="mailto:{{$email}}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$email}}
                        </a>
                    @endforeach
                </div>


                <!-- Phone Numbers -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="email" value="{{ __('Phone Numbers') }}" />
                    @foreach($userCompanyAccess->phone_numbers ?? [] as $phone)
                        <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$phone}}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <a href="{{route('companies.users.update', ['company_id' => $userCompanyAccess->company_id, 'user_id' => $userCompanyAccess->user_id])}}" class="bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition">
                {{ __('Update') }}
            </a>
            <x-jet-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </div>

    </div>
</div>

