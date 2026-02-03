@extends('layouts.admin.app')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Profile</h2>
            <p class="text-gray-500 mt-1">Update karein <span class="text-indigo-600 font-semibold">{{ $user->name }}</span> ki details aur permissions.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition shadow-sm w-fit">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Back to List
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-4">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center sticky top-8">
                        <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider text-center">Current Photo</label>
                        
                        <div class="relative group inline-block">
                            <div class="w-40 h-40 rounded-3xl overflow-hidden ring-4 ring-indigo-50 bg-gray-100 border-2 border-white shadow-md">
                                @if($user->image_url)
                                    <img id="edit-preview" src="{{ asset($user->image_url) }}" class="w-full h-full object-cover">
                                @else
                                    <img id="edit-preview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=fff&size=128" class="w-full h-full object-cover">
                                @endif
                            </div>
                            
                            <label for="image-upload" class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl cursor-pointer">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke-width="2"/><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/></svg>
                            </label>
                            <input id="image-upload" type="file" name="image" class="hidden" onchange="previewImage(this)">
                        </div>

                        <div class="mt-4">
                            <h4 class="font-bold text-gray-800">{{ $user->name }}</h4>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $user->role }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                            <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                            </span>
                            Account Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                                    class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition outline-none text-gray-800 shadow-inner" 
                                    placeholder="Full Name">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                    class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition outline-none text-gray-800 shadow-inner" 
                                    placeholder="Email Address">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Assign New Role</label>
                                <div class="relative">
                                    <select name="role" required class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-indigo-500 appearance-none outline-none text-gray-800 shadow-inner">
                                        <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                        <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="mt-10">
                            <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('edit-preview');
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection