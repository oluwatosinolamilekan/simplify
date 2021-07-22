@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "form-select bg-white py-3 px-3 border-gray-300 dark:bg-dark-1 block mt-1 w-full focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18 focus:ring-opacity-50"]) !!}>
    {{ $slot }}
</select>
