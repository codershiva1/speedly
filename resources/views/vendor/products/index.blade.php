<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <a href="{{ route('vendor.products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    {{ __('Add Product') }}
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold">#</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Name') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Category') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Brand') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Price') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Stock') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Status') }}
                                </th>
                                <th class="px-3 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($products as $product)
                                <tr>
                                    <td class="px-3 py-2">{{ $product->id }}</td>
                                    <td class="px-3 py-2">{{ $product->name }}</td>
                                    <td class="px-3 py-2">{{ optional($product->category)->name }}</td>
                                    <td class="px-3 py-2">{{ optional($product->brand)->name }}</td>
                                    <td class="px-3 py-2">{{ $product->price }}</td>
                                    <td class="px-3 py-2">{{ $product->stock_quantity }}</td>
                                    <td class="px-3 py-2">{{ ucfirst($product->status) }}</td>
                                    <td class="px-3 py-2 text-right space-x-2">
                                        <a href="{{ route('vendor.products.edit', $product) }}" class="text-indigo-600 hover:underline text-xs">{{ __('Edit') }}</a>
                                        <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-xs" onclick="return confirm('Delete this product?')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-3 py-4 text-center text-gray-500">{{ __('No products found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
