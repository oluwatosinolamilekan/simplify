@props(['disabled' => false])

<div class="sm:inline-block sm:float-right w-1/2 min-w-0">
    <span class="input-symbol-rate">
        <input {{ $disabled ? 'disabled' : '' }} type="number" dir="rtl" {!! $attributes->merge(['class' => 'form-control mt-1 block w-full']) !!}/>
    </span>
</div>
