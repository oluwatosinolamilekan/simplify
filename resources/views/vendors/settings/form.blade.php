@extends('layouts.form', ['partial' => $partial, 'section' => 'settings'])
@section('settings')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- Buy Status -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="buy_status" value="{{ __('Buy / No Buy') }}"  class="sm:inline-block"/>
                    <x-forms.toggle-input id="generate_invoice" wire:model="settings.buy_status"/>
                    <x-jet-input-error for="settings.buy_status" class="mt-3" />
                </div>

                <!-- Send Email Remittances -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="send_email_remittances" value="{{ __('Send Email Remittances') }}" class="sm:inline-block"/>
                    <x-forms.toggle-input id="send_email_remittances" wire:model="settings.send_email_remittances"/>
                    <x-jet-input-error for="settings.send_email_remittances" class="mt-3" />
                </div>

            </div>
        </div>
    </div>
@endsection
