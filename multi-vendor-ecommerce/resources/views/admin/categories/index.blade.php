@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl md:text-2xl font-extrabold text-gray-800">Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5"></path></svg>
            Add Category
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Image</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Name</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Parent</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Status</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-emerald-50/20 transition">
                        <td class="p-4">
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" class="h-10 w-10 rounded-lg object-cover border border-gray-100">
                            @else
                                <div class="h-10 w-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold text-[10px]">NO IMG</div>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900 leading-tight">{{ $category->name }}</div>
                            <div class="text-[10px] text-gray-400 font-mono">{{ $category->slug }}</div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            {{ $category->parent->name ?? 'None' }}
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $category->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $category->status }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end items-center gap-3">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-emerald-600 hover:text-emerald-800 text-xs font-bold uppercase">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete category?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 text-xs font-bold uppercase">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="5" class="p-8 text-center text-gray-500 italic">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Zero Scroll) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($categories as $category)
            <div class="p-5 bg-white group hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-4">
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" class="h-14 w-14 rounded-2xl object-cover border-2 border-white shadow-sm ring-1 ring-gray-100">
                        @else
                            <div class="h-14 w-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-xl shadow-inner border-2 border-white ring-1 ring-gray-100">
                                {{ substr($category->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-black text-emerald-900 text-sm leading-tight uppercase tracking-tight">{{ $category->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $category->parent->name ?? 'Primary Dept' }}</div>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 text-[8px] font-black uppercase rounded-lg border shadow-sm {{ $category->status == 'active' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-gray-50 text-gray-600 border-gray-100' }}">
                        {{ $category->status }}
                    </span>
                </div>
                
                <div class="flex items-center justify-between mt-4 border-t border-gray-50 pt-4">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ $category->slug }}</span>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-emerald-600 text-[10px] font-black uppercase tracking-widest hover:underline">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-rose-600 text-[10px] font-black uppercase tracking-widest hover:underline">Revoke</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Inventory Sterile</div>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection