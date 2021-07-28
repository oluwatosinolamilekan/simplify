@extends('layouts.form', ['partial' => $partial, 'section' => 'settings'])
@section('settings')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- Buy Status -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="buy_status" value="{{ __('Buy / No Buy') }}"  class="sm:inline-block"/>
                    <x-forms.toggle-input id="buy_status" wire:model="settings.buy_status"/>
                    <x-jet-input-error for="settings.buy_status" class="mt-3" />
                </div>

                <!-- Do Not Contact -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="do_not_contact" value="{{ __('Do Not Contact') }}" class="sm:inline-block"/>
                    <x-forms.toggle-input id="do_not_contact" wire:model="settings.do_not_contact"/>
                    <x-jet-input-error for="settings.do_not_contact" class="mt-3" />
                </div>

                <!-- Require Original Invoices -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="require_original_invoices" value="{{ __('Require Original Invoices') }}" class="sm:inline-block"/>
                    <x-forms.toggle-input id="require_original_invoices" wire:model="settings.require_original_invoices"/>
                    <x-jet-input-error for="settings.require_original_invoices" class="mt-3" />
                </div>

                <!-- Noa Email -->
                <div class="col-span-3 sm:col-span-6">
                    <x-jet-label for="noa_email" value="{{ __('Noa Email') }}" class="sm:inline-block"/>
                    <x-jet-input id="noa_email" type="text" wire:model="settings.noa_email" class="w-1/2 float-right" autocomplete="email" />
                    <x-jet-input-error for="settings.noa_email" class="mt-3" />
                </div>

                <!-- Notes -->
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="warning_note" value="{{ __('Warning Notes') }}"/>
                    <div class="sm:inline-block w-1/2 float-right">
                        <x-jet-input id="note" type="text" wire:model.defer="note" class="w-3/4"/>
                        <x-success-anchor wire:click="addNote"> + Add </x-success-anchor>
                        <x-jet-input-error for="note" class="mt-3" />
                    </div>

                    <div class="col-span-6 sm:col-span-4 offset-2">
                        @foreach($settings->warning_notes ?? [] as $i => $note)
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

