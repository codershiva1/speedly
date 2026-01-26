@php
    $user = auth()->user();
    $isCustomer = $user->role === 'customer';
@endphp

@if ($isCustomer)

<x-layouts.site :title="__('Profile').' | '.config('app.name')">

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div 
    x-data="{ tab: 'profile' }"
    class="grid grid-cols-1 md:grid-cols-4 gap-6"
>

    <!-- ================= LEFT SIDEBAR ================= -->
    <aside class="bg-white rounded-2xl shadow p-4 space-y-2">

        <button @click="tab='profile'"
            :class="tab==='profile' ? 'bg-indigo-600 text-white' : 'text-gray-700'"
            class="w-full text-left px-4 py-2 rounded-xl">
            👤 Profile
        </button>

          <a href="{{ route('dashboard') }}"><button 
            :class="tab==='dashboard' ? 'bg-indigo-600 text-white' : 'text-gray-700'"
            class="w-full text-left px-4 py-2 rounded-xl">
          
            🏠 Dashboard
        
        </button></a>

         <a href="{{ route('account.orders.index') }}"><button
            :class="tab==='orders' ? 'bg-indigo-600 text-white' : 'text-gray-700'"
            class="w-full text-left px-4 py-2 rounded-xl">
            📦 Orders
        </button></a>

        <button @click="tab='address'"
            :class="tab==='address' ? 'bg-indigo-600 text-white' : 'text-gray-700'"
            class="w-full text-left px-4 py-2 rounded-xl">
            📍 Addresses
        </button>

         <a href="{{ route('wishlist.index') }}"><button
            :class="tab==='wishlist' ? 'bg-indigo-600 text-white' : 'text-gray-700'"
            class="w-full text-left px-4 py-2 rounded-xl">
            ❤️ Wishlist
        </button></a>

       <a href="{{ route('account.cart.index') }}"> <button
            :class="tab==='cart' ? 'bg-indigo-600 text-white' : 'text-gray-700'"
            class="w-full text-left px-4 py-2 rounded-xl">
            
            🛒 Cart
           
        </button> </a>

        <button @click="tab='security'"
            :class="tab==='security' ? 'bg-indigo-600 text-white' : 'text-gray-700'"
            class="w-full text-left px-4 py-2 rounded-xl">
            🔒 Security
        </button>

    </aside>

    <!-- ================= RIGHT CONTENT ================= -->
    <main class="md:col-span-3 bg-white rounded-2xl shadow p-6 space-y-8">

        <!-- ================= PROFILE ================= -->
        <section x-show="tab==='profile'">
            <h2 class="text-xl font-bold mb-4">Profile Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-5 rounded-xl text-sm space-y-2">
                    <div class="flex justify-between">
                        <span>Name</span>
                        <span class="font-medium">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Email</span>
                        <span class="font-medium">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Phone</span>
                        <span class="font-medium">{{ $user->phone ?? 'Not added' }}</span>
                    </div>
                </div>

                <div class="bg-gray-50 p-5 rounded-xl text-sm space-y-2">
                    <div class="flex justify-between">
                        <span>User ID</span>
                        <span>#{{ $user->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Joined</span>
                        <span>{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </section>

        <!-- ================= DASHBOARD ================= -->
        <section x-show="tab==='dashboard'">
            <h2 class="text-2xl font-bold mb-2">Welcome, {{ $user->name }} 👋</h2>
            <p class="text-gray-600">Manage your account & orders</p>
        </section>

        <!-- ================= ORDERS ================= -->
        <section x-show="tab==='orders'">
            <h2 class="text-xl font-bold mb-4">My Orders</h2>

            @forelse($orders ?? [] as $order)
                <div class="border rounded-xl p-4 mb-3">
                    <strong>Order #{{ $order->id }}</strong><br>
                    Amount: ₹{{ $order->total }}
                </div>
            @empty
                <p>No orders found.</p>
            @endforelse
        </section>

        <!-- ================= ADDRESSES ================= -->
        <section x-show="tab==='address'" class="space-y-6">
            <h2 class="text-xl font-bold">My Addresses</h2>

            @forelse($addresses as $address)
                <div class="border rounded-xl p-4">
                    <strong>{{ $address->label }}</strong>
                    <p class="text-sm mt-1">
                        {{ $address->name }} ({{ $address->phone }})<br>
                        {{ $address->address_line1 }},
                        {{ $address->city }},
                        {{ $address->state }} - {{ $address->postal_code }}
                    </p>
                </div>
            @empty
                <p>No address added yet.</p>
            @endforelse

            <!-- ADD NEW ADDRESS -->
            <div class="border-t pt-6">
                <h3 class="font-semibold mb-3">➕ Add New Address</h3>

                <form method="POST"
                      action="{{ route('profile.address.store') }}"
                      class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <input name="label" placeholder="Home / Office" required class="rounded-xl border-gray-300">
                    <input name="name" placeholder="Receiver Name" required class="rounded-xl border-gray-300">
                    <input name="phone" placeholder="Phone" required class="rounded-xl border-gray-300">
                    <input name="address_line1" placeholder="Address Line 1" required class="rounded-xl border-gray-300 md:col-span-2">
                    <input name="address_line2" placeholder="Address Line 2" class="rounded-xl border-gray-300 md:col-span-2">
                    <input name="city" placeholder="City" required class="rounded-xl border-gray-300">
                    <input name="state" placeholder="State" required class="rounded-xl border-gray-300">
                    <input name="postal_code" placeholder="Postal Code" required class="rounded-xl border-gray-300">

                    <button class="md:col-span-2 bg-indigo-600 text-white py-2 rounded-xl">
                        💾 Save Address
                    </button>
                </form>
            </div>
        </section>

        <!-- ================= WISHLIST ================= -->
        <section x-show="tab==='wishlist'">
            <h2 class="text-xl font-bold">Wishlist</h2>
            <p>Wishlist items will appear here</p>
        </section>

        <!-- ================= CART ================= -->
        <section x-show="tab==='cart'">
            <h2 class="text-xl font-bold">Cart</h2>
            <p>Cart items will appear here</p>
        </section>

        <!-- ================= SECURITY ================= -->
        <section x-show="tab==='security'" class="space-y-6">
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </section>

    </main>

</div>
</div>
</div>

</x-layouts.site>

@else

<x-layouts.site :title="__('Profile').' | '.config('app.name')">
    <div class="py-12 max-w-7xl mx-auto space-y-6">
        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>
</x-layouts.site>

@endif
