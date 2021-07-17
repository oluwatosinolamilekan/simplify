<div x-data class="flex flex-col mr-2.5">
    <div class="flex">
        <x-select
            x-ref="select"
            name="{{ $name }}"
            wire:input="applyFilter('select', '{{ $index }}', $event.target.value)"
            x-on:input="$refs.select.value=''"
            class="text-gray-500 h-8 mt-2.5"
        >
            <option value="">Select..</option>
            @foreach($options as $value => $label)
                @if(is_object($label))
                    <option value="{{ $label->id }}" class="text-gray-800">{{ $label->name }}</option>
                @elseif(is_array($label))
                    <option value="{{ $label['id'] }}" class="text-gray-800">{{ $label['name'] }}</option>
                @elseif(is_numeric($value))
                    <option value="{{ $label }}" class="text-gray-800">{{ $label }}</option>
                @else
                    <option value="{{ $value }}" class="text-gray-800">{{ $label }}</option>
                @endif
            @endforeach
        </x-select>
    </div>

    <div class="flex flex-wrap max-w-48 space-x-1">
        @foreach($this->activeSelectFilters[$index] ?? [] as $key => $value)
        <button wire:click="removeFilter('select', '{{ $index }}', '{{ $key }}')" x-on:click="$refs.select.value=''"
            class="m-1 pl-1 flex items-center uppercase tracking-wide bg-gray-300 text-white hover:bg-red-400 rounded-full focus:outline-none text-xs space-x-1">
            <span>{{ $this->getDisplayValue($index, $value) }}</span>
            <x-icons.x-circle />
        </button>
        @endforeach
    </div>
</div>
