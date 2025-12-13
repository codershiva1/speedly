<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    {{ __('Add Category') }}
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold">#</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Name') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Parent') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Status') }}</th>
                                <th class="px-3 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="px-3 py-2">{{ $category->id }}</td>
                                    <td class="px-3 py-2">{{ $category->name }}</td>
                                    <td class="px-3 py-2">{{ optional($category->parent)->name }}</td>
                                    <td class="px-3 py-2">{{ $category->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="px-3 py-2 text-right space-x-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:underline text-xs">{{ __('Edit') }}</a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-xs" onclick="return confirm('Delete this category?')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-4 text-center text-gray-500">{{ __('No categories found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
