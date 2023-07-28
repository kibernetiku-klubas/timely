<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-none text-purple-500 border border-purple-500 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-purple-500 focus:bg-purple-700 active:bg-purple-900 focus:outline-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 hover:text-white transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
