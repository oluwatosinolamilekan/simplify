<x-slot name="header">
    {{ __('Factor Wizard') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs tabs='{
        "general": "General",
        "address": {"title": "Address & Contact Details", "enabled": "{{$factor->exists}}"},
        "bank": {"title": "Bank Information", "enabled": "{{$factor->exists}}"},
        "users": {"title": "Users", "enabled": "{{$factor->exists}}"}
    }'>
        <x-slot name="general">
            <form wire:submit.prevent="save">

                <!-- Company Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Company Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill company information.') }}</x-slot>
                        </x-jet-section-title>

                        @include('companies.form', ['company' => $company])
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

                        @include('factors.relation.form', ['factor' => $factor])
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

                        @include('factors.subscription-plan-form', ['factor' => $factor])
                    </div>
                </div>

                    <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => $factor->exists])
            </form>
        </x-slot>

        <x-slot name="address">
        @if($factor->exists)
            <!-- Address Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Address Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill company address information.') }}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:address.address-form :address="$address" :partial="false" :nested="true"/>
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

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:contact.contact-form :contact="$contact" :partial="false" :nested="true"/>
                        </div>
                    </div>
                </div>
        @endif
        </x-slot>
        <x-slot name="bank">
        @if($factor->exists)
            <!-- Bank Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Bank Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill company bank information.') }}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:bank-information.bank-information-form :bankInformation="$bankInformation" :partial="false" :nested="true"/>
                        </div>
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="users">
            @if ($factor->exists)
            <!-- Administrator Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __( 'Administrator Information') }}</x-slot>
                        <x-slot name="description">{{ 'Fill administrator account information.'}}</x-slot>
                    </x-jet-section-title>

                    <x-collapsible-container>
                        <x-slot name="form">
                            <livewire:company.user.company-user-form :company="$company" :partial="false" :nested="true"/>
                        </x-slot>
                    </x-collapsible-container>

                </div>
            </div>
            <livewire:company.user.company-users-list :company="$company"/>
            @endif
        </x-slot>

    </x-tabs>
</div>
