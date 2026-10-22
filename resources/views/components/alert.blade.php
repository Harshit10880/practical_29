@props([
    'type' => 'info',
    'title' => null,
])

@php
    $typeClasses = [
        'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'error'   => 'bg-rose-50 text-rose-800 border-rose-200',
        'warning' => 'bg-amber-50 text-amber-800 border-amber-200',
        'info'    => 'bg-sky-50 text-sky-800 border-sky-200',
    ][$type] ?? 'bg-sky-50 text-sky-800 border-sky-200';
@endphp

<div {{ $attributes->merge(['class' => "p-4 mb-4 text-sm rounded-lg border {$typeClasses} flex items-start gap-3 shadow-sm"]) }} role="alert">
    <div class="flex-shrink-0 text-lg">
        @if($type === 'success')
            <span class="text-emerald-600 font-bold">✓</span>
        @elseif($type === 'error')
            <span class="text-rose-600 font-bold">✕</span>
        @elseif($type === 'warning')
            <span class="text-amber-600 font-bold">⚠</span>
        @else
            <span class="text-sky-600 font-bold">ℹ</span>
        @endif
    </div>
    <div class="flex-1">
        @if($title)
            <div class="font-bold text-sm mb-1">{{ $title }}</div>
        @endif
        {{ $slot }}
    </div>
</div>
