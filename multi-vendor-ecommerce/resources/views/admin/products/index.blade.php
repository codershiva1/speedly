@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Product Inventory') }}
            </h2>
            <p class="text-sm text-gray-500">Manage your store products, stock levels, and pricing.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 transition ease-in-out duration-150 shadow-lg shadow-indigo-100">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            {{ __('Add New Product') }}
        </a>
    </div>

    @if(session('status'))
        <div class="mb-6 p-4 bg-green-50 border-s-4 border-green-500 rounded-xl flex items-center shadow-sm">
            <svg class="w-5 h-5 text-green-500 me-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="text-sm font-medium text-green-800">{{ session('status') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Image') }}</th> 
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Product') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Category & Brand') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Price') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Stock') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $product->id }}</td>
                            <td class="px-6 py-4">
                                <div class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg border border-gray-100 bg-gray-50">
                                    @if($product->images->first())
                                        <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                                            alt="{{ $product->name }}" 
                                            class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-[10px] text-gray-400">
                                            No Image
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800 text-sm">{{ $product->name }}</div>
                                <div class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $product->sku }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-sm text-gray-700 font-medium">{{ optional($product->category)->name ?? 'Uncategorized' }}</span>
                                <span class="text-xs text-gray-400">{{ optional($product->brand)->name ?? 'No Brand' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                @if($product->discount_price)
                                    <div class="text-[10px] text-red-400 line-through">${{ number_format($product->discount_price, 2) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($product->stock_quantity <= 5)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        {{ $product->stock_quantity }} Low
                                    </span>
                                @else
                                    <span class="text-sm text-gray-600">{{ $product->stock_quantity }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = [
                                        'active' => 'bg-green-100 text-green-700',
                                        'draft' => 'bg-gray-100 text-gray-600',
                                        'inactive' => 'bg-red-100 text-red-700'
                                    ][$product->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $statusColor }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Permanent delete this product?')" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="text-gray-500 font-medium">No products found in your inventory.</p>
                                    <a href="{{ route('admin.products.create') }}" class="text-indigo-600 text-sm hover:underline mt-2">Create your first product</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection