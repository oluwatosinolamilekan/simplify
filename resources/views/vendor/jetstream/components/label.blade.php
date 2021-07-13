@props(['value'])

<label {{ $attributes->merge(['class' => 'inline-block font-medium text-sm text-gray-700 sm:inline-block w-1/2 mt-3 text-wrap']) }}>
    {{ $value ?? $slot }}
</label>
