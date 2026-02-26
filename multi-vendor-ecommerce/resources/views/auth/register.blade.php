<x-guest-layout>
    <style>
        /* Custom Styles for the premium look */
        .form-input-custom {
            width: 100%;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
            color: #374151;
            background-color: white;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            outline: none;
        }
        .form-input-custom:focus {
            border-color: #2d4d30;
            box-shadow: 0 0 0 2px rgba(45, 77, 48, 0.2);
        }
        .left-panel { background-color: #2d4d30; }
        .right-panel { background-color: #e2ede1; }
        .btn-register {
            background-color: #53724f;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background-color: #435c3f;
            transform: translateY(-1px);
        }
    </style>

    <div class="flex min-h-screen items-stretch overflow-hidden w-full">
        
        <div class="left-panel hidden md:flex md:w-1/2 md:p-12 lg:p-20 flex-col justify-start relative overflow-hidden text-white shrink-0">
            <div class="absolute -top-16 -left-16 w-64 h-64 rounded-full bg-white/5 pointer-events-none"></div>
            <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-white/5 pointer-events-none"></div>

            <div class="relative z-10 max-w-lg mx-auto md:mx-0">
                <div class="flex items-center mb-10">
                    <img src="https://speedlymart.com/storage/uploads/logo/speedlylogo4.png" alt="Logo" class="h-14 w-auto object-contain">
                </div>
                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">Join Our Growing Community!</h1>
                <p class="text-green-100 text-base lg:text-xl opacity-80 mb-12 leading-relaxed">Shop amazing products, sell your goods, or deliver smiles.</p>
                
                <div class="flex gap-8 mb-8 text-white/50 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177V14.25m0 0H8.25m11.25-14.25h-4.5" /></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                </div>
                <p class="text-[12px] font-bold text-green-300 uppercase tracking-[0.3em]">Become a seller & delivery partner</p>
            </div>
        </div>

        <div class="right-panel w-full md:w-1/2 p-6 md:p-12 lg:p-20 flex flex-col justify-start relative min-h-screen">
            <div class="absolute -bottom-12 -right-12 w-64 h-64 rounded-full bg-[#2d4d30]/5 pointer-events-none"></div>

                 <!-- Logo for mobile only -->
            <div class="md:hidden flex justify-center mb-8">
                <img src="https://speedlymart.com/storage/uploads/logo/speedlylogo4.png" alt="Speedly Logo" class="h-10 w-auto object-contain">
            </div>

            <div class="relative z-10 w-full max-w-xl mx-auto flex flex-col">
                <div class="mb-8 md:mb-10">
                    <h2 class="text-[#2d4d30] text-2xl lg:text-4xl font-black tracking-tight text-center md:text-left leading-tight">Create Your Account</h2>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <input id="name" type="text" name="name" placeholder="First Name" value="{{ old('name') }}" required autofocus class="form-input-custom" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div>
                            <input id="last_name" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required class="form-input-custom" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <input id="email" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required class="form-input-custom" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>
                        <div>
                            <input id="mobile" type="tel" name="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}" required class="form-input-custom" />
                            <x-input-error :messages="$errors->get('mobile')" class="mt-1" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="relative">
                            <select name="gender" required class="form-input-custom appearance-none bg-white text-gray-400 cursor-pointer">
                                <option value="" disabled selected>Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <!-- <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>
                            </div> -->
                        </div>
                        <div class="relative flex items-center">
                            <!-- <span class="absolute left-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest pointer-events-none">DOB</span> -->
                            <input type="date" name="dob" value="{{ old('dob') }}" required class="form-input-custom pl-16 text-gray-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <input id="password" type="password" name="password" placeholder="Password" required class="form-input-custom" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                        <div>
                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-input-custom" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex items-center gap-3 py-2 justify-center">
                        <input type="checkbox" id="terms" name="terms" required class="w-5 h-5 accent-[#2d4d30] rounded cursor-pointer">
                        <label for="terms" class="text-xs text-gray-500 font-medium cursor-pointer">
                            I agree to the <span class="text-[#2d4d30] font-bold hover:underline">Terms & Conditions</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center gap-6 pt-2">
                        <button type="submit" class="btn-register w-full sm:w-auto px-16 py-4 text-white font-bold rounded-full shadow-xl uppercase tracking-[0.2em] text-sm">
                            {{ __('Register Now') }}
                        </button>

                        <div class="relative w-full flex items-center justify-center">
                            <div class="border-b border-gray-300 w-full"></div>
                            <span class="absolute bg-[#e2ede1] px-4 text-[10px] text-[#2d4d30] font-bold uppercase tracking-[0.1em] whitespace-nowrap">Or Register with social</span>
                        </div>
                        
                        <div class="flex gap-8">
                            <a href="#" class="text-gray-400 hover:text-[#2d4d30] transition-transform hover:scale-110">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/></svg>
                            </a>

                             <a href="#" class="text-gray-500 hover:text-[#2d4d30] transition-transform hover:scale-110">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M19,3H5C3.895,3,3,3.895,3,5v14c0,1.105,0.895,2,2,2h14c1.105,0,2-0.895,2-2V5C21,3.895,20.105,3,19,3z M9,17H6.477v-7H9V17z M7.694,8.717c-0.771,0-1.286-0.514-1.286-1.2s0.514-1.2,1.371-1.2c0.771,0,1.286,0.514,1.286,1.2S8.466,8.717,7.694,8.717z M18,17h-2.442v-3.826c0-1.058-0.651-1.302-0.895-1.302s-1.058,0.163-1.058,1.302V17h-2.442v-7h2.442v1.1c0.7-0.7,1.6-1.1,2.5-1.1c2.2,0,4,1.8,4,4V17z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-[#2d4d30] transition-transform hover:scale-110">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.325-.593 1.325-1.325v-21.351c0-.732-.593-1.325-1.325-1.325z"/></svg>
                            </a>
                        </div>

                        <p class="text-gray-600 text-sm font-medium">
                            Already have an account? <a href="{{ route('login') }}" class="text-[#2d4d30] font-extrabold hover:underline">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>