<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-[#E60914] border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-[#C50812 focus:outline-none focus:ring-2 focus:ring-[#E60914] focus:ring-offset-2 focus:ring-offset-white disabled:opacity-40 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
