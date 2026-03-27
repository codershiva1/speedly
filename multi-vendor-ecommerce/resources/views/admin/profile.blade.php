@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8 max-w-4xl">
    <div class="mb-8">
        <h2 class="text-2xl font-black text-emerald-900 tracking-tighter uppercase leading-none">Administrative Profile</h2>
        <p class="text-xs text-gray-500 mt-2 tracking-wide uppercase font-bold">Manage your account settings and security preferences.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-xs font-bold uppercase tracking-widest animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 bg-emerald-50/30">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-2xl bg-emerald-600 flex items-center justify-center text-white text-3xl font-black shadow-xl shadow-emerald-100">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-lg font-black text-emerald-900 uppercase">Administrator Node</h3>
                    <p class="text-xs text-gray-400 font-mono mt-1">ID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }} • Role: {{ strtoupper($user->role) }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" class="p-8 space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Basic Info -->
                <div class="space-y-6">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Identity Configuration</h4>
                    
                    <div class="space-y-1">
                        <label class="block text-[10px] font-black text-emerald-900 uppercase tracking-widest pl-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-emerald-500 transition shadow-inner">
                        @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[10px] font-black text-emerald-900 uppercase tracking-widest pl-1">Email Protocol</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-emerald-500 transition shadow-inner">
                        @error('email') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Security -->
                <div class="space-y-6">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Security Authorization</h4>
                    
                    <div class="space-y-1">
                        <label class="block text-[10px] font-black text-emerald-900 uppercase tracking-widest pl-1">Current Password</label>
                        <input type="password" name="current_password" placeholder="••••••••"
                            class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-emerald-500 transition shadow-inner">
                        @error('current_password') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[10px] font-black text-emerald-900 uppercase tracking-widest pl-1">New Password (OPTIONAL)</label>
                        <input type="password" name="new_password" placeholder="Min. 8 characters"
                            class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-emerald-500 transition shadow-inner">
                        @error('new_password') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[10px] font-black text-emerald-900 uppercase tracking-widest pl-1">Confirm New Encryption</label>
                        <input type="password" name="new_password_confirmation" placeholder="••••••••"
                            class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-emerald-500 transition shadow-inner">
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-50 flex justify-end">
                <button type="submit" class="px-10 py-4 bg-emerald-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-emerald-700 transition shadow-xl shadow-emerald-100 transform hover:-translate-y-1 active:translate-y-0">
                    Symmetrize Profile
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 p-6 bg-amber-50 rounded-3xl border border-amber-100">
        <div class="flex gap-4">
            <div class="shrink-0 w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </div>
            <div>
                <h4 class="text-xs font-black text-amber-900 uppercase tracking-widest">Security Advisory</h4>
                <p class="text-[10px] text-amber-700 font-bold mt-1 leading-relaxed uppercase tracking-tighter">Changing your email protocol or authorization password will log you out of all other active sessions for security integrity.</p>
            </div>
        </div>
    </div>
</div>
@endsection
