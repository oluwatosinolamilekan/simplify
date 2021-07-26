@extends('layouts.form', ['partial' => $partial, 'section' => 'creditForm'])
@section('creditForm')

    <!-- Debtor Credit -->
    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

            <x-jet-section-title>
                <x-slot name="title">{{ __('Debtor Credit') }}</x-slot>
                <x-slot name="description">{{ __('Fill debtor credit information.') }}</x-slot>
            </x-jet-section-title>

            @include('debtors.credit.partials.credit-form', ['credit' => $credit, 'partial' => true, 'nested' => true])
        </div>
    </div>

    <x-jet-section-border />

    <!-- Debtor Credit Limit -->
    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">

            <x-jet-section-title>
                <x-slot name="title">{{ __('Debtor Credit Limit') }}</x-slot>
                <x-slot name="description">{{ __('Fill debtor credit limit information.') }}</x-slot>
            </x-jet-section-title>

            @include('debtors.credit.partials.credit-limit-form', ['creditLimit' => $creditLimit, 'partial' => true, 'nested' => true])
        </div>
    </div>

@endsection
