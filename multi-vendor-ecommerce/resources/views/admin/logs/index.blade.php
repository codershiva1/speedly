@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8 pb-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight leading-none">Security & Audit Logs</h2>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-3">Monitoring system activities and administrative changes.</p>
        </div>
        <div class="bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
            <span class="text-[10px] text-gray-400 font-black uppercase block tracking-tighter text-center">Total Logs Captured</span>
            <span class="text-lg font-black text-emerald-600 leading-none block text-center mt-1">{{ number_format($logs->total()) }}</span>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden text-wrap break-all">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/30 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-[10px] font-black uppercase text-gray-500">Timestamp</th>
                        <th class="p-4 text-[10px] font-black uppercase text-gray-500">User / Actor</th>
                        <th class="p-4 text-[10px] font-black uppercase text-gray-500 text-center">Action</th>
                        <th class="p-4 text-[10px] font-black uppercase text-gray-500">Description</th>
                        <th class="p-4 text-[10px] font-black uppercase text-gray-500">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50/50 transition group">
                            <td class="p-4">
                                <div class="text-[11px] font-black text-gray-800">{{ $log->created_at->format('d M, H:i:s') }}</div>
                                <div class="text-[9px] text-gray-400 font-mono tracking-tighter">{{ $log->ip_address }}</div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-black text-[10px] uppercase">
                                        {{ substr($log->user->name ?? 'SYS', 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="text-[11px] font-black text-gray-900 leading-none">{{ $log->user->name ?? 'System' }}</div>
                                        <div class="text-[9px] text-gray-400 mt-1 uppercase font-bold tracking-widest">{{ $log->user->role ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @php
                                    $actionColors = [
                                        'created' => 'bg-emerald-100 text-emerald-700',
                                        'updated' => 'bg-blue-100 text-blue-700',
                                        'deleted' => 'bg-red-100 text-red-700',
                                        'login'   => 'bg-amber-100 text-amber-700',
                                    ];
                                    $class = $actionColors[$log->action] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-2.5 py-1 rounded-md text-[9px] font-black uppercase tracking-widest {{ $class }}">{{ $log->action }}</span>
                            </td>
                            <td class="p-4">
                                <div class="text-[11px] font-bold text-gray-700 truncate max-w-xs">{{ $log->description }}</div>
                                <div class="text-[9px] text-gray-400 mt-1 font-mono">{{ class_basename($log->model_type) }} #{{ $log->model_id }}</div>
                            </td>
                            <td class="p-4">
                                <button onclick='showLogData({!! json_encode($log->properties) !!})' class="p-2 hover:bg-emerald-50 rounded-lg text-emerald-600 transition group-hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-20 text-center text-gray-400 italic text-sm">No activity logs recorded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Zero Scroll) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($logs as $log)
            <div class="p-5 bg-white hover:bg-gray-50/30 transition-colors">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-black text-[11px] ring-4 ring-white shadow-sm">
                            {{ substr($log->user->name ?? 'SYS', 0, 2) }}
                        </div>
                        <div>
                            <div class="text-xs font-black text-emerald-900 uppercase tracking-tight">{{ $log->user->name ?? 'System' }}</div>
                            <div class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.1em] mt-0.5">{{ $log->created_at->format('d M, H:i:s') }}</div>
                        </div>
                    </div>
                    @php
                        $actionColors = [
                            'created' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            'updated' => 'bg-blue-50 text-blue-700 border-blue-100',
                            'deleted' => 'bg-rose-50 text-rose-700 border-rose-100',
                            'login'   => 'bg-amber-50 text-amber-700 border-amber-100',
                        ];
                        $class = $actionColors[$log->action] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                    @endphp
                    <span class="px-2.5 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest border {{ $class }} shadow-sm">{{ $log->action }}</span>
                </div>

                <div class="bg-gray-50/50 p-4 rounded-2xl border border-gray-100 mb-4">
                    <p class="text-[11px] font-bold text-gray-700 leading-relaxed">{{ $log->description }}</p>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-[9px] text-gray-400 font-mono tracking-tighter">{{ $log->ip_address }}</span>
                        <span class="text-[9px] text-emerald-600 font-black uppercase tracking-widest">{{ class_basename($log->model_type) }} #{{ $log->model_id }}</span>
                    </div>
                </div>
                
                <button onclick='showLogData({!! json_encode($log->properties) !!})' class="w-full py-3 bg-white border border-gray-100 text-gray-500 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] shadow-sm hover:bg-emerald-50 hover:text-emerald-600 transition-all flex items-center justify-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    View Stack Metadata
                </button>
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Zero Activity Captured</div>
            @endforelse
        </div>
    </div>
    
    <div class="mt-8">
        {{ $logs->links() }}
    </div>
</div>

<!-- Simple Log Detail Modal -->
<div id="logModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-99999 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h5 class="text-xs font-black text-gray-800 uppercase tracking-widest">Entry Metadata (JSON)</h5>
            <button onclick="closeLogModal()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </button>
        </div>
        <div class="p-8">
            <pre id="logContent" class="bg-gray-950 text-emerald-400 p-6 rounded-2xl text-[11px] font-mono overflow-auto max-h-[60vh] leading-relaxed shadow-inner border border-white/10 no-scrollbar"></pre>
        </div>
    </div>
</div>

<script>
function showLogData(data) {
    document.getElementById('logContent').textContent = JSON.stringify(data, null, 4);
    document.getElementById('logModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeLogModal() {
    document.getElementById('logModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
@endsection
