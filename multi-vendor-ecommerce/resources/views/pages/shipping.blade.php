<x-layouts.site :title="__('Shipping & Delivery Policy')">

<style>
/* ===== Unique Design Style (Shipping) ===== */

.ship-page {
    max-width: 1150px;
    margin: 0 auto;
    padding: 36px 18px;
    font-family: Inter, system-ui, sans-serif;
    color: #1e293b;
}

.ship-hero {
    background: url('https://images.unsplash.com/photo-1607083204584-25db27d08c88?auto=format&q=80&w=1600')
    center/cover no-repeat;
    padding: 70px 30px;
    border-radius: 14px;
    color: #fff;
    margin-bottom: 24px;
    position: relative;
    overflow:hidden;
}

.ship-hero::after {
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(180deg,rgba(0,0,0,.3),rgba(0,0,0,.6));
}

.ship-hero-content {
    position:relative;
    z-index:5;
}

.ship-hero h1 {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 8px;
}

.ship-box {
    background: #fff;
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.06);
}

.ship-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
}

.ship-text {
    font-size: 15px;
    color: #475569;
    line-height: 1.7;
}

/* Delivery zones grid */
.zone-grid {
    display: grid;
    gap: 18px;
}
@media (min-width: 768px) {
    .zone-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.zone-card {
    border-radius: 12px;
    background: linear-gradient(180deg, #fff, #f8fbff);
    border: 1px solid #e4ecf5;
    padding: 18px;
    text-align: center;
    box-shadow: 0 8px 28px rgba(17, 24, 39, 0.05);
}

.zone-card h4 {
    margin-bottom: 6px;
    font-size: 17px;
    font-weight: 700;
}

.zone-card p {
    font-size: 14px;
    color: #475569;
}

/* Timeline Steps */
.timeline {
    margin: 25px 0;
    padding-left: 16px;
    border-left: 3px solid #3b82f6;
}

.t-step {
    margin-bottom: 20px;
    position: relative;
}

.t-step::before {
    content: "";
    position: absolute;
    left: -11px;
    top: 4px;
    width: 14px;
    height: 14px;
    background: #3b82f6;
    border-radius: 50%;
}

.t-step h4 {
    margin:0;
    font-size: 16px;
    font-weight: 700;
    color:#1e293b;
}

.t-step p {
    margin: 4px 0 0;
    color: #475569;
    font-size: 14px;
}

/* Callout */
.ship-callout {
    background: linear-gradient(90deg,rgba(34,197,94,0.07),rgba(16,185,129,0.08));
    padding: 14px;
    border-radius: 10px;
    border-left: 4px solid #16a34a;
    margin-top: 10px;
    font-size: 14px;
    color:#065f46;
}
</style>


<div class="ship-page">

    <!-- HERO -->
    <div class="ship-hero">
        <div class="ship-hero-content">
            <h1>Shipping & Delivery Policy</h1>
            <p class="text-lg">Know how deliveries work, timelines, zones, courier partners & handling rules.</p>
        </div>
    </div>

    <!-- Delivery Overview -->
    <div class="ship-box">
        <h3 class="ship-title">Overview</h3>
        <p class="ship-text">
            Our marketplace partners with multiple vendors and trusted courier partners to ensure fast,
            safe, and trackable delivery across India. Delivery timelines may vary depending on the
            vendor's warehouse location, product availability, and customer’s delivery pincode.
        </p>
    </div>

    <!-- Shipping Zones -->
    <div class="ship-box">
        <h3 class="ship-title">Delivery Zones & Estimated Timelines</h3>
        <p class="ship-text">Below are typical delivery timelines for most orders:</p>

        <div class="zone-grid mt-4">
            <div class="zone-card">
                <h4>Zone A – Metro Cities</h4>
                <p>2–4 business days</p>
            </div>
            <div class="zone-card">
                <h4>Zone B – Tier 1 & 2 Cities</h4>
                <p>3–6 business days</p>
            </div>
            <div class="zone-card">
                <h4>Zone C – Remote Areas</h4>
                <p>5–10 business days</p>
            </div>
        </div>

        <div class="ship-callout mt-4">
            Timelines may change during festivals, large sales events, or bad weather conditions.
        </div>
    </div>

    <!-- Shipping Process Timeline -->
    <div class="ship-box">
        <h3 class="ship-title">Shipping Process</h3>

        <div class="timeline">
            <div class="t-step">
                <h4>1. Order Confirmation</h4>
                <p>Your order is verified and forwarded to the vendor within minutes.</p>
            </div>
            <div class="t-step">
                <h4>2. Vendor Processing</h4>
                <p>The vendor packs the item and generates a courier label (1–2 business days).</p>
            </div>
            <div class="t-step">
                <h4>3. Courier Pickup</h4>
                <p>The courier partner picks up the order from the warehouse.</p>
            </div>
            <div class="t-step">
                <h4>4. In Transit</h4>
                <p>Your order moves through courier hubs. Tracking is updated in real time.</p>
            </div>
            <div class="t-step">
                <h4>5. Out for Delivery</h4>
                <p>The package is sent to your local delivery center and marked as “Out for Delivery”.</p>
            </div>
            <div class="t-step">
                <h4>6. Delivered</h4>
                <p>Order is delivered to your doorstep with OTP/signature verification.</p>
            </div>
        </div>
    </div>

    <!-- Shipping Charges -->
    <div class="ship-box">
        <h3 class="ship-title">Shipping Charges</h3>
        <p class="ship-text">
            Shipping fees depend on the product, vendor, weight, volumetric size, and customer location.
            Some vendors offer **free shipping**, while others follow standard courier rate charts.
        </p>
        <div class="ship-callout">
            Free shipping offers (if available) will be shown on the product page.
        </div>
    </div>

    <!-- COD Policy -->
    <div class="ship-box">
        <h3 class="ship-title">Cash on Delivery (COD)</h3>
        <p class="ship-text">
            COD is available for select pincodes and product categories. High-value or oversized items
            may require prepaid payment for security reasons.
        </p>
    </div>

    <!-- Delays & Exceptions -->
    <div class="ship-box">
        <h3 class="ship-title">Delays & Exceptional Situations</h3>
        <p class="ship-text">Your order may get delayed due to:</p>
        <ul class="list-disc pl-6 text-sm text-slate-600 leading-7">
            <li>Bad weather or natural disruptions</li>
            <li>Courier operational delays</li>
            <li>Incorrect delivery address or unreachable phone</li>
            <li>High volume during festivals</li>
        </ul>

        <div class="ship-callout">
            If your order is delayed beyond the maximum timeline, contact our support team for a priority update.
        </div>
    </div>

    <!-- Support -->
    <div class="ship-box">
        <h3 class="ship-title">Need Help?</h3>
        <p class="ship-text">For any shipping-related issues, contact:</p>
        <p class="ship-text font-semibold">
            Email: support@yourmarketplace.com <br>
            Phone: +91-98765-43210
        </p>
    </div>

</div>

</x-layouts.site>
