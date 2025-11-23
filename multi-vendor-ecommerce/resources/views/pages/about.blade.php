<x-layouts.site :title="__('About Us')">

{{-- ================= CUSTOM CSS ================= --}}
<style>
.about-wrapper { animation: fadeIn .7s ease; }
@keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to {opacity:1;} }

/* Hero */
.about-hero {
    background: linear-gradient(135deg, #ff8a00, #e52e71);
    color: #fff;
    padding: 70px 20px;
    border-radius: 18px;
    text-align: center;
    margin-bottom: 40px;
}
.about-hero h1 {
    font-size: 40px;
    font-weight: 700;
}
.about-hero p {
    font-size: 17px;
    opacity: .9;
}

/* Section Titles */
.section-title {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 15px;
}

/* Card Grid */
.info-card {
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
    transition: .4s;
    height: 100%;
    position: relative;
    overflow: hidden;
}
.info-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 35px rgba(0,0,0,.16);
}

/* Glowing border on hover */
.info-card::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 14px;
    padding: 2px;
    background: linear-gradient(135deg, #e52e71, #ff8a00);
    opacity: 0;
    transition: .4s;
    mask: 
        linear-gradient(#fff 0 0) content-box, 
        linear-gradient(#fff 0 0);
    mask-composite: exclude;
}
.info-card:hover::before { opacity: 1; }

.info-card i {
    font-size: 45px;
    color: #e52e71;
    margin-bottom: 12px;
}

/* Stats */
.stats-box {
    background: #fff;
    padding: 40px 25px;
    text-align: center;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,.08);
}
.stats-box h3 {
    font-size: 36px;
    font-weight: 800;
    color: #e52e71;
}
.stats-box p { font-size: 15px; }

/* Timeline */
.timeline {
    border-left: 3px solid #e52e71;
    padding-left: 25px;
    margin: 25px 0;
}
.timeline-item {
    margin-bottom: 25px;
}
.timeline-item h5 {
    font-weight: 600;
    color: #e52e71;
}

/* Promise Box */
.promise-box {
    background: #f8f9ff;
    padding: 28px;
    border-radius: 14px;
    border-left: 5px solid #e52e71;
    margin-top: 25px;
}

/* Grid responsiveness */
@media (min-width: 768px) {
    .card-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
}
</style>

{{-- ================= PAGE CONTENT ================= --}}
<div class="container py-5 about-wrapper">

    {{-- HERO SECTION --}}
    <div class="about-hero">
        <h1>About Our Marketplace</h1>
        <p>A modern multi-vendor platform built to empower sellers and delight customers.</p>
    </div>

    {{-- WHO WE ARE --}}
    <h2 class="section-title">Who We Are</h2>
    <p class="text-muted mb-4">
        We are a next-generation multi-vendor eCommerce marketplace that connects independent sellers, 
        brands, wholesalers, and manufacturers to millions of customers across India.
        Our platform helps vendors grow their business with powerful tools while offering customers 
        a secure and seamless shopping experience.
    </p>

    {{-- MISSION & VISION GRID --}}
    <div class="card-grid mb-5">

        <div class="info-card">
            <i class="fas fa-bullseye"></i>
            <h5 class="fw-bold">Our Mission</h5>
            <p>To build the most trusted marketplace that empowers small and large sellers to reach customers nationwide.</p>
        </div>

        <div class="info-card">
            <i class="fas fa-lightbulb"></i>
            <h5 class="fw-bold">Our Vision</h5>
            <p>To become India’s leading multi-vendor shopping destination with innovation and affordability at the core.</p>
        </div>

        <div class="info-card">
            <i class="fas fa-handshake"></i>
            <h5 class="fw-bold">Our Values</h5>
            <p>Transparency, trust, customer happiness, seller empowerment, and a seamless buying journey.</p>
        </div>

    </div>

    {{-- MARKETPLACE STATS --}}
    <h2 class="section-title">Our Growth</h2>
    <div class="stats-grid mb-5">

        <div class="stats-box">
            <h3>1500+</h3>
            <p>Active Vendors</p>
        </div>

        <div class="stats-box">
            <h3>45K+</h3>
            <p>Products Listed</p>
        </div>

        <div class="stats-box">
            <h3>2M+</h3>
            <p>Monthly Visitors</p>
        </div>

        <div class="stats-box">
            <h3>98%</h3>
            <p>Customer Satisfaction</p>
        </div>

    </div>

    {{-- TIMELINE / JOURNEY --}}
    <h2 class="section-title">Our Journey</h2>
    <div class="timeline">

        <div class="timeline-item">
            <h5>2021 — Beginning</h5>
            <p>Started as a small startup with just 12 vendors on board.</p>
        </div>

        <div class="timeline-item">
            <h5>2022 — Expansion</h5>
            <p>Launched nationwide shipping and onboarded 500+ sellers.</p>
        </div>

        <div class="timeline-item">
            <h5>2023 — Technology Upgrade</h5>
            <p>Introduced a new mobile-first UI, faster checkout, and better vendor dashboards.</p>
        </div>

        <div class="timeline-item">
            <h5>2024 — Today</h5>
            <p>Now serving millions of customers with thousands of vendors and premium brands.</p>
        </div>

    </div>

    {{-- PROMISE SECTION --}}
    <h2 class="section-title mt-5">Our Promise</h2>

    <div class="promise-box">
        <h5 class="fw-bold">For Customers</h5>
        <p>Best prices, genuine products, fast delivery, and easy returns—every time.</p>
    </div>

    <div class="promise-box">
        <h5 class="fw-bold">For Vendors</h5>
        <p>Zero complications, real-time insights, marketing tools, and quick payouts.</p>
    </div>

</div>

</x-layouts.site>
