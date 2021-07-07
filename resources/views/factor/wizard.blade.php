<x-slot name="header">
    {{ __('Factor Wizard') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <form wire:submit.prevent="save">

        <!-- Company Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Company Information') }}</x-slot>
                    <x-slot name="description">{{ __('Fill company information.') }}</x-slot>
                </x-jet-section-title>

                @include('company.form', ['company' => $company])
            </div>
        </div>

        <x-jet-section-border />

        <!-- Factor Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Factor Information') }}</x-slot>
                    <x-slot name="description">{{ __('Fill factor information.') }}</x-slot>
                </x-jet-section-title>

                @include('factor.relation-form', ['factor' => $factor])
            </div>
        </div>

        <x-jet-section-border />

        <!-- Subscription plan selection -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Subscription plan') }}</x-slot>
                    <x-slot name="description">{{ __('Select subscription plan.') }}</x-slot>
                </x-jet-section-title>

                @include('factor.subscription-plan-form', ['factor' => $factor])
            </div>
        </div>

        <x-jet-section-border />

        <!-- Bank Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Bank Information') }}</x-slot>
                    <x-slot name="description">{{ __('Fill company bank information.') }}</x-slot>
                </x-jet-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2" >
                    @include('bank-information.form', ['bankInformation' => $bankInformation])
                </div>
            </div>
        </div>

        @if (!$factor->exists)
        <!-- Administrator Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __( 'Administrator Information') }}</x-slot>
                    <x-slot name="description">{{ 'Fill administrator account information.'}}</x-slot>
                </x-jet-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-6 gap-6">
                            @include('company.user.partials.user-form', ['user' => $user])
                        </div>

                        <x-jet-section-border />

                        <div class="grid grid-cols-6 gap-6">
                            @include('company.user.partials.company-access-form', ['userCompanyAccess' => $userCompanyAccess, 'roles' => [\App\Enums\Role::Administrator]])
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <x-jet-section-border />
        @endif

        <!-- Address Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Address Information') }}</x-slot>
                    <x-slot name="description">{{ __('Fill company address information.') }}</x-slot>
                </x-jet-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2" >
                    @include('address.form', ['address' => $address])
                </div>
            </div>
        </div>

        <x-jet-section-border />

        <!-- Contact Information -->
        <div class="mt-10 sm:mt-0">
            <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Contact Details') }}</x-slot>
                    <x-slot name="description">{{ __('Fill contact details.') }}</x-slot>
                </x-jet-section-title>

                @include('contact.form', ['contact' => $contact])
            </div>
        </div>

        <x-jet-section-border />

        <!-- Actions -->
        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button class="text-center xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>

                @if($factor->exists)
                    <x-jet-danger-button wire:click="confirmDeletion" class="text-center xl:mr-3 align-top border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-jet-danger-button>
                @endif
            </div>
    </form>
</div>
