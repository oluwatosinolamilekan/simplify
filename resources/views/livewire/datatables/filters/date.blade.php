<div x-data class="flex flex-col">
    <div class="w-full relative flex">
        <input x-ref="start" class="m-1 pr-6 text-sm pt-1 flex-grow form-input" type="date"
            wire:change="applyFilter('dateFilterStart', '{{ $index }}', $event.target.value)" style="padding-bottom: 5px" />
        <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
            <button x-on:click="$refs.start.value=''" wire:click="doDateFilterStart('{{ $index }}', '')" class="inline-flex text-gray-400 hover:text-red-600 focus:outline-none" tabindex="-1">
                <x-icons.x-circle class="h-3 w-3 stroke-current" />
            </button>
        </div>
    </div>
    <div class="w-full relative flex">
        <input x-ref="end" class="m-1 pr-6 text-sm pt-1 flex-grow form-input" type="date"
            wire:change="doDateFilterEnd('{{ $index }}', $event.target.value)" style="padding-bottom: 5px" />
            <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
            <button x-on:click="$refs.end.value=''" wire:click="doDateFilterEnd('{{ $index }}', '')" class="inline-flex text-gray-400 hover:text-red-600 focus:outline-none" tabindex="-1">
                <x-icons.x-circle class="h-3 w-3 stroke-current" />
            </button>
        </div>
    </div>
    <div class="w-full relative flex">
        @foreach($this->activeDateFilters ?? [] as $index => $filter)
            <button wire:click="removeFilter('date', '{{ $index }}')" class="m-1 pl-1 flex items-center uppercase tracking-wide bg-gray-300 text-white hover:bg-red-600 rounded-full focus:outline-none text-xs space-x-1">
                <span>{{ $filter['start'] ?? '' }} - {{ $filter['end'] ?? '' }}</span>
                <x-icons.x-circle />
            </button>
        @endforeach
    </div>
</div>
