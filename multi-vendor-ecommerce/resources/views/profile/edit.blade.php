@php
    $isCustomer = auth()->user()->role === 'customer';
@endphp

@if ($isCustomer)

    {{-- ========== CUSTOMER (SITE LAYOUT) ========== --}}
    <x-layouts.site :title="__('Profile').' | '.config('app.name')">


    

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

           <section class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

            <!-- HEADER -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    Customer Profile
                </h2>
                <p class="text-sm text-gray-500">
                    View and manage your personal information & address
                </p>
            </div>

            <!-- BASIC DETAILS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <div class="bg-gray-50 rounded-xl p-6 space-y-3 text-sm">
                    <h3 class="font-semibold text-gray-700">👤 Basic Info</h3>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Name</span>
                        <span class="font-medium">{{ $user->name }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Email</span>
                        <span class="font-medium">{{ $user->email }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Phone</span>
                        <span class="font-medium">{{ $user->phone ?? 'Not added' }}</span>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 space-y-3 text-sm">
                    <h3 class="font-semibold text-gray-700">📄 Account Info</h3>

                    <div class="flex justify-between">
                        <span class="text-gray-500">User ID</span>
                        <span class="font-medium">#{{ $user->id }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Joined</span>
                        <span class="font-medium">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- ADDRESS SECTION -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    📍 Address Details
                </h3>

                @if($user->address)
                    <!-- SHOW ADDRESS -->
                    <div class="mb-4 text-sm text-gray-700 leading-relaxed">
                        {{ $user->address }}
                    </div>

                    <button
                        onclick="document.getElementById('addressForm').classList.toggle('hidden')"
                        class="text-indigo-600 text-sm font-medium underline">
                        ✏️ Edit Address
                    </button>
                @endif

                <!-- ADD / EDIT ADDRESS FORM -->
                @foreach($addresses as $address)
            <div class="border p-4 rounded-xl mb-3">

                <div class="flex justify-between">
                    <strong>{{ $address->label }}</strong>
                    @if($address->is_default)
                        <span class="text-green-600 text-xs font-medium">Default</span>
                    @endif
                </div>

                <p class="text-sm mt-1">
                    {{ $address->name }} ({{ $address->phone }}) <br>
                    {{ $address->address_line1 }},
                    {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}
                </p>

                <!-- EDIT BUTTON -->
                <button onclick="document.getElementById('editForm{{ $address->id }}').classList.toggle('hidden')"
                    class="text-indigo-600 text-sm underline mt-2">
                    ✏️ Edit Address
                </button>

                <!-- EDIT FORM -->
                <form id="editForm{{ $address->id }}" 
                    method="POST" 
                    action="{{ route('profile.address.update', $address->id) }}" 
                    class="hidden mt-3 space-y-3">
                    @csrf
                    @method('PUT')

                    <input type="text" name="label" value="{{ $address->label }}" class="w-full rounded-xl" required>
                    <input type="text" name="name" value="{{ $address->name }}" class="w-full rounded-xl" required>
                    <input type="text" name="phone" value="{{ $address->phone }}" class="w-full rounded-xl" required>
                    <input type="text" name="address_line1" value="{{ $address->address_line1 }}" class="w-full rounded-xl" required>
                    <input type="text" name="address_line2" value="{{ $address->address_line2 }}" class="w-full rounded-xl">
                    <input type="text" name="city" value="{{ $address->city }}" class="w-full rounded-xl" required>
                    <input type="text" name="state" value="{{ $address->state }}" class="w-full rounded-xl" required>
                    <input type="text" name="postal_code" value="{{ $address->postal_code }}" class="w-full rounded-xl" required>

                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl">💾 Update Address</button>
                </form>

            </div>
            @endforeach

            @if($addresses->isEmpty())
            <div class="bg-indigo-50 p-6 rounded-xl">
                <h3 class="font-semibold mb-3">➕ Add New Address</h3>

                <form method="POST" action="{{ route('profile.address.store') }}" class="space-y-3">
                    @csrf
                    <input type="text" name="label" placeholder="Home / Office" class="w-full rounded-xl" required>
                    <input type="text" name="name" placeholder="Receiver Name" class="w-full rounded-xl" required>
                    <input type="text" name="phone" placeholder="Phone" class="w-full rounded-xl" required>
                    <input type="text" name="address_line1" placeholder="Address Line 1" class="w-full rounded-xl" required>
                    <input type="text" name="address_line2" placeholder="Address Line 2" class="w-full rounded-xl">
                    <input type="text" name="city" placeholder="City" class="w-full rounded-xl" required>
                    <input type="text" name="state" placeholder="State" class="w-full rounded-xl" required>
                    <input type="text" name="postal_code" placeholder="Postal Code" class="w-full rounded-xl" required>

                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl">💾 Add Address</button>
                </form>
            </div>
            @endif
            </div>

        </section>


                

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>

    </x-layouts.site>

@else

    {{-- ========== ADMIN / VENDOR (APP LAYOUT) ========== --}}
    <x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>

    </x-app-layout>

@endif
