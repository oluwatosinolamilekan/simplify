@php $id = uniqid(); @endphp
@extends('layouts.form', ['partial' => $partial, 'section' => "nfe-model-{$id}", 'delete' => true])

@section("nfe-model-{$id}")
    <div class="grid grid-cols-6 gap-6">

        <!-- Name -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="model.name" value="{{ __('Name') }}" />
            <x-jet-input type="text" class="w-1/2 float-right" wire:model="model.name" />
            <x-jet-input-error for="model.name" class="mt-3" />
        </div>

        <div class="col-span-6 sm:col-span-2">
            <x-success-button wire:click="addRate()" type="button"> + Add Rate </x-success-button>
        </div>

        <div class="col-span-6 sm:col-span-6">
            @include('settings.nfe-models.rates.list', ['model' => $model])
        </div>
    </div>
@endsection
