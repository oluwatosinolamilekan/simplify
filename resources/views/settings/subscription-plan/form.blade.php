@php $id = uniqid(); @endphp
@extends('layouts.form', ['partial' => $partial, 'section' => "subscription-plan-{$id}", 'delete' => true])

@section("subscription-plan-{$id}")
    <div class="grid grid-cols-6 gap-6">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="plan.name" value="{{ __('Name') }}" />
            <x-jet-input type="text" class="w-1/2 float-right" wire:model="plan.name" />
            <x-jet-input-error for="plan.name" class="mt-3" />
        </div>

        <!-- Price -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="plan.price" value="{{ __('Price') }}" />
            <x-forms.currency-input wire:model="plan.price" />
            <x-jet-input-error for="plan.price" class="mt-3" />
        </div>

        <!-- Status -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="plan.status" value="{{ __('Status') }}" />
            @php
                $statuses = collect(\App\Enums\StatusTypesList::SubscriptionPlan)
                            ->map(fn ($status) => [
                                'id' => $status,
                                'name' => \App\Enums\Status::fromValue($status)->description
                            ])
            @endphp
            <x-select-option :values="$statuses" wire:model="plan.status" class="w-1/2 float-right"/>
            <x-jet-input-error for="plan.status" class="mt-3" />
        </div>

    </div>
@endsection
