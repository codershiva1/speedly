@php
    $user = auth()->user();
    $isCustomer = $user->role === 'customer';
@endphp

@if ($isCustomer)

<x-layouts.site :title="__('My Profile') . ' | ' . config('app.name')">
    <div class="bg-gray-50 min-h-screen pb-20">
        
        {{-- HEADER --}}
        <div class="bg-white border-b border-gray-100 py-8 mb-8">
            <div class="max-w-7xl mx-auto px-6">
                <h1 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic">Account <span class="text-green-600">Settings</span></h1>
                <p class="text-gray-500 text-sm font-medium mt-1">Manage your personal information, addresses, and orders.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div x-data="{ tab: 'profile', mobileMenuOpen: false }" class="relative">
                
                {{-- MOBILE MENU TRIGGER --}}
                <div class="lg:hidden mb-6">
                    <button @click="mobileMenuOpen = true" class="w-full flex items-center justify-between bg-white border border-gray-100 p-4 rounded-2xl shadow-sm group active:scale-[0.98] transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center text-white">
                                <i class="bi bi-list text-xl"></i>
                            </div>
                            <div class="text-left">
                                <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Navigation</span>
                                <span class="block text-sm font-black text-gray-900 uppercase italic tracking-tighter">Account Menu</span>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-gray-300 group-hover:text-green-600 transition-colors"></i>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    
                    {{-- SIDEBAR NAVIGATION --}}
                    <aside 
                        :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                        class="fixed lg:relative inset-y-0 left-0 w-80 lg:w-auto bg-white lg:bg-transparent z-[60] lg:z-0 transform transition-transform duration-300 ease-in-out lg:translate-x-0 shadow-2xl lg:shadow-none p-6 lg:p-0 overflow-y-auto lg:overflow-visible"
                    >
                        <div class="flex lg:hidden items-center justify-between mb-8 pb-4 border-b border-gray-50">
                            <h2 class="text-xl font-black text-gray-900 italic uppercase tracking-tighter">Menu</h2>
                            <button @click="mobileMenuOpen = false" class="text-gray-400 hover:text-red-500 transition-colors">
                                <i class="bi bi-x-lg text-xl"></i>
                            </button>
                        </div>

                        <div class="space-y-2">
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 overflow-hidden">
                                <nav class="space-y-1">
                                    <button @click="tab='profile'; mobileMenuOpen=false"
                                        :class="tab==='profile' ? 'bg-gray-900 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-50'"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest transition-all text-left">
                                        <i class="bi bi-person-circle text-lg"></i>
                                        <span>Profile Info</span>
                                    </button>

                                    <a href="{{ route('dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest text-gray-600 hover:bg-gray-50 transition-all">
                                        <i class="bi bi-speedometer2 text-lg"></i>
                                        <span>Dashboard</span>
                                    </a>

                                    <a href="{{ route('account.orders.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest text-gray-600 hover:bg-gray-50 transition-all">
                                        <i class="bi bi-box-seam text-lg"></i>
                                        <span>My Orders</span>
                                    </a>

                                    <button @click="tab='address'; mobileMenuOpen=false"
                                        :class="tab==='address' ? 'bg-gray-900 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-50'"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest transition-all text-left">
                                        <i class="bi bi-geo-alt text-lg"></i>
                                        <span>Addresses</span>
                                    </button>

                                    <a href="{{ route('wishlist.index')}}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest text-gray-600 hover:bg-gray-50 transition-all">
                                        <i class="bi bi-heart text-lg"></i>
                                        <span>Wishlist</span>
                                    </a>

                                    <a href="{{ route('account.cart.index')}}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest text-gray-600 hover:bg-gray-50 transition-all">
                                        <i class="bi bi-cart3 text-lg"></i>
                                        <span>My Cart</span>
                                    </a>

                                    <button @click="tab='security'; mobileMenuOpen=false"
                                        :class="tab==='security' ? 'bg-gray-900 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-50'"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest transition-all border-t border-gray-50 pt-4 mt-2 text-left">
                                        <i class="bi bi-shield-lock text-lg"></i>
                                        <span>Security</span>
                                    </button>
                                </nav>
                            </div>

                            {{-- HELP WIDGET --}}
                            <div class="bg-green-600 rounded-2xl p-6 text-white shadow-xl shadow-green-600/20">
                                <h4 class="font-black uppercase tracking-widest text-xs mb-2">Need Help?</h4>
                                <p class="text-[10px] text-white/80 leading-relaxed mb-4 font-medium">Contact our 24/7 support for any issues with your orders.</p>
                                <a href="#" class="inline-block bg-white text-green-600 px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">Support Center</a>
                            </div>
                        </div>
                    </aside>

                    {{-- MOBILE OVERLAY --}}
                    <div 
                        x-show="mobileMenuOpen" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        @click="mobileMenuOpen = false" 
                        class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 lg:hidden"
                    ></div>

                    {{-- MAIN CONTENT --}}
                    <main class="lg:col-span-3">
                    
                    {{-- STATUS NOTIFICATIONS --}}
                    @if(session('status'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl shadow-sm text-sm font-bold flex items-center gap-3">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ session('status') === 'profile-updated' ? 'Profile saved successfully!' : (session('status') === 'address-added' ? 'Address added successfully!' : session('status')) }}
                        </div>
                    @endif

                    <!-- ================= PROFILE TAB ================= -->
                    <section x-show="tab==='profile'" x-cloak class="space-y-6">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('patch')

                            <div class="flex flex-col md:flex-row gap-6">
                                {{-- LEFT: AVATAR --}}
                                <div class="w-full md:w-1/3 bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col items-center justify-center relative overflow-hidden group">
                                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-white opacity-40"></div>
                                    <div class="relative z-10 flex flex-col items-center w-full">
                                        <div class="relative w-32 h-32 rounded-full mb-6 shadow-2xl border-4 border-white cursor-pointer group-hover:border-green-100 transition-all font-inter" onclick="document.getElementById('avatarInput').click()">
                                            @if($user->image_url)
                                                <img id="avatarPreview" src="@storageUrl($user->image_url)" alt="Profile" class="w-full h-full object-cover rounded-full">
                                            @else
                                                <div id="avatarFallback" class="w-full h-full flex items-center justify-center bg-gray-900 text-white text-4xl font-black rounded-full italic">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <img id="avatarPreviewNew" src="#" alt="Preview" class="w-full h-full object-cover rounded-full hidden">
                                            @endif
                                            
                                            <div class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <i class="bi bi-camera text-white text-2xl"></i>
                                            </div>

                                            <div class="absolute bottom-0 right-0 bg-green-600 text-white p-2 rounded-full border-2 border-white shadow-lg">
                                                <i class="bi bi-pencil-fill text-[10px]"></i>
                                            </div>
                                        </div>
                                        <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*" onchange="previewImage(event)">
                                        <x-input-error class="mt-2 text-[10px]" :messages="$errors->get('avatar')" />
                                        
                                        <h3 class="text-xl font-black text-gray-900 italic uppercase tracking-tighter">{{ $user->name }}</h3>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mt-1">ID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>

                                {{-- RIGHT: CORE INFO --}}
                                <div class="w-full md:w-2/3 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">Personal Details</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">First Name</label>
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 border-gray-100 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl py-3 px-4 font-bold text-gray-800 transition-all" required>
                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Last Name</label>
                                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full bg-gray-50 border-gray-100 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl py-3 px-4 font-bold text-gray-800 transition-all">
                                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Email Address (Locked)</label>
                                            <div class="relative">
                                                <input type="email" value="{{ $user->email }}" disabled class="w-full bg-gray-100 border-gray-200 rounded-xl py-3 px-4 font-bold text-gray-400 cursor-not-allowed">
                                                <i class="bi bi-lock-fill absolute right-4 top-3.5 text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ADDITIONAL INFO --}}
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                                <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">Contact & Identity</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Mobile Number</label>
                                        <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}" class="w-full bg-gray-50 border-gray-100 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl py-3 px-4 font-bold text-gray-800 transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Gender</label>
                                        <select name="gender" class="w-full bg-gray-50 border-gray-100 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl py-3 px-4 font-bold text-gray-800 transition-all appearance-none">
                                            <option value="">Select</option>
                                            <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Date of Birth</label>
                                        <input type="date" name="dob" value="{{ old('dob', $user->dob) }}" class="w-full bg-gray-50 border-gray-100 focus:border-green-500 focus:ring-green-500 focus:bg-white rounded-xl py-3 px-4 font-bold text-gray-800 transition-all">
                                    </div>
                                </div>

                                <div class="flex justify-end mt-10">
                                    <button type="submit" class="w-full md:w-fit bg-gray-900 text-white font-black py-4 px-12 rounded-xl text-xs uppercase tracking-widest hover:bg-green-600 transition-all shadow-xl shadow-gray-900/10 active:scale-95">
                                        Save Profile Settings
                                    </button>
                                </div>
                            </div>
                        </form>
                    </section>

                    <!-- ================= ADDRESSES TAB ================= -->
                    <section x-show="tab==='address'" x-cloak class="space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <div class="flex items-center justify-between mb-8 border-b border-gray-50 pb-4">
                                <h4 class="text-xl font-black text-gray-900 italic uppercase tracking-tighter">My <span class="text-green-600">Addresses</span></h4>
                                <button @click="document.getElementById('addressFormSection').scrollIntoView({behavior: 'smooth'})" class="bg-gray-100 text-gray-900 px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-green-600 hover:text-white transition-all">
                                    + Add New
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($addresses as $address)
                                    <div class="group relative bg-gray-50/50 rounded-2xl p-5 border border-gray-100 hover:border-green-500 hover:bg-white transition-all">
                                        <span class="inline-block bg-white border border-gray-200 rounded px-2 py-1 text-[8px] font-black uppercase tracking-widest text-gray-400 mb-2 group-hover:bg-green-600 group-hover:text-white transition-colors">
                                            {{ $address->label }}
                                        </span>
                                        <h5 class="font-black text-gray-900 italic text-base uppercase tracking-tight">{{ $address->name }}</h5>
                                        <p class="text-[11px] text-gray-400 font-bold mb-4">{{ $address->phone }}</p>
                                        <div class="text-[10px] text-gray-500 font-medium leading-relaxed">
                                            {{ $address->address_line1 }},<br>
                                            {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-2 text-center py-12">
                                        <i class="bi bi-geo text-4xl text-gray-200"></i>
                                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs mt-4">No address added yet.</p>
                                    </div>
                                @endforelse
                            </div>

                            <div id="addressFormSection" class="mt-20 pt-10 border-t border-gray-100">
                                <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.3em] mb-8">Add New Address</h4>
                                <form method="POST" action="{{ route('profile.address.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @csrf
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Label (e.g. Home, Office)</label>
                                        <input name="label" required class="w-full bg-gray-50 border-gray-100 focus:border-green-500 rounded-xl py-3 px-4 font-bold text-gray-800">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Receiver Name</label>
                                        <input name="name" required class="w-full bg-gray-50 border-gray-100 focus:border-green-500 rounded-xl py-3 px-4 font-bold text-gray-800">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Phone Number</label>
                                        <input name="phone" required class="w-full bg-gray-50 border-gray-100 focus:border-green-500 rounded-xl py-3 px-4 font-bold text-gray-800">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Address Details</label>
                                        <input name="address_line1" required placeholder="Apartment, Street, etc." class="w-full bg-gray-50 border-gray-100 focus:border-green-500 rounded-xl py-3 px-4 font-bold text-gray-800">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">City</label>
                                        <input name="city" required class="w-full bg-gray-50 border-gray-100 focus:border-green-500 rounded-xl py-3 px-4 font-bold text-gray-800">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">State</label>
                                        <input name="state" required class="w-full bg-gray-50 border-gray-100 focus:border-green-500 rounded-xl py-3 px-4 font-bold text-gray-800">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 pl-1">Postal Code</label>
                                        <input name="postal_code" required class="w-full bg-gray-50 border-gray-100 focus:border-green-500 rounded-xl py-3 px-4 font-bold text-gray-800">
                                    </div>
                                    <div class="md:col-span-2">
                                        <button class="w-full bg-gray-900 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest hover:bg-green-600 transition-all shadow-xl shadow-gray-900/10">
                                            💾 Save Address
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- ================= SECURITY TAB ================= -->
                    <section x-show="tab==='security'" x-cloak class="space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                             @include('profile.partials.update-password-form')
                        </div>
                        <div class="bg-red-50 rounded-2xl p-8 border border-red-100">
                             @include('profile.partials.delete-user-form')
                        </div>
                    </section>

                </main>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                // 1. Show immediate preview for UX
                reader.onload = function(e) {
                    const preview = document.getElementById('avatarPreview');
                    const previewNew = document.getElementById('avatarPreviewNew');
                    const fallback = document.getElementById('avatarFallback');
                    
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    if (previewNew) {
                        previewNew.src = e.target.result;
                        previewNew.classList.remove('hidden');
                    }
                    if(fallback) fallback.classList.add('hidden');
                }
                reader.readAsDataURL(file);

                // 2. Upload immediately via AJAX
                const formData = new FormData();
                formData.append('avatar', file);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('profile.avatar.update') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(!data.success) {
                        alert(data.message || 'Failed to upload image. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error uploading avatar:', error);
                    alert('An error occurred while uploading. Ensure file size is below 2MB and format is correct.');
                });
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-layouts.site>

@else
<x-layouts.site :title="__('Profile')">
    <div class="py-12 max-w-7xl mx-auto px-6 space-y-6">
        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>
</x-layouts.site>
@endif
