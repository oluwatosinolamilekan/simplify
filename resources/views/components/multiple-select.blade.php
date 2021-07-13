@props(['values'])

<!-- BEGIN: Multi Select -->
<div id="multi-select" class="p-5">
    <div class="preview">
        <select data-placeholder="Select option" data-search="true" class="tail-select w-full" multiple>
            @foreach ($values as $value)
                <option value="{{ $value->id }}" {{$value->selected ? 'selected' : ''}}>{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<!-- END: Multi Select -->
