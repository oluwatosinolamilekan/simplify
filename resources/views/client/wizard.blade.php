<x-slot name="header">
    {{ __('Client Wizard') }}
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-tabs active="General">

        <x-tab name="General">
            <form wire:submit.prevent="saveClient">

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

                        @include('client.relation-form', ['client' => $client])
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

                        @include('client.factor-form', ['client' => $client])
                    </div>
                </div>

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => $client->exists, 'disabled' => !$client->exists])

            </form>
        </x-tab>
        <x-tab name="Identity & Analysis">
            <form wire:submit.prevent="saveIdentity">
                <!-- Company Identity -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Identity') }}</x-slot>
                            <x-slot name="description">{{ __('Company identity information.') }}</x-slot>
                        </x-jet-section-title>

                        @include('company.identity.form', ['companyIdentity' => $companyIdentity])
                    </div>
                </div>

                <!-- Client Analysis -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Client Analysis') }}</x-slot>
                            <x-slot name="description">{{ __('Client analysis information.') }}</x-slot>
                        </x-jet-section-title>

                        @include('client.analysis-form', ['clientAnalysis' => $clientAnalysis])
                    </div>
                </div>

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => false, 'disabled' => !$client->exists])

            </form>
        </x-tab>
        <x-tab name="Address & Contact Details">
            <form wire:submit.prevent="saveContact">
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

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => false, 'disabled' => !$client->exists])
            </form>

        </x-tab>
        <x-tab name="Bank Information">
            <form wire:submit.prevent="saveBankInformation">
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

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => false, 'disabled' => !$client->exists])
            </form>
        </x-tab>
        <x-tab name="Users">
                @if (!$client->exists)
                    <form wire:submit.prevent="saveUser">
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

                        <!-- Actions -->
                        @include('components.forms.form-actions', ['delete' => false, 'disabled' => !$client->exists])
                    </form>

                @else
                    <!-- Users -->
                    <div class="mt-10 sm:mt-0">
                        <x-jet-nav-link href="{{route('companies.users.create', ['company_id' => $company->id])}}" :active="true">+ Add new user</x-jet-nav-link>

                        <livewire:company.user.company-users-list :company="$company"/>
                    </div>
                @endif
        </x-tab>
    </x-tabs>
</div>
