<div x-data class="flex flex-col mr-2.5">
    <x-select
        x-ref="select"
        name="{{ $name }}"
        wire:input="applyFilter('boolean', '{{ $index }}', $event.target.value)"
        x-on:input="$refs.select.value=''"
        class="text-gray-500 h-8 mt-2.5"
    >
        <option value="">Select..</option>
        <option value="0" class="text-gray-800">No</option>
        <option value="1" class="text-gray-800">Yes</option>
    </x-select>

    <div class="flex flex-wrap max-w-48 space-x-1">
        @isset($this->activeBooleanFilters[$index])
        @if($this->activeBooleanFilters[$index] == 1)
        <button wire:click="removeFilter('boolean', '{{ $index }}')"
            class="m-1 pl-1 flex items-center uppercase tracking-wide bg-gray-300 text-white hover:bg-red-400 rounded-full focus:outline-none text-xs space-x-1">
            <span>YES</span>
            <x-icons.x-circle />
        </button>
        @elseif(strlen($this->activeBooleanFilters[$index]) > 0)
        <button wire:click="removeFilter('boolean', '{{ $index }}')"
            class="m-1 pl-1 flex items-center uppercase tracking-wide bg-gray-300 text-white hover:bg-red-400 rounded-full focus:outline-none text-xs space-x-1">
            <span>No</span>
            <x-icons.x-circle />
        </button>
        @endif
        @endisset
    </div>
</div>
