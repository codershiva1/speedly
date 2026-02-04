@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Promotional Coupons</h2>
            <p class="text-xs text-gray-500 mt-1">Manage discounts and seasonal offers.</p>
        </div>
        <a href="{{ route('admin.coupons.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            CREATE COUPON
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($coupons as $coupon)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition group">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-100">
                            <span class="text-indigo-700 font-black font-mono text-sm tracking-wider uppercase">{{ $coupon->code }}</span>
                        </div>
                        <form action="{{ route('admin.coupons.toggle', $coupon) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-11 h-6 {{ $coupon->is_active ? 'bg-green-500' : 'bg-gray-200' }} rounded-full relative transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="absolute top-1 {{ $coupon->is_active ? 'right-1' : 'left-1' }} w-4 h-4 bg-white rounded-full shadow-sm transition-all duration-200"></span>
                            </button>
                        </form>
                    </div>

                    <div class="space-y-1 mb-4">
                        <h3 class="text-xl font-black text-gray-800">
                            @if($coupon->type == 'percent')
                                {{ (int)$coupon->value }}% OFF
                            @else
                                ₹{{ number_format($coupon->value, 0) }} OFF
                            @endif
                        </h3>
                        <div class="flex items-center text-[11px] text-gray-500">
                            <span class="bg-gray-100 px-1.5 py-0.5 rounded mr-1">MIN</span>
                            Min. Purchase: <span class="font-bold text-gray-700 ml-1">₹{{ number_format($coupon->min_cart_value, 0) }}</span>
                        </div>
                    </div>

                    @if($coupon->max_uses)
                        <div class="mb-4 bg-gray-50 p-3 rounded-xl">
                            <div class="flex justify-between text-[10px] font-bold text-gray-400 mb-1.5 uppercase">
                                <span>Redeemed</span>
                                <span>{{ $coupon->used_count }} / {{ $coupon->max_uses }}</span>
                            </div>
                            <div class="h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 rounded-full transition-all duration-500" style="width: {{ min(($coupon->used_count / $coupon->max_uses) * 100, 100) }}%"></div>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50 mt-4">
                        <div class="flex flex-col">
                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">Validity</span>
                            <span class="text-[10px] {{ $coupon->expires_at && $coupon->expires_at->isPast() ? 'text-red-500' : 'text-gray-700' }} font-bold flex items-center">
                                <svg class="w-3 h-3 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                {{ $coupon->expires_at ? $coupon->expires_at->format('d M, Y') : 'Lifetime' }}
                            </span>
                        </div>
                        
                        <div class="flex gap-1.5">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="p-2.5 bg-gray-50 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </a>
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Delete coupon?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2.5 bg-gray-50 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border-2 border-dashed border-gray-100 shadow-sm">
                <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
                <h3 class="text-gray-800 font-bold">No coupons found</h3>
                <p class="text-gray-400 text-sm mt-1 mb-6">Create your first discount coupon to boost sales.</p>
                <a href="{{ route('admin.coupons.create') }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white rounded-lg font-bold text-xs">
                    ADD NOW
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection