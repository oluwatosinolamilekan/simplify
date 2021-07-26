<a {!! $attributes->merge(['class' => 'inline-flex capitalize text-center px-4 py-2 mx-2 bg-white dark:bg-dark-1 border border-gray-300 cursor-pointer rounded-md text-gray-700 dark:text-white shadow-sm hover:text-gray-500 dark:hover:text-gray-400 focus:border-theme-18 focus:ring-offset-theme-18 focus:ring-theme-18 focus:ring-opacity-50 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition']) !!}>
    {{ $slot }}
</a>
