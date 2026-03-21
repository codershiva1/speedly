<x-delivery-layout>
    <x-slot name="header">
        Rider Training & SOP
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Intro -->
        <div class="bg-indigo-600 rounded-2xl shadow-lg p-8 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-black uppercase tracking-tight mb-2">Welcome to the Elite Rider Program</h2>
                <p class="text-indigo-100 text-sm max-w-lg">Follow these Standard Operating Procedures (SOP) to maximize your earnings and maintain a 5-star rating.</p>
            </div>
            <svg class="absolute right-[-20px] top-[-20px] w-64 h-64 text-indigo-500 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99z"/></svg>
        </div>

        <!-- Training Modules -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Module 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-2">Safety Priorities</h3>
                <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4">
                    <li>Always wear a helmet and reflective gear.</li>
                    <li>Check vehicle brakes and tires daily.</li>
                    <li>Never use your phone while riding.</li>
                    <li>Use the <strong>Emergency SOS</strong> button for accidents.</li>
                </ul>
            </div>

            <!-- Module 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-2">Order Handling</h3>
                <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4">
                    <li>Use the <strong>Pickup Checklist</strong> at every store.</li>
                    <li>Ensure hot and cold items are stored separately.</li>
                    <li>Handle fragile items with extreme care.</li>
                    <li>Match 4-digit OTP before handing over.</li>
                </ul>
            </div>

            <!-- Module 3 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                </div>
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-2">Customer Service</h3>
                <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4">
                    <li>Always greet the customer with a smile.</li>
                    <li>Confirm the order number verbally.</li>
                    <li>Place the bag in a clean area if contactless.</li>
                    <li>Ask them politely to rate your service!</li>
                </ul>
            </div>

            <!-- Module 4 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-2">Earnings Maximize</h3>
                <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4">
                    <li>Rider during "Peak Hours" for 1.5x multi-bonus.</li>
                    <li>Maintain >95% acceptance rate for incentives.</li>
                    <li>Complete the <strong>Daily Target</strong> for bonus pay.</li>
                    <li>Refer other riders to earn referral wallet cash.</li>
                </ul>
            </div>
        </div>

        <!-- Video Placeholder -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-4">Video Tutorials</h3>
            <div class="aspect-video bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-200">
                <div class="text-center">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Loading Training Content...</p>
                </div>
            </div>
        </div>
    </div>
</x-delivery-layout>
