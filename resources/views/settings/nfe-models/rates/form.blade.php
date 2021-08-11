<!-- Base Rate -->
<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="rates.{{$index}}.base_rate" value="{{ __('Base Rate') }}" />
    <x-forms.rate-input wire:model="rates.{{$index}}.base_rate" />
    <x-jet-input-error for="rates.{{$index}}.base_rate" class="mt-3" />
</div>

<!-- Date -->
<div class="col-span-3 sm:col-span-3">
    <x-jet-label for="rates.{{$index}}.date" value="{{ __('Date') }}" />
    <x-forms.date-input wire:model="rates.{{$index}}.date" />
    <x-jet-input-error for="rates.{{$index}}.date" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-6">
    <x-jet-section-border />
    <x-danger-button wire:click="deleteModelRate({{$index}})" class="float-right">
        {{ $rates[$index]->id ? 'Delete' : 'Cancel' }}
    </x-danger-button>
</div>
