@extends('layouts.form', ['partial' => $partial, 'section' => 'contact'])

@section('contact')
    <div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white dark:bg-dark-2 sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">

            <!-- Emails -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="contact-emails" value="{{ __('Emails') }}" />
                <x-jet-input id="contact-emails" type="text" class="mt-1 block w-full" wire:model="contact.emails" />
                <x-jet-input-error for="contact.emails" class="mt-3" />
            </div>

            <!-- Phone Numbers -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="contact-phone_numbers" value="{{ __('Phone Numbers') }}" />
                <x-jet-input id="contact-phone_numbers" type="text" class="mt-1 block w-full" wire:model="contact.phone_numbers"/>
                <x-jet-input-error for="contact.phone_numbers" class="mt-3" />
            </div>

            <!-- Notes -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="notes" value="{{ __('Notes') }}" />
                <x-jet-input id="notes" type="text" class="mt-1 block w-full" wire:model="contact.notes" />
                <x-jet-input-error for="contact.notes" class="mt-3" />
            </div>

        </div>
    </div>
</div>
@endsection
