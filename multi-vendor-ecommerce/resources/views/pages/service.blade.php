<x-layouts.site :title="__('Customer Service')">

{{-- ================= CUSTOM CSS ================= --}}
<style>
/* Page Fade */
.service-wrapper { animation: fadeIn .8s ease; }
@keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }

/* Hero Section */
.service-hero {
    background: linear-gradient(135deg, #5d2cff 0%, #00b3ff 100%);
    padding: 60px 20px;
    border-radius: 18px;
    color: #fff;
    text-align: center;
    margin-bottom: 40px;
}

.service-hero h1 {
    font-size: 38px;
    font-weight: 700;
}

.service-hero p {
    font-size: 17px;
    opacity: .9;
}

/* Service Grid */
.service-card {
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
    transition: .4s;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.service-card i {
    font-size: 42px;
    color: #5d2cff;
    margin-bottom: 12px;
}

.service-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,.15);
}

/* Animated border glow */
.service-card::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 14px;
    padding: 2px;
    background: linear-gradient(135deg, #00b3ff, #5d2cff);
    opacity: 0;
    transition: .4s;
    mask: 
        linear-gradient(#fff 0 0) content-box, 
        linear-gradient(#fff 0 0);
    mask-composite: exclude;
}

.service-card:hover::before {
    opacity: 1;
}

/* FAQ */
.faq-item {
    border: 1px solid #ddd;
    padding: 18px;
    border-radius: 10px;
    background: #fff;
    margin-bottom: 15px;
    transition: .3s;
}
.faq-item:hover {
    border-color: #5d2cff;
    box-shadow: 0 6px 20px rgba(0,0,0,.08);
}

/* Policy box */
.policy-box {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
    margin-bottom: 25px;
}

/* Contact */
.support-box {
    background: #5d2cff;
    padding: 35px;
    color: #fff;
    border-radius: 16px;
    text-align: center;
}

.support-box h3 {
    font-size: 28px;
    font-weight: 600;
}

.support-box p { opacity: .9; }

/* Responsive Grid */
@media (min-width: 768px) {
    .service-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
}
</style>

{{-- ================= PAGE CONTENT ================= --}}
<div class="container py-5 service-wrapper">

    {{-- HERO SECTION --}}
    <div class="service-hero">
        <h1>Customer Service</h1>
        <p>Your complete guide to shipping, returns, warranty, payments & vendor support</p>
    </div>

    {{-- SERVICE FEATURES GRID --}}
    <h2 class="fw-bold mb-3">Our Services</h2>
    <div class="service-grid">

        <div class="service-card">
            <i class="fas fa-shipping-fast"></i>
            <h5 class="fw-bold">Fast Shipping</h5>
            <p>Standard & express delivery options with real-time tracking updates.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-undo"></i>
            <h5 class="fw-bold">Easy Returns</h5>
            <p>Simple return process with doorstep pickup and instant refund initiation.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-shield-alt"></i>
            <h5 class="fw-bold">Warranty Protection</h5>
            <p>Brand warranty on electronics, mobile devices, appliances, and accessories.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-headset"></i>
            <h5 class="fw-bold">24/7 Support</h5>
            <p>Our support team is always available for order, payment, or delivery issues.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-credit-card"></i>
            <h5 class="fw-bold">Secure Payments</h5>
            <p>100% SSL secure transactions with COD and UPI options.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-store"></i>
            <h5 class="fw-bold">Vendor Assistance</h5>
            <p>Dedicated seller helpdesk for onboarding, catalog upload & order handling.</p>
        </div>

    </div>

    <hr class="my-5">

    {{-- POLICY SECTIONS --}}
    <h2 class="fw-bold mb-3">Policies</h2>

    <div class="policy-box">
        <h4 class="fw-bold">Shipping Policy</h4>
        <p>Orders are dispatched within 24–48 hours. Express delivery available for selected cities.</p>
    </div>

    <div class="policy-box">
        <h4 class="fw-bold">Return & Refund Policy</h4>
        <p>Return window ranges from 7–10 days depending on the product category. Refunds are issued within 2–5 working days.</p>
    </div>

    <div class="policy-box">
        <h4 class="fw-bold">Warranty Policy</h4>
        <p>Brand warranty applies to all eligible electronics & accessories. Claims can be raised via our support team.</p>
    </div>

    <hr class="my-5">

    {{-- FAQ --}}
    <h2 class="fw-bold mb-3">Frequently Asked Questions</h2>

    <div class="faq-item">
        <h6 class="fw-bold">How can I track my order?</h6>
        <p>You can track your order in the "My Orders" section using the tracking ID.</p>
    </div>

    <div class="faq-item">
        <h6 class="fw-bold">How to request a return?</h6>
        <p>Open your order details and click “Request Return.” We will arrange pickup.</p>
    </div>

    <div class="faq-item">
        <h6 class="fw-bold">Are my payments secure?</h6>
        <p>Yes. All transactions are processed through certified secure channels.</p>
    </div>

    <div class="faq-item">
        <h6 class="fw-bold">How can vendors contact support?</h6>
        <p>Sellers can raise tickets from their vendor dashboard or via email.</p>
    </div>

    <hr class="my-5">

    {{-- CONTACT SUPPORT --}}
    <div class="support-box">
        <h3>Need Help?</h3>
        <p>Our support team is ready to assist you anytime.</p>

        <p class="mt-3 mb-0"><strong>Email:</strong> support@yourmarket.com</p>
        <p class="mb-0"><strong>Phone:</strong> +91 98765 43210</p>
    </div>

</div>

</x-layouts.site>
