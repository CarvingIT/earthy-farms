@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 mb-4 bg-emerald-50 border border-emerald-200/50 text-emerald-800 rounded-xl text-xs font-semibold shadow-sm']) }}>
        {{ $status }}
    </div>
@endif
