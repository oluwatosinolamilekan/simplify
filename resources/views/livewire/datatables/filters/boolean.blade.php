<div x-data class="flex flex-col mr-2.5 ml-1 mb-3">
    <x-select
        x-ref="select"
        name="{{ $name }}"
        wire:input="applyFilter('boolean', '{{ $index }}', $event.target.value)"
        x-on:input="$refs.select.value=''"
        class="text-gray-500 h-8 mt-2.5 pt-1 pb-1"
    >
        <option value="">Select..</option>
        <option value="0" class="text-gray-800">No</option>
        <option value="1" class="text-gray-800">Yes</option>
    </x-select>

    <div class="flex flex-wrap max-w-48">
        @isset($this->activeBooleanFilters[$index])
        @if($this->activeBooleanFilters[$index] == 1)
        <x-selected-filter-tag wire:click="removeFilter('boolean', '{{ $index }}')">
            <span class="pr-2">Yes</span>
        </x-selected-filter-tag>
        @elseif(strlen($this->activeBooleanFilters[$index]) > 0)
        <x-selected-filter-tag wire:click="removeFilter('boolean', '{{ $index }}')">
            <span class="pr-2">No</span>
        </x-selected-filter-tag>
        @endif
        @endisset
    </div>
</div>
