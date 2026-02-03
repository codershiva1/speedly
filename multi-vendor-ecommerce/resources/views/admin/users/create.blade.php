@extends('layouts.admin.app')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create New User</h2>
            <p class="text-gray-500 mt-1">Naye user ko system mein add karein aur roles assign karein.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition shadow-sm w-fit">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Back to List
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-4">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center">
                        <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Profile Photo</label>
                        <div class="relative group">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden ring-4 ring-gray-50 bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                                <img id="avatar-preview" src="https://ui-avatars.com/api/?name=New+User&background=EBF4FF&color=7F9CF5" class="w-full h-full object-cover hidden">
                                <svg id="avatar-placeholder" class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                            <div class="mt-4">
                                <label for="image-upload" class="cursor-pointer bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-indigo-100 transition inline-block">
                                    Choose Photo
                                </label>
                                <input id="image-upload" type="file" name="image" class="hidden" onchange="previewImage(this)">
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-4 leading-relaxed">Allowed: JPG, PNG, GIF. <br> Max Size: 2MB</p>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" required 
                                    class="w-full bg-gray-50 border-transparent border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition outline-none text-gray-800 placeholder-gray-400 shadow-inner" 
                                    placeholder="e.g. Rahul Sharma">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" required 
                                    class="w-full bg-gray-50 border-transparent border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition outline-none text-gray-800 placeholder-gray-400 shadow-inner" 
                                    placeholder="rahul@example.com">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">System Role</label>
                                <div class="relative">
                                    <select name="role" required class="w-full bg-gray-50 border-transparent border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-indigo-500 appearance-none outline-none text-gray-800 shadow-inner">
                                        <option value="customer">Customer</option>
                                        <option value="vendor">Vendor</option>
                                        <option value="admin">Administrator</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                                <input type="password" name="password" required 
                                    class="w-full bg-gray-50 border-transparent border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition outline-none text-gray-800 placeholder-gray-400 shadow-inner" 
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <div class="mt-10 flex items-center gap-4">
                            <button type="submit" class="flex-1 bg-indigo-600 text-white px-6 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Create Account
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
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-placeholder');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection