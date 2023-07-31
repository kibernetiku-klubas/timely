<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-none text-red-600 border border-red-600 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-red-600 focus:bg-red-700 active:bg-red-900 focus:outline-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 hover:text-white transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
