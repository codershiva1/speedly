@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-black text-emerald-900 tracking-tighter uppercase">Financial Withdrawals</h2>
            <p class="text-xs text-gray-500 mt-1">Review and process rider payout requests.</p>
        </div>
        <div class="flex gap-2">
            <div class="bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100">
                <span class="text-[10px] font-bold text-emerald-600 uppercase block">Pending Volume</span>
                <span class="text-lg font-black text-emerald-700">₹{{ number_format($requests->where('status', 'pending')->sum('amount'), 0) }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Rider / Delivery Boy</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Amount</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Settlement Info</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-center">Status</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($requests as $req)
                        <tr class="hover:bg-emerald-50/20 transition group">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold uppercase text-xs">
                                        {{ substr($req->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-emerald-900 leading-tight uppercase text-xs">{{ $req->user->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-mono">{{ $req->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="text-sm font-black text-emerald-900 tracking-tight">₹{{ number_format($req->amount, 2) }}</div>
                                <div class="text-[9px] text-gray-400 uppercase font-bold">{{ $req->created_at->format('d M, H:i') }}</div>
                            </td>
                            <td class="p-4">
                                <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100 text-[11px]">
                                    <div class="font-bold text-gray-700 mb-0.5">{{ $req->bank_name }}</div>
                                    <div class="text-gray-500 font-mono">{{ $req->account_number }} ({{ $req->ifsc_code }})</div>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @if($req->status === 'pending')
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Pending</span>
                                @elseif($req->status === 'approved')
                                    <div class="flex flex-col items-center">
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Approved</span>
                                        <span class="text-[8px] text-gray-400 mt-1 font-mono uppercase">{{ $req->transaction_id ?? 'Auto-Settled' }}</span>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center">
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Rejected</span>
                                        @if($req->admin_note)
                                            <span class="text-[8px] text-red-400 mt-1 font-bold italic">"{{ Str::limit($req->admin_note, 20) }}"</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                @if($req->status === 'pending')
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.withdrawals.approve', $req) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                            </button>
                                        </form>
                                        <button onclick="rejectRequest({{ $req->id }})" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest italic">Settled</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-16 text-center text-gray-500 italic">No pending requests.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Zero Scroll) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($requests as $req)
            <div class="p-5 bg-white group hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-lg shadow-inner border-2 border-white ring-1 ring-gray-100">
                            {{ substr($req->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-black text-emerald-900 text-sm leading-tight uppercase tracking-tight">{{ $req->user->name }}</div>
                            <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $req->created_at->format('d M, Y') }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-emerald-900 leading-none">₹{{ number_format($req->amount, 2) }}</div>
                        <div class="mt-2">
                             @if($req->status === 'pending')
                                <span class="px-2 py-1 bg-amber-50 text-amber-600 border border-amber-100 rounded-lg text-[8px] font-black uppercase tracking-widest shadow-sm">Pending</span>
                            @elseif($req->status === 'approved')
                                <span class="px-2 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg text-[8px] font-black uppercase tracking-widest shadow-sm">Approved</span>
                            @else
                                <span class="px-2 py-1 bg-rose-50 text-rose-600 border border-rose-100 rounded-lg text-[8px] font-black uppercase tracking-widest shadow-sm">Rejected</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 mb-5 relative group-hover:bg-white transition-colors">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        Settlement Details
                    </p>
                    <div class="flex flex-col gap-1">
                        <p class="text-[11px] font-black text-emerald-900 uppercase tracking-tighter">{{ $req->bank_name }}</p>
                        <p class="text-[10px] text-gray-500 font-mono">{{ $req->account_number }}</p>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $req->ifsc_code }}</p>
                    </div>
                    @if($req->transaction_id)
                        <div class="mt-2 pt-2 border-t border-gray-100/50">
                             <p class="text-[10px] font-mono text-emerald-600 font-bold uppercase tracking-tighter">TXN: {{ $req->transaction_id }}</p>
                        </div>
                    @endif
                </div>
                
                @if($req->status === 'pending')
                <div class="flex items-center gap-3">
                    <form action="{{ route('admin.withdrawals.approve', $req) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full py-3 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition shadow-md shadow-emerald-100">
                            Approve
                        </button>
                    </form>
                    <button onclick="rejectRequest({{ $req->id }})" class="flex-1 py-3 bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-rose-100 hover:bg-rose-600 hover:text-white transition shadow-sm">
                        Reject
                    </button>
                </div>
                @endif
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Zero Requests Pending</div>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        {{ $requests->links() }}
    </div>
</div>

<script>
function rejectRequest(id) {
    const reason = prompt("Enter rejection reason (required):");
    if (reason && reason.trim() !== "") {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/withdrawals/${id}/reject`;
        form.innerHTML = `
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="reason" value="${reason}">
        `;
        document.body.appendChild(form);
        form.submit();
    } else if (reason !== null) {
        alert("Reason is required to reject a request.");
    }
}
</script>
@endsection
