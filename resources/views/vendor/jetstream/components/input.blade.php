@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control py-2 px-2 sm:inline-block border-gray-300 bg-white dark:bg-dark-1 focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
