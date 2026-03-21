<x-delivery-layout>
    <x-slot name="header">
        Order Details #{{ $order->order_number }}
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Order details & Status -->
        <div class="col-span-1 lg:col-span-2 space-y-6">
            <!-- Map Placeholder -->
            <div class="bg-gray-200 rounded-xl overflow-hidden h-72 border border-gray-300 relative group">
                @if($order->latitude && $order->longitude)
                    <iframe 
                        id="order-map"
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}&hl=en&z=15&amp;output=embed">
                    </iframe>
                @else
                    <iframe 
                        id="order-map"
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?width=100%25&amp;height=100%25&amp;hl=en&amp;q={{ urlencode($order->shipping_address_line1 . ',' . $order->shipping_city) }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    </iframe>
                @endif
                
                <!-- Recenter on Me -->
                <button onclick="recenterMap()" class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur shadow-md rounded-lg text-indigo-600 hover:bg-white transition z-10" title="Recenter on My Location">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </button>

                <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md p-4 rounded-xl shadow-xl flex justify-between items-center border border-white/20">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Estimated Trip</span>
                        <div class="flex items-center space-x-3">
                            <span id="geo-distance" class="font-black text-gray-800 text-base">Calculating...</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span id="geo-status" class="text-xs font-bold text-gray-400 uppercase italic">Checking Proximity</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button onclick="checkProximity()" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200" title="Refresh Location">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </button>
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($order->shipping_address_line1 . ',' . $order->shipping_city) }}&travelmode=driving" target="_blank" class="bg-indigo-600 text-white font-bold px-4 py-2 rounded-lg shadow-sm hover:bg-indigo-700 transition flex items-center text-xs">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Start Route
                        </a>
                    </div>
                </div>
            </div>

            <!-- Store/Vendor Info (Pickup Point) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Store / Pickup Point</h3>
                    <div class="flex space-x-2">
                        @php $firstItem = $order->items->first(); @endphp
                        @if($firstItem && $firstItem->vendor)
                            <a href="tel:{{ $firstItem->vendor->vendorProfile->phone ?? $firstItem->vendor->mobile }}" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </a>
                        @endif
                        <button class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition" title="Chat with Support">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </button>
                    </div>
                </div>
                @if($firstItem && $firstItem->vendor)
                    <p class="text-gray-900 font-bold">{{ $firstItem->vendor->vendorProfile?->store_name ?? $firstItem->vendor->name }}</p>
                    <p class="text-gray-600 text-sm mt-1">
                        {{ $firstItem->vendor->vendorProfile?->address_line1 ?? '' }}
                        {{ ($firstItem->vendor->vendorProfile?->address_line2 ?? '') ? ', ' . $firstItem->vendor->vendorProfile->address_line2 : '' }}<br>
                        {{ $firstItem->vendor->vendorProfile?->city ?? '' }}, {{ $firstItem->vendor->vendorProfile?->postal_code ?? '' }}
                    </p>
                @else
                    <p class="text-gray-500 italic text-sm">Main Branch / Dark Store</p>
                @endif
            </div>

            <!-- Customer Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Customer Details</h3>
                    <a href="tel:{{ $order->shipping_phone }}" class="flex items-center text-green-600 hover:text-green-700 bg-green-50 px-3 py-1.5 rounded-lg font-medium transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Call {{ explode(' ', trim($order->shipping_name))[0] }}
                    </a>
                </div>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">Address:</strong> {{ $order->shipping_address_line1 }}, {{ $order->shipping_address_line2 }}</p>
                <p class="text-gray-600"><strong class="text-gray-800">City/Zip:</strong> {{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                @if($order->notes)
                <div class="mt-4 p-3 bg-yellow-50 text-yellow-800 rounded-lg text-sm border border-yellow-100">
                    <strong>Customer Note:</strong> {{ $order->notes }}
                </div>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="text-lg font-bold text-gray-800">Pickup Checklist</h3>
                    <span class="text-xs font-bold text-gray-400 uppercase">Verify all items</span>
                </div>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="item-{{ $item->id }}" class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <label for="item-{{ $item->id }}" class="font-medium text-gray-800">
                                    <span class="bg-gray-100 text-gray-800 font-bold px-1.5 py-0.5 rounded text-[10px] mr-2">{{ $item->quantity }}x</span>
                                    {{ $item->product_name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Missing Item Button -->
                <button class="w-full mt-4 text-sm text-red-500 font-medium hover:underline flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Report Missing Item
                </button>
            </div>
        </div>

        <!-- Right Column: Actions -->
        <div class="col-span-1 space-y-6">
            <!-- Payment Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Payment Collection</h3>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-600 font-medium">Payment Type</span>
                    <span class="px-2 py-1 bg-{{ $order->payment_method === 'cod' ? 'red' : 'green' }}-100 text-{{ $order->payment_method === 'cod' ? 'red' : 'green' }}-800 font-bold text-xs rounded uppercase">{{ $order->payment_method }}</span>
                </div>
                @if($order->payment_method === 'cod')
                <div class="p-4 bg-orange-50 border border-orange-200 rounded-lg mt-4 text-center">
                    <p class="text-orange-800 text-sm font-bold mb-1">CASH TO COLLECT</p>
                    <p class="text-3xl font-black text-orange-600">₹{{ number_format($order->total_amount, 2) }}</p>
                </div>
                @else
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg mt-4 text-center text-green-800">
                    <span class="font-bold">PRE-PAID</span> • No cash collection required.
                </div>
                @endif
            </div>

            <!-- Status Action Flow -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Delivery Action</h3>
                
                <x-auth-session-status class="mb-4" :status="session('success')" />
                <x-input-error :messages="session('error')" class="mb-4" />

                @if($order->delivery_status === 'assigned')
                    <form action="{{ route('delivery.orders.status', $order) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="picked_up">
                        <p class="text-sm text-gray-600 mb-4 text-center">Arrived at the store? Mark order as picked up.</p>
                        <button type="submit" class="w-full py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg shadow transition">
                            Confirm Pickup
                        </button>
                    </form>
                @elseif($order->delivery_status === 'picked_up')
                    <form action="{{ route('delivery.orders.status', $order) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="out_for_delivery">
                        <p class="text-sm text-gray-600 mb-4 text-center">Ready to navigate to customer?</p>
                        <button type="submit" class="w-full py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-lg shadow transition">
                            Start Delivery
                        </button>
                    </form>
                @elseif($order->delivery_status === 'out_for_delivery')
                    <form action="{{ route('delivery.orders.status', $order) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="delivered">
                        
                        <div class="mb-4 shadow-inner bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Customer OTP <span class="text-red-500">*</span></label>
                                <input type="text" name="otp" required placeholder="Enter 4-digit OTP" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-center text-xl tracking-widest font-mono">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Photo Proof (Optional)</label>
                                <input type="file" name="pod_image" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                            </div>
                        </div>
                        
                        <div id="target-far-warning" class="hidden mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-xs font-bold flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            You must be within 100m of the delivery location to confirm.
                        </div>
                        
                        <button id="btn-delivered" type="submit" disabled class="w-full py-3 bg-gray-400 text-white font-bold rounded-lg shadow transition cursor-not-allowed">
                            Mark as Delivered
                        </button>
                    </form>
                @elseif($order->delivery_status === 'delivered')
                    <div class="p-4 bg-green-100 text-green-800 border border-green-200 rounded-lg text-center font-bold flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Successfully Delivered
                    </div>
                @endif
                
                <!-- Helper link to report issue -->
                <div class="mt-6 text-center">
                    <a href="#" class="text-sm text-red-500 font-medium hover:underline">Report an issue with this delivery</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        const targetLat = {{ $order->latitude ?? '28.6139' }}; // Placeholder or actual
        const targetLng = {{ $order->longitude ?? '77.2090' }};
        const deliveryStatus = "{{ $order->delivery_status }}";

        function checkProximity() {
            if (!navigator.geolocation) {
                console.warn("Geolocation not supported");
                enableDeliveredButton(); // Fallback if no geo support
                return;
            }

            navigator.geolocation.getCurrentPosition((position) => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                const distance = getHaversineDistance(userLat, userLng, targetLat, targetLng);

                const distElement = document.getElementById('geo-distance');
                const statusElement = document.getElementById('geo-status');
                const warningElement = document.getElementById('target-far-warning');
                const btnDelivered = document.getElementById('btn-delivered');

                if (distElement) distElement.textContent = (distance < 1 ? (distance * 1000).toFixed(0) + ' m' : distance.toFixed(2) + ' km');
                
                if (deliveryStatus === 'out_for_delivery') {
                    if (distance <= 0.1) { // 100 meters
                        if (statusElement) statusElement.textContent = "Reached Destination";
                        if (statusElement) statusElement.classList.add('text-green-600');
                        if (warningElement) warningElement.classList.add('hidden');
                        enableDeliveredButton();
                    } else {
                        if (statusElement) statusElement.textContent = "Moving towards target";
                        if (warningElement) warningElement.classList.remove('hidden');
                        disableDeliveredButton();
                    }
                }
            });
        }

        function getHaversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Earth's radius in km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        function enableDeliveredButton() {
            const btn = document.getElementById('btn-delivered');
            if (btn) {
                btn.disabled = false;
                btn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                btn.classList.add('bg-green-500', 'hover:bg-green-600');
            }
        }

        function disableDeliveredButton() {
            const btn = document.getElementById('btn-delivered');
            if (btn) {
                btn.disabled = true;
                btn.classList.add('bg-gray-400', 'cursor-not-allowed');
                btn.classList.remove('bg-green-500', 'hover:bg-green-600');
            }
        }

        function recenterMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const map = document.getElementById('order-map');
                    if (map) {
                        map.src = `https://maps.google.com/maps?q=${lat},${lng}&hl=en&z=15&output=embed`;
                    }
                });
            }
        }

        // Auto check on load if status is out_for_delivery
        if (deliveryStatus === 'out_for_delivery') {
            checkProximity();
            setInterval(checkProximity, 30000); // Re-check every 30s
        } else {
             const distElement = document.getElementById('geo-distance');
             if (distElement) distElement.textContent = "-- km";
        }
    </script>
</x-delivery-layout>
