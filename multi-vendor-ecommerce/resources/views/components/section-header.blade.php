@props([
    'title', 
    'badgeText', 
    'icon' => 'bolt', // Default icon
    'pulse' => false
])

<div class="flex flex-col md:flex-row md:items-center justify-between gap-1.5 px-2">
    <h2 class="text-1xl md:text-2xl font-black italic tracking-widest text-transparent uppercase"
        style="-webkit-text-stroke: .9px #22c55e; filter: drop-shadow(0 0 5px rgba(34, 197, 94, 0.3));">
        {{ $title }}
    </h2>

    <div class="flex items-center gap-2 px-2 py-1 rounded-full border-2 border-green-400 bg-green-300 backdrop-blur-sm 
                shadow-[0_0_15px_rgba(74,222,128,0.5)] {{ $pulse ? 'animate-pulse' : '' }}">
        
        @if($icon === 'bolt')
            <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        @elseif($icon === 'fire')
            <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/></svg>
        @elseif($icon === 'star')
            <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        @elseif($icon === 'leaf')
            <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.318 6.318a4.5 4.5 0 000 6.364L10 18.364l5.682-5.682a4.5 4.5 0 00-6.364-6.364L10 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" clip-rule="evenodd"/></svg>
        @endif

        <span class="text-yellow-900 font-bold text-sm uppercase tracking-widest">
            {{ $badgeText }}
        </span>
    </div>
</div>