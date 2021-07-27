@extends('layouts.form', ['partial' => $partial, 'section' => 'creditLimit'])
@section('creditLimit')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- All Customer Limit -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="all_customer_limit" value="{{ __('All Customer Limit') }}" class="sm:inline-block"/>
                    <x-forms.currency-input id="all_customer_limit" wire:model="creditLimit.all_customer_limit"/>
                    <x-jet-input-error for="creditLimit.all_customer_limit" class="mt-3" />
                </div>

                <!-- Months Good For -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="months_good_for" value="{{ __('Months Good For') }}" class="sm:inline-block"/>
                    <x-forms.number-input id="months_good_for" wire:model="creditLimit.months_good_for" disabled/>
                    <x-jet-input-error for="creditLimit.months_good_for" class="mt-3" />
                </div>

                <!-- Credit Date -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="credit_date" value="{{ __('Credit Date') }}" class="sm:inline-block"/>
                    <x-forms.date-input id="credit_date" wire:model="creditLimit.credit_date"/>
                    <x-jet-input-error for="creditLimit.credit_date" class="mt-3" />
                </div>

                <!-- Credit Expiring Date -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="credit_expiry_date" value="{{ __('Credit Expiry Date') }}" class="sm:inline-block"/>
                    <x-forms.date-input id="credit_expiry_date" wire:model="creditLimit.credit_expiry_date"/>
                    <x-jet-input-error for="creditLimit.credit_expiry_date" class="mt-3" />
                </div>

                <!-- Notes -->
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="warning_note" value="{{ __('Notes') }}"/>
                    <div class="sm:inline-block w-1/2 float-right">
                        <x-jet-input id="credit_limit_note" type="text" wire:model.defer="note" class="w-3/4"/>
                        <x-success-anchor wire:click="addNote"> + Add </x-success-anchor>
                        <x-jet-input-error for="note" class="mt-3" />
                    </div>

                    <div class="col-span-6 sm:col-span-4 offset-2">
                        @foreach($creditLimit->notes ?? [] as $i => $note)
                            <div>
                                <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$note}}</span>
                                <x-danger-anchor wire:click="deleteNote({{$i}})"> x </x-danger-anchor>
                            </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
