@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-3 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition text-center xl:mr-3 align-top bg-theme-18 border-theme-18 focus:ring-theme-18']) !!}>
    {{ $slot }}
</button>
