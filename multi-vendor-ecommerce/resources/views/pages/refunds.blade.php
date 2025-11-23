<x-layouts.site :title="__('Refund & Return Policy')">

<style>
/* ===== Refund & Return Policy Styles ===== */
.refund-page {
  max-width: 1100px;
  margin: 0 auto;
  padding: 36px 16px;
  color: #24303a;
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}

.refund-hero {
  background: linear-gradient(90deg, rgba(0,179,255,0.06), rgba(93,44,255,0.06));
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 20px;
  display:flex;
  gap: 16px;
  align-items: center;
}
.refund-hero h1 { margin: 0; font-size: 26px; font-weight: 700; color: #0f172a; }
.refund-hero p { margin: 0; color: #475569; }

.refund-box {
  background: #fff;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 10px 30px rgba(17,24,39,0.04);
  margin-bottom: 20px;
}

.refund-section h3 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #0f172a;
}
.refund-section p, .refund-section li {
  color: #334155;
  line-height: 1.7;
  font-size: 15px;
}

.refund-list { margin-left: 18px; padding-left: 16px; }

.refund-steps {
  display: grid;
  gap: 14px;
  margin: 10px 0 20px;
}
@media (min-width: 768px) {
  .refund-steps { grid-template-columns: repeat(4, 1fr); }
}

.step {
  background: linear-gradient(180deg, #fff, #fbfdff);
  border: 1px solid #eef2f7;
  padding: 14px;
  border-radius: 10px;
  text-align: center;
  font-size: 14px;
}
.step .num {
  display: inline-block;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: linear-gradient(90deg,#00b3ff,#5d2cff);
  color: #fff;
  line-height: 36px;
  font-weight: 700;
  margin-bottom: 8px;
}

.return-form {
  display: grid;
  gap: 10px;
  margin-top: 14px;
}
.return-form label { font-size: 14px; color: #374151; }
.return-form input, .return-form textarea, .return-form select {
  width: 100%;
  padding: 10px 12px;
  border-radius: 8px;
  border: 1px solid #e6eef7;
  background: #fafcff;
  font-size: 14px;
}

/* callout */
.refund-callout {
  border-left: 4px solid rgba(93,44,255,0.12);
  background: linear-gradient(90deg, rgba(93,44,255,0.03), rgba(0,179,255,0.02));
  padding: 12px;
  border-radius: 8px;
  margin: 12px 0;
  color: #334155;
}

/* policy table style (simple) */
.policy-grid {
  display: grid;
  gap: 14px;
}
@media (min-width: 768px) {
  .policy-grid { grid-template-columns: 1fr 1fr; }
}

.note {
  font-size: 13px;
  color: #6b7280;
}

.refund-foot {
  margin-top: 24px;
  color: #6b7280;
  font-size: 13px;
}
</style>

<div class="refund-page">

  <header class="refund-hero" role="banner">
    <div>
      <h1>Refund &amp; Return Policy</h1>
      <p>Clear, fair and easy: how returns are handled, refund timelines, vendor responsibilities and exceptions.</p>
    </div>
  </header>

  <main class="refund-box" role="main">

    <section class="refund-section">
      <h3>Overview</h3>
      <p>We understand returns and refunds are an important part of online shopping. This policy explains how you can request returns, the eligibility criteria, timelines for refund processing, and the responsibilities of vendors and the Marketplace.</p>
    </section>

    <section class="refund-section">
      <h3>Return Eligibility</h3>
      <p>Most products are eligible for return within <strong>7–10 calendar days</strong> from the date of delivery, subject to the following conditions:</p>
      <ul class="refund-list">
        <li>Product is unused and in original condition with all tags, accessories and original packaging.</li>
        <li>Proof of purchase (order invoice / order ID) is provided.</li>
        <li>The return request is submitted within the specified return window shown on the product page.</li>
      </ul>
      <div class="refund-callout">
        <strong>Note:</strong> Per-category return windows may differ (e.g., perishable goods, intimate apparel). Check the product’s return policy on the product page for exceptions.
      </div>
    </section>

    <section class="refund-section">
      <h3>Non-returnable / Restricted Items</h3>
      <p>The following items are typically non-returnable unless they are defective or incorrectly shipped:</p>
      <ul class="refund-list">
        <li>Perishable goods (food, groceries)</li>
        <li>Opened personal care items, cosmetics, or intimate apparel</li>
        <li>Gift cards, downloadable software, and digital goods</li>
        <li>Products marked as non-returnable on the product page</li>
      </ul>
    </section>

    <section class="refund-section">
      <h3>Return &amp; Refund Process (Customer)</h3>

      <div class="refund-steps">
        <div class="step">
          <div class="num">1</div>
          <div><strong>Open Order</strong><br>Go to <em>My Orders</em> and select the order.</div>
        </div>
        <div class="step">
          <div class="num">2</div>
          <div><strong>Request Return</strong><br>Click <em>Request Return</em> and select the items &amp; reason.</div>
        </div>
        <div class="step">
          <div class="num">3</div>
          <div><strong>Pickup / Drop-off</strong><br>We or the vendor will arrange courier pickup or provide drop-off instructions.</div>
        </div>
        <div class="step">
          <div class="num">4</div>
          <div><strong>Refund</strong><br>After inspection, refund is processed to the original payment method.</div>
        </div>
      </div>

      <p class="note">If you face difficulty, contact support with your order number — we help coordinate returns and keep you updated.</p>
    </section>

    <section class="refund-section">
      <h3>Inspection &amp; Refund Timelines</h3>
      <p>After the returned item is received by the vendor / warehouse, it is inspected for eligibility. Typical timelines:</p>
      <ul class="refund-list">
        <li><strong>Pickup to Inspection:</strong> 2–5 business days depending on courier & location.</li>
        <li><strong>Inspection Completion:</strong> 1–3 business days from receipt.</li>
        <li><strong>Refund Processing:</strong> Refunds are initiated within 2 business days after inspection. The time taken to reflect in your account depends on the payment method (3–10 business days for card payments, immediate for wallet/COD adjustments in some cases).</li>
      </ul>
      <div class="refund-callout">
        <strong>Important:</strong> Refunds are credited only after successful inspection. Damaged, missing accessories, or opened products may lead to partial deductions.
      </div>
    </section>

    <section class="refund-section">
      <h3>Refund Methods</h3>
      <p>Refunds will be made to the original payment method wherever possible (card, UPI, netbanking). In some cases the refund may be credited as:</p>
      <ul class="refund-list">
        <li>Refund to the original card / bank account (may take 3–10 business days depending on the bank)</li>
        <li>Refund to the marketplace wallet (instant credit) — if the customer opts in</li>
        <li>Store credit or exchange vouchers (only if permitted by the vendor)</li>
      </ul>
    </section>

    <section class="refund-section">
      <h3>Exchanges</h3>
      <p>Exchanges (replace with same product or another variant) are allowed where the vendor has stock and exchange is offered on the product page. The exchange process follows the same return flow; an exchange item is shipped once the returned item is accepted.</p>
    </section>

    <section class="refund-section">
      <h3>Return Shipping &amp; Costs</h3>
      <p>Return shipping costs depend on the reason for return:</p>
      <div class="policy-grid">
        <div class="refund-box">
          <h4>Vendor / Marketplace Error</h4>
          <p>When the return is due to vendor error (wrong item / defective / damaged), return shipping is <strong>free</strong> and the vendor bears the cost.</p>
        </div>
        <div class="refund-box">
          <h4>Customer Change of Mind</h4>
          <p>If the return is due to change of mind, the customer may be responsible for return shipping unless a prepaid return label is offered at checkout.</p>
        </div>
      </div>
    </section>

    <section class="refund-section">
      <h3>Restocking Fees &amp; Deductions</h3>
      <p>In rare cases, vendors may apply a restocking fee (e.g., for large appliances or special-order items). Deductions may also apply for missing accessories or damage attributable to customer misuse. Any such deductions will be communicated during the inspection process.</p>
    </section>

    <section class="refund-section">
      <h3>Vendor &amp; Marketplace Responsibilities</h3>
      <ul class="refund-list">
        <li><strong>Vendor:</strong> Process returns, inspect returned items, and communicate delays. Vendors must follow marketplace return SLAs.</li>
        <li><strong>Marketplace:</strong> Coordinate pickups, process refunds if vendor is non-responsive, and step in to resolve disputes.</li>
      </ul>
    </section>

    <section class="refund-section">
      <h3>Refund Disputes &amp; Chargebacks</h3>
      <p>If you believe a refund was wrongly denied, contact our support team and provide order details. If a chargeback is initiated with your bank, we will investigate. Unjustified chargebacks may result in vendor or buyer account action.</p>
    </section>

    <section class="refund-section">
      <h3>Warranty vs Return</h3>
      <p>Warranty claims are separate from returns. If an item is defective after the return window but covered by manufacturer warranty, please raise a warranty claim with the vendor via the vendor support process or follow the warranty policy on this site.</p>
    </section>

    <section class="refund-section">
      <h3>How to Submit a Return Request (Sample Form)</h3>
      <p>Use this form to submit a return request quickly. The form below is an example you can adapt to your routes/controllers.</p>

      {{-- Sample Blade form - adapt route & CSRF as needed --}}
      <form method="POST" action="" class="return-form" novalidate>
        @csrf
        <label for="order_id">Order ID</label>
        <input id="order_id" name="order_id" type="text" placeholder="e.g. ORD123456" required>

        <label for="item_sku">Product / SKU</label>
        <input id="item_sku" name="item_sku" type="text" placeholder="e.g. SKU-001" required>

        <label for="reason">Reason for Return</label>
        <select id="reason" name="reason" required>
          <option value="">Select reason</option>
          <option value="defective">Defective / Damaged</option>
          <option value="wrong_item">Wrong item received</option>
          <option value="no_longer_needed">No longer needed</option>
          <option value="other">Other</option>
        </select>

        <label for="details">Additional Details</label>
        <textarea id="details" name="details" rows="3" placeholder="Describe the issue..." required></textarea>

        <button class="btn btn-primary" type="submit">Submit Return Request</button>
      </form>

      <p class="note mt-2">After submitting, our support or the vendor will contact you with pickup instructions and estimated inspection timelines.</p>
    </section>

    <section class="refund-section">
      <h3>Special Cases &amp; Exceptions</h3>
      <ul class="refund-list">
        <li>Customized or personalized items may not be eligible for standard returns unless faulty.</li>
        <li>Clearance / final sale items will show "No returns" on the product page where applicable.</li>
        <li>If a vendor goes out of business, the Marketplace will attempt to process refunds where possible, subject to payment provider rules.</li>
      </ul>
    </section>

    <section class="refund-section">
      <h3>Contact &amp; Support</h3>
      <p>If you have questions or need help with a return, contact our support team:</p>
      <p><strong>Email:</strong> refunds@yourmarketplace.com<br>
         <strong>Phone:</strong> +91-98765-43210</p>

      <div class="refund-callout">
        For urgent issues (damaged or safety-related), please call support immediately and keep photos of the product and packaging ready for faster resolution.
      </div>
    </section>

    <div class="refund-foot">
      <p>Last updated: <strong>{{ date('F j, Y') }}</strong></p>
      <p>This Refund &amp; Return Policy is a template prepared for your marketplace. Depending on local consumer protection laws, specific timelines or obligations may vary — consult legal counsel to ensure full compliance.</p>
    </div>

  </main>

</div>

</x-layouts.site>
