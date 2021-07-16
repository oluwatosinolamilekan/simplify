<a {!! $attributes->merge(['class' => 'text-center px-4 py-3 mx-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-gray-300 focus:ring focus:ring-gray-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition']) !!}>
    {{ $slot }}
</a>
