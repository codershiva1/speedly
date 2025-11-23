<x-layouts.site :title="__('Vendor Agreement')">

<section class="relative bg-gray-50 py-16 px-6">

    {{-- Decorative SVG Background --}}
    <div class="absolute inset-0 -z-10 opacity-40 bg-fixed"
         style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');">
    </div>

    {{-- Header --}}
    <div class="max-w-5xl mx-auto text-center mb-12">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 animate-fade-in">
            Vendor Agreement & Seller Policy
        </h1>
        <p class="text-sm sm:text-base text-gray-600 mt-3 animate-slide-up">
            Please read carefully before registering as a vendor on our platform.
        </p>
    </div>

    <div class="max-w-5xl mx-auto space-y-10 text-gray-700">

        {{-- Section 1: Introduction --}}
        <div class="group bg-white border border-gray-200 p-8 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl font-semibold text-gray-900 mb-3">1. Introduction</h2>
            <p class="text-sm leading-relaxed">
                By registering as a vendor on our marketplace, you agree to comply with all rules,
                guidelines, and policies stated in this Vendor Agreement. This policy ensures a safe,
                transparent, and professional experience for sellers and customers.
            </p>
        </div>

        {{-- Section 2: Eligibility --}}
        <div class="group bg-blue-50 border border-blue-200 p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
            <h2 class="text-xl font-semibold text-blue-900 mb-3">2. Vendor Eligibility</h2>
            <ul class="text-sm list-disc list-inside space-y-1">
                <li>You must be 18 years or older.</li>
                <li>You must have a valid phone number and email address.</li>
                <li>You must provide accurate business details (GST, PAN, Address proof, etc.).</li>
                <li>All products must be genuine and legally allowed for sale in India.</li>
            </ul>
        </div>

        {{-- Section 3: Product Listing Policy --}}
        <div class="group bg-white border border-gray-200 p-8 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl font-semibold text-gray-900 mb-3">3. Product Listing Policy</h2>
            <p class="text-sm leading-relaxed mb-2">
                Vendors are responsible for the accuracy, images, pricing, stock information, and descriptions
                of the products they upload. Listing rules:
            </p>
            <ul class="list-disc list-inside text-sm space-y-1">
                <li>No duplicate listings.</li>
                <li>No misleading images or descriptions.</li>
                <li>Only licensed and authentic products are allowed.</li>
                <li>Variation details (size, color, model) must be listed clearly.</li>
            </ul>
        </div>

        {{-- Section 4: Order Fulfillment --}}
        <div class="group bg-gray-900 text-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
            <h2 class="text-xl font-semibold mb-3">4. Order Packing & Shipping</h2>
            <ul class="text-sm list-disc list-inside space-y-1">
                <li>Orders must be shipped within 1–2 working days.</li>
                <li>Packing must be secure to avoid damage in transit.</li>
                <li>Tracking ID must be updated immediately after dispatch.</li>
                <li>Non-compliance may result in penalties or account restrictions.</li>
            </ul>
        </div>

        {{-- Section 5: Commission & Payments --}}
        <div class="group bg-green-50 border border-green-200 p-8 rounded-xl shadow-md hover:shadow-lg transition-all">
            <h2 class="text-xl font-semibold text-green-900 mb-3">5. Commission & Payment Settlement</h2>
            <p class="text-sm leading-relaxed">
                The platform charges a fixed commission on every order. Commission depends on category and
                seller tier level.
            </p>
            <ul class="list-disc list-inside text-sm mt-2 space-y-1">
                <li>Payment settlement is processed every 7 days.</li>
                <li>Order must be marked as delivered to start payment cycle.</li>
                <li>Refund/Return cases delay payment release until resolved.</li>
            </ul>
        </div>

        {{-- Section 6: Prohibited Items --}}
        <div class="group bg-red-50 border border-red-200 p-8 rounded-xl shadow-md hover:shadow-lg transition-all">
            <h2 class="text-xl font-semibold text-red-900 mb-3">6. Prohibited Items</h2>
            <p class="text-sm leading-relaxed mb-2">The following items are strictly banned:</p>
            <ul class="list-disc list-inside text-sm space-y-1">
                <li>Fake, replica, or counterfeit products</li>
                <li>Alcohol, tobacco, explosive or hazardous materials</li>
                <li>Illegal or stolen items</li>
                <li>Adult or restricted products without license</li>
            </ul>
        </div>

        {{-- Section 7: Returns & Seller Responsibility --}}
        <div class="group bg-white border border-gray-200 p-8 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl font-semibold mb-3">7. Returns, Refunds & Liability</h2>
            <p class="text-sm leading-relaxed">
                Vendors are responsible for quality issues, wrong shipments, and manufacturing defects.
                If the return rate exceeds platform limits, penalties may apply.
            </p>
        </div>

        {{-- Section 8: Account Termination --}}
        <div class="group bg-indigo-50 border border-indigo-200 p-8 rounded-xl shadow-md hover:shadow-lg transition-all">
            <h2 class="text-xl font-semibold text-indigo-900 mb-3">8. Account Suspension & Termination</h2>
            <p class="text-sm leading-relaxed">
                The platform may temporarily block or permanently terminate vendor accounts involved in fraud,
                policy violations, poor customer service, or frequent cancellations.
            </p>
        </div>

        {{-- Section 9: Acceptance --}}
        <div class="group bg-gray-100 border border-gray-300 p-8 rounded-xl shadow-md hover:shadow-xl transition-all">
            <h2 class="text-xl font-semibold mb-3">9. Vendor Acceptance</h2>
            <p class="text-sm leading-relaxed">
                By registering, you confirm that you have read, understood, and agreed to the terms of this Vendor Agreement.
            </p>
        </div>

    </div>

</section>


<style>
@keyframes fade-in {
    0% { opacity: 0; transform: translateY(10px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.8s ease-out forwards; }

@keyframes slide-up {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-slide-up { animation: slide-up 1s ease-out forwards; }
</style>

</x-layouts.site>
