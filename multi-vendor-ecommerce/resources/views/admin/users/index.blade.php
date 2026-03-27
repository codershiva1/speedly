@extends('layouts.admin.app')

@section('content')
<div class=" sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl md:text-2xl font-black text-emerald-900 tracking-tighter uppercase">Manage Users</h2>
        <a href="{{ route('admin.users.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5"></path></svg>
            Add New User
        </a>
    </div>

    <div class="mb-6 border-b border-gray-100 pb-2">
        <ul class="flex flex-wrap gap-2 text-sm font-medium">
            <li>
                <a href="{{ route('admin.users.index') }}" class="inline-block px-4 py-2 rounded-xl border {{ !request('role') ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-100' : 'bg-gray-50 text-gray-500 border-gray-100 hover:bg-white hover:border-emerald-200 transition' }} font-bold text-[10px] uppercase tracking-widest">All Users</a>
            </li>
            <li>
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="inline-block px-4 py-2 rounded-xl border {{ request('role') == 'admin' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-100' : 'bg-gray-50 text-gray-500 border-gray-100 hover:bg-white hover:border-emerald-200 transition' }} font-bold text-[10px] uppercase tracking-widest">Admins</a>
            </li>
            <li>
                <a href="{{ route('admin.users.index', ['role' => 'vendor']) }}" class="inline-block px-4 py-2 rounded-xl border {{ request('role') == 'vendor' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-100' : 'bg-gray-50 text-gray-500 border-gray-100 hover:bg-white hover:border-emerald-200 transition' }} font-bold text-[10px] uppercase tracking-widest">Vendors</a>
            </li>
            <li>
                <a href="{{ route('admin.users.index', ['role' => 'customer']) }}" class="inline-block px-4 py-2 rounded-xl border {{ request('role') == 'customer' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-100' : 'bg-gray-50 text-gray-500 border-gray-100 hover:bg-white hover:border-emerald-200 transition' }} font-bold text-[10px] uppercase tracking-widest">Customers</a>
            </li>
        </ul>
    </div>

    <form class="flex flex-col sm:flex-row gap-3 mb-6">
        <input type="hidden" name="role" value="{{ request('role') }}">
        <div class="relative flex-grow max-w-md">
            <input type="text" name="search" placeholder="Search name or email..." class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition" value="{{ request('search') }}">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 sm:flex-none bg-emerald-600 text-white px-6 py-2.5 rounded-xl text-sm font-black hover:bg-emerald-700 transition uppercase tracking-widest shadow-lg shadow-emerald-50">Search</button>
            @if(request('search') || request('role'))
                <a href="{{ route('admin.users.index') }}" class="flex-1 sm:flex-none bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl text-sm font-bold text-center hover:bg-gray-200 transition">Clear</a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">User Details</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Role</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Status</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                    <tr class="{{ $user->trashed() ? 'bg-red-50/30' : 'hover:bg-gray-50' }} transition">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                @if($user->image_url)
                                    <img src="{{ asset($user->image_url) }}" class="h-10 w-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-sm">{{ substr($user->name, 0, 1) }}</div>
                                @endif
                                <div>
                                    <div class="font-black text-emerald-900 leading-tight uppercase text-xs">{{ $user->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded bg-gray-100 text-gray-600 border border-gray-200">{{ $user->role }}</span>
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $user->trashed() ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $user->trashed() ? 'INACTIVE' : 'ACTIVE' }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end items-center gap-3">
                                @if($user->trashed())
                                    <a href="{{ route('admin.users.restore', $user->id) }}" class="text-blue-600 hover:text-blue-800 text-xs font-bold uppercase">Activate</a>
                                    <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST" onsubmit="return confirm('Permanently delete?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800 text-xs font-bold uppercase">Delete</button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-gray-600 hover:text-gray-900 text-xs font-bold uppercase">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-orange-600 hover:text-orange-800 text-xs font-bold uppercase">Deactivate</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="4" class="p-8 text-center text-gray-500 italic">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-gray-50">
            @forelse($users as $user)
            <div class="p-5 {{ $user->trashed() ? 'bg-red-50/10' : 'bg-white' }} group hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            @if($user->image_url)
                                <img src="{{ asset($user->image_url) }}" class="h-14 w-14 rounded-2xl object-cover border-2 border-white shadow-sm ring-1 ring-gray-100">
                            @else
                                <div class="h-14 w-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-xl shadow-inner border-2 border-white ring-1 ring-gray-100">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-lg border-2 border-white shadow-sm flex items-center justify-center {{ $user->trashed() ? 'bg-red-500' : 'bg-emerald-500' }}">
                                <div class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></div>
                            </div>
                        </div>
                        <div>
                            <div class="font-black text-emerald-900 text-sm leading-tight uppercase tracking-tight">{{ $user->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $user->email }}</div>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 text-[9px] font-black uppercase rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">{{ $user->role }}</span>
                </div>
                
                <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-50">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full {{ $user->trashed() ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest {{ $user->trashed() ? 'text-red-600' : 'text-emerald-700' }}">
                            {{ $user->trashed() ? 'Security Locked' : 'Verified Node' }}
                        </span>
                    </div>
                    
                    <div class="flex gap-2">
                        @if($user->trashed())
                            <a href="{{ route('admin.users.restore', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-600 hover:text-white transition shadow-sm border border-emerald-100">Restore</a>
                        @else
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-700 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-white hover:border-emerald-200 transition shadow-sm border border-gray-200">Refine</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="inline-flex items-center px-4 py-2 bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-600 hover:text-white transition shadow-sm border border-rose-100">Lock</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Zero Entity Matched</div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>
@endsection