<x-slot name="header">
    {{ __('Update User Details') }}
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
            <x-input id="first_name" type="text" wire:model.defer="user.first_name" autocomplete="name" />
            <x-jet-input-error for="user.first_name" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
            <x-input id="last_name" type="text" wire:model.defer="user.last_name" autocomplete="name" />
            <x-jet-input-error for="user.last_name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" wire:model.defer="user.email"/>
            <x-jet-input-error for="user.email" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="role" value="{{ __('Role') }}" />
            <x-select id="role" wire:model.defer="user.role" disabled>
                <option value="{{\App\Enums\Role::SuperAdministrator}}">{{\App\Enums\Role::SuperAdministrator()->description}}</option>
            </x-select>
            <x-jet-input-error for="user.role" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="status" value="{{ __('Status') }}" />
            <x-select id="status" wire:model.defer="user.status">
                <option value={{\App\Enums\Status::Active}} selected>
                    {{ \App\Enums\Status::Active()->description }}
                </option>
                <option value={{\App\Enums\Status::NotActive}}>
                    {{ \App\Enums\Status::NotActive()->description }}
                </option>
            </x-select>
            <x-jet-input-error for="user.status" class="mt-2" />
        </div>
    </x-slot>

    <!-- Actions -->
    <x-slot name="actions">

        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-success-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-success-button>

        @if($user->exists)
            <x-jet-danger-button wire:click="confirmDeletion" class="text-center xl:mr-3 align-top" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-form-section>
