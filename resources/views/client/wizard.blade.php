<x-slot name="header">
    {{ __('Client Wizard') }}
</x-slot>




<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <div x-data="{ tab: window.location.hash ? window.location.hash : '#tab1' }" class="box">
        <div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start border-b border-gray-200">

            <a class="mt-5 px-4 pb-4"
               href="#" x-on:click.prevent="tab='#tab1'" :class="{ 'active': tab=='#tab1' }" >General</a>

            <a class="mt-5 px-4 pb-4"
               href="#" x-on:click.prevent="tab='#tab2'" :class="{ 'active': tab=='#tab2' }">Identity & Analysis</a>

            <a class="mt-5 px-4 pb-4"
               href="#" x-on:click.prevent="tab='#tab3'" :class="{ 'active': tab=='#tab3' }">Address & Contact Details</a>

            <a class="mt-5 px-4 pb-4"
               href="#" x-on:click.prevent="tab='#tab4'" :class="{ 'active': tab=='#tab4' }">Bank Information</a>

            <a class="mt-5 px-4 pb-4"
               href="#" x-on:click.prevent="tab='#tab5'" :class="{ 'active': tab=='#tab5' }">Users</a>

        </div>

        <div x-show="tab == '#tab1'" x-cloak class="mt-5 px-4 pb-4">
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

                <!-- Funding Instructions -->
                <div class="mt-10 sm:mt-0">
                    <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

                        <x-jet-section-title>
                            <x-slot name="title">{{ __('Funding Instructions') }}</x-slot>
                            <x-slot name="description">{{ __('Fill funding instructions.') }}</x-slot>
                        </x-jet-section-title>

                        @include('client.funding-instructions-form', ['fundingInstructions' => $fundingInstructions])
                    </div>
                </div>

                <!-- Actions -->
                @include('components.forms.form-actions', ['delete' => $client->exists, 'disabled' => false])

            </form>
        </div>

        <div x-show="tab == '#tab2'" x-cloak class="mt-5 px-4 pb-4">
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
        </div>

        <div x-show="tab == '#tab3'" x-cloak class="mt-5 px-4 pb-4">
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
        </div>

        <div x-show="tab == '#tab4'" x-cloak class="mt-5 px-4 pb-4">
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
        </div>

        <div x-show="tab == '#tab5'" x-cloak class="mt-5 px-4 pb-4">
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
        </div>
    </div>
</div>
