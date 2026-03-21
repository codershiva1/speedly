<x-delivery-layout>
    <x-slot name="header">
        Earnings & Cash
    </x-slot>

    <!-- Earnings Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Today</p>
            <h3 class="text-2xl font-black text-gray-800">₹{{ number_format($todayEarnings, 2) }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Weekly</p>
            <h3 class="text-2xl font-black text-green-600">₹{{ number_format($weeklyEarnings, 2) }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Incentives</p>
            <h3 class="text-2xl font-black text-blue-600">₹{{ number_format($totalIncentives, 2) }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">COD Collected</p>
            <h3 class="text-2xl font-black text-orange-600">₹{{ number_format($codCollected, 2) }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Wallet & Withdrawal -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-indigo-100 text-sm font-medium mb-1">Wallet Balance</p>
                    <h2 class="text-4xl font-black mb-6">₹{{ number_format(auth()->user()->deliveryBoyProfile->wallet_balance ?? 0, 2) }}</h2>
                    
                    <form action="{{ route('delivery.earnings.withdraw') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-indigo-200 uppercase mb-1">Withdraw Amount</label>
                            <input type="number" name="amount" min="100" step="0.01" required placeholder="Min ₹100" class="w-full bg-white/10 border-white/20 text-white placeholder-indigo-300 rounded-lg focus:ring-white focus:border-white py-2 text-sm italic">
                        </div>
                        <button type="submit" class="w-full bg-white text-indigo-600 font-bold py-2.5 rounded-lg hover:bg-indigo-50 transition shadow-md active:transform active:scale-95">
                            Request Payout
                        </button>
                    </form>
                    <p class="text-[10px] text-indigo-200 mt-4 italic text-center">* Payouts are usually processed within 24-48 hours.</p>
                </div>
                <!-- Abstract circles for styling -->
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -top-10 -left-10 w-32 h-32 bg-indigo-500/20 rounded-full"></div>
            </div>

            <!-- Bank Details Snapshot -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Settlement Account
                </h4>
                <div class="text-xs text-gray-500 space-y-1">
                    <p><span class="font-bold text-gray-700">Bank:</span> {{ auth()->user()->deliveryBoyProfile->bank_name ?? '--' }}</p>
                    <p><span class="font-bold text-gray-700">A/C:</span> {{ auth()->user()->deliveryBoyProfile->bank_account_number ?? '--' }}</p>
                    <p><span class="font-bold text-gray-700">IFSC:</span> {{ auth()->user()->deliveryBoyProfile->bank_ifsc ?? '--' }}</p>
                </div>
                <a href="{{ route('delivery.profile') }}" class="block mt-4 text-center text-[10px] text-blue-500 hover:underline font-bold uppercase tracking-widest">Update Details</a>
            </div>
        </div>

        <!-- Withdrawal & Earnings Tabs -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-widest">Withdrawal History</h3>
                </div>
                <div class="max-h-[300px] overflow-y-auto">
                    @if($withdrawalRequests->isEmpty())
                        <div class="p-8 text-center text-gray-400 text-xs italic">No payout requests found.</div>
                    @else
                        <table class="w-full text-left text-xs">
                            <thead class="bg-gray-50 text-gray-500 uppercase font-black text-[9px] sticky top-0">
                                <tr>
                                    <th class="px-6 py-3">ID</th>
                                    <th class="px-6 py-3">Amount</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($withdrawalRequests as $request)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-bold text-gray-400">#WTH-{{ $request->id }}</td>
                                        <td class="px-6 py-4 font-black text-gray-800">₹{{ number_format($request->amount, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase
                                                @if($request->status === 'pending') bg-yellow-100 text-yellow-700 
                                                @elseif($request->status === 'completed') bg-green-100 text-green-700
                                                @else bg-red-100 text-red-700 @endif">
                                                {{ $request->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right text-gray-400">{{ $request->created_at->format('d M, y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-widest">Recent Transactions</h3>
                </div>
                
                @if($earningsList->isEmpty())
                    <div class="p-8 text-center text-gray-400 text-xs italic">No recent transactions.</div>
                @else
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-500 uppercase font-black text-[9px] sticky top-0">
                            <tr>
                                <th class="px-6 py-3">Type</th>
                                <th class="px-6 py-3">Description</th>
                                <th class="px-6 py-3 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($earningsList as $earning)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="px-6 py-4">
                                        <span class="capitalize font-bold {{ $earning->type === 'penalty' ? 'text-red-600' : 'text-green-600' }}">{{ $earning->type }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $earning->description ?? 'Order Payout' }}</td>
                                    <td class="px-6 py-4 text-right font-black text-gray-900">₹{{ number_format($earning->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-3 border-t border-gray-50">
                        {{ $earningsList->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-delivery-layout>
