@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-bold text-neutral-500 uppercase tracking-wider']) }}>
    {{ $value ?? $slot }}
</label>
