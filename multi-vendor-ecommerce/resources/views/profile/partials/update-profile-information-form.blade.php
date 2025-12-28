<section class="bg-gradient-to-br from-gray-50 via-white to-gray-100 rounded-2xl shadow-lg border border-gray-100 p-8">

    <!-- HEADER -->
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            👤 Update Profile
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Update your personal details and keep your account secure.
        </p>
    </header>

    <!-- EMAIL VERIFICATION FORM -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- PROFILE FORM -->
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- NAME -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full rounded-xl focus:ring-2 focus:ring-indigo-500"
                :value="old('name', $user->name)"
                required
                autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- EMAIL -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full rounded-xl focus:ring-2 focus:ring-indigo-500"
                :value="old('email', $user->email)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm">
                    <p class="text-yellow-800 font-medium">
                        ⚠️ Your email address is not verified.
                    </p>

                    <button
                        form="send-verification"
                        class="mt-2 inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 underline text-sm font-medium">
                        🔁 Re-send verification email
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-green-600 text-sm font-medium">
                            ✅ Verification link sent successfully!
                        </p>
                    @endif
                </div>
            @else
                <p class="mt-2 text-xs text-green-600 flex items-center gap-1">
                    ✅ Email verified
                </p>
            @endif
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-4 pt-4">
            <x-primary-button
                class="px-8 py-2 rounded-xl text-base shadow-lg bg-indigo-600 hover:bg-indigo-700">
                💾 Save Changes
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600 font-medium"
                >
                    ✔ Profile updated successfully
                </p>
            @endif
        </div>

    </form>
</section>