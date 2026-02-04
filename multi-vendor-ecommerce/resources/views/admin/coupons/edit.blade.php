@extends('layouts.admin.app')

@section('content')
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Coupon:') }} <span class="text-indigo-600">{{ $coupon->code }}</span>
            </h2>
            <a href="{{ route('admin.coupons.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to List
            </a>
        </div>


    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white  shadow-sm border border-gray-100 rounded-3xl">
                            <h3 class="text-lg font-bold text-gray-800 mb-6 border-b border-gray-50 pb-4">General Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <x-input-label for="code" :value="__('Coupon Code')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="code" name="code" type="text" class="block w-full mt-1 rounded-xl border-gray-200" :value="old('code', $coupon->code)" required />
                                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="type" :value="__('Discount Type')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <select name="type" id="type" class="block w-full mt-1 rounded-xl border-gray-200 text-sm">
                                        <option value="percent" @selected(old('type', $coupon->type) == 'percent')>Percentage (%)</option>
                                        <option value="fixed" @selected(old('type', $coupon->type) == 'fixed')>Fixed Amount (Flat)</option>
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="value" :value="__('Discount Value')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="value" name="value" type="number" step="0.01" class="block w-full mt-1 rounded-xl border-gray-200" :value="old('value', $coupon->value)" required />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white  shadow-sm border border-gray-100 rounded-3xl">
                            <h3 class="text-lg font-bold text-gray-800 mb-6 uppercase text-xs tracking-widest text-gray-400">Rules & Limits</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="min_cart_value" :value="__('Min. Purchase Required')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="min_cart_value" name="min_cart_value" type="number" step="0.01" class="block w-full mt-1 rounded-xl border-gray-200" :value="old('min_cart_value', $coupon->min_cart_value)" required />
                                </div>
                                <div>
                                    <x-input-label for="max_uses" :value="__('Total Usage Limit')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="max_uses" name="max_uses" type="number" class="block w-full mt-1 rounded-xl border-gray-200" :value="old('max_uses', $coupon->max_uses)" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 shadow-sm border border-gray-100 rounded-3xl">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Availability</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="expires_at" :value="__('Expiry Date')" class="text-xs font-bold text-gray-500 mb-2" />
                                    <x-text-input id="expires_at" name="expires_at" type="date" class="block w-full rounded-xl border-gray-200 text-sm" :value="old('expires_at', optional($coupon->expires_at)->format('Y-m-d'))" />
                                </div>

                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                    <span class="text-sm font-bold text-gray-700">Active Status</span>
                                    <input type="hidden" name="is_active" value="0">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" @checked(old('is_active', $coupon->is_active))>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="mt-8 space-y-3">
                                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition duration-150 uppercase text-xs tracking-widest">
                                    Update Changes
                                </button>
                                <a href="{{ route('admin.coupons.index') }}" class="block w-full text-center text-gray-400 hover:text-gray-600 font-bold py-2 text-xs uppercase tracking-widest transition">
                                    Discard Changes
                                </a>
                            </div>
                        </div>

                        <div class="bg-indigo-600 p-6 rounded-3xl text-white">
                            <h4 class="text-[10px] uppercase tracking-widest opacity-50 font-bold mb-4">Coupon Performance</h4>
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-3xl font-black">{{ $coupon->used_count ?? 0 }}</p>
                                    <p class="text-[10px] opacity-70 uppercase font-bold">Times Used</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold">
                                        @if($coupon->max_uses)
                                            {{ round(($coupon->used_count / $coupon->max_uses) * 100) }}%
                                        @else
                                            &infin;
                                        @endif
                                    </p>
                                    <p class="text-[10px] opacity-70 uppercase font-bold">Quota Filled</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection