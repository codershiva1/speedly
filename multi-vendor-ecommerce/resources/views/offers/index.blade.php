<style>
     @media (max-width: 767px) {
            .sticky-header{ display:none; }
        }
</style>

<x-layouts.site title="Offers Hub | Speedly Savings">
<div class="bg-[#f8fafc] min-h-screen pb-32">
    
    {{-- 1. PREMIUM STATS BAR --}}
    <div class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="px-3 py-1 bg-red-600 rounded text-white text-[10px] font-black uppercase tracking-tighter shadow-lg shadow-red-500/20">
                    Flash Sale
                </div>
                <div class="flex items-center gap-2">
                    <span id="countdown" class="text-sm font-mono font-black text-gray-900 border-r border-gray-200 pr-4">00:00:00</span>
                    <span class="hidden md:inline text-[9px] font-bold text-gray-400 uppercase tracking-widest pl-2">Vouchers live for all users</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                    <i class="bi bi-shield-check text-green-600"></i> Verified
                </div>
                <div class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-tighter border-l border-gray-200 pl-6">
                    <i class="bi bi-truck text-green-600"></i> Free Delivery
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MODERN HERO HEADER --}}
    <div class="relative bg-white pt-10 pb-20 px-6 overflow-hidden border-b border-gray-100">
        <div class="absolute inset-0 bg-gradient-to-tr from-green-50/20 via-white to-gray-50/30"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-gray-900 text-white text-[9px] font-black rounded mb-6 uppercase tracking-widest">
                        <i class="bi bi-stars text-green-400 font-bold"></i> Exclusive Access
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-gray-900 tracking-tighter leading-[0.85] italic uppercase mb-6">
                        The Big <span class="text-green-600 underline">Savings</span> Hub
                    </h1>
                    <p class="text-gray-500 font-medium text-lg max-w-lg leading-relaxed">
                        Hand-picked premium deals across Fashion, Fresh, and Electronics. Updated every hour.
                    </p>
                </div>

                {{-- VIP CARD (PREMIUM MODERN) --}}
                <div class="w-full md:w-96">
                    <div class="bg-gray-900 rounded-3xl p-8 shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-4 opacity-10 text-white text-8xl transform group-hover:scale-110 transition-transform">
                            <i class="bi bi-gem"></i>
                        </div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center text-3xl shadow-xl shadow-green-500/20">
                                    👑
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-[10px] font-black text-green-400 uppercase tracking-widest">Discount Pool</p>
                                    <p class="text-4xl font-black text-white italic">₹4,500+</p>
                                </div>
                            </div>
                            <button class="w-full bg-white text-gray-900 font-black py-4 rounded-xl text-xs uppercase tracking-widest hover:bg-green-500 hover:text-white transition-all shadow-lg active:scale-95">
                                Upgrade to Membership
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-12">
        
        {{-- 3. HERO AD SLIDER (Premium Wide Banners) --}}
        @if(isset($placements['off_hero']))
        <div class="mb-20">
            <div class="flex gap-6 overflow-x-auto no-scrollbar snap-x snap-mandatory">
                @foreach($placements['off_hero']->ads as $ad)
                <a href="{{ route('offers.click', $ad) }}" class="min-w-[90%] md:min-w-[48%] aspect-[21/9] bg-white rounded-3xl overflow-hidden shadow-2xl snap-center relative block group border border-gray-100 hover:scale-[1.02] transition-transform duration-500">
                    <img src="@storageUrl($ad->banner_image)" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s]">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/20 to-transparent p-10 flex flex-col justify-end">
                        <div class="transform group-hover:-translate-y-2 transition-transform">
                            <h2 class="text-2xl md:text-3xl font-black text-white italic uppercase tracking-tighter leading-tight mb-4">{{ $ad->title }}</h2>
                            <span class="inline-flex items-center gap-2 bg-green-600 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-green-600/30">Claim Now</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- 4. PROFESSIONAL FLASH GRID --}}
        @if(isset($placements['off_grid']))
        <div class="mb-20">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-baseline gap-4">
                    <h3 class="text-3xl md:text-4xl font-black text-gray-900 italic tracking-tighter uppercase">Flash Frenzy</h3>
                    <div class="w-2 h-2 rounded-full bg-red-600 animate-ping"></div>
                </div>
                <div class="h-px flex-1 bg-gray-200 mx-10 hidden md:block opacity-50"></div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] hidden md:block">Updated Live</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach($placements['off_grid']->ads as $ad)
                <a href="{{ route('offers.click', $ad) }}" class="bg-white p-4 rounded-2xl shadow-sm hover:shadow-2xl transition-all group border border-gray-100 flex flex-col">
                    <div class="aspect-square rounded-xl overflow-hidden mb-6 relative bg-gray-50 p-6 flex items-center justify-center">
                        <img src="@storageUrl($ad->banner_image)" class="w-full h-full object-contain group-hover:rotate-6 group-hover:scale-110 transition-all duration-500">
                        <div class="absolute top-4 left-4 bg-red-600 text-white text-[8px] font-black px-3 py-1 rounded shadow-lg shadow-red-600/20 uppercase tracking-tighter">
                            Top Deal
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <h4 class="text-sm font-black text-gray-800 line-clamp-2 uppercase tracking-tighter leading-tight mb-6 h-10">{{ $ad->title }}</h4>
                        <div class="w-full py-3 bg-gray-900 text-white text-[9px] font-black rounded-lg group-hover:bg-green-600 transition-colors text-center uppercase tracking-widest">
                            Shop Offer
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- 5. SLIM HIGH-FIDELITY BANNERS --}}
        @if(isset($placements['off_slim']))
        <div class="grid md:grid-cols-2 gap-8 mb-20">
            @foreach($placements['off_slim']->ads as $ad)
            <a href="{{ route('offers.click', $ad) }}" class="group relative h-64 rounded-3xl overflow-hidden shadow-2xl border border-gray-100">
                <img src="@storageUrl($ad->banner_image)" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[3s]">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/10 to-transparent p-12 flex flex-col justify-center">
                    <span class="text-green-500 text-[10px] font-black uppercase tracking-[0.4em] mb-4">Spotlight</span>
                    <h4 class="text-3xl font-black text-white italic uppercase tracking-tighter leading-none mb-6 max-w-xs">{{ $ad->title }}</h4>
                    <div class="mt-4 flex items-center gap-3 bg-white/10 backdrop-blur-md w-fit px-8 py-3 rounded-full border border-white/20 text-white text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-gray-900 transition-all">
                        Explore <i class="fa fa-arrow-right"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        {{-- 6. PARTNER CODES (MODERN PARTNER GRID) --}}
        @if(isset($placements['off_bank']))
        <div class="bg-white rounded-3xl p-10 md:p-16 shadow-2xl border border-gray-100 relative overflow-hidden mb-24">
            <div class="absolute top-0 right-0 p-10 text-gray-50 text-9xl -mr-16 -mt-16 pointer-events-none">
                <i class="bi bi-wallet2"></i>
            </div>
            
            <div class="relative z-10 mb-16 flex flex-col items-center text-center max-w-xl mx-auto">
                <span class="text-green-600 text-[10px] font-black uppercase tracking-[0.4em] mb-4">Limited Availability</span>
                <h3 class="text-4xl font-black text-gray-900 italic tracking-tighter uppercase mb-2">Partner <span class="text-green-600">Rewards</span></h3>
                <div class="w-12 h-1 bg-green-600 rounded-full mt-4"></div>
            </div>
            
            <div class="grid lg:grid-cols-3 gap-10 relative z-10">
                @foreach($placements['off_bank']->ads as $ad)
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:border-green-500 hover:bg-white transition-all group shadow-sm flex flex-col h-full">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-md flex items-center justify-center text-2xl text-green-600 group-hover:scale-110 transition-transform">
                            <i class="bi bi-bank"></i>
                        </div>
                        <h6 class="text-lg font-black text-gray-800 italic uppercase leading-none">{{ $ad->title }}</h6>
                    </div>
                    
                    <p class="text-xs font-medium text-gray-400 mb-10 leading-relaxed flex-1 italic">Combinable with regular discounts and free delivery codes.</p>
                    
                    <div class="flex items-center bg-white rounded-xl overflow-hidden shadow-inner border border-gray-200">
                        <div class="flex-1 px-6 py-4 font-mono text-[10px] md:text-xs font-black text-gray-900 tracking-widest uppercase truncate">SPEED2026</div>
                        <button class="bg-green-600 text-white px-8 py-4 text-[10px] font-black uppercase tracking-widest hover:bg-gray-900 transition-all shadow-xl">Copy Code</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<script>
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