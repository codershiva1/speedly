@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Brand Management') }}
            </h2>
            <p class="text-sm text-gray-500">Manage your store brands and their official logos.</p>
        </div>
        <a href="{{ route('admin.brands.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition duration-150">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            {{ __('Add New Brand') }}
        </a>
    </div>

    @if(session('status'))
        <div class="mb-6 p-4 bg-green-50 border-s-4 border-green-500 rounded-xl flex items-center shadow-sm">
            <svg class="w-5 h-5 text-green-500 me-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="text-sm font-medium text-green-800">{{ session('status') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Logo') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Brand Details') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($brands as $brand)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $brand->id }}</td>
                            
                            <td class="px-6 py-4">
                                <div class="h-12 w-12 rounded-lg border border-gray-100 bg-gray-50 flex items-center justify-center overflow-hidden">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-full w-full object-contain p-1">
                                    @else
                                        <span class="text-[10px] text-gray-400 font-bold uppercase">No Logo</span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800 text-sm">{{ $brand->name }}</div>
                                <div class="text-[10px] text-gray-400 font-mono uppercase tracking-tighter">{{ $brand->slug }}</div>
                            </td>

                            <td class="px-6 py-4">
                                @if($brand->status)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        <span class="w-1 h-1 me-1.5 rounded-full bg-green-500"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        <span class="w-1 h-1 me-1.5 rounded-full bg-red-500"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Delete this brand? This might affect products under this brand.')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic">
                                {{ __('No brands found in the system.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($brands->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $brands->links() }}
            </div>
        @endif
    </div>
</div>
@endsection