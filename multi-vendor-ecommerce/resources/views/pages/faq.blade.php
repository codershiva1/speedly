<x-layouts.site :title="__('FAQ')">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6 text-sm">
        <h1 class="text-2xl font-semibold text-gray-900">Frequently Asked Questions</h1>
        <div class="space-y-4 text-gray-700">
            <div>
                <h2 class="font-semibold">How does this demo marketplace work?</h2>
                <p>This is a Laravel multi-vendor demo where multiple sellers can list products and customers can place orders with a unified checkout.</p>
            </div>
            <div>
                <h2 class="font-semibold">Is payment processing fully implemented?</h2>
                <p>For demo purposes, the flow uses Cash on Delivery (COD). Integrate your own gateway here for production.</p>
            </div>
            <div>
                <h2 class="font-semibold">Can I manage my own products as a vendor?</h2>
                <p>Yes, login as vendor and use the vendor dashboard to add, edit, and manage products and orders.</p>
            </div>
        </div>
    </div>
</x-layouts.site>
