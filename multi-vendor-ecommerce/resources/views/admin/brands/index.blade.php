@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl md:text-2xl font-extrabold text-gray-800">Brands</h2>
        <a href="{{ route('admin.brands.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5"></path></svg>
            Add Brand
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Logo</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Name</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Slug</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Status</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($brands as $brand)
                    <tr class="hover:bg-emerald-50/20 transition">
                        <td class="p-4">
                            @if($brand->logo)
                                <img src="{{ asset($brand->logo) }}" class="h-10 w-10 rounded-lg object-contain border border-gray-100 p-1">
                            @else
                                <div class="h-10 w-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold text-[10px]">NO LOGO</div>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900 leading-tight">{{ $brand->name }}</div>
                        </td>
                        <td class="p-4 text-xs text-gray-500 font-mono">
                            {{ $brand->slug }}
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $brand->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $brand->status }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end items-center gap-3">
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="text-emerald-600 hover:text-emerald-800 text-xs font-bold uppercase">Edit</a>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Delete brand?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 text-xs font-bold uppercase">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="5" class="p-8 text-center text-gray-500 italic">No brands found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Zero Scroll) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($brands as $brand)
            <div class="p-5 bg-white group hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-4">
                        @if($brand->logo)
                            <img src="{{ asset($brand->logo) }}" class="h-14 w-14 rounded-2xl object-contain border-2 border-white shadow-sm ring-1 ring-gray-100 bg-white p-2">
                        @else
                            <div class="h-14 w-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-xl shadow-inner border-2 border-white ring-1 ring-gray-100">
                                {{ substr($brand->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-black text-emerald-900 text-sm leading-tight uppercase tracking-tight">{{ $brand->name }}</div>
                            <span class="px-2 py-0.5 text-[8px] font-black uppercase rounded-lg border shadow-sm {{ $brand->status == 'active' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-gray-50 text-gray-600 border-gray-100' }}">
                                {{ $brand->status }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mt-4 border-t border-gray-50 pt-4">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ $brand->slug }}</span>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="text-emerald-600 text-[10px] font-black uppercase tracking-widest hover:underline">Edit</a>
                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-rose-600 text-[10px] font-black uppercase tracking-widest hover:underline">Destroy</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Market Vacant</div>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        {{ $brands->links() }}
    </div>
</div>
@endsection