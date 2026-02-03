@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Edit User: {{ $user->name }}</h2>
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 text-sm italic">← Back to List</a>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT') {{-- Resource route ke liye PUT method zaroori hai --}}
            
            <div class="flex items-center gap-6 mb-4">
                <div class="h-24 w-24 rounded-full border-2 border-gray-200 overflow-hidden bg-gray-50">
                    @if($user->image_url)
                        <img id="edit-preview" src="{{ asset($user->image_url) }}" class="h-full w-full object-cover">
                    @else
                        <img id="edit-preview" src="https://ui-avatars.com/api/?name={{ $user->name }}" class="h-full w-full object-cover">
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Update Profile Photo</label>
                    <input type="file" name="image" onchange="previewImage(this)" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
                <select name="role" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="pt-6 border-t flex gap-3">
                <button type="submit" class="flex-1 bg-green-600 text-white py-2.5 rounded-lg font-bold hover:bg-green-700 transition shadow-lg shadow-green-100">
                    Update User Details
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('edit-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection