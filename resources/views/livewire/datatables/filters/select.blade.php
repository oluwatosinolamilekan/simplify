<div x-data class="flex flex-col mr-2.5 ml-1 mb-3">
    <div class="flex">
        <x-select
            id="datatable_field_filter_{{str_replace(' ', '_', strtolower($name))}}"
            x-ref="select"
            name="{{ $name }}"
            wire:input="applyFilter('select', '{{ $index }}', $event.target.value)"
            x-on:input="$refs.select.value=''"
            class="text-gray-500 h-8 mt-2.5 pt-1 pb-1 text-sm-13 dark:bg-dark-2"
        >
            <option value="">Select..</option>
            @foreach($options as $value => $label)
                @if(is_object($label))
                    <option value="{{ $label->id }}" class="text-gray-800 dark:text-white">{{ $label->name }}</option>
                @elseif(is_array($label))
                    <option value="{{ $label['id'] }}" class="text-gray-800 dark:text-white">{{ $label['name'] }}</option>
                @elseif(is_numeric($value))
                    <option value="{{ $label }}" class="text-gray-800 dark:text-white">{{ $label }}</option>
                @else
                    <option value="{{ $value }}" class="text-gray-800 dark:text-white">{{ $label }}</option>
                @endif
            @endforeach
        </x-select>
    </div>

    <div class="flex flex-wrap max-w-48">
        @foreach($this->activeSelectFilters[$index] ?? [] as $key => $value)
        <x-selected-filter-tag wire:click="removeFilter('select', '{{ $index }}', '{{ $key }}')" x-on:click="$refs.select.value=''">
            <span class="pr-2">{{ $this->getDisplayValue($index, $value) }}</span>
        </x-selected-filter-tag>
        @endforeach
    </div>
</div>
