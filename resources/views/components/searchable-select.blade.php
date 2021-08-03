@props(['values', 'disabled' => false])

   <div id="multi-select" {!! $attributes !!}>
    <div class="preview">
        <select {{ $disabled ? 'disabled' : '' }} class="form-select bg-white py-3 px-4 border-gray-300 dark:bg-dark-1 block mt-1 focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18 focus:ring-opacity-50">
            <option>No selection</option>
            @foreach ($values as $value)
                <option value="{{ $value['id']}}"> {{ $value['name'] }} </option>
            @endforeach
        </select>

    </div>
</div>
