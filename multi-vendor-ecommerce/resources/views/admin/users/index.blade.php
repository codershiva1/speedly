@extends('layouts.admin.app')

@section('content')
<div class=" sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl md:text-2xl font-extrabold text-gray-800">Manage Users</h2>
        <a href="{{ route('admin.users.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5"></path></svg>
            Add New User
        </a>
    </div>

    <div class="mb-6 border-b border-gray-200 overflow-x-auto">
        <ul class="flex whitespace-nowrap -mb-px text-sm font-medium">
            <li class="mr-2">
                <a href="{{ route('admin.users.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ !request('role') ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">All Users</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ request('role') == 'admin' ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">Admins</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.users.index', ['role' => 'vendor']) }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ request('role') == 'vendor' ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">Vendors</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.users.index', ['role' => 'customer']) }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ request('role') == 'customer' ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">Customers</a>
            </li>
        </ul>
    </div>

    <form class="flex flex-col sm:flex-row gap-3 mb-6">
        <input type="hidden" name="role" value="{{ request('role') }}">
        <div class="relative flex-grow max-w-md">
            <input type="text" name="search" placeholder="Search name or email..." class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" value="{{ request('search') }}">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 sm:flex-none bg-gray-900 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-800 transition">Search</button>
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
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">{{ substr($user->name, 0, 1) }}</div>
                                @endif
                                <div>
                                    <div class="font-bold text-gray-900 leading-tight">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
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

        <div class="md:hidden divide-y divide-gray-100">
            @forelse($users as $user)
            <div class="p-4 {{ $user->trashed() ? 'bg-red-50/30' : '' }}">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        @if($user->image_url)
                            <img src="{{ asset($user->image_url) }}" class="h-12 w-12 rounded-full border border-gray-200">
                        @else
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-lg">{{ substr($user->name, 0, 1) }}</div>
                        @endif
                        <div>
                            <div class="font-bold text-gray-900 text-base">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-[10px] font-bold uppercase rounded bg-gray-100 text-gray-500 border border-gray-200">{{ $user->role }}</span>
                </div>
                
                <div class="flex items-center justify-between mt-4 bg-gray-50 p-3 rounded-xl">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $user->trashed() ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                        {{ $user->trashed() ? 'INACTIVE' : 'ACTIVE' }}
                    </span>
                    
                    <div class="flex gap-4">
                        @if($user->trashed())
                            <a href="{{ route('admin.users.restore', $user->id) }}" class="text-blue-600 text-xs font-bold uppercase">Activate</a>
                        @else
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-gray-700 text-xs font-bold uppercase">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-orange-600 text-xs font-bold uppercase">Deactivate</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <div class="p-8 text-center text-gray-500 italic">No users found.</div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>
@endsection