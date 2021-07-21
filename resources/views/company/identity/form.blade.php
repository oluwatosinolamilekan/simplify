@extends('layouts.form', ['partial' => $partial, 'section' => 'identity'])

@section('identity')

    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Company Code -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="company_code" value="{{ __('Company Code') }}" />
                <x-jet-input id="company_code" type="text" class="mt-1 block w-full" wire:model="identity.company_code" />
                <x-jet-input-error for="identity.company_code" class="mt-3" />
            </div>

            <!-- Alternate Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="alternate_name" value="{{ __('Alternate Name') }}" />
                <x-jet-input id="alternate_name" type="text" class="mt-1 block w-full" wire:model="identity.alternate_name" />
                <x-jet-input-error for="identity.alternate_name" class="mt-3" />
            </div>

            <!-- MC Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="mc_number" value="{{ __('MC Number') }}" />
                <x-jet-input id="mc_number" type="text" class="mt-1 block w-full" wire:model="identity.mc_number" />
                <x-jet-input-error for="identity.mc_number" class="mt-3" />
            </div>

            <!-- DOT Number -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="dot_number" value="{{ __('DOT Number') }}" />
                <x-jet-input id="dot_number" type="text" class="mt-1 block w-full" wire:model="identity.dot_number" />
                <x-jet-input-error for="identity.dot_number" class="mt-3" />
            </div>

            <!-- Fed Tax ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="fed_tax_id" value="{{ __('Federal Tax ID') }}" />
                <x-jet-input id="fed_tax_id" type="text" class="mt-1 block w-full" wire:model="identity.fed_tax_id" />
                <x-jet-input-error for="identity.fed_tax_id" class="mt-3" />
            </div>

            <!-- EDI ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="edi_id" value="{{ __('EDI ID') }}" />
                <x-jet-input id="edi_id" type="text" class="mt-1 block w-full" wire:model="identity.edi_id" />
                <x-jet-input-error for="identity.edi_id" class="mt-3" />
            </div>

            <!-- DUNS ID -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="duns_id" value="{{ __('DUNS ID') }}" />
                <x-jet-input id="duns_id" type="text" class="mt-1 block w-full" wire:model="identity.duns_id" />
                <x-jet-input-error for="identity.duns_id" class="mt-3" />
            </div>


        </div>
    </div>

@endsection

