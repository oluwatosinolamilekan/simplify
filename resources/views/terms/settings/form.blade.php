@extends('layouts.form', ['partial' => $partial, 'section' => 'settings'])
@section('settings')

    <div class="mt-5 md:mt-0 md:col-span-2" >
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- Advance Rate -->
                <div class="col-span-3 sm:col-span-4">
                    <x-jet-label for="advance_rate" value="{{ __('Advance Rate') }}" />
                    <x-forms.rate-input wire:model="settings.advance_rate" />
                    <x-jet-input-error for="settings.advance_rate" class="mt-3" />
                </div>

                <!-- Purchase Fee Rate -->
                <div class="col-span-3 sm:col-span-4">
                    <x-jet-label for="purchase_fee_rate" value="{{ __('Purchase Fee Rate') }}" />
                    <x-forms.rate-input wire:model="settings.purchase_fee_rate" />
                    <x-jet-input-error for="settings.purchase_fee_rate" class="mt-3" />
                </div>

                <!-- Escrow Rate -->
                <div class="col-span-3 sm:col-span-4">
                    <x-jet-label for="escrow_rate" value="{{ __('Escrow Rate') }}" />
                    <x-forms.rate-input wire:model="settings.escrow_rate" />
                    <x-jet-input-error for="settings.escrow_rate" class="mt-3" />
                </div>

                <div class="col-span-3 sm:col-span-6">
                    <x-jet-section-border />
                </div>

                <!-- Minimum Fee Per Invoice -->
                <div class="col-span-3 sm:col-span-4">
                    <x-jet-label for="minimum_fee_per_invoice" value="{{ __('Minimum Fee Per Invoice') }}"/>
                    <x-forms.currency-input wire:model="settings.minimum_fee_per_invoice"/>
                    <x-jet-input-error for="settings.minimum_fee_per_invoice" class="mt-3" />
                </div>

                <!-- Minimum Fee Applied To Non Advanced Loads -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="minimum_fee_applied_to_non_advanced_loads" value="{{ __('Applied To Non Advanced Loads') }}" class="sm:inline-block"/>
                    <x-forms.toggle-input id="minimum_fee_applied_to_non_advanced_loads" wire:model="settings.minimum_fee_applied_to_non_advanced_loads"/>
                    <x-jet-input-error for="settings.minimum_fee_applied_to_non_advanced_loads" class="mt-3" />
                </div>

                <!-- Prioritize Minimum Fee -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="prioritize_minimum_fee" value="{{ __('Minimum Fee Calculated Before Extra Fees') }}" class="sm:inline-block"/>
                    <x-forms.toggle-input id="prioritize_minimum_fee" wire:model="settings.prioritize_minimum_fee"/>
                    <x-jet-input-error for="settings.prioritize_minimum_fee" class="mt-3" />
                </div>

                <div class="col-span-3 sm:col-span-6">
                    <x-jet-section-border />
                </div>

                <!-- Collection Fee Rule -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="collection_fee_rule" value="{{ __('Collection Fee Relative To') }}" />
                    @php
                        $rules = collect(\App\Enums\CollectionFeeRule::getInstances())
                                    ->map(fn ($rule) => [
                                        'id' => $rule->value,
                                        'name' => $rule->description ,
                                        'selected' => $settings->collection_fee_rule->is($rule->value)
                                    ])
                    @endphp
                    <x-searchable :values="$rules" wire:model="settings.collection_fee_rule"  class="w-1/2 float-right"/>
                    <x-jet-input-error for="settings.collection_fee_rule" class="mt-3" />
                </div>

                <!-- Escrow Rebate Rule -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="escrow_rebate_rule" value="{{ __('Release Escrow Upon') }}" />
                    @php
                        $rules = collect(\App\Enums\EscrowRebateRule::getInstances())
                                    ->map(fn ($rule) => [
                                        'id' => $rule->value,
                                        'name' => $rule->description ,
                                        'selected' => $settings->escrow_rebate_rule->is($rule->value)
                                    ])
                    @endphp
                    <x-searchable :values="$rules" wire:model="settings.escrow_rebate_rule"  class="w-1/2 float-right"/>
                    <x-jet-input-error for="settings.escrow_rebate_rule" class="mt-3" />
                </div>

                <!-- Fee Base Date -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="fee_base_date" value="{{ __('Calculate Fees Based On') }}" />
                    @php
                        $types = collect(\App\Enums\BaseDateType::getInstances())
                                    ->map(fn ($type) => [
                                        'id' => $type->value,
                                        'name' => $type->description ,
                                        'selected' => $settings->fee_base_date->is($type->value)
                                    ])
                    @endphp
                    <x-searchable :values="$types" wire:model="settings.fee_base_date"  class="w-1/2 float-right"/>
                    <x-jet-input-error for="settings.fee_base_date" class="mt-3" />
                </div>

                <!-- Rate Base Date -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="rate_base_type" value="{{ __('Calculate Rates Based On') }}" />
                    @php
                        $types = collect(\App\Enums\RateBaseType::getInstances())
                                    ->map(fn ($type) => [
                                        'id' => $type->value,
                                        'name' => $type->description ,
                                        'selected' => $settings->rate_base_type->is($type->value)
                                    ])
                    @endphp
                    <x-searchable :values="$types" wire:model="settings.rate_base_type"  class="w-1/2 float-right"/>
                    <x-jet-input-error for="settings.rate_base_type" class="mt-3" />
                </div>

                <!-- Float Days Type -->
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="float_days_type" value="{{ __('Float Days') }}" />
                    @php
                        $types = collect(\App\Enums\FloatDaysType::getInstances())
                                    ->map(fn ($type) => [
                                        'id' => $type->value,
                                        'name' => $type->description ,
                                        'selected' => $settings->float_days_type->is($type->value)
                                    ])
                    @endphp
                    <x-searchable :values="$types" wire:model="settings.float_days_type"  class="w-1/2 float-right"/>
                    <x-jet-input-error for="settings.float_days_type" class="mt-3" />
                </div>

            </div>
        </div>
    </div>
@endsection
