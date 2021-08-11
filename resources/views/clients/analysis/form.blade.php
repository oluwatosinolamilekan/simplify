@extends('layouts.form', ['partial' => $partial, 'section' => 'analysis'])

@section('analysis')
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Business Type -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="business_type" value="{{ __('Business Type') }}" />
                @php
                    $businesses = collect(\App\Enums\BusinessType::getInstances())
                                ->map(fn ($type) => [
                                    'id' => $type->value,
                                    'name' => $type->description,
                                ])
                @endphp
                <x-select-option :values="$businesses" wire:model="analysis.business_type"  class=""/>
                <x-jet-input-error for="analysis.business_type" class="mt-3" />
            </div>

            <!-- Industry -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="industry" value="{{ __('Industry') }}" />
                <x-jet-input id="industry" type="text" class="mt-1 block w-full" wire:model="analysis.industry" />
                <x-jet-input-error for="analysis.industry" class="mt-3" />
            </div>

            <!-- Region TODO @Sofia: this should be select with US state codes list -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="region" value="{{ __('Region') }}" />
                <x-jet-input id="region" type="text" class="mt-1 block w-full" wire:model="analysis.region" />
                <x-jet-input-error for="analysis.region" class="mt-3" />
            </div>

            <!-- Loan Grade -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="loan_grade" value="{{ __('Loan Grade') }}" />
                <x-jet-input id="loan_grade" type="text" class="mt-1 block w-full" wire:model="analysis.loan_grade" />
                <x-jet-input-error for="analysis.loan_grade" class="mt-3" />
            </div>

        </div>
    </div>
@endsection
