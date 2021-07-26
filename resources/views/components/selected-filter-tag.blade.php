<button {!! $attributes->merge(['class' => "mt-3 mx-2 ml-0 pl-2.5 pr-2 py-0.5 flex items-center tracking-wide bg-theme-18-with-opacity text-gray-700 hover:bg-theme-18 hover:text-white rounded-md focus:outline-none transition ease-in-out duration-150 selected_filter_tag"]) !!}>
    {{ $slot }}
    <x-icons.x />
</button>
