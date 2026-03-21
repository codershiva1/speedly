<x-delivery-layout>
    <x-slot name="header">
        Performance & Ratings
    </x-slot>

    <!-- Performance Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Success Rate -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm font-medium text-gray-500">Success Rate</p>
                <span class="text-green-600 bg-green-50 px-2 py-0.5 rounded text-[10px] font-bold">LIFETIME</span>
            </div>
            <h3 class="text-3xl font-black text-gray-900">{{ $successRate }}%</h3>
            <div class="mt-4 w-full bg-gray-100 rounded-full h-1.5">
                <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $successRate }}%"></div>
            </div>
            <p class="text-[10px] text-gray-400 mt-2">{{ $completedCount }} successful deliveries total</p>
        </div>

        <!-- Average Time -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm font-medium text-gray-500">Avg Delivery Time</p>
                <span class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded text-[10px] font-bold">TODAY</span>
            </div>
            <h3 class="text-3xl font-black text-gray-900">{{ $avgTime > 0 ? $avgTime : '--' }} <span class="text-sm font-bold text-gray-400">mins</span></h3>
            <div class="mt-4 flex items-center space-x-1">
                @for($i=0; $i<5; $i++)
                    <div class="flex-1 h-1.5 rounded-full {{ $avgTime > 0 && $avgTime <= 25 ? 'bg-green-400' : ($avgTime > 25 ? 'bg-orange-400' : 'bg-gray-100') }}"></div>
                @endfor
            </div>
            <p class="text-[10px] text-gray-400 mt-2">Calculated from pickup to dropoff</p>
        </div>

        <!-- Incentives Milestone -->
        <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-xl shadow-lg p-6 text-white overflow-hidden relative">
            <div class="relative z-10">
                <p class="text-purple-100 text-sm font-medium mb-1">Daily Bonus Goal</p>
                @if($ordersNeededForBonus > 0)
                    <h3 class="text-2xl font-black">{{ $ordersNeededForBonus }} <span class="text-xs font-normal">more orders needed</span></h3>
                    <p class="text-[10px] text-purple-200 mt-2">Finish 10 orders today for ₹100 extra!</p>
                @else
                    <h3 class="text-2xl font-black text-green-300">Goal Reached!</h3>
                    <p class="text-[10px] text-purple-200 mt-2">₹100 bonus will be added to your wallet.</p>
                @endif
            </div>
            <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
        </div>
    </div>

    <!-- Feedback Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Rating Breakdown -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Customer Ratings</h3>
                <div class="text-center mb-8">
                    <h2 class="text-5xl font-black text-gray-900">{{ number_format($avgRating, 1) }}</h2>
                    <div class="flex justify-center my-2 text-yellow-400">
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-6 h-6 {{ $i <= round($avgRating) ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-400 font-medium">Based on recent feedback</p>
                </div>

                <div class="space-y-3">
                    @php $stars = [5 => 85, 4 => 10, 3 => 3, 2 => 1, 1 => 1]; @endphp
                    @foreach($stars as $star => $per)
                        <div class="flex items-center text-xs text-gray-500">
                            <span class="w-4 font-bold">{{ $star }}</span>
                            <svg class="w-3 h-3 text-gray-300 mx-1 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <div class="flex-1 h-2 bg-gray-100 rounded-full mx-2">
                                <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $per }}%"></div>
                            </div>
                            <span class="w-8 text-right font-medium">{{ $per }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-widest">Customer Comments</h3>
                </div>
                
                @if($reviewsList->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </div>
                        <p class="text-gray-400 font-medium">No reviews received yet.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($reviewsList as $review)
                            <div class="p-6">
                                <div class="flex space-x-4">
                                    <div class="w-10 h-10 bg-gray-100 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-gray-400">
                                        {{ substr($review->customer->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="text-sm font-bold text-gray-800">{{ $review->customer->name }}</h4>
                                            <span class="text-[10px] text-gray-400 uppercase font-bold">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex text-yellow-400 mb-2">
                                            @for($i=1; $i<=5; $i++)
                                                <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @endfor
                                        </div>
                                        <p class="text-xs text-gray-600 leading-relaxed italic">"{{ $review->comment }}"</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        {{ $reviewsList->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-delivery-layout>
