@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "relative inline-flex items-center px-2 py-2 bg-white dark:bg-dark-1 text-sm leading-5 font-medium text-gray-400 focus:outline-none focus:z-10 transition ease-in-out duration-150"]) !!}>
    {{ $slot }}
</button>
