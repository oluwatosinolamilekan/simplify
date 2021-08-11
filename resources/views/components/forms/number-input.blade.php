
@props(['disabled' => false])

<div class="sm:inline-block sm:float-right w-1/2">
    <input {{ $disabled ? 'disabled' : '' }} type="number" {!! $attributes->merge(['class' => 'form-control mt-1 block w-full']) !!}/>
</div>
