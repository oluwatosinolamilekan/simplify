@props(['disabled' => false])

<div class="sm:inline-block sm:float-right w-1/2">
    <span class="input-symbol-currency">
        <input {{ $disabled ? 'disabled' : '' }} type="number" {!! $attributes->merge(['class' => 'form-control mt-1 block w-full bg-white dark:bg-dark-1']) !!}/>
    </span>
</div>
