<button {!! $attributes->merge(['class' => "h-8 flex justify-between items-center relative inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-5 rounded-md dark:bg-dark-2 focus:outline-none focus:shadow-outline-gray focus:border-gray-300 dark:focus:border-gray-700 transition ease-in-out duration-150"]) !!}>
    {{ $slot }}
</button>
