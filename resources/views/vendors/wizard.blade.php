<x-slot name="header">
    {{ __('Vendor Wizard') }}
</x-slot>


<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs tabs='{
        "general": "General",
        "identity": {"title": "Identity", "enabled": "{{$vendor->exists}}"},
        "address": {"title": "Address & Contact Details", "enabled": "{{$vendor->exists}}"},
        "bank": {"title": "Bank Information", "enabled": "{{$vendor->exists}}"},
        "users": {"title": "Users", "enabled": "{{$vendor->exists}}"}
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

                <!-- Vendor Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Vendor Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill vendor information.') }}</x-slot>
                        </x-jet-section-title>

                        @include('vendors.relation.form', ['vendor' => $vendor])
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

                        @include('vendors.relation.client-form', ['vendor' => $vendor])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Settings -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Vendor Settings') }}</x-slot>
                            <x-slot name="description">{{ __('Fill vendor settings.') }}</x-slot>
                        </x-jet-section-title>

                        @include('vendors.settings.form', ['settings' => $settings, 'partial' => true, 'nested' => true])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => $vendor->exists])

            </form>
        </x-slot>
        <x-slot name="identity">
        @if($vendor->exists)
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
        @if($vendor->exists)
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
        @if($vendor->exists)
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
        @if ($vendor->exists)
            <!-- Administrator Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __( 'Administrator Information') }}</x-slot>
                            <x-slot name="description">{{ 'Fill administrator account information.'}}</x-slot>
                        </x-jet-section-title>

                        <x-collapsible-container  :collapseButton="'Cancel'" :expandButton="'+Add'">llapsible-container>
                            <x-slot name="form">
                                <livewire:company.user.company-user-form :company="$company" :partial="false" :nested="true"/>
                            </x-slot>
                        </x-collapsible-container>


                    </div>
                </div>
                <div>
                    <livewire:company.user.company-users-list :company="$company"/>
                </div>

            @endif
        </x-slot>
    </x-tabs>
</div>
