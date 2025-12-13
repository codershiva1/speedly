<x-layouts.site :title="__('Cancellation Policy')">

<style>
/* ===== Cancellation Policy — Unique Design ===== */
.cancel-page {
  max-width: 1100px;
  margin: 0 auto;
  padding: 36px 18px;
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  color: #1f2937;
}

/* Header card with icon */
.cancel-hero {
  display: flex;
  gap: 18px;
  align-items: center;
  background: linear-gradient(90deg, rgba(245,247,255,1), rgba(239,246,255,1));
  border-radius: 14px;
  padding: 22px;
  border: 1px solid rgba(14,165,233,0.08);
  margin-bottom: 20px;
}

.cancel-hero .logo {
  width: 72px;
  height: 72px;
  border-radius: 14px;
  background: linear-gradient(90deg,#06b6d4,#3b82f6);
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  font-weight:700;
  font-size:20px;
  box-shadow: 0 8px 30px rgba(59,130,246,0.12);
}

.cancel-hero h1 {
  margin: 0;
  font-size: 24px;
  font-weight: 700;
}

.cancel-hero p {
  margin: 0;
  color: #475569;
}

/* main content */
.cancel-box {
  background: #fff;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 12px 30px rgba(2,6,23,0.04);
}

/* section headings */
.c-section {
  margin-bottom: 18px;
}
.c-section h3 {
  font-size: 18px;
  margin-bottom: 8px;
  color: #0f172a;
}
.c-section p, .c-section ul {
  color: #334155;
  line-height: 1.7;
  font-size: 15px;
}

/* rules grid */
.rules-grid {
  display: grid;
  gap: 14px;
  margin-top: 12px;
}
@media(min-width:768px){ .rules-grid { grid-template-columns: 1fr 1fr; } }

.rule-card {
  background: linear-gradient(180deg,#fff,#fbfdff);
  border: 1px solid #eef2f7;
  padding: 14px;
  border-radius: 10px;
}

/* timeline bar */
.timeline {
  display:flex;
  gap:10px;
  align-items:center;
  margin-top: 14px;
}
.timeline .step {
  flex:1;
  background:#f1f5f9;
  padding:10px;
  border-radius:10px;
  text-align:center;
  font-size:13px;
  color:#334155;
  position:relative;
}
.timeline .step.active {
  background: linear-gradient(90deg,#06b6d4,#3b82f6);
  color:#fff;
  box-shadow: 0 8px 20px rgba(59,130,246,0.12);
}

/* callout */
.cancel-note {
  margin-top: 12px;
  padding: 12px;
  border-left: 4px solid rgba(59,130,246,0.12);
  background: linear-gradient(90deg, rgba(59,130,246,0.03), rgba(99,102,241,0.02));
  border-radius: 8px;
  color:#334155;
}

/* sample form */
.cancel-form {
  display:grid;
  gap:10px;
  margin-top: 14px;
}
.cancel-form input, .cancel-form select, .cancel-form textarea {
  padding:10px 12px;
  border-radius:8px;
  border:1px solid #e6eef7;
  background:#fbfdff;
  font-size:14px;
}

/* small footer */
.cancel-foot {
  margin-top:20px;
  font-size:13px;
  color:#6b7280;
}
</style>

<div class="cancel-page">

  <header class="cancel-hero" role="banner">
    <div class="logo">C</div>
    <div>
      <h1>Cancellation Policy</h1>
      <p>Clear rules and easy steps for order cancellation — for buyers and vendors.</p>
    </div>
  </header>

  <main class="cancel-box" role="main">

    <section class="c-section">
      <h3>Overview</h3>
      <p>We understand plans change. This Cancellation Policy explains when and how orders can be cancelled, timelines for refunds, vendor obligations, and special cases (preorders, made-to-order items).</p>
    </section>

    <section class="c-section">
      <h3>Cancellation Windows</h3>
      <ul>
        <li>Buyer-initiated cancellation is allowed <strong>before the vendor marks the order as dispatched</strong>.</li>
        <li>Once the order is marked as “Dispatched” or “Out for Delivery”, cancellation may not be possible through the normal flow — follow the return process once delivered.</li>
        <li>Preorder or custom-made items are cancellable only within 24 hours of order placement unless vendor policy states otherwise.</li>
      </ul>

      <div class="cancel-note">
        <strong>Quick tip:</strong> Use the “Cancel Order” button in your order details immediately after placing the order to speed up cancellation.
      </div>
    </section>

    <section class="c-section">
      <h3>How Cancellation Works (Buyer)</h3>
      <div class="rules-grid">
        <div class="rule-card">
          <strong>Step 1 — Request</strong>
          <p>Open the order in My Orders and click "Cancel Order" with reason.</p>
        </div>
        <div class="rule-card">
          <strong>Step 2 — Vendor Response</strong>
          <p>Vendor must accept or reject cancellation within 24 hours. If vendor doesn't respond, the platform may auto-approve.</p>
        </div>
        <div class="rule-card">
          <strong>Step 3 — Refund</strong>
          <p>Refunds are processed after vendor confirms cancellation. Time to reflect depends on the payment method.</p>
        </div>
        <div class="rule-card">
          <strong>Step 4 — Confirmation</strong>
          <p>You'll receive an email/SMS once cancellation and refund are completed.</p>
        </div>
      </div>

      <div class="timeline" aria-hidden="true">
        <div class="step">Placed</div>
        <div class="step active">Cancellation Request</div>
        <div class="step">Vendor Confirm</div>
        <div class="step">Refund</div>
      </div>
    </section>

    <section class="c-section">
      <h3>When Cancellation May Be Denied</h3>
      <ul>
        <li>Order already packed/shipped by vendor at time of cancellation.</li>
        <li>Perishable or custom products after the 24-hour window.</li>
        <li>Items restricted by vendor policy (clearly indicated on product page).</li>
      </ul>
    </section>

    <section class="c-section">
      <h3>Refund Timelines & Methods</h3>
      <p>Refunds are processed after cancellation confirmation. Typical timelines:</p>
      <ul>
        <li>Payment gateway refunds (cards/UPI/netbanking): 3–10 business days.</li>
        <li>Marketplace wallet refunds: typically instant (if option chosen).</li>
        <li>COD cancellations may be credited as wallet credit or via bank transfer depending on vendor settings.</li>
      </ul>
    </section>

    <section class="c-section">
      <h3>Vendor Obligations</h3>
      <p>Vendors must:</p>
      <ul>
        <li>Respond to cancellation requests within 24 hours;</li>
        <li>Not unreasonably refuse cancellations for orders not yet dispatched;</li>
        <li>Timely process refunds and update order status;</li>
        <li>Communicate any cancellation fees or restocking charges prior to sale.</li>
      </ul>
    </section>

    <section class="c-section">
      <h3>Cancellation Fees & Restocking</h3>
      <p>In some categories a small restocking fee may apply (e.g., large appliances or special orders). Any fee will be disclosed on the product page and applied before refund is issued.</p>
    </section>

    <section class="c-section">
      <h3>Special Cases</h3>
      <ul>
        <li><strong>Fraud or payment issues:</strong> If a payment fails or suspected fraud is detected, orders may be auto-cancelled by the platform.</li>
        <li><strong>Vendor out-of-stock:</strong> Vendors who cannot fulfill an order must cancel and notify buyers immediately and initiate refunds.</li>
      </ul>
    </section>

    <section class="c-section">
      <h3>How to Submit a Cancellation Request (Sample Form)</h3>

      {{-- Blade sample cancellation form; wire up to your controller --}}
      <form method="POST" action="" class="cancel-form" novalidate>
        @csrf
        <input type="text" name="order_id" placeholder="Enter Order ID (e.g. ORD12345)" required>
        <select name="reason" required>
          <option value="">Select reason for cancellation</option>
          <option value="changed_mind">Changed my mind</option>
          <option value="found_better_price">Found better price</option>
          <option value="wrong_item">Ordered wrong item</option>
          <option value="other">Other</option>
        </select>
        <textarea name="details" rows="3" placeholder="Optional: additional details"></textarea>
        <div>
          <button class="btn btn-primary" type="submit">Submit Cancellation Request</button>
        </div>
      </form>

      <p class="cancel-foot">Note: This form is an example. Implement server-side validation, email notification to vendor/admin, and update order status appropriately in your controller.</p>
    </section>

    <section class="c-section">
      <h3>Contact Support</h3>
      <p>If you need immediate help, contact our support team:</p>
      <p><strong>Email:</strong> support@yourmarketplace.com &nbsp; | &nbsp; <strong>Phone:</strong> +91 98765 43210</p>
    </section>

    <div class="cancel-foot">
      <p>Last updated: <strong>{{ date('F j, Y') }}</strong></p>
      <p>This Cancellation Policy provides guidance for buyers and sellers. It is a template — adapt as needed and review with legal counsel to ensure compliance with local consumer protection laws.</p>
    </div>

  </main>

</div>

</x-layouts.site>
