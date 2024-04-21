<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border-orange-400/75 border-2 border-transparent rounded-md font-semibold text-xs text-orange-500/75 uppercase tracking-widest hover:text-white hover:bg-orange-500/75 focus:bg-orange-700 active:bg-orange-900/75 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:text-white focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
