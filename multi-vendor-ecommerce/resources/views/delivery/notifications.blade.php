<x-delivery-layout>
    <x-slot name="header">
        Notifications & Alerts
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center space-x-2">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Inbox</h3>
                    @if($unreadCount > 0)
                        <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ $unreadCount }} NEW</span>
                    @endif
                </div>
                @if($unreadCount > 0)
                    <form action="{{ route('delivery.notifications.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-[10px] font-bold text-blue-600 hover:text-blue-800 uppercase tracking-tighter">Mark all as read</button>
                    </form>
                @endif
            </div>

            @if(count($notifications) > 0)
                <div class="divide-y divide-gray-50">
                    @foreach($notifications as $notification)
                        @php 
                            $data = (array) $notification->data;
                            $isUnread = $notification->read_at === null;
                            $notificationId = $notification->id;
                            $createdAt = $notification->created_at;
                        @endphp
                        <div class="p-6 hover:bg-gray-50/50 transition relative {{ $isUnread ? 'bg-blue-50/30' : '' }}">
                            <div class="flex items-start space-x-4">
                                <!-- Icon based on type -->
                                <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center
                                    @if(($data['type'] ?? '') == 'order') bg-green-100 text-green-600 
                                    @elseif(($data['type'] ?? '') == 'payment') bg-blue-100 text-blue-600
                                    @elseif(($data['type'] ?? '') == 'admin') bg-purple-100 text-purple-600
                                    @else bg-gray-100 text-gray-400 @endif">
                                    @if(($data['type'] ?? '') == 'order')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a2 2 0 00-4 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    @elseif(($data['type'] ?? '') == 'payment')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-sm font-bold text-gray-800">{{ $data['title'] ?? 'System Update' }}</h4>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $createdAt->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">{{ $data['message'] ?? 'You have a new update in your delivery panel.' }}</p>
                                    
                                    <div class="mt-3 flex items-center space-x-4">
                                        @if($isUnread)
                                            <form action="{{ route('delivery.notifications.read', $notificationId) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-[10px] font-black text-indigo-600 hover:underline uppercase tracking-widest">Mark as read</button>
                                            </form>
                                        @endif
                                        @if($data['action_url'] ?? false)
                                            <a href="{{ $data['action_url'] }}" class="text-[10px] font-black text-gray-400 hover:text-gray-800 uppercase tracking-widest flex items-center">
                                                View Details <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-16 text-center">
                    <div class="w-20 h-20 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0L12 16.5 4 13m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.5l-1 1h-5l-1-1H4"></path></svg>
                    </div>
                    <h4 class="text-gray-400 font-bold">Your inbox is empty</h4>
                    <p class="text-gray-400 text-xs mt-1">We'll notify you here for new orders and updates.</p>
                </div>
            @endif

            @if(method_exists($notifications, 'links'))
                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-delivery-layout>
