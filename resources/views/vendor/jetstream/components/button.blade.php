<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center px-4 py-4 rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring disabled:opacity-25 hover:opacity-75 transition']) }}>
    {{ $slot }}
</button>
