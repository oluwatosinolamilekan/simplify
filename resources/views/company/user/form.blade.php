
<x-slot name="header">
    {{ __('User Details') }}
</x-slot>
<x-jet-form-section submit="save" class="mt-6">
    <x-slot name="title">
        @if($userCompanyAccess->exists) {{__('Update')}} @else {{ __('Create') }} @endif {{ __(' User Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Fill account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        @include('company.user.partials.user-form', ['user' => $user])

        <div class="border-t border-gray-200 col-span-6 sm:col-span-6 "></div>

        @include('company.user.partials.company-access-form', ['userCompanyAccess' => $userCompanyAccess])
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

