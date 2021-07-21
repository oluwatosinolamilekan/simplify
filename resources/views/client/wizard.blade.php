<x-slot name="header">
    {{ __('Client Wizard') }}
</x-slot>


<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs tabs='{
        "general": "General",
        "identity": {"title": "Identity & Analysis", "enabled": "{{$client->exists}}"},
        "address": {"title": "Address & Contact Details", "enabled": "{{$client->exists}}"},
        "bank": {"title": "Bank Information", "enabled": "{{$client->exists}}"},
        "users": {"title": "Users", "enabled": "{{$client->exists}}"}
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

                        @include('company.form', ['company' => $company])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Client Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Client Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill client information.') }}</x-slot>
                        </x-jet-section-title>

                        @include('client.relation.form', ['client' => $client])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Factor Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Factor Information') }}</x-slot>
                            <x-slot name="description">{{ __('Select factor.') }}</x-slot>
                        </x-jet-section-title>

                        @include('client.relation.factor-form', ['client' => $client])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Funding Instructions -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Funding Instructions') }}</x-slot>
                            <x-slot name="description">{{ __('Fill funding instructions.') }}</x-slot>
                        </x-jet-section-title>

                        @include('client.funding-instructions.form', ['fundingInstructions' => $fundingInstructions, 'partial' => true])
                    </div>
                </div>

                <x-jet-section-border />

                <!-- Credit -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Credit') }}</x-slot>
                            <x-slot name="description">{{ __('Fill credit details.') }}</x-slot>
                        </x-jet-section-title>

                        @include('client.credit.form', ['credit' => $credit, 'partial' => true])
                    </div>
                </div>

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => $client->exists, 'disabled' => false])

            </form>
        </x-slot>
        <x-slot name="identity">
            @if($client->exists)
                <!-- Company Identity -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Identity') }}</x-slot>
                            <x-slot name="description">{{ __('Company identity information.') }}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:company.company-identity-form :identity="$identity" :partial="false"/>
                        </div>
                    </div>
                </div>

                <!-- Client Analysis -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Client Analysis') }}</x-slot>
                            <x-slot name="description">{{ __('Client analysis information.') }}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:client.client-analysis-form :analysis="$analysis" :partial="false"/>
                        </div>
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot name="address">
            @if($client->exists)
                <!-- Address Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Address Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill company address information.') }}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:address.address-form :address="$address" :partial="false"/>
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
                            <livewire:contact.contact-form :contact="$contact" :partial="false"/>
                        </div>
                    </div>
                </div>
            @endif

        </x-slot>
        <x-slot name="bank">
            @if($client->exists)
                <!-- Bank Information -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Bank Information') }}</x-slot>
                            <x-slot name="description">{{ __('Fill company bank information.') }}</x-slot>
                        </x-jet-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <livewire:bank-information.bank-information-form :bankInformation="$bankInformation" :partial="false"/>
                        </div>
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot name="users">
        @if ($client->exists)
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
                <livewire:company.user.company-users-list :company="$company"/>
            @endif
        </x-slot>
    </x-tabs>
</div>
