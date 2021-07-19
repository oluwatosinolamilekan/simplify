<x-slot name="header">
    {{ __('Client Details') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <x-tabs tabs='{
        "general": "General",
        "identity": "Identity & Analysis",
        "address": "Address & Contact Details",
        "bank": "Bank Information",
        "users": "Users"
    }'>
        <x-slot name="general">

            <!-- Company Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                    @include('company.details', ['company' => $company])

                </div>
            </div>

            <x-jet-section-border />

            <!-- Client Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
                    @include('client.relation.details', ['company' => $company])
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
                        @include('client.funding-instructions.details', ['fundingInstructions' => $fundingInstructions])
                    @else
                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <a class="p-4 cursor-pointer bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                    + Add
                                </a>
                            </div>

                            <form wire:submit.prevent="saveFundingInstructions">

                                @include('client.funding-instructions.form', ['fundingInstructions' => $fundingInstructions])

                                <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                    <!-- TODO @Sofia: Clicking this button should collapse the form above -->
                                    <a class="p-4 cursor-pointer bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                        Cancel
                                    </a>
                                    <x-success-button wire:loading.attr="disabled">
                                        {{ __('Save') }}
                                    </x-success-button>
                                </div>

                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <x-jet-section-border />

            <!-- Credit Information -->
            <div class="mt-10 sm:mt-0">
                <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                    <x-jet-section-title>
                        <x-slot name="title">{{ __('Client Credit') }}</x-slot>
                        <x-slot name="description">{{ __('Client Credit Information.') }}</x-slot>
                    </x-jet-section-title>

                    @if ($credit->exists)
                        @include('client.credit.details', ['credit' => $credit])
                    @else
                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <a class="p-4 cursor-pointer bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                    + Add
                                </a>
                            </div>

                            <form wire:submit.prevent="saveCredit">

                                @include('client.credit.form', ['credit' => $credit])

                                <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                    <!-- TODO @Sofia: Clicking this button should collapse the form above -->
                                    <a class="p-4 cursor-pointer bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                        Cancel
                                    </a>
                                    <x-success-button wire:loading.attr="disabled">
                                        {{ __('Save') }}
                                    </x-success-button>
                                </div>

                            </form>
                        </div>
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
                        @include('company.identity.details', ['identity' => $identity])
                    @else
                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <a class="p-4 cursor-pointer bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                    + Add
                                </a>
                            </div>

                            <form wire:submit.prevent="saveIdentity">

                                @include('client.identity.form', ['identity' => $identity])

                                <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                    <!-- TODO @Sofia: Clicking this button should collapse the form above -->
                                    <a class="p-4 cursor-pointer bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                        Cancel
                                    </a>
                                    <x-success-button wire:loading.attr="disabled">
                                        {{ __('Save') }}
                                    </x-success-button>
                                </div>

                            </form>
                        </div>
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
                        @include('client.analysis.details', ['analysis' => $analysis])
                    @else
                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <a class="p-4 cursor-pointer bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                    + Add
                                </a>
                            </div>

                            <form wire:submit.prevent="saveAnalysis">

                                @include('client.analysis.form', ['analysis' => $analysis])

                                <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                    <!-- TODO @Sofia: Clicking this button should collapse the form above -->
                                    <a class="p-4 cursor-pointer bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                        Cancel
                                    </a>
                                    <x-success-button wire:loading.attr="disabled">
                                        {{ __('Save') }}
                                    </x-success-button>
                                </div>

                            </form>
                        </div>
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
                        @include('address.details', ['address' => $client->company->address])
                    @else
                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <a class="p-4 cursor-pointer bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                    + Add
                                </a>
                            </div>

                            <form wire:submit.prevent="saveAddressInformation">

                                @include('address.form', ['address' => $address])

                                <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                    <!-- TODO @Sofia: Clicking this button should collapse the form above -->
                                    <a class="p-4 cursor-pointer bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                        Cancel
                                    </a>
                                    <x-success-button wire:loading.attr="disabled">
                                        {{ __('Save') }}
                                    </x-success-button>
                                </div>

                            </form>
                        </div>
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
                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <a class="p-4 cursor-pointer bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                    + Add
                                </a>
                            </div>

                            <form wire:submit.prevent="saveContactDetails">

                                @include('contact.form', ['contact' => $contact])

                                <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                    <!-- TODO @Sofia: Clicking this button should collapse the form above -->
                                    <a class="p-4 cursor-pointer bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                        Cancel
                                    </a>
                                    <x-jet-button class="text-center xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18" wire:loading.attr="disabled">
                                        {{ __('Save') }}
                                    </x-jet-button>
                                </div>

                            </form>
                        </div>
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
                        <div class="mt-5 md:mt-0 md:col-span-2" >
                            <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
                                <a class="p-4 cursor-pointer bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                    + Add
                                </a>
                            </div>
                            <form wire:submit.prevent="saveBankInformation">

                                @include('bank-information.form', ['bankInformation' => $bankInformation])

                                <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
                                    <!-- TODO @Sofia: Clicking this button should collapse the form above -->
                                    <a class="p-4 cursor-pointer bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" href="javascript:;">
                                        Cancel
                                    </a>
                                    <x-success-button wire:loading.attr="disabled">
                                        {{ __('Save') }}
                                    </x-success-button>
                                </div>

                            </form>
                        </div>
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

        <a href="{{route('clients.update', $this->client->id)}}" class="bg-theme-18 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition">
            {{ __('Update') }}
        </a>

        <x-jet-danger-button wire:click="confirmDeletion" class="bg-red-600 text-center mx-2 px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-jet-danger-button>
    </div>

</div>
