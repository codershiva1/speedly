@props([
    'title', 
    'badgeText', 
    'icon' => 'bolt', 
    'pulse' => false
])

<div class="flex items-center gap-3 px-2 w-full">
    <div class="flex flex-col">
        <h3 class="text-sm md:text-2xl font-black italic tracking-tighter text-gray-900 uppercase leading-none">
            {{ $title }}
        </h3>
        <div class="h-1 w-12 bg-green-500 rounded-full mt-1"></div>
    </div>

    <div class="badge-folding flex items-center gap-2 px-3 py-1.5 rounded-lg border border-green-200 bg-gradient-to-r from-green-50 to-white shadow-sm {{ $pulse ? 'glow-pulse' : '' }}">
        
        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-green-500 text-white shadow-md">
            @if($icon === 'bolt')
                <i class="fa fa-bolt text-xs"></i>
            @elseif($icon === 'fire')
                <i class="fa fa-fire text-xs"></i>
            @elseif($icon === 'star')
                <i class="fa fa-star text-xs"></i>
            @elseif($icon === 'leaf')
                <i class="fa fa-leaf text-xs"></i>
            @endif
        </div>

        <span class="text-green-800 text-[10px] md:text-xs font-black uppercase tracking-widest whitespace-nowrap">
            {{ $badgeText }}
        </span>
    </div>

    <div class="flex-grow"></div> {{-- Spacer to keep 'View all' or other items on the far right if present --}}
</div>