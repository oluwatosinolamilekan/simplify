@extends('layouts.form', ['partial' => $partial, 'section' => 'credit'])
@section('credit')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">

                <!-- Annual Sales -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="annual_sales" value="{{ __('Annual Sales') }}" class="sm:inline-block"/>
                    <x-forms.currency-input id="annual_sales" wire:model="credit.annual_sales"/>
                    <x-jet-input-error for="credit.annual_sales" class="mt-3" />
                </div>

                <!-- Net Worth -->
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="net_worth" value="{{ __('Net Worth') }}" class="sm:inline-block"/>
                    <x-forms.currency-input id="net_worth" wire:model="credit.net_worth"/>
                    <x-jet-input-error for="credit.net_worth" class="mt-3" />
                </div>

                <!-- Notes -->
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="warning_note" value="{{ __('Notes') }}"/>
                    <div class="sm:inline-block w-1/2 float-right">
                        <x-jet-input id="credit_note" type="text" wire:model.defer="credit.notes.{{count($credit->notes ?? [])}}" class="w-3/4"/>
                        <x-success-anchor wire:click="addNote"> + Add </x-success-anchor>
                        <x-jet-input-error for="credit_note" class="mt-3" />
                    </div>



                    <div class="col-span-6 sm:col-span-4 offset-2">
                        @foreach($credit->notes ?? [] as $i => $note)
                            <div>
                                <span class="text-wrap mx-2 py-3 sm:inline-block w-5/6">{{$note}}</span>
                                <x-danger-anchor wire:click="deleteNote"> x </x-danger-anchor>
                            </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
