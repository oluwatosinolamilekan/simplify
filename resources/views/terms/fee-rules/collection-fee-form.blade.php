<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.start_day" value="{{ __('Start Day') }}" />
    <x-jet-input type="text" class="w-1/2 float-right" wire:model="feeRules.{{$index}}.configuration.start_day" />
    <x-jet-input-error for="feeRules.{{$index}}.configuration.start_day" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.thru_day" value="{{ __('Thru Day') }}" />
    <x-jet-input type="text" class="w-1/2 float-right" wire:model="feeRules.{{$index}}.configuration.thru_day" />
    <x-jet-input-error for="feeRules.{{$index}}.configuration.thru_day" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.rate" value="{{ __('Rate') }}" />
    <x-forms.rate-input wire:model="feeRules.{{$index}}.rate" />
    <x-jet-input-error for="feeRules.{{$index}}.rate" class="mt-3" />
</div>
