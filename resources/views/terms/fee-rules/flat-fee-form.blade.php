<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="rate_type" value="{{ __('Type') }}" />
    <x-jet-input id="rate_type" type="text" class="w-1/2 float-right" wire:model="feeRules.{{$index}}.rate_type" />
    <x-jet-input-error for="feeRules.{{$index}}.rate_type" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.rate" value="{{ __('Amount') }}" />
    <x-forms.currency-input wire:model="feeRules.{{$index}}.rate" />
    <x-jet-input-error for="feeRules.{{$index}}.rate" class="mt-3" />
</div>
