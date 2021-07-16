@props(['type' => 'submit'])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'text-center px-4 py-3 rounded-md font-semibold text-xs text-white tracking-widest bg-theme-18 focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition']) }}>
    {{ $slot }}
</button>
