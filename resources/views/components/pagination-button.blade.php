@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-400 transition ease-in-out duration-150"]) !!}>
    {{ $slot }}
</button>
