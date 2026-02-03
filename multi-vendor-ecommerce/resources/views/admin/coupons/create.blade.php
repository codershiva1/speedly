@extends('layouts.admin.app')

@section('content')
   
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Create New Coupon') }}
            </h2>
            <a href="{{ route('admin.coupons.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
        </div>
   

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.coupons.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-8 shadow-sm border border-gray-100 rounded-3xl">
                            <h3 class="text-lg font-bold text-gray-800 mb-6 border-b border-gray-50 pb-4">Coupon Configuration</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <x-input-label for="code" :value="__('Coupon Code')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="code" name="code" type="text" class="block w-full mt-1 rounded-xl border-gray-200 focus:ring-indigo-500" :value="old('code')" placeholder="SUMMER50" required />
                                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="type" :value="__('Discount Type')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <select name="type" id="type" class="block w-full mt-1 rounded-xl border-gray-200 focus:ring-indigo-500 text-sm">
                                        <option value="percent" @selected(old('type') == 'percent')>Percentage (%)</option>
                                        <option value="fixed" @selected(old('type') == 'fixed')>Fixed Amount (Flat)</option>
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="value" :value="__('Discount Value')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="value" name="value" type="number" step="0.01" class="block w-full mt-1 rounded-xl border-gray-200 focus:ring-indigo-500" :value="old('value')" placeholder="0.00" required />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-8 shadow-sm border border-gray-100 rounded-3xl">
                            <h3 class="text-lg font-bold text-gray-800 mb-6">Usage & Conditions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="min_cart_value" :value="__('Min. Purchase Amount')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="min_cart_value" name="min_cart_value" type="number" step="0.01" class="block w-full mt-1 rounded-xl border-gray-200 focus:ring-indigo-500" :value="old('min_cart_value', 0)" required />
                                </div>
                                <div>
                                    <x-input-label for="max_uses" :value="__('Usage Limit (Total)')" class="text-xs font-bold uppercase text-gray-500 mb-2" />
                                    <x-text-input id="max_uses" name="max_uses" type="number" class="block w-full mt-1 rounded-xl border-gray-200 focus:ring-indigo-500" :value="old('max_uses')" placeholder="e.g. 100" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 shadow-sm border border-gray-100 rounded-3xl">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Publishing</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="expires_at" :value="__('Expiry Date')" class="text-xs font-bold text-gray-500 mb-2" />
                                    <x-text-input id="expires_at" name="expires_at" type="date" class="block w-full rounded-xl border-gray-200 text-sm" :value="old('expires_at')" />
                                </div>

                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <span class="text-sm font-bold text-gray-700">Status</span>
                                    <input type="hidden" name="is_active" value="0">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" @checked(old('is_active', 1))>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition duration-150 uppercase text-xs tracking-widest">
                                    Create Coupon
                                </button>
                            </div>
                        </div>

                        <div class="bg-indigo-50 p-6 rounded-3xl border border-indigo-100">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs text-indigo-700 leading-relaxed">
                                    <strong>Tip:</strong> Keep coupon codes short and memorable. Use "Fixed" for flat discounts like ₹100 and "Percent" for seasonal sales like 20% off.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
   