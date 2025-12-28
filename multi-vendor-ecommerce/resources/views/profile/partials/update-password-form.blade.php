<section class="bg-gradient-to-br from-indigo-50 via-white to-gray-100 rounded-2xl shadow-lg border border-gray-100 p-8">

    <!-- HEADER -->
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            🔐 Update Password
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Use a strong, unique password to keep your account protected from unauthorized access.
        </p>
    </header>

    <!-- PASSWORD FORM -->
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- CURRENT PASSWORD -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full rounded-xl focus:ring-2 focus:ring-indigo-500"
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- NEW PASSWORD -->
        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1 block w-full rounded-xl focus:ring-2 focus:ring-indigo-500"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

            <!-- PASSWORD TIP -->
            <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                💡 Use at least 8 characters, including letters, numbers & symbols
            </p>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm New Password')" />
            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full rounded-xl focus:ring-2 focus:ring-indigo-500"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- SECURITY NOTE -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-sm text-blue-700 flex gap-2">
            🛡️ <span>For your security, you’ll be logged out from other devices after changing your password.</span>
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-4 pt-4">
            <x-primary-button
                class="px-8 py-2 rounded-xl text-base shadow-lg bg-indigo-600 hover:bg-indigo-700">
                🔄 Update Password
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600 font-medium"
                >
                    ✅ Password updated successfully
                </p>
            @endif
        </div>

    </form>
</section>
