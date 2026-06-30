@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-1.5 rounded-xl text-[13px] font-semibold text-emerald-700 bg-emerald-50 transition-all duration-200'
            : 'inline-flex items-center px-3 py-1.5 rounded-xl text-[13px] font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-50 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

