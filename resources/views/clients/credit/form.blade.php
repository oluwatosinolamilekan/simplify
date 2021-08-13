@extends('layouts.form', ['partial' => $partial, 'section' => 'credit'])

@section('credit')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- Approved -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="approved" value="{{ __('Approved') }}"  class="sm:inline-block"/>
                    <x-forms.toggle-input id="approved" wire:model="credit.approved"/>
                    <x-jet-input-error for="credit.approved" class="mt-3" />
                </div>

                <x-forms.border />

                <!-- Credit Rating -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="credit_rating" value="{{ __('Credit Rating') }}" />
                    <x-jet-input id="credit_rating" type="text" wire:model="credit.credit_rating" class="w-1/2 float-right"/>
                    <x-jet-input-error for="credit.credit_rating" class="mt-3" />
                </div>

                <!-- Credit Limit -->
                <div class="col-span-3 md:col-span-6 lg:col-span-3">
                    <x-jet-label for="credit_limit" value="{{ __('Credit Limit') }}" class="sm:inline-block"/>
                    <x-forms.currency-input id="credit_limit" wire:model="credit.credit_limit"/>
                    <x-jet-input-error for="credit.credit_limit" class="mt-3" />
                </div>

                <!-- Debtor Limit -->
                <div class="col-span-3 md:col-span-6 lg:col-span-3">
                    <x-jet-label for="debtor_limit" value="{{ __('Debtor Limit') }}" class="sm:inline-block"/>
                    <x-forms.currency-input id="debtor_limit" wire:model="credit.debtor_limit"/>
                    <x-jet-input-error for="credit.debtor_limit" class="mt-3" />
                </div>

                <!-- Debtor Concentration -->
                <div class="col-span-3 md:col-span-6 lg:col-span-3">
                    <x-jet-label for="debtor_concentration" value="{{ __('Debtor Concentration') }}" class="sm:inline-block"/>
                    <x-forms.rate-input id="debtor_concentration" wire:model="credit.debtor_concentration"/>
                    <x-jet-input-error for="credit.debtor_concentration" class="mt-3" />
                </div>

                <x-forms.border />

                <!-- Standard Terms -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="standard_terms" value="{{ __('Standard Terms') }}" />
                    <x-forms.number-input id="standard_terms" wire:model="credit.standard_terms" class="w-1/2 float-right"/>
                    <x-jet-input-error for="credit.standard_terms" class="mt-3" />
                </div>

                <!-- Ineligible Days -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="ineligible_days" value="{{ __('Ineligible Days') }}" />
                    <x-forms.number-input id="ineligible_days" wire:model="credit.ineligible_days" class="w-1/2 float-right"/>
                    <x-jet-input-error for="credit.ineligible_days" />
                </div>

                <x-forms.border />

                <!-- Charge Report -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="report_charge" value="{{ __('Charge Report') }}"  class="sm:inline-block"/>
                    <x-forms.toggle-input id="report_charge" wire:model="credit.report_charge"/>
                    <x-jet-input-error for="credit.report_charge" class="mt-3" />
                </div>

                <!-- Report Charge Amount -->
                <div class="col-span-3 md:col-span-6 lg:col-span-3">
                    <x-jet-label for="report_charge_amount" value="{{ __('Report Charge Amount') }}" class="sm:inline-block"/>
                    <x-forms.currency-input id="report_charge_amount" wire:model="credit.report_charge_amount"/>
                    <x-jet-input-error for="credit.report_charge_amount" class="mt-3" />
                </div>

                <x-forms.border />

                <!-- UCC Date -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="ucc_date" value="{{ __('UCC Date') }}" class="sm:inline-block"/>
                    <x-forms.date-input id="ucc_date" wire:model="credit.ucc_date"/>
                    <x-jet-input-error for="credit.ucc_date" class="mt-3" />
                </div>

                <!-- UCC Date 2 -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="ucc_date_2" value="{{ __('UCC Date 2') }}" class="sm:inline-block"/>
                    <x-forms.date-input id="ucc_date_2" wire:model="credit.ucc_date_2"/>
                    <x-jet-input-error for="credit.ucc_date_2" class="mt-3" />
                </div>

                <!-- UCC Expiring Date -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="ucc_expiring_date" value="{{ __('UCC Expiring Date') }}" class="sm:inline-block"/>
                    <x-forms.date-input id="ucc_expiring_date" wire:model="credit.ucc_expiring_date"/>
                    <x-jet-input-error for="credit.ucc_expiring_date" class="mt-3" />
                </div>

            </div>
        </div>
    </div>
@endsection
