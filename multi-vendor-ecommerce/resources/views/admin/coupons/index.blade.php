@extends('layouts.admin.app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Coupons</h1>
        <a href="{{ route('admin.coupons.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Add Coupon
        </a>
    </div>

    @if(session('status'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border-b">Code</th>
                    <th class="px-4 py-2 border-b">Type</th>
                    <th class="px-4 py-2 border-b">Value</th>
                    <th class="px-4 py-2 border-b">Expiry</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $coupon->code }}</td>
                        <td class="px-4 py-2">{{ ucfirst($coupon->type) }}</td>
                        <td class="px-4 py-2">
                            @if($coupon->type === 'fixed')
                                ₹{{ number_format($coupon->value, 2) }}
                            @else
                                {{ $coupon->value }}%
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $coupon->expiry_date?->format('d M, Y') ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if($coupon->is_active)
                                <span class="text-green-600 font-semibold">Active</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}"
                               class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('admin.coupons.toggle', $coupon) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                        class="text-orange-600 hover:underline">
                                    {{ $coupon->is_active ? 'Disable' : 'Enable' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                            No coupons found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
