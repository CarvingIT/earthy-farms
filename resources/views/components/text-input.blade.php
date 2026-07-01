@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-neutral-200 focus:border-emerald-500 focus:ring-emerald-500/20 focus:ring-2 rounded-xl shadow-sm text-sm py-2 px-3 transition-colors duration-200']) }}>
