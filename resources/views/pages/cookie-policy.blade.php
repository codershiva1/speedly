<x-layouts.site :title="__('Cookie Policy')">
    <div class="relative overflow-hidden">
        
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-amber-500 to-yellow-600  py-16 px-6 text-center">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-3 animate__animated animate__fadeInDown">
                Cookie Policy
            </h1>
            <p class="max-w-2xl mx-auto text-sm sm:text-base opacity-90 animate__animated animate__fadeInUp">
                Understand how and why we use cookies to improve your browsing experience on our marketplace.
            </p>
        </div>

        <!-- Main Content -->
        <div class="max-w-5xl mx-auto px-6 sm:px-10 py-12 space-y-10">

            <!-- Section 1 -->
            <div class="bg-white shadow-lg rounded-xl p-6 sm:p-8 border border-gray-100 hover:shadow-2xl transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">1. What Are Cookies?</h2>
                <p class="text-gray-700 leading-relaxed">
                    Cookies are small text files stored on your device when you visit our website. They help us
                    remember your preferences, enhance website functionality, and improve the overall user
                    experience.
                </p>
            </div>

            <!-- Section 2 -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 shadow rounded-xl p-6 sm:p-8 border border-gray-200 hover:shadow-xl transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">2. Types of Cookies We Use</h2>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Essential Cookies:</strong> Required for basic site features like navigation and cart functionality.</li>
                    <li><strong>Performance Cookies:</strong> Track website performance and loading times.</li>
                    <li><strong>Functional Cookies:</strong> Remember your preferences such as language and region.</li>
                    <li><strong>Analytics Cookies:</strong> Help us understand how users interact with the site.</li>
                    <li><strong>Advertising Cookies:</strong> Used for personalized product suggestions and remarketing.</li>
                </ul>
            </div>

            <!-- Section 3 -->
            <div class="bg-white shadow-lg rounded-xl p-6 sm:p-8 border border-gray-100 hover:shadow-2xl transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">3. Why We Use Cookies</h2>
                <p class="text-gray-700 leading-relaxed">
                    We use cookies to ensure a smooth shopping experience, improve website performance, show
                    relevant recommendations, and help vendors optimize their product visibility on the marketplace.
                </p>
            </div>

            <!-- Section 4 -->
            <div class="bg-gradient-to-br from-yellow-50 to-amber-100 shadow rounded-xl p-6 sm:p-8 border border-yellow-200 hover:shadow-xl transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">4. Managing Your Cookie Preferences</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    You can accept or reject cookies anytime using your browser settings. However, disabling certain
                    cookies may affect website functionality.
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <li>Block or delete cookies from browser settings.</li>
                    <li>Use incognito/private browsing mode.</li>
                    <li>Adjust tracking preferences with browser extensions.</li>
                </ul>
            </div>

            <!-- Section 5 -->
            <div class="bg-white shadow-lg rounded-xl p-6 sm:p-8 border border-gray-100 hover:shadow-2xl transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">5. Third-Party Cookies</h2>
                <p class="text-gray-700 leading-relaxed">
                    We may use third-party services such as Google Analytics, Meta Pixel, or advertising networks.
                    These third parties may also store cookies on your device to track browsing behavior across the
                    internet.
                </p>
            </div>

            <!-- Section 6 -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-200 shadow rounded-xl p-6 sm:p-8 border border-gray-200 hover:shadow-xl transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">6. Updates to This Cookie Policy</h2>
                <p class="text-gray-700 leading-relaxed">
                    We may update our cookie practices to comply with legal requirements or improve user experience.
                    All changes will be reflected on this page with a revised “Last Updated” date.
                </p>
                <p class="text-gray-600 text-sm mt-2">Last Updated: {{ date('F d, Y') }}</p>
            </div>

        </div>
    </div>
</x-layouts.site>
