<div x-data class="flex flex-col mr-2.5 ml-1 mb-3">
    <x-input
        x-ref="input"
        type="text"
        wire:change="applyFilter('text', '{{ $index }}', $event.target.value)"
        x-on:change="$refs.input.value = ''"
        placeholder="{{ $name }}"
        class="h-8 mt-2.5"
    />
    <div class="flex flex-wrap max-w-48">
        @foreach($this->activeTextFilters[$index] ?? [] as $key => $value)
        <x-selected-filter-tag wire:click="removeFilter('text', '{{ $index }}', '{{ $key }}')">
            <span class="pr-2">{{ $this->getDisplayValue($index, $value) }}</span>
        </x-selected-filter-tag>
        @endforeach
    </div>
</div>
