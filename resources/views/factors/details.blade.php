<x-slot name="header">
    {{ __('Factor Wizard') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs tabs='{
        "general": "General",
        "address": "Address & Contact Details",
        "bank": "Bank Information",
        "clients": "Clients",
        "vendors": "Vendors",
        "debtors": "Debtors",
        "users": "Users"
    }'>
        <x-slot name="general">
            <!-- Company Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                    @include('companies.details', ['company' => $company])

                </div>
            </div>

            <x-jet-section-border />

            <!-- Factor Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                    @include('factors.relation.details', ['company' => $company])
                </div>
            </div>

            <x-jet-section-border />
        </x-slot>

        <x-slot name="address">

            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Address Information') }}</x-slot>
                        <x-slot name="description">{{ __('Company address information.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($address->exists)
                        @include('address.details', ['address' => $address])
                    @else
                        <x-collapsible-container>
                            <x-slot name="form">
                                <livewire:address.address-form :address="$address" :partial="false"/>
                            </x-slot>
                        </x-collapsible-container>
                    @endif
                </div>
            </div>

            <!-- Contact Details -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Contact Details') }}</x-slot>
                        <x-slot name="description">{{ __('Company contact details.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($contact->exists)
                        @include('contact.details', ['contact' => $client->company->contact])
                    @else
                        <x-collapsible-container>
                            <x-slot name="form">
                                <livewire:contact.contact-form :contact="$contact" :partial="false"/>
                            </x-slot>
                        </x-collapsible-container>
                    @endif
                </div>
            </div>
        </x-slot>
        <x-slot name="bank">

            <!-- Bank Information -->

            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Bank Information') }}</x-slot>
                        <x-slot name="description">{{ __('Bank account information.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($bankInformation->exists)
                        @include('bank-information.details', ['bankInformation' => $bankInformation])
                    @else
                        <x-collapsible-container>
                            <x-slot name="form">
                                <livewire:bank-information.bank-information-form :bankInformation="$bankInformation" :partial="false"/>
                            </x-slot>
                        </x-collapsible-container>

                    @endif
                </div>
            </div>
        </x-slot>
        <x-slot name="clients">
            <!-- Clients -->
            <div>
                <livewire:factor.factor-clients-list :factor="$factor" :identifier="'factor-clients-list'"/>
            </div>
        </x-slot>
        <x-slot name="vendors">
            <!-- Vendors -->
            <div>
                <livewire:factor.factor-vendors-list :factor="$factor" :identifier="'factor-vendors-list'"/>
            </div>
        </x-slot>
        <x-slot name="debtors">
            <!-- Debtors -->
            <div>
                <livewire:factor.factor-debtors-list :factor="$factor" :identifier="'factor-debtors-list'"/>
            </div>
        </x-slot>
        <x-slot name="users">
            <!-- Users -->
            <div>
                <x-jet-nav-link href="{{route('companies.users.create', ['company_id' => $company->id])}}" :active="true">+ Add new user</x-jet-nav-link>

                <livewire:company.user.company-users-list :company="$company" :identifier="'factor-users-list'"/>
            </div>
        </x-slot>

    </x-tabs>

    <x-jet-section-border />

    <!-- Actions -->
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6" x-cloak>

        <x-success-anchor href="{{route('factors.update', $this->factor->id)}}">
            {{ __('Update') }}
        </x-success-anchor>

        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </div>
</div>
