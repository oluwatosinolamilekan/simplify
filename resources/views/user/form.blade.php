<x-slot name="header">
    {{ __('User Details') }}
</x-slot>
<x-jet-form-section submit="save" class="mt-6">
    <x-slot name="title">
        @if($user->exists) {{__('Update')}} @else {{ __('Create') }} @endif {{ __(' User Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Fill account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- First Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="first_name" value="{{ __('First Name') }}" />
            <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model="user.first_name" autocomplete="name" />
            <x-jet-input-error for="user.first_name" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
            <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model="user.last_name" autocomplete="name" />
            <x-jet-input-error for="user.last_name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="user.email"/>
            <x-jet-input-error for="user.email" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="role" value="{{ __('Role') }}" />
            <select id="role" wire:model="user.role" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" disabled>
                <option value="{{\App\Enums\Role::SuperAdministrator}}">{{\App\Enums\Role::SuperAdministrator()->description}}</option>
            </select>
            <x-jet-input-error for="user.role" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="status" value="{{ __('Status') }}" />
            <select id="status" wire:model="user.status" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value={{\App\Enums\Status::Active}} selected>
                    {{ \App\Enums\Status::Active()->description }}
                </option>
                <option value={{\App\Enums\Status::NotActive}}>
                    {{ \App\Enums\Status::NotActive()->description }}
                </option>
            </select>
            <x-jet-input-error for="user.status" class="mt-2" />
        </div>
    </x-slot>

    <!-- Actions -->
    <x-slot name="actions">

        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button class="text-center xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>

        @if($user->exists)
            <x-jet-danger-button wire:click="confirmDeletion" class="text-center xl:mr-3 align-top border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-form-section>
