<x-slot name="header">
    {{ __('Vendor Details') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <x-tabs tabs='{
        "general": "General",
        "identity": "Identity",
        "address": "Address & Contact Details",
        "bank": "Bank Information",
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

            <!-- Vendor Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                    @include('vendors.relation.details', ['company' => $company])
                </div>
            </div>

            <x-jet-section-border />

            <!-- Settings -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Vendor Settings') }}</x-slot>
                        <x-slot name="description">{{ __('Vendor Settings Information.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($settings->exists)
                        @include('vendors.settings.details', ['settings' => $settings])
                    @else
                        <x-collapsible-container>
                            <x-slot name="form">
                                <livewire:vendor.vendor-settings-form :settings="$settings" :partial="false" :nested="true"/>
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
                        @include('contact.details', ['contact' => $vendor->company->contact])
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
        <x-slot name="users">
            <!-- Users -->
            <div>
                <x-jet-nav-link href="{{route('companies.users.create', ['company_id' => $company->id])}}" :active="true">+ Add new user</x-jet-nav-link>

                <livewire:company.user.company-users-list :company="$company"/>
            </div>
        </x-slot>
    </x-tabs>

    <x-jet-section-border />

    <!-- Actions -->
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

        <x-success-anchor href="{{route('vendors.update', $this->vendor->id)}}">
            {{ __('Update') }}
        </x-success-anchor>

        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </div>

</div>
