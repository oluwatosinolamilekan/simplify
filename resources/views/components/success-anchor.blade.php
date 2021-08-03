<a {!! $attributes->merge(['class' => 'text-center px-4 py-3 mx-2 rounded-md font-semibold cursor-pointer text-xs text-white tracking-widest bg-theme-18 focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition nowrap']) !!}>
    {{ $slot }}
</a>
