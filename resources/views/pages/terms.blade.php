<x-layouts.site :title="__('Terms & Conditions')">

<style>
/* Global page styling */
.legal-page {
  padding: 36px 16px;
  max-width: 1100px;
  margin: 0 auto;
  color: #333;
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}

/* Hero */
.legal-hero {
  background: linear-gradient(90deg, rgba(93,44,255,0.08), rgba(0,179,255,0.06));
  border-radius: 12px;
  padding: 26px;
  margin-bottom: 22px;
  display:flex;
  gap: 20px;
  align-items: center;
}
.legal-hero .title {
  margin: 0;
  font-size: 26px;
  font-weight: 700;
}
.legal-hero p { margin: 0; color: #555; }

/* Content layout */
.legal-content {
  background: #fff;
  border-radius: 12px;
  padding: 26px;
  box-shadow: 0 10px 30px rgba(17,24,39,0.04);
}

/* Section headings */
.legal-section {
  margin-bottom: 22px;
}
.legal-section h3 {
  font-size: 18px;
  margin-bottom: 12px;
  color: #1f2937;
}
.legal-section p, .legal-section li {
  color: #374151;
  line-height: 1.65;
  font-size: 15px;
}

/* Lists */
.legal-section ul {
  margin-left: 18px;
  margin-top: 8px;
  padding-left: 16px;
}

/* Note / callout */
.legal-note {
  background: linear-gradient(90deg, rgba(93,44,255,0.04), rgba(0,179,255,0.03));
  border-left: 4px solid rgba(93,44,255,0.12);
  padding: 14px;
  border-radius: 8px;
  margin: 16px 0;
  color: #374151;
}

/* Small print / foot */
.legal-foot {
  margin-top: 28px;
  color: #6b7280;
  font-size: 13px;
}

/* Responsive tweaks */
@media (max-width: 767px) {
  .legal-hero { flex-direction: column; align-items: flex-start; gap: 6px; }
  .legal-hero .title { font-size: 20px; }
  .legal-content { padding: 18px; }
}
</style>

<div class="legal-page">

  <div class="legal-hero" role="banner">
    <div>
      <h1 class="title">Terms &amp; Conditions</h1>
      <p class="mt-1">Important legal information governing use of the marketplace — please read carefully.</p>
    </div>
  </div>

  <div class="legal-content" role="main">

    <div class="legal-section">
      <h3>1. Introduction</h3>
      <p>Welcome to <strong>YourMarketplace</strong> (the “Site,” “Platform” or “Marketplace”). These Terms &amp; Conditions ("Terms") govern your access to and use of our marketplace services, websites, APIs, mobile applications and related services (collectively, the "Services"). By using or accessing our Services you accept and agree to be bound by these Terms.</p>
    </div>

    <div class="legal-section">
      <h3>2. Who can use the Service</h3>
      <p>The Services are available only to persons who can form legally binding contracts under applicable law. You must be at least 18 years old (or the minimum age in your jurisdiction) to use the Services and create an account. By creating an account you represent that you meet this age requirement and that the information you provide is accurate.</p>
    </div>

    <div class="legal-section">
      <h3>3. Account registration &amp; security</h3>
      <p>To use certain features you must create an account. When you register you agree to provide accurate and complete information, keep your password secure, and notify us immediately of any unauthorized use. You are responsible for all activity on your account and should not share credentials.</p>
      <ul>
        <li>Keep your password confidential and change it periodically.</li>
        <li>We may suspend or terminate accounts that violate these Terms or for security reasons.</li>
      </ul>
    </div>

    <div class="legal-section">
      <h3>4. Buyers &amp; Orders</h3>
      <p>When a buyer places an order, the contract for sale is between the buyer and the vendor offering the product. We act as the marketplace operator and facilitate transactions, but payment processing, product fulfillment, and warranties are the responsibility of the individual vendors unless otherwise stated.</p>
      <ul>
        <li>Order confirmations are sent by email — keep your contact details current.</li>
        <li>Prices listed include or exclude taxes depending on displayed tax rules; final price shown at checkout is binding.</li>
      </ul>
    </div>

    <div class="legal-section">
      <h3>5. Vendor responsibilities</h3>
      <p>Vendors who list products on the Marketplace must comply with our seller policies. Vendors are responsible for:</p>
      <ul>
        <li>Accurate product listings, images and descriptions;</li>
        <li>Timely order fulfilment and shipping;</li>
        <li>Warranty &amp; returns management as per their listed policy;</li>
        <li>Complying with local laws (e.g., taxes, product safety).</li>
      </ul>
    </div>

    <div class="legal-section">
      <h3>6. Pricing, payments &amp; commissions</h3>
      <p>All payments processed through the Marketplace are subject to the payment gateway terms and commissions set by the Marketplace operator. We may deduct applicable commissions, fees and charges before disbursing payouts to vendors. Payment settlement schedules are posted in the vendor dashboard.</p>
    </div>

    <div class="legal-section">
      <h3>7. Intellectual property</h3>
      <p>All content on the Site (including logos, graphics, text, images and code) is owned by the Marketplace or its licensors and protected by copyright, trademark and other laws. You may not copy, reproduce, modify or create derivative works without prior written permission. Vendors grant the Marketplace a worldwide license to display their product content for the purpose of providing the Services.</p>
    </div>

    <div class="legal-section">
      <h3>8. User content &amp; reviews</h3>
      <p>Customers and vendors may post reviews, ratings, or other content. By posting content you grant us a non-exclusive, royalty-free license to use, reproduce, and display it. You represent that you own or have the right to post the content and that it does not infringe any third-party rights.</p>
      <div class="legal-note">
        <strong>Note:</strong> We may remove or moderate content that violates our policies, is harmful, or illegal.
      </div>
    </div>

    <div class="legal-section">
      <h3>9. Prohibited activities</h3>
      <p>When using the Services you must not:</p>
      <ul>
        <li>Engage in fraud, misrepresentation, or unauthorized transactions;</li>
        <li>Upload malware or malicious code;</li>
        <li>Use the Services to promote hate, violence, or illegal activities;</li>
        <li>Interfere with the operation or security of the Platform.</li>
      </ul>
    </div>

    <div class="legal-section">
      <h3>10. Limitation of liability</h3>
      <p>To the maximum extent permitted by law, the Marketplace and its affiliates, officers, employees and agents are not liable for any indirect, incidental, special, punitive or consequential damages arising out of or related to your use of the Services. Our aggregate liability for direct damages is limited to an amount not to exceed the fees paid by you to the Marketplace in the 12 months prior to the claim.</p>
    </div>

    <div class="legal-section">
      <h3>11. Indemnification</h3>
      <p>You agree to indemnify, defend, and hold harmless the Marketplace and its affiliates from any claim, demand, loss, liability, or expense arising from your breach of these Terms or your misuse of the Services.</p>
    </div>

    <div class="legal-section">
      <h3>12. Termination</h3>
      <p>We may suspend or terminate accounts and access to the Services at any time for violations of these Terms, suspected fraud, or legal reasons. On termination, certain provisions (intellectual property, limitations of liability, indemnification) survive.</p>
    </div>

    <div class="legal-section">
      <h3>13. Governing law &amp; dispute resolution</h3>
      <p>These Terms are governed by the laws of the jurisdiction in which the Marketplace operates (for example, India). Any dispute arising under these Terms will be governed by the exclusive jurisdiction of the competent courts in that jurisdiction, unless otherwise agreed in writing.</p>
    </div>

    <div class="legal-section">
      <h3>14. Changes to these Terms</h3>
      <p>We may update these Terms from time to time. If we make material changes, we will notify you by posting the updated Terms on the Site and/or via email. Continued use of the Services after changes constitutes acceptance of the updated Terms.</p>
    </div>

    <div class="legal-section">
      <h3>15. Contact us</h3>
      <p>If you have questions about these Terms, please contact our legal team at <a href="mailto:legal@yourmarketplace.com">legal@yourmarketplace.com</a> or use the Contact Us page.</p>
    </div>

    <div class="legal-foot">
      <p>Last updated: <strong>{{ date('F j, Y') }}</strong></p>
      <p>These Terms &amp; Conditions were generated for a multi-vendor marketplace. They are provided for informational purposes and do not constitute legal advice. For legal certainty, obtain advice from a qualified attorney in your jurisdiction.</p>
    </div>

  </div>

</div>

</x-layouts.site>
