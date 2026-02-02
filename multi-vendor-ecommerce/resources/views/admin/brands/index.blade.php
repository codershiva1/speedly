@extends('layouts.admin.app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Brands</h1>
        <a href="{{ route('admin.brands.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Add Brand
        </a>
    </div>

    @if(session('status'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold">#</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Name') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Status') }}</th>
                                <th class="px-3 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($brands as $brand)
                                <tr>
                                    <td class="px-3 py-2">{{ $brand->id }}</td>
                                    <td class="px-3 py-2">{{ $brand->name }}</td>
                                    <td class="px-3 py-2">{{ $brand->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="px-3 py-2 text-right space-x-2">
                                        <a href="{{ route('admin.brands.edit', $brand) }}" class="text-indigo-600 hover:underline text-xs">{{ __('Edit') }}</a>
                                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-xs" onclick="return confirm('Delete this brand?')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-4 text-center text-gray-500">{{ __('No brands found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
