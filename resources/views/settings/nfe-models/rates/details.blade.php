<!-- Base Rate -->
<div class="col-span-6 sm:col-span-2">
    <x-jet-label for="rate.base_rate" value="{{ __('Base Rate') }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $rate->base_rate }} %
    </span>
</div>

<!-- Date -->
<div class="col-span-3 sm:col-span-2">
    <x-jet-label for="rate.date" value="{{ __('Date') }}" />
    <span class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        {{ $rate->date }}
    </span>
</div>

<div class="col-span-6 sm:col-span-2">
    <x-jet-section-border />
    <x-danger-button wire:click="deleteModelRate({{$index}}, {{$rateIndex}})" class="float-right">
        Delete
    </x-danger-button>
</div>
