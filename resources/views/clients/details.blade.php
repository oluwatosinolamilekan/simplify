<x-slot name="header">
    {{ __('Client Details') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <x-tabs tabs='{
        "general": "General",
        "identity": "Identity & Analysis",
        "address": "Address & Contact Details",
        "bank": "Bank Information",
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

            <!-- Client Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                    @include('clients.relation.details', ['company' => $company])
                </div>
            </div>

            <x-jet-section-border />

            <!-- Funding Instructions -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Client Funding Instructions') }}</x-slot>
                        <x-slot name="description">{{ __('Funding Instructions Information.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($fundingInstructions->exists)
                        @include('clients.funding-instructions.details', ['fundingInstructions' => $fundingInstructions])
                    @else
                       <x-collapsible-container>
                           <x-slot name="form">
                               <livewire:client.client-funding-instructions-form :fundingInstructions="$fundingInstructions" :partial="false" :nested="true" />
                           </x-slot>
                       </x-collapsible-container>
                    @endif
                </div>
            </div>

            <x-jet-section-border />

            <!-- Credit Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Client Credit') }} </x-slot>
                        <x-slot name="description">{{ __('Client Credit Information.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($credit->exists)
                        @include('clients.credit.details', ['credit' => $credit])
                    @else
                        <x-collapsible-container>
                            <x-slot name="form">
                                <livewire:client.client-credit-form :credit="$credit" :partial="false" :nested="true"/>
                            </x-slot>
                        </x-collapsible-container>
                    @endif
                </div>
            </div>

        </x-slot>
        <x-slot name="identity">

            <!-- Company Identity -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Company Identity') }}</x-slot>
                        <x-slot name="description">{{ __('Company Identity Information.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($identity->exists)
                        @include('companies.identity.details', ['identity' => $identity])
                    @else
                        <x-collapsible-container>
                            <x-slot name="form">
                                <livewire:company.company-identity-form :identity="$identity" :partial="false" :nested="true"/>
                            </x-slot>
                        </x-collapsible-container>
                    @endif

                </div>
            </div>

            <!-- Client Analysis Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Client Analysis') }}</x-slot>
                        <x-slot name="description">{{ __('Client Analysis Details.') }}</x-slot>
                    </x-jet-section-title>

                @if ($analysis->exists)
                        @include('clients.analysis.details', ['analysis' => $analysis])
                    @else
                        <x-collapsible-container>
                            <x-slot name="form">
                                <livewire:client.client-analysis-form :analysis="$analysis" :partial="false" :nested="true"/>
                            </x-slot>
                        </x-collapsible-container>
                    @endif
                </div>
            </div>

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
                                <livewire:address.address-form :address="$address" :partial="false" :nested="true"/>
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
                                <livewire:contact.contact-form :contact="$contact" :partial="false" :nested="true"/>
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
                                <livewire:bank-information.bank-information-form :bankInformation="$bankInformation" :partial="false" :nested="true"/>
                            </x-slot>
                        </x-collapsible-container>

                    @endif
                </div>
            </div>
        </x-slot>
        <x-slot name="vendors">
            <!-- Vendors -->
            <div>
                <livewire:client.client-vendors-list :client="$client" :identifier="'client-vendors-list'" />
            </div>
        </x-slot>
        <x-slot name="debtors">
            <!-- Debtors -->
            <div>
                <livewire:client.client-debtors-list :client="$client" :identifier="'client-debtors-list'" />
            </div>
        </x-slot>
        <x-slot name="users">
            <!-- Users -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                    <x-collapsible-container>
                        <x-slot name="form">
                            <livewire:company.user.company-user-form :company="$company" :partial="false" :nested="true"/>
                        </x-slot>
                    </x-collapsible-container>

                </div>
            </div>
            <div>
                <livewire:company.user.company-users-list :company="$company" :user="$user" :identifier="'client-users-list'"/>
            </div>
        </x-slot>
    </x-tabs>

    <x-jet-section-border />

    <!-- Actions -->
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

        <x-success-anchor href="{{route('clients.update', $this->client->id)}}">
            {{ __('Update') }}
        </x-success-anchor>

        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </div>

</div>
