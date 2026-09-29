@props([
    'href' => '#',
    'badge' => null,
    'badgeColor' => 'zinc', // zinc, indigo, emerald
    'title' => '',
    'description' => '',
    'actionText' => 'Lihat detail &rarr;',
])

@php
    $badgeStyles = [
        'zinc' => 'bg-zinc-100/80 text-zinc-700 border-zinc-200/60',
        'indigo' => 'bg-indigo-50/80 text-indigo-700 border-indigo-200/60',
        'emerald' => 'bg-emerald-50/80 text-emerald-700 border-emerald-200/60',
    ][$badgeColor] ?? 'bg-zinc-100/80 text-zinc-700 border-zinc-200/60';
@endphp

<a href="{{ $href }}" 
   {{ $attributes->merge([
       'class' => 'group relative flex flex-col justify-between overflow-hidden rounded-2xl bg-white/75 p-6 backdrop-blur-md border border-white/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-0.5 hover:border-zinc-300/60 transition-all duration-300'
   ]) }}>

    <!-- Ambient Subtle Glow Background saat hover -->
    <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full bg-gradient-to-br from-indigo-100/40 via-purple-50/20 to-transparent blur-2xl group-hover:from-indigo-200/40 transition-all duration-500"></div>

    <div>
        <!-- Top bar: Icon & Badge -->
        <div class="flex items-center justify-between gap-3 mb-5">
            @if(isset($icon))
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-zinc-900/[0.04] border border-zinc-900/[0.06] text-zinc-800 group-hover:bg-zinc-900 group-hover:text-white transition-colors duration-300">
                    {{ $icon }}
                </div>
            @endif

            @if($badge)
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-medium tracking-tight border backdrop-blur-sm {{ $badgeStyles }}">
                    {{ $badge }}
                </span>
            @endif
        </div>

        <!-- Typography Section -->
        <h3 class="text-base font-semibold tracking-tight text-zinc-900 group-hover:text-indigo-600 transition-colors duration-200">
            {{ $title }}
        </h3>
        
        @if($description)
            <p class="mt-2 text-sm text-zinc-500 leading-relaxed font-normal">
                {{ $description }}
            </p>
        @endif
    </div>

    <!-- Bottom Action Footer -->
    <div class="mt-6 flex items-center justify-between border-t border-zinc-100/80 pt-4">
        <span class="text-xs font-semibold text-zinc-800 group-hover:text-indigo-600 transition-colors flex items-center gap-1 group-hover:translate-x-0.5 transition-transform duration-200">
            {!! $actionText !!}
        </span>
    </div>
</a>