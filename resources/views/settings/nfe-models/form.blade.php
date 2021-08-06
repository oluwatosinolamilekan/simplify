
<!-- Name -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="models.{{$index}}.name" value="{{ __('Name') }}" />
    <x-jet-input type="text" class="w-1/2 float-right" wire:model="models.{{$index}}.name" />
    <x-jet-input-error for="models.{{$index}}.name" class="mt-3" />
</div>

<!-- Base Rate -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="models.{{$index}}.base_rate" value="{{ __('Base Rate') }}" />
    <x-forms.rate-input wire:model="models.{{$index}}.base_rate" />
    <x-jet-input-error for="models.{{$index}}.base_rate" class="mt-3" />
</div>

<!-- Date -->
<div class="col-span-3 sm:col-span-3">
    <x-jet-label for="models.{{$index}}.date" value="{{ __('Date') }}" />
    <x-forms.date-input wire:model="models.{{$index}}.date" />
    <x-jet-input-error for="models.{{$index}}.date" class="mt-3" />
</div>

<!-- Region -->
<!-- TODO @Sofia or @Lamidi: this should be select with country codes list -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="models.{{$index}}.country" value="{{ __('Country') }}" />
    <x-jet-input type="text" class="w-1/2 float-right" wire:model="models.{{$index}}.country" />
    <x-jet-input-error for="models.{{$index}}.country" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-6">
    <x-jet-section-border />
    <x-danger-button wire:click="deleteModel({{$index}})" class="float-right">Delete</x-danger-button>
</div>
