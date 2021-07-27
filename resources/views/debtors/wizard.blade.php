<x-slot name="header">
    {{ __('Debtor Wizard') }}
</x-slot>


<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs tabs='{
        "general": "General",
        "credit": {"title": "Credit", "enabled": "{{$debtor->exists}}"},
        "identity": {"title": "Identity", "enabled": "{{$debtor->exists}}"},
        "address": {"title": "Address & Contact Details", "enabled": "{{$debtor->exists}}"},
        "bank": {"title": "Bank Information", "enabled": "{{$debtor->exists}}"},
        "users": {"title": "Users", "enabled": "{{$debtor->exists}}"}
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

                <!-- Debtor Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Debtor Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill debtor information.') }}</x-slot>
                        </x-jet-section-title>

                        @include('debtors.relation.form', ['debtor' => $debtor])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Factor Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Client Information') }}</x-slot>
                            <x-slot name="description">{{ __('Select client.') }}</x-slot>
                        </x-jet-section-title>

                        @include('debtors.relation.client-form', ['debtor' => $debtor])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Settings -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Debtor Settings') }}</x-slot>
                            <x-slot name="description">{{ __('Fill debtor settings.') }}</x-slot>
                        </x-jet-section-title>

                        @include('debtors.settings.form', ['settings' => $settings, 'partial' => true, 'nested' => true])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => $debtor->exists])

            </form>
        </x-slot>
        <x-slot name="credit">
            @if($debtor->exists)
                <livewire:debtor.debtor-credit-main-form :debtor="$debtor" :partial="false" :nested="true"/>
            @endif
        </x-slot>
        <x-slot name="identity">
            @if($debtor->exists)
                <!-- Company Identity -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Identity') }}</x-slot>
                            <x-slot name="description">{{ __('Company identity information.') }}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:company.company-identity-form :identity="$identity" :partial="false" :nested="true"/>
                        </div>
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot name="address">
        @if($debtor->exists)
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
        @if($debtor->exists)
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
        @if ($debtor->exists)
            <!-- Administrator Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __( 'Administrator Information') }}</x-slot>
                            <x-slot name="description">{{ 'Fill administrator account information.'}}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <x-success-anchor wire:loading.attr="disabled"> + Add </x-success-anchor>
                            </div>

                            <livewire:company.user.company-user-form :company="$company" :partial="false" :nested="true"/>
                        </div>
                    </div>
                </div>
                <div>
                    <livewire:company.user.company-users-list :company="$company"/>
                </div>

            @endif
        </x-slot>
    </x-tabs>
</div>
