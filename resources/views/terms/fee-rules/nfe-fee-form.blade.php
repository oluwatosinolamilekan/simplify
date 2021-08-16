
<div class="col-span-6 sm:col-span-6">
    @foreach(\App\Models\NFEModel::get() as $model)
        <x-radio wire:model="feeRules.{{$index}}.configuration.nfe_model_id" value="{{$model->id}}"> {{ $model->name }} </x-radio>
    @endforeach
        <x-jet-input-error for="feeRules.{{$index}}.configuration.nfe_model_id" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.rate" value="{{ __('Interest Rate') }}" />
    <x-forms.rate-input wire:model="feeRules.{{$index}}.rate" />
    <x-jet-input-error for="feeRules.{{$index}}.rate" class="mt-3" />
</div>

<div class="col-span-6 sm:col-span-3">
    <x-jet-label for="feeRules.{{$index}}.configuration.float_days" value="{{ __('Float Days') }}" />
    <x-forms.number-input wire:model="feeRules.{{$index}}.configuration.float_days" />
    <x-jet-input-error for="feeRules.{{$index}}.configuration.float_days" class="mt-3" />
</div>
