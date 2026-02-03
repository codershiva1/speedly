@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manage Users</h2>
         <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5"></path></svg>
            Add New User
        </a>
    </div>

    <div class="mb-6 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
            <li class="mr-2">
                <a href="{{ route('admin.users.index') }}" 
                   class="inline-block p-4 border-b-2 rounded-t-lg {{ !request('role') ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">
                   All Users
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
                   class="inline-block p-4 border-b-2 rounded-t-lg {{ request('role') == 'admin' ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">
                   Admins
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.users.index', ['role' => 'vendor']) }}" 
                   class="inline-block p-4 border-b-2 rounded-t-lg {{ request('role') == 'vendor' ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">
                   Vendors
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.users.index', ['role' => 'customer']) }}" 
                   class="inline-block p-4 border-b-2 rounded-t-lg {{ request('role') == 'customer' ? 'text-blue-600 border-blue-600 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">
                   Customers
                </a>
            </li>
        </ul>
    </div>

    {{-- Search Section (Simplified since role is in tabs) --}}
    <form class="flex gap-4 mb-6">
        <input type="hidden" name="role" value="{{ request('role') }}">
        <input type="text" name="search" placeholder="Search name or email..." class="border rounded-lg px-4 py-2 w-64 text-sm focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition">Search</button>
        @if(request('search') || request('role'))
            <a href="{{ route('admin.users.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-300 transition">Clear</a>
        @endif
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-xs font-bold uppercase text-gray-500">User Details</th>
                    <th class="p-4 text-xs font-bold uppercase text-gray-500">Role</th>
                    <th class="p-4 text-xs font-bold uppercase text-gray-500">Status</th>
                    <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($users as $user)
                <tr class="{{ $user->trashed() ? 'bg-red-50/50' : 'hover:bg-gray-50' }} transition">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 flex-shrink-0">
                                @if($user->image_url)
                                    <img src="{{ asset($user->image_url) }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold uppercase text-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 leading-none">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    
                    <td class="p-4">
                        <span class="px-2 py-1 text-[10px] font-bold uppercase rounded bg-gray-100 text-gray-600 border border-gray-200">
                            {{ $user->role }}
                        </span>
                    </td>

                    <td class="p-4">
                        @if($user->trashed())
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700">INACTIVE</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700">ACTIVE</span>
                        @endif
                    </td>

                    <td class="p-4 text-right flex justify-end items-center gap-3">
                        @if($user->trashed())
                            <a href="{{ route('admin.users.restore', $user->id) }}" class="text-blue-600 hover:text-blue-800 text-xs font-bold uppercase">Activate</a>
                            <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST" onsubmit="return confirm('Force Delete permanently?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 text-xs font-bold uppercase">Force Delete</button>
                            </form>
                        @else
                            <a href="{{ route('admin.users.edit', $user->id) }}"><button  class="text-gray-600 hover:text-gray-900 text-xs font-bold uppercase">Edit</button></a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Deactivate this user?')">
                                @csrf @method('DELETE')
                                <button class="text-orange-600 hover:text-orange-800 text-xs font-bold uppercase">Deactivate</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500 italic">No users found in this category.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>
@endsection