<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Coupon
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
                    @csrf
                    @method('PUT')

                    <!-- Coupon Code -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Coupon Code</label>
                        <input type="text"
                               name="code"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('code', $coupon->code) }}"
                               required>
                    </div>

                    <!-- Discount Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Discount Type</label>
                        <select name="type" class="w-full border rounded px-3 py-2" required>
                            <option value="percent" {{ old('type', $coupon->type) === 'percent' ? 'selected' : '' }}>
                                Percent (%)
                            </option>
                            <option value="fixed" {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}>
                                Fixed Amount
                            </option>
                        </select>
                    </div>

                    <!-- Discount Value -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Discount Value</label>
                        <input type="number"
                               step="0.01"
                               name="value"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('value', $coupon->value) }}"
                               required>
                    </div>

                    <!-- Minimum Cart Value -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Minimum Cart Value
                        </label>
                        <input type="number"
                               step="0.01"
                               name="min_cart_value"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('min_cart_value', $coupon->min_cart_value) }}"
                               required>
                    </div>

                    <!-- Maximum Uses -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Maximum Uses (optional)
                        </label>
                        <input type="number"
                               name="max_uses"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('max_uses', $coupon->max_uses) }}">
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Expiry Date (optional)
                        </label>
                        <input type="date"
                               name="expires_at"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('expires_at', optional($coupon->expires_at)->format('Y-m-d')) }}">
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <input type="hidden" name="is_active" value="0">

                        <label class="inline-flex items-center">
                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}
                                   class="mr-2">
                            Active
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.coupons.index') }}"
                           class="px-4 py-2 border rounded">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded">
                            Update Coupon
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
