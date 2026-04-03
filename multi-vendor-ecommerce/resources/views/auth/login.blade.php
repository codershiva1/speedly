<x-guest-layout>
    <div class="flex h-screen w-full overflow-hidden font-['Segoe_UI',_sans-serif]">
        
        <div class="hidden md:block md:w-1/2 h-screen overflow-hidden">
            
            {{-- url('public/images/grocery-basket.png') --}}
            <img src="https://speedlymart.com/public/images/grocery-basket.png" class="w-full h-full object-cover">
        </div>

        <div class="w-full md:w-1/2 bg-[#eef3ee] flex justify-center items-center p-4">
            <div class="w-full max-w-[420px] p-10 rounded-[20px]">

                <a href="{{ url('/') }}">
                    <img class="w-[150px] mb-5" src="@storageUrl('uploads/logo/speedlylogo4.png')" alt="Logo">
                </a>

                <h1 class="text-[28px] font-bold mb-[5px] text-black">Welcome back 👋</h1>
                <p class="text-[#6b7280] mb-[25px]">Login to continue shopping fresh groceries</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-[18px]">
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Email address" 
                               required autofocus
                               class="w-full p-3.5 border border-[#d1d5db] rounded-[12px] text-sm outline-none focus:border-[#16a34a] focus:ring-4 focus:ring-[#16a34a]/10 transition-all bg-white" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-[18px]">
                        <input id="password" 
                               type="password" 
                               name="password" 
                               placeholder="Password" 
                               required
                               class="w-full p-3.5 border border-[#d1d5db] rounded-[12px] text-sm outline-none focus:border-[#16a34a] focus:ring-4 focus:ring-[#16a34a]/10 transition-all bg-white" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex justify-between items-center text-sm mb-5">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#16a34a] focus:ring-[#16a34a]">
                            <span class="ms-2 text-gray-600">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-[#16a34a] hover:underline" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full p-3.5 bg-[#2e7d32] hover:bg-[#1b5e20] text-white font-semibold text-[15px] rounded-[40px] transition-all duration-300 uppercase">
                        LOGIN TO SPEEDLYMART
                    </button>

                    <div class="text-center my-5 text-[#777]">Or login with</div>

                    <div class="flex justify-center gap-[15px]">
                        <a href="#" class="w-[42px] h-[42px] flex items-center justify-center rounded-full bg-[#1DA1F2] text-white hover:opacity-90">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                <path d="M22 5.8c-.7.3-1.5.6-2.3.7.8-.5 1.4-1.3 1.7-2.3-.8.5-1.7.9-2.6 1.1A4.1 4.1 0 0015.5 4c-2.3 0-4.2 1.9-4.2 4.2 0 .3 0 .6.1.9-3.5-.2-6.6-1.9-8.7-4.6-.4.6-.6 1.3-.6 2 0 1.4.7 2.6 1.8 3.3-.6 0-1.2-.2-1.7-.5v.1c0 2 1.4 3.6 3.3 4-.3.1-.7.1-1 .1-.2 0-.5 0-.7-.1.5 1.6 2 2.8 3.8 2.8A8.3 8.3 0 012 18.6 11.7 11.7 0 008.3 20c7.6 0 11.7-6.3 11.7-11.7v-.5c.8-.6 1.5-1.3 2-2z"/>
                            </svg>
                        </a>

                        <a href="#" class="w-[42px] h-[42px] flex items-center justify-center rounded-full bg-white hover:bg-gray-50 border border-gray-100 shadow-sm">
                            <svg viewBox="0 0 48 48" width="18" height="18">
                                <path fill="#EA4335" d="M24 9.5c3.1 0 5.9 1.1 8.1 3.3l6-6C34.2 2.4 29.5 0 24 0 14.6 0 6.7 5.4 2.7 13.3l7.2 5.6C11.8 13 17.4 9.5 24 9.5z"/>
                                <path fill="#34A853" d="M46.1 24.5c0-1.6-.1-2.7-.4-4H24v7.6h12.6c-.3 2-1.8 5-5.1 7l7.9 6.1c4.6-4.2 7.2-10.4 7.2-16.7z"/>
                                <path fill="#FBBC05" d="M9.9 28.9A14.5 14.5 0 019.5 24c0-1.7.3-3.4.9-4.9l-7.2-5.6A23.8 23.8 0 000 24c0 3.9.9 7.6 2.7 10.7l7.2-5.8z"/>
                                <path fill="#4285F4" d="M24 48c6.5 0 12-2.1 16-5.7l-7.9-6.1c-2.2 1.5-5 2.5-8.1 2.5-6.6 0-12.2-4.4-14.2-10.4l-7.2 5.8C6.7 42.6 14.6 48 24 48z"/>
                            </svg>
                        </a>

                        <a href="#" class="w-[42px] h-[42px] flex items-center justify-center rounded-full bg-[#1877F2] text-white hover:opacity-90">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                <path d="M22 12a10 10 0 10-11.6 9.9v-7h-2.7V12h2.7V9.8c0-2.7 1.6-4.2 4-4.2 1.2 0 2.4.2 2.4.2v2.7h-1.4c-1.4 0-1.9.9-1.9 1.8V12h3.2l-.5 2.9h-2.7v7A10 10 0 0022 12z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="text-center mt-5 text-sm text-gray-600">
                        New to SpeedlyMart?
                        <a href="{{ route('register') }}" class="text-[#16a34a] font-semibold hover:underline">Create account</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>