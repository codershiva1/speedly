@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-black text-emerald-900 tracking-tighter uppercase leading-none">Support Help Desk</h2>
            <p class="text-xs text-gray-500 mt-2 tracking-wide uppercase font-bold">Manage incoming messages from Users, Vendors & Riders.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
                <span class="text-[10px] text-gray-400 font-black uppercase block tracking-tighter">Total Inbox</span>
                <span class="text-lg font-black text-emerald-900 leading-none">{{ $messages->total() }}</span>
            </div>
            <div class="bg-emerald-600 px-4 py-2 rounded-xl shadow-lg shadow-emerald-100">
                <span class="text-[10px] text-emerald-100 font-black uppercase block tracking-tighter">Unread</span>
                <span class="text-lg font-black text-white leading-none">{{ $messages->where('is_read', false)->count() }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($messages as $msg)
            <div class="bg-white rounded-3xl p-6 border {{ $msg->is_read ? 'border-gray-50 opacity-75' : 'border-emerald-100 shadow-sm ring-1 ring-emerald-50' }} hover:shadow-md transition group overflow-hidden relative">
                @if(!$msg->is_read)
                    <div class="absolute top-0 right-0 p-3">
                        <span class="flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                    </div>
                @endif

                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-64 shrink-0">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-black uppercase">
                                {{ substr($msg->user->name ?? '?', 0, 2) }}
                            </div>
                            <div>
                                <div class="font-black text-emerald-900 leading-none uppercase text-xs">{{ $msg->user->name ?? 'Guest User' }}</div>
                                <div class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-widest">{{ $msg->sender_role }}</div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-[10px] text-gray-500 font-bold">
                                <svg class="w-3.5 h-3.5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                {{ $msg->created_at->format('d M, Y • H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow">
                        <div class="bg-gray-50/50 p-5 rounded-2xl border border-gray-100 group-hover:bg-white transition">
                            <p class="text-sm text-gray-700 leading-relaxed font-medium">
                                {{ $msg->message }}
                            </p>
                        </div>
                        
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex gap-2">
                                @if(!$msg->is_read)
                                <form action="{{ route('admin.support.mark-read', $msg) }}" method="POST">
                                    @csrf
                                    <button class="px-5 py-2 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">Mark as Read</button>
                                </form>
                                @endif
                                <a href="mailto:{{ $msg->user->email ?? '#' }}" class="px-5 py-2 bg-white border border-gray-200 text-gray-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-gray-50 transition">Reply via Email</a>
                            </div>

                            <form action="{{ route('admin.support.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete message?')">
                                @csrf @method('DELETE')
                                <button class="text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 transition">Delete Permanently</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 text-center bg-white rounded-3xl border-2 border-dashed border-gray-100">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
                <h3 class="text-gray-800 font-black uppercase text-sm tracking-widest">Inbox Zero!</h3>
                <p class="text-gray-400 text-xs mt-1">Koi naya support message nahi mila.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $messages->links() }}
    </div>
</div>
@endsection
