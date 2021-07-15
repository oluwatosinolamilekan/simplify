<a {!! $attributes->merge(['class' => 'text-center px-4 py-3 mx-2 bg-red-600 rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-500 active:bg-red-600 disabled:opacity-25 transition']) !!}>
    {{ $slot }}
</a>
