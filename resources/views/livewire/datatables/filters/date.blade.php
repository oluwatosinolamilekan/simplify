<div x-data class="flex flex-col mr-2.5 ml-1 mb-3 date_input_min_with">
    <div class="w-full relative flex">
        <div class="relative">

            <x-input x-ref="range" id="datepicker" wire:selected="doDateFilterRange('{{ $index }}', $event.target.value)" class="h-8 mt-auto pr-7 mt-2.5" placeholder="Select Date.." />

            <div class="absolute inset-y-0 right-0 pr-2 flex items-center mt-2.5">
                <x-clear-filter x-on:click="$refs.range.value=''" tabindex="-1"/>
            </div>
        </div>
    </div>
    <div class="w-full relative flex">
        @foreach($this->activeDateFilters ?? [] as $index => $filter)
            <x-selected-filter-tag wire:click="removeFilter('date', '{{ $index }}')" x-on:click="$refs.range.value=''">
                <span class="pr-2">{{ $filter['start'] ?? '' }} - {{ $filter['end'] ?? '' }}</span>
            </x-selected-filter-tag>
        @endforeach
    </div>
</div>
