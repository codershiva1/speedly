<x-delivery-layout>
    <x-slot name="header">
        Support & Help Center
    </x-slot>

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Sidebar: FAQ & Shortcuts -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-4">Quick Help</h3>
                <div class="space-y-3">
                    <a href="#" class="block p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 transition border border-gray-100 group">
                        <p class="text-xs font-bold text-gray-800 group-hover:text-indigo-600">Payment Issue</p>
                        <p class="text-[10px] text-gray-500">Earnings not showing up?</p>
                    </a>
                    <a href="#" class="block p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 transition border border-gray-100 group">
                        <p class="text-xs font-bold text-gray-800 group-hover:text-indigo-600">App Troubleshooting</p>
                        <p class="text-[10px] text-gray-500">GPS or App crashing?</p>
                    </a>
                    <a href="#" class="block p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 transition border border-gray-100 group">
                        <p class="text-xs font-bold text-gray-800 group-hover:text-indigo-600">Order Dispute</p>
                        <p class="text-[10px] text-gray-500">Customer rejected order?</p>
                    </a>
                </div>
            </div>

            <div class="bg-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                <h3 class="text-sm font-black uppercase tracking-widest mb-2">Call Hotline</h3>
                <p class="text-xs text-indigo-100 mb-4">24/7 Priority Support for active riders.</p>
                <a href="tel:+919876543210" class="flex items-center justify-center w-full py-3 bg-white text-indigo-600 rounded-xl font-black text-sm active:scale-95 transition-all shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    CALL NOW
                </a>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[600px]">
                <!-- Chat Header -->
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-black">S</div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Support Agent</h4>
                            <div class="flex items-center space-x-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Active Now</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div id="chat-messages" class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50/30">
                    <div class="flex justify-start">
                        <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-none p-4 max-w-[80%] shadow-sm">
                            <p class="text-sm text-gray-700">Hello {{ explode(' ', trim(auth()->user()->name))[0] }}! How can we help you today?</p>
                            <span class="text-[8px] text-gray-400 font-bold uppercase mt-1 block">10:05 AM</span>
                        </div>
                    </div>
                </div>
                <div class="flex-1 overflow-y-auto p-6 bg-gray-50/30">
                    <div id="chat-container" class="space-y-4 mb-6 h-96 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-green-200">
                        <!-- Welcome Message -->
                        <div class="flex justify-start">
                            <div class="bg-gray-100 text-gray-800 p-3 rounded-2xl rounded-tl-none max-w-[80%] text-sm shadow-sm border border-gray-200">
                                <p class="font-bold text-[10px] uppercase text-gray-400 mb-1">Speedly Support Bot</p>
                                Welcome to Speedly Rider Support! How can we help you today?
                            </div>
                        </div>

                        @foreach($messages as $msg)
                            @if($msg->sender_role === 'rider')
                                <div class="flex justify-end">
                                    <div class="bg-green-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[80%] text-sm shadow-lg shadow-green-100">
                                        {{ $msg->message }}
                                        <p class="text-[9px] text-green-100 mt-1 text-right">{{ $msg->created_at->format('H:i') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-start">
                                    <div class="bg-white text-gray-800 p-3 rounded-2xl rounded-tl-none max-w-[80%] text-sm shadow-sm border border-gray-200">
                                        <p class="font-bold text-[10px] uppercase text-green-600 mb-1">Support Agent</p>
                                        {{ $msg->message }}
                                        <p class="text-[9px] text-gray-400 mt-1">{{ $msg->created_at->format('H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Input Area -->
                    <div class="relative">
                        <textarea id="message-input" rows="2" class="w-full bg-gray-50 border-gray-200 rounded-2xl py-3 px-4 pr-16 text-sm focus:ring-green-500 focus:border-green-500 transition-all resize-none" placeholder="Type your message here..."></textarea>
                        <button onclick="sendMessage()" class="absolute right-2 bottom-2 bg-green-600 text-white p-2.5 rounded-xl hover:bg-green-700 shadow-md transition-all active:scale-95">
                            <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendMessage() {
            const input = document.getElementById('message-input');
            const message = input.value.trim();
            if (!message) return;

            const container = document.getElementById('chat-container');
            
            // Append Rider Message UI
            const riderMsg = `
                <div class="flex justify-end">
                    <div class="bg-green-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[80%] text-sm shadow-lg shadow-green-100">
                        ${message}
                        <p class="text-[9px] text-green-100 mt-1 text-right">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', riderMsg);
            input.value = '';
            container.scrollTop = container.scrollHeight;

            // Send to Backend
            fetch("{{ route('delivery.support.send') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                // Simulate agent reply
                setTimeout(() => {
                    const agentReplyHtml = `
                        <div class="flex justify-start">
                            <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-none p-4 max-w-[80%] shadow-sm">
                                <p class="text-sm text-gray-700">Thank you for reporting. Our agent will review this shortly.</p>
                                <span class="text-[8px] text-gray-400 font-bold uppercase mt-1 block">BOT REPLY</span>
                            </div>
                        </div>
                    `;
                    chatBox.insertAdjacentHTML('beforeend', agentReplyHtml);
                    chatBox.scrollTop = chatBox.scrollHeight;
                }, 1500);
            });
        }
    </script>
</x-delivery-layout>
