<x-layouts.site title="Offers Hub | Speedly Savings">
<div class="bg-[#f0f4f2] min-h-screen pb-32">
    
   

    {{-- 2. CINEMATIC HEADER SECTION --}}
    <div class="relative bg-[#0b3d21] pt-2 pb-36 px-6 overflow-hidden">
        {{-- Animated background pattern --}}
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        
        <div class="max-w-7xl mx-auto relative z-10 flex flex-col  justify-between gap-3 w-full">

               {{-- 1. STICKY GLASSMORPHISM STATS BAR --}}
            <div class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-green-100 py-3 shadow-sm">
                <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="flex h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
                        <span class="text-[10px] font-black text-gray-800 uppercase tracking-widest">Live Flash Sale Ends In:</span>
                        <span id="countdown" class="text-xs font-mono font-black text-red-600 bg-red-50 px-2 py-0.5 rounded border border-red-100">00:00:00</span>
                    </div>
                    <div class="hidden md:flex items-center gap-6">
                        <div class="flex items-center gap-2 text-[10px] font-bold text-gray-500">
                            <i class="bi bi-shield-check text-green-600"></i> 100% VERIFIED DEALS
                        </div>
                        <div class="flex items-center gap-2 text-[10px] font-bold text-gray-500">
                            <i class="bi bi-truck text-green-600"></i> FREE DELIVERY OFFERS
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-center justify-between gap-12 w-full">
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center gap-2 bg-green-500/20 text-green-300 text-[10px] font-black px-4 py-1.5 rounded-full mb-6 border border-green-500/30">
                        <i class="bi bi-stars"></i> EXCLUSIVE MEMBER ACCESS
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-white italic tracking-tighter leading-[0.85]">
                        THE <span class="text-transparent" style="-webkit-text-stroke: 1.5px #4ade80;">BIG</span><br>SAVINGS
                    </h1>
                    <p class="text-green-100/70 mt-2 font-medium text-lg max-w-md">
                        Hand-picked premium deals across Fashion, Fresh, and Electronics. Updated every 60 minutes.
                    </p>
                </div>

                {{-- Premium Card Widget --}}
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-green-400 to-yellow-400 rounded-[3rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative bg-[#154d2e] p-8 rounded-[2.5rem] border border-white/10 shadow-2xl">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="h-12 w-12 rounded-2xl bg-yellow-400 flex items-center justify-center text-2xl">
                                💰
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-green-300 uppercase">Available Discount Pools</p>
                                <p class="text-2xl font-black text-white italic">₹2.5 Lakhs+</p>
                            </div>
                        </div>
                        <button class="w-full bg-white text-green-900 font-black py-4 rounded-2xl text-xs uppercase tracking-widest hover:bg-green-400 hover:text-white transition-all">
                            Upgrade to VIP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 -mt-24">
        
        {{-- 3. HERO SLIDER SECTION (off_hero) --}}
        @if(isset($placements['off_hero']))
        <div class="mb-20">
            <div class="flex gap-6 overflow-x-auto no-scrollbar snap-x snap-mandatory pb-4">
                @foreach($placements['off_hero']->ads as $ad)
                <a href="{{ route('offers.click', $ad) }}" class="min-w-[90%] md:min-w-[55%] aspect-[21/9] bg-white rounded-[3.5rem] overflow-hidden shadow-2xl snap-center relative block group border-[6px] border-white">
                    <img src="{{ asset('storage/'.$ad->banner_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent p-12 flex flex-col justify-end">
                        <div class="translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                            <h2 class="text-4xl md:text-5xl font-black text-white italic uppercase tracking-tighter leading-none mb-2">{{ $ad->title }}</h2>
                            <div class="flex items-center gap-3">
                                <span class="bg-yellow-400 text-black text-[10px] font-black px-4 py-1 rounded-full uppercase">Claim Now</span>
                                <span class="text-white/60 text-xs font-bold">Limited time only</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- 4. FLASH DEALS GRID (off_grid) --}}
        @if(isset($placements['off_grid']))
        <div class="mb-24">
            <div class="flex items-center justify-between mb-10 px-6">
                <div>
                    <h3 class="text-4xl font-black text-gray-900 italic tracking-tighter">Flash <span class="text-green-600">Frenzy</span></h3>
                    <p class="text-xs text-gray-400 font-bold uppercase mt-1">Supercharged discounts for the next few hours</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($placements['off_grid']->ads as $ad)
                <a href="{{ route('offers.click', $ad) }}" class="bg-white p-3 rounded-[2.5rem] shadow-xl hover:shadow-green-200 hover:-translate-y-3 transition-all group border border-white">
                    <div class="aspect-square rounded-[2rem] overflow-hidden mb-4 relative shadow-inner bg-gray-50">
                        <img src="{{ asset('storage/'.$ad->banner_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                        <div class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black px-3 py-1 rounded-lg">
                            TOP DEAL
                        </div>
                    </div>
                    <div class="px-2">
                        <h4 class="text-[11px] font-black text-gray-800 line-clamp-2 uppercase tracking-tight mb-4 min-h-[32px]">{{ $ad->title }}</h4>
                        <div class="w-full py-2.5 bg-green-50 text-green-600 text-[10px] font-black rounded-2xl group-hover:bg-green-600 group-hover:text-white transition-all text-center uppercase tracking-widest">
                            Grab Deal
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- 5. SLIM CATEGORY BANNERS (off_slim) --}}
        @if(isset($placements['off_slim']))
        <div class="grid md:grid-cols-2 gap-8 mb-24">
            @foreach($placements['off_slim']->ads as $ad)
            <a href="{{ route('offers.click', $ad) }}" class="group relative h-48 rounded-[3rem] overflow-hidden shadow-2xl">
                <img src="{{ asset('storage/'.$ad->banner_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-transparent p-10 flex flex-col justify-center">
                    <span class="text-green-400 text-[9px] font-black uppercase tracking-[0.3em] mb-2">Category Spotlight</span>
                    <h4 class="text-2xl font-black text-white italic uppercase tracking-tighter">{{ $ad->title }}</h4>
                    <div class="mt-4 flex items-center gap-2 text-white/80 text-[10px] font-bold uppercase">
                        Explore Now <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        {{-- 6. BANK VOUCHER SECTION (off_bank) --}}
        @if(isset($placements['off_bank']))
        <div class="bg-white rounded-[4rem] p-12 shadow-2xl border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-12 opacity-5">
                <i class="bi bi-wallet2 text-9xl"></i>
            </div>
            
            <h3 class="text-3xl font-black text-gray-900 italic mb-10 relative z-10">Partner <span class="text-green-600">Bonuses</span></h3>
            
            <div class="grid lg:grid-cols-3 gap-8 relative z-10">
                @foreach($placements['off_bank']->ads as $ad)
                <div class="bg-gray-50 rounded-[2.5rem] p-8 border-2 border-dashed border-gray-200 hover:border-green-500 hover:bg-green-50/30 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-2xl text-green-600 mb-6 group-hover:scale-110 transition-transform">
                        <i class="bi bi-bank"></i>
                    </div>
                    <h4 class="text-lg font-black text-gray-800 italic uppercase mb-2">{{ $ad->title }}</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6 leading-relaxed">Applicable on all major credit and debit cards during checkout.</p>
                    
                    <div class="flex items-center bg-white rounded-2xl overflow-hidden border border-gray-100">
                        <div class="flex-1 px-4 py-3 font-mono text-xs font-black text-gray-600">SPEED2026</div>
                        <button class="bg-gray-900 text-white px-6 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-green-600 transition-all">Copy</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<script>
    // Real-time Countdown Timer Logic
    function startTimer(duration, display) {
        var timer = duration, hours, minutes, seconds;
        setInterval(function () {
            hours = parseInt(timer / 3600, 10);
            minutes = parseInt((timer % 3600) / 60, 10);
            seconds = parseInt(timer % 60, 10);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = hours + ":" + minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    window.onload = function () {
        var fourHours = 60 * 60 * 4,
            display = document.querySelector('#countdown');
        startTimer(fourHours, display);
    };
</script>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .snap-x { scroll-snap-type: x mandatory; scroll-behavior: smooth; }
</style>
</x-layouts.site>