<div x-data class="flex flex-col mr-2.5 ml-1 mb-3 date_input_min_with">
    <div class="w-full relative flex">
        <div class="relative">

            <x-input id="datepicker" class="h-8 mt-auto pr-7 mt-2.5" placeholder="Select Date.."
            wire:change="applyFilter('dateFilterStart', '{{ $index }}', $event.target.value); doDateFilterEnd('{{ $index }}', '')" x-on:change="console.log('test');" onchange="alert(this.value)"/>

            <div class="absolute inset-y-0 right-0 pr-2 flex items-center mt-2.5">
                <x-clear-filter x-on:click="$refs.start.value=''" wire:click="doDateFilterStart('{{ $index }}', '')" tabindex="-1"/>
            </div>
        </div>
        {{--<div class="relative">--}}

            {{--<x-input  id="end-date" x-ref="end" type="date" class="h-8 mt-auto pr-7 mt-2.5" placeholder="Select End Date.."--}}
            {{--wire:change="doDateFilterEnd('{{ $index }}', $event.target.value)"/>--}}
            {{--<div class="absolute inset-y-0 right-0 pr-2 flex items-center mt-2.5">--}}
                {{--<x-clear-filter x-on:click="$refs.end.value=''" wire:click="doDateFilterEnd('{{ $index }}', '')" tabindex="-1"/>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <div class="w-full relative flex">
        @foreach($this->activeDateFilters ?? [] as $index => $filter)
            <x-selected-filter-tag wire:click="removeFilter('date', '{{ $index }}')">
                <span class="pr-2">{{ $filter['start'] ?? '' }} - {{ $filter['end'] ?? '' }}</span>
            </x-selected-filter-tag>
        @endforeach
    </div>
</div>
