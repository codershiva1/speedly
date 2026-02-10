<x-layouts.site title="Exclusive Offers | Speedly">
<div class="bg-gray-50 min-h-screen pb-24">
    
    {{-- TOP BRANDED HEADER --}}
    <div class="bg-[#1aab4b] pt-12 pb-24 px-6 rounded-b-[4rem] shadow-xl relative overflow-hidden">
        <div class="max-w-6xl mx-auto relative z-10 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-black text-white italic tracking-tighter">OFFERS <span class="text-green-200">HUB</span></h1>
                <p class="text-green-50 mt-1 font-bold text-xs uppercase tracking-widest opacity-80">Premium Savings for Speedly Members</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/20 backdrop-blur-md p-4 rounded-3xl border border-white/30 text-white">
                    <p class="text-[10px] font-black uppercase">Your Savings Today</p>
                    <p class="text-2xl font-black">₹1,250+</p>
                </div>
            </div>
        </div>
        {{-- Abstract background shapes --}}
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-green-500 rounded-full blur-3xl opacity-30"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 -mt-16">

        {{-- 1. MAIN HERO SLIDER --}}
        @if(isset($placements['off_hero']))
        <div class="flex gap-4 overflow-x-auto no-scrollbar snap-x snap-mandatory mb-12">
            @foreach($placements['off_hero']->ads as $ad)
            <a href="{{ route('offers.click', $ad) }}" class="min-w-[85%] md:min-w-[45%] aspect-[21/10] bg-white rounded-[2.5rem] overflow-hidden shadow-2xl snap-center relative block group">
                <img src="{{ asset('storage/'.$ad->banner_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent p-8 flex flex-col justify-end">
                    <span class="bg-yellow-400 text-black text-[10px] font-extrabold px-3 py-1 rounded-full w-fit mb-3">MEGA DEAL</span>
                    <h2 class="text-2xl font-black text-white italic leading-tight uppercase">{{ $ad->title }}</h2>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        {{-- 2. DAILY FLASH DEALS (Grid) --}}
        @if(isset($placements['off_grid']))
        <div class="mb-12">
            <div class="flex justify-between items-end mb-6 px-2">
                <div>
                    <h3 class="text-2xl font-black text-gray-900 italic">Daily <span class="text-green-600">Flash Sales</span></h3>
                    <p class="text-xs text-gray-400 font-bold uppercase">Refreshes every 24 hours</p>
                </div>
                <div class="bg-red-50 text-red-600 px-4 py-1 rounded-full text-[10px] font-black border border-red-100 animate-pulse">
                    LIVE NOW
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($placements['off_grid']->ads as $ad)
                <a href="{{ route('offers.click', $ad) }}" class="bg-white p-2 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-green-200 transition-all group">
                    <div class="aspect-square rounded-[1.5rem] overflow-hidden mb-3 relative">
                        <img src="{{ asset('storage/'.$ad->banner_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all">
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-[9px] font-black text-green-600 shadow-sm">
                            HOT
                        </div>
                    </div>
                    <div class="px-1">
                        <h4 class="text-[11px] font-black text-gray-800 line-clamp-1 uppercase tracking-tighter">{{ $ad->title }}</h4>
                        <div class="mt-2 py-1.5 text-center bg-green-50 text-green-600 text-[9px] font-black rounded-xl group-hover:bg-green-600 group-hover:text-white transition-colors">
                            VIEW DEAL
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- 3. BANK & PAYMENT OFFERS --}}
        @if(isset($placements['off_bank']))
        <div class="grid md:grid-cols-2 gap-4">
            @foreach($placements['off_bank']->ads as $ad)
            <div class="bg-white rounded-3xl p-6 border-2 border-dashed border-green-200 flex items-center justify-between group">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 bg-green-600 rounded-2xl flex items-center justify-center text-white text-3xl shadow-lg shadow-green-100">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-gray-900 italic leading-none">{{ $ad->title }}</h4>
                        <p class="text-[10px] text-gray-400 font-bold uppercase mt-2 tracking-widest">Auto-applied at checkout</p>
                    </div>
                </div>
                <button class="bg-gray-100 text-gray-400 px-4 py-2 rounded-xl text-[10px] font-black cursor-not-allowed">NO CODE REQ</button>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
</x-layouts.site>