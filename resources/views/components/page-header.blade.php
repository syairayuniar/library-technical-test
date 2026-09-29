@props(['subtitle' => '', 'title' => '', 'description' => ''])

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <div>
        @if($subtitle)
            <p class="text-[11px] font-semibold uppercase tracking-widest text-zinc-400">
                {{ $subtitle }}
            </p>
        @endif
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900">
            {{ $title }}
        </h1>
        @if($description)
            <p class="text-sm text-zinc-500 mt-0.5">
                {{ $description }}
            </p>
        @endif
    </div>
    @if(isset($action))
        <div>
            {{ $action }}
        </div>
    @endif
</div>