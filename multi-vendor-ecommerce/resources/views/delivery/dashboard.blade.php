<x-delivery-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Duty Management -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center space-x-4">
            <div class="relative w-12 h-12">
                @if(auth()->user()->image_url)
                    <img src="@storageUrl(auth()->user()->image_url)" class="w-full h-full rounded-full object-cover border-2 border-white shadow-sm" alt="Profile">
                @else
                    <div class="w-full h-full rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-xl border-2 border-white shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="absolute bottom-0 right-0 w-4 h-4 rounded-full border-2 border-white {{ auth()->user()->deliveryBoyProfile->is_online ? 'bg-green-500' : 'bg-gray-400' }}"></div>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Hello, {{ auth()->user()->name }}!</h2>
                <p class="text-sm text-gray-500 font-medium">
                    Status: 
                    @if(!auth()->user()->deliveryBoyProfile->is_on_shift)
                        <span class="text-gray-400">Off-Duty</span>
                    @elseif(auth()->user()->deliveryBoyProfile->is_on_break)
                        <span class="text-orange-500 font-bold">On Break</span>
                    @else
                        <span class="text-green-600 font-bold">On-Duty & Active</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <!-- Break Toggle (Only visible if on shift) -->
            <div id="break-toggle-container" class="{{ auth()->user()->deliveryBoyProfile->is_on_shift ? 'block' : 'hidden' }}">
                <button onclick="toggleBreak()" id="btn-break" class="px-6 py-2.5 rounded-xl font-bold transition-all flex items-center shadow-sm {{ auth()->user()->deliveryBoyProfile->is_on_break ? 'bg-orange-100 text-orange-700 border border-orange-200' : 'bg-gray-100 text-gray-700 border border-gray-200' }}">
                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                   {{ auth()->user()->deliveryBoyProfile->is_on_break ? 'End Break' : 'Take a Break' }}
                </button>
            </div>

            <!-- Shift Toggle -->
            <button onclick="toggleShift()" id="btn-shift" class="px-8 py-2.5 rounded-xl font-bold transition-all text-white shadow-md flex items-center {{ auth()->user()->deliveryBoyProfile->is_on_shift ? 'bg-red-500 hover:bg-red-600' : 'bg-green-600 hover:bg-green-700' }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                {{ auth()->user()->deliveryBoyProfile->is_on_shift ? 'End Shift' : 'Start Shift' }}
            </button>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Earnings -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Today's Earnings</p>
                <h3 class="text-2xl font-bold text-gray-900">₹ {{ number_format($todayEarnings, 2) }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Active Orders -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Active Orders</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $activeOrdersCount }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>

        <!-- Delivery Time -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Avg Delivery Time</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $avgDeliveryTime > 0 ? $avgDeliveryTime . ' Mins' : '--' }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Rating -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Your Rating</p>
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    {{ number_format($rating, 1) }} 
                    <svg class="w-5 h-5 text-yellow-400 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </h3>
            </div>
            <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
        </div>

        <!-- COD Collection -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Today's COD</p>
                <h3 class="text-2xl font-bold text-orange-600">₹ {{ number_format($todayCodCollected, 2) }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 012 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Safety & Alerts -->
    <div class="mb-8 grid grid-cols-1 gap-6">
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <div class="p-2 bg-red-600 text-white rounded-lg animate-pulse">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h4 class="text-red-800 font-bold">Emergency SOS</h4>
                    <p class="text-red-600 text-xs">Instantly notify support and share your location in case of emergency.</p>
                </div>
            </div>
            <button onclick="openSosModal()" class="w-full md:w-auto px-6 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition shadow-lg active:transform active:scale-95">
                ACTIVATE SOS
            </button>
        </div>
    </div>

    <!-- SOS Modal -->
    <div id="sos-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeSosModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border-t-8 border-red-600">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 text-red-600 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-black text-gray-900 uppercase tracking-tight" id="modal-title">Emergency Alert</h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <p class="mb-4">Please specify the type of emergency. Help will be notified immediately.</p>
                                
                                <form id="sos-form" class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Incident Type</label>
                                        <select name="type" required class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500">
                                            <option value="breakdown">Vehicle Breakdown</option>
                                            <option value="accident">Accident</option>
                                            <option value="medical">Medical Emergency</option>
                                            <option value="other">Other / Support Needed</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Additional Notes</label>
                                        <textarea name="notes" rows="3" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500" placeholder="Briefly describe the situation..."></textarea>
                                    </div>
                                    <div id="sos-error" class="hidden text-red-500 text-xs font-bold"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="button" onclick="submitSos()" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-2 bg-red-600 text-base font-bold text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-all active:scale-95">
                        SEND ALERT
                    </button>
                    <button type="button" onclick="closeSosModal()" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all">
                        CANCEL
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Productivity Analytics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-xl shadow-md p-6 text-white">
            <p class="text-green-100 text-sm font-medium mb-1">Acceptance Rate</p>
            <h3 class="text-3xl font-bold">{{ $acceptanceRate }}%</h3>
            <div class="mt-4 w-full bg-green-800 bg-opacity-30 rounded-full h-2">
                <div class="bg-white h-2 rounded-full" style="width: {{ $acceptanceRate }}%"></div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm font-medium text-gray-500">Orders Per Hour</p>
                <span class="text-green-600 bg-green-50 px-2 py-0.5 rounded text-xs font-bold">Live</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $ordersPerHour }} <span class="text-sm font-normal text-gray-400">orders/hr</span></h3>
            <p class="text-xs text-gray-400 mt-2">Based on current shift duration</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm font-medium text-gray-500">Idle Time</p>
                <span class="text-gray-400 bg-gray-50 px-2 py-0.5 rounded text-xs font-bold">Today</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">1.2 <span class="text-sm font-normal text-gray-400">hours</span></h3>
            <p class="text-xs text-gray-400 mt-2">Time spent waiting for orders</p>
        </div>
    </div>

    <!-- Daily Target & Training SOP -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Daily Target -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Daily Target</h3>
                <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full">{{ $completedCount }}/{{ $dailyTarget }} Orders</span>
            </div>
            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-[10px] font-black inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">
                            {{ round(($completedCount / $dailyTarget) * 100) }}% Complete
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] font-black inline-block text-indigo-600">
                            ₹{{ number_format(($completedCount / $dailyTarget) * 500, 2) }} / ₹500.00
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-100">
                    <div style="width:{{ min(100, ($completedCount / $dailyTarget) * 100) }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-600 transition-all duration-500"></div>
                </div>
                <p class="text-[10px] text-gray-400 font-medium">Complete {{ $dailyTarget }} orders today to unlock a <strong class="text-gray-600">₹500.00</strong> bonus!</p>
            </div>
        </div>

        <!-- Training SOP Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-2">Rider Training (SOP)</h3>
                <p class="text-xs text-gray-500 mb-4">Learn the best practices for safety and fast deliveries.</p>
            </div>
            <a href="{{ route('delivery.training') }}" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 transition group border border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-800 group-hover:text-indigo-600 uppercase tracking-widest">Open SOP Guide</span>
                </div>
                <svg class="w-4 h-4 text-gray-300 group-hover:text-indigo-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <!-- Active Deliveries Component -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Ongoing Deliveries</h3>
        
        <div class="space-y-4">
            @forelse($ongoingDeliveries as $order)
                <div class="border border-gray-200 rounded-lg p-4 flex flex-col md:flex-row md:items-center justify-between {{ $order->delivery_status === 'out_for_delivery' ? 'bg-blue-50' : 'bg-orange-50' }}">
                    <div class="flex items-start space-x-4 mb-4 md:mb-0">
                        <div class="p-3 rounded-lg {{ $order->delivery_status === 'out_for_delivery' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }}">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <h4 class="font-bold text-gray-900">Order #{{ $order->order_number }}</h4>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $order->delivery_status === 'out_for_delivery' ? 'blue' : 'orange' }}-200 text-{{ $order->delivery_status === 'out_for_delivery' ? 'blue' : 'orange' }}-800">
                                    {{ strtoupper(str_replace('_', ' ', $order->delivery_status)) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $order->shipping_city }} → {{ explode(' ', trim($order->shipping_name))[0] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $order->items->count() }} Items • COD: ₹{{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('delivery.orders.show', $order) }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition cursor-pointer">View Details</a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500 bg-gray-50 rounded-lg">No active deliveries at the moment. Take a break!</div>
            @endforelse
        </div>
    </div>

    <script>
        function toggleShift() {
            const isOnShift = {{ auth()->user()->deliveryBoyProfile->is_on_shift ? 'true' : 'false' }};
            const btn = document.getElementById('btn-shift');
            
            fetch("{{ route('delivery.shift.toggle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ is_on_shift: !isOnShift })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Quickest way to sync all UI states
                }
            });
        }

        function toggleBreak() {
            const isOnBreak = {{ auth()->user()->deliveryBoyProfile->is_on_break ? 'true' : 'false' }};
            
            fetch("{{ route('delivery.shift.break') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ is_on_break: !isOnBreak })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function openSosModal() {
            document.getElementById('sos-modal').classList.remove('hidden');
        }

        function closeSosModal() {
            document.getElementById('sos-modal').classList.add('hidden');
        }

        function submitSos() {
            const form = document.getElementById('sos-form');
            const errorDiv = document.getElementById('sos-error');
            const formData = new FormData(form);
            const data = {
                type: formData.get('type'),
                notes: formData.get('notes'),
                location: null
            };

            // Try to get geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    data.location = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    sendSosRequest(data);
                }, (error) => {
                    console.warn("Geolocation failed, sending SOS without coordinates.");
                    sendSosRequest(data);
                });
            } else {
                sendSosRequest(data);
            }
        }

        function sendSosRequest(data) {
            fetch("{{ route('delivery.sos.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    closeSosModal();
                } else {
                    document.getElementById('sos-error').textContent = "Failed to send alert. Please call support directly.";
                    document.getElementById('sos-error').classList.remove('hidden');
                }
            })
            .catch(err => {
                document.getElementById('sos-error').textContent = "Connection error. Please call support.";
                document.getElementById('sos-error').classList.remove('hidden');
            });
        }
    </script>

    @push('scripts')
    <script>
        function checkNewOrders() {
            fetch("{{ route('delivery.check-new-orders') }}")
                .then(response => response.json())
                .then(data => {
                    if (data.new_order) {
                        // Show a browser notification
                        if (Notification.permission === "granted") {
                            new Notification("Speedly Delivery", {
                                body: data.message,
                                icon: "/favicon.ico"
                            });
                        }
                        
                        // Also show a toast/alert in the UI
                        showOrderToast(data.message, data.order_id);
                    }
                });
        }

        function showOrderToast(message, orderId) {
            const toast = document.createElement('div');
            toast.className = "fixed top-20 right-4 z-50 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-bounce";
            toast.innerHTML = `
                <div class="flex-1">
                    <p class="font-bold">🔔 NEW ORDER ASSIGNED!</p>
                    <p class="text-sm opacity-90">${message}</p>
                </div>
                <a href="/delivery/orders/${orderId}" class="bg-white text-green-600 px-4 py-2 rounded-xl font-bold text-xs uppercase hover:bg-green-50 transition">View Details</a>
            `;
            document.body.appendChild(toast);
            
            // Audio alert
            const audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
            audio.play().catch(e => console.log("Audio play failed: ", e));

            setTimeout(() => toast.remove(), 10000);
        }

        // Request notification permission
        if (Notification.permission !== "denied") {
            Notification.requestPermission();
        }

        // Poll every 30 seconds
        setInterval(checkNewOrders, 30000);
    </script>
    @endpush
</x-delivery-layout>
