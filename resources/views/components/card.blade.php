@props([
    'title' => null,
    'subtitle' => null,
    'footer' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden']) }}>
    @if($title || $subtitle)
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            @if($title)
                <h3 class="text-lg font-bold text-slate-800 tracking-tight">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="text-xs text-slate-500 mt-0.5">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div class="p-6 text-slate-600">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 text-xs text-slate-500">
            {{ $footer }}
        </div>
    @endif
</div>
