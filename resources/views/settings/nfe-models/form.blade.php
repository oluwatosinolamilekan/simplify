
<!-- Name -->
<div class="col-span-6 sm:col-span-2">
    <x-jet-label for="models.{{$index}}.name" value="{{ __('Name') }}" />
    <x-jet-input type="text" class="w-1/2 float-right" wire:model="models.{{$index}}.name" />
    <x-jet-input-error for="models.{{$index}}.name" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-2">
    <x-success-button wire:click="addModelRate({{$index}})" type="button"> + Add Rate </x-success-button>
</div>

<div class="col-span-6 sm:col-span-6">
    @include('settings.nfe-models.rates.list', ['model' => $models[$index], 'index' => $index])
</div>

<div class="col-span-6 sm:col-span-6">
    <x-jet-section-border />
    <x-danger-button wire:click="deleteModel({{$index}})" class="float-right">{{ $models[$index]->id ? 'Delete' : 'Cancel' }}</x-danger-button>
</div>
