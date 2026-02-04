@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Product Inventory') }}
            </h2>
            <p class="text-sm text-gray-500">Manage your store products, stock levels, and pricing.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="w-full md:w-auto inline-flex items-center justify-center px-5 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition duration-150 shadow-lg shadow-indigo-100">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            {{ __('Add New Product') }}
        </a>
    </div>

    @if(session('status'))
        <div class="mb-6 p-4 bg-green-50 border-s-4 border-green-500 rounded-xl flex items-center shadow-sm animate-fade-in-down">
            <svg class="w-5 h-5 text-green-500 me-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="text-sm font-medium text-green-800">{{ session('status') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Image') }}</th> 
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Product') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Details') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Price & Stock') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $product->id }}</td>
                            <td class="px-6 py-4">
                                <div class="h-12 w-12 overflow-hidden rounded-lg border border-gray-100 bg-gray-50">
                                    @if($product->images->first())
                                        <img src="{{ asset('storage/' . $product->images->first()->path) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-[8px] text-gray-400">NO IMG</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800 text-sm">{{ $product->name }}</div>
                                <div class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $product->sku }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-xs text-gray-700 font-medium">{{ optional($product->category)->name }}</span>
                                <span class="text-[10px] text-gray-400">{{ optional($product->brand)->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">${{ number_format($product->price, 2) }}</div>
                                <div class="text-xs {{ $product->stock_quantity <= 5 ? 'text-red-500 font-bold' : 'text-gray-500' }}">
                                    Stock: {{ $product->stock_quantity }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusStyle = match($product->status) {
                                        'active' => 'bg-green-100 text-green-700',
                                        'inactive' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $statusStyle }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete product?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-6 py-12 text-center text-gray-400 italic">No products found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-gray-100">
            @forelse ($products as $product)
                <div class="p-4 flex flex-col gap-3">
                    <div class="flex items-start gap-4">
                        <div class="h-20 w-20 flex-shrink-0 rounded-xl border border-gray-100 bg-gray-50 overflow-hidden">
                            @if($product->images->first())
                                <img src="{{ asset('storage/' . $product->images->first()->path) }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full w-full items-center justify-center text-[10px] text-gray-400">NO IMAGE</div>
                            @endif
                        </div>

                        <div class="flex-grow min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-gray-900 text-sm truncate leading-tight">{{ $product->name }}</h3>
                                <span class="ml-2 flex-shrink-0 inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold {{ $product->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-0.5 font-mono">{{ $product->sku }}</p>
                            
                            <div class="mt-2 flex items-baseline gap-2">
                                <span class="text-base font-extrabold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                                @if($product->stock_quantity <= 5)
                                    <span class="text-[10px] font-bold text-red-600 uppercase">⚠️ {{ $product->stock_quantity }} Left</span>
                                @else
                                    <span class="text-[10px] font-medium text-gray-500">In Stock: {{ $product->stock_quantity }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                        <div class="text-[10px] text-gray-500">
                            <span class="font-semibold">{{ optional($product->category)->name }}</span> • {{ optional($product->brand)->name }}
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="flex items-center gap-1 px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-bold transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"></path></svg>
                                    Del
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-gray-400 text-sm italic">No products found in inventory.</div>
            @endforelse
        </div>

        @if($products->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out forwards; }
</style>
@endsection