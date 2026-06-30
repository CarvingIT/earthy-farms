@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-emerald-500 text-start text-base font-semibold text-emerald-700 bg-emerald-50/50 transition-all duration-150'
            : 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-transparent text-start text-base font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-50 hover:border-neutral-300 transition-all duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

