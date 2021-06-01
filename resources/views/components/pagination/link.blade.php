@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block pl-1 pr-1 py-1 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition'
                : 'block pl-1 pr-1 py-1 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition';
@endphp

<button type="button" {{ $attributes->merge(['class' => $classes]) }} class="page-link">{{ $slot }}</button>
