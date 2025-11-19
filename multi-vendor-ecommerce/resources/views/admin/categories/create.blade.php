<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent_id" :value="__('Parent Category')" />
                            <select id="parent_id" name="parent_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">-- {{ __('None') }} --</option>
                                @foreach ($parents as $id => $name)
                                    <option value="{{ $id }}" @selected(old('parent_id') == $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                        </div>

                        <div class="mb-4 flex items-center">
                            <input id="status" type="checkbox" name="status" value="1" class="rounded border-gray-300" checked>
                            <label for="status" class="ms-2 text-sm text-gray-700">{{ __('Active') }}</label>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.categories.index') }}" class="me-3 text-sm text-gray-600 hover:underline">{{ __('Cancel') }}</a>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
