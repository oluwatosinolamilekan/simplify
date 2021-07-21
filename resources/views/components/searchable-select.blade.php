@props(['values'])

<div id="multi-select" {!! $attributes !!}>
    <div class="preview">
        <select data-placeholder="Select option" data-search="true" class="tail-select form-control mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            @foreach ($values as $value)
                <option value="{{ $value['id']}}" {{$value['selected'] ?? false ? 'selected' : ''}}> {{ $value['name'] }} </option>
            @endforeach
        </select>
    </div>
</div>
