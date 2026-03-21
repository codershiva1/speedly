<x-delivery-layout>
    <x-slot name="header">
        Rider Profile
    </x-slot>

    <div class="max-w-5xl mx-auto pb-10">
        
        @if(session('status'))
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl shadow-sm text-sm font-semibold">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl shadow-sm text-sm">
                <ul class="list-disc pl-5 mt-1 space-y-1 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('delivery.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Top Section: Avatar & Basic Info -->
            <div class="flex flex-col md:flex-row gap-6">
                
                <!-- Top-Left: Avatar -->
                <div class="w-full md:w-1/3 bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-white opacity-50 z-0"></div>
                    <div class="relative z-10 flex flex-col items-center w-full">
                        <div class="relative w-32 h-32 rounded-full mb-4 shadow-md border-4 border-white cursor-pointer group-hover:border-green-100 transition-all focus-within:ring-4 focus-within:ring-green-200" onclick="document.getElementById('avatarInput').click()" tabindex="0" role="button" aria-label="Update profile picture">
                            
                            @if($user->image_url)
                                <img id="avatarPreview" src="{{ asset('storage/' . $user->image_url) }}" alt="Rider Profile" class="w-full h-full object-cover rounded-full">
                            @else
                                <div id="avatarFallback" class="w-full h-full flex items-center justify-center bg-green-100 text-green-700 text-4xl font-extrabold rounded-full">
                                    {{ strtoupper(substr($user->name, 0, 1) . substr($user->last_name ?? '', 0, 1)) }}
                                </div>
                                <img id="avatarPreview" src="#" alt="Preview" class="w-full h-full object-cover rounded-full hidden">
                            @endif

                            <!-- Edit Icon Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16s-1 0-1-1V5s0-1 1-1h10s1 0 1 1v10s0 1-1 1H3zm11-1H3M8 12l2-2 4 4m2-4v4"></path></svg>
                            </div>
                            
                            <!-- Small floating edit icon -->
                            <div class="absolute bottom-0 right-0 bg-green-600 text-white p-2 rounded-full border-2 border-white shadow-sm hover:bg-green-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </div>
                        </div>
                        
                        <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*" onchange="previewImage(event)">
                        
                        <h3 class="text-xl font-bold text-gray-800 mt-2 text-center">{{ $user->name }} {{ $user->last_name }}</h3>
                        <p class="text-[11px] font-extrabold text-green-600 uppercase tracking-widest mt-1 bg-green-50 px-3 py-1 rounded-full border border-green-100">Delivery Partner</p>
                    </div>
                </div>

                <!-- Top-Right: Basic Information -->
                <div class="w-full md:w-2/3 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 space-y-6">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-2">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Basic Information
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">First Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">Phone / Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wide mb-1.5 pl-1">Email Address</label>
                            <div class="relative">
                                <input type="email" value="{{ $user->email }}" disabled class="w-full bg-gray-100 border-gray-200 rounded-xl shadow-sm font-medium text-gray-500 px-4 py-3 cursor-not-allowed">
                                <span class="absolute right-3 top-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-5">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        Vehicle Details
                    </h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">Vehicle Type (Optional)</label>
                        <select name="vehicle_type" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors appearance-none">
                            <option value="">Select Vehicle Type</option>
                            <option value="bike" {{ old('vehicle_type', $profile?->vehicle_type) === 'bike' ? 'selected' : '' }}>Motorbike</option>
                            <option value="scooty" {{ old('vehicle_type', $profile?->vehicle_type) === 'scooty' ? 'selected' : '' }}>Scooter</option>
                            <option value="bicycle" {{ old('vehicle_type', $profile?->vehicle_type) === 'bicycle' ? 'selected' : '' }}>Bicycle</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">Vehicle Registration Number (Optional)</label>
                        <input type="text" name="vehicle_number" value="{{ old('vehicle_number', $profile?->vehicle_number) }}" placeholder="e.g. MH 01 AB 1234" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors uppercase">
                    </div>
                </div>
            </div>

            <!-- Bank Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-5">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Bank Details for Payouts
                    </h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">Bank Name (Optional)</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', $profile?->bank_name) }}" placeholder="e.g. HDFC Bank" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">Account Number (Optional)</label>
                        <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $profile?->bank_account_number) }}" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 pl-1">IFSC Code (Optional)</label>
                        <input type="text" name="bank_ifsc" value="{{ old('bank_ifsc', $profile?->bank_ifsc) }}" placeholder="e.g. HDFC0001234" class="w-full bg-gray-50 border-gray-200 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl shadow-sm font-semibold text-gray-800 px-4 py-3 transition-colors uppercase">
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end pt-2">
                <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-4 px-10 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all outline-none focus:ring-4 focus:ring-green-300">
                    Save Profile Settings
                </button>
            </div>
            
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const preview = document.getElementById('avatarPreview');
                    const fallback = document.getElementById('avatarFallback');
                    
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    
                    if(fallback) {
                        fallback.classList.add('hidden');
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-delivery-layout>
