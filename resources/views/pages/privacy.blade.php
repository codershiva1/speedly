<x-layouts.site :title="__('Privacy Policy')">

<style>
/* ====== Privacy Page Styles ====== */
.privacy-page {
  max-width: 1100px;
  margin: 0 auto;
  padding: 36px 16px;
  color: #24303a;
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}

/* Hero */
.privacy-hero {
  background: linear-gradient(90deg, rgba(0,179,255,0.06), rgba(93,44,255,0.06));
  border-radius: 12px;
  padding: 22px;
  display:flex;
  gap: 18px;
  align-items: center;
  margin-bottom: 22px;
}
.privacy-hero h1 { margin: 0; font-size: 26px; font-weight: 700; color: #102129; }
.privacy-hero p { margin: 0; color: #475569; }

/* Content box */
.privacy-box {
  background: #fff;
  border-radius: 12px;
  padding: 26px;
  box-shadow: 0 10px 30px rgba(17,24,39,0.04);
}

/* Sections */
.privacy-section {
  margin-bottom: 22px;
}
.privacy-section h3 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #0f172a;
}
.privacy-section p, .privacy-section li {
  color: #334155;
  line-height: 1.7;
  font-size: 15px;
}

/* Lists */
.privacy-list {
  margin-left: 18px;
  padding-left: 16px;
}

/* Callout */
.privacy-callout {
  background: linear-gradient(90deg, rgba(93,44,255,0.03), rgba(0,179,255,0.02));
  border-left: 4px solid rgba(93,44,255,0.12);
  padding: 12px;
  border-radius: 8px;
  margin: 14px 0;
  color: #334155;
}

/* small print */
.privacy-foot {
  margin-top: 22px;
  color: #6b7280;
  font-size: 13px;
}

/* table-like list for third parties */
.thirdparty-list {
  display: grid;
  gap: 8px;
}
.thirdparty-item {
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #eef2f7;
  background: #fbfdff;
  font-size: 14px;
}

/* mobile */
@media (max-width: 767px) {
  .privacy-hero { flex-direction: column; align-items: flex-start; gap: 8px; }
  .privacy-box { padding: 18px; }
}
</style>

<div class="privacy-page">

  <header class="privacy-hero" role="banner">
    <div>
      <h1>Privacy Policy</h1>
      <p>We respect your privacy. This policy explains how we collect, use, disclose, and protect your personal data when you use our marketplace.</p>
    </div>
  </header>

  <main class="privacy-box" role="main">

    <section class="privacy-section">
      <h3>1. Scope &amp; Acceptance</h3>
      <p>These Privacy Policy terms ("Policy") apply to the services provided by <strong>YourMarketplace</strong> and describe how we collect and process personal information through our website, mobile apps, APIs, and related services (collectively, the "Services"). By using the Services or providing personal data to us, you agree to the terms of this Policy.</p>
    </section>

    <section class="privacy-section">
      <h3>2. Information We Collect</h3>
      <p>We collect information necessary to provide and improve the Services. The types of information we collect include:</p>
      <ul class="privacy-list">
        <li><strong>Account information:</strong> name, email address, phone number, password, billing and shipping address.</li>
        <li><strong>Transactional data:</strong> order details, products purchased, vendor information, payment method metadata (not full card data).</li>
        <li><strong>Communications:</strong> messages with support, emails, SMS, and chat transcripts.</li>
        <li><strong>Device &amp; usage data:</strong> IP address, browser type, device identifiers, pages visited, timestamps, and analytics data.</li>
        <li><strong>Marketing data:</strong> preferences, opt-in status, marketing interactions.</li>
        <li><strong>Third-party data:</strong> information from identity verification, payment processors, or social login providers (where used).</li>
      </ul>
    </section>

    <section class="privacy-section">
      <h3>3. How We Collect Data</h3>
      <p>We obtain personal data in several ways, including:</p>
      <ul class="privacy-list">
        <li>Directly from you when you create an account, place orders, communicate with us, or update your profile.</li>
        <li>Automatically through cookies, analytics tools, and server logs when you visit the Site.</li>
        <li>From third-party partners such as payment processors, identity verification services, or marketing platforms.</li>
      </ul>
    </section>

    <section class="privacy-section">
      <h3>4. Purpose &amp; Legal Basis for Processing</h3>
      <p>We process personal data for the following purposes:</p>
      <ul class="privacy-list">
        <li><strong>To provide Services:</strong> process orders, manage accounts, facilitate vendor payouts, and provide customer support.</li>
        <li><strong>Payment processing &amp; fraud prevention:</strong> to accept payments and reduce fraudulent activity.</li>
        <li><strong>Communications:</strong> transactional messages, order updates, and marketing (with consent where required).</li>
        <li><strong>Legal compliance:</strong> tax, accounting, and regulatory obligations.</li>
        <li><strong>Improvement &amp; analytics:</strong> product insights, A/B testing, and site performance improvements.</li>
      </ul>
      <p>Where required by law (for example, GDPR), we rely on appropriate legal bases to process your data such as contract performance, legitimate interests, consent, or legal obligations.</p>
    </section>

    <section class="privacy-section">
      <h3>5. Cookies &amp; Tracking Technologies</h3>
      <p>We and our partners use cookies, web beacons, and similar technologies to collect usage information and provide features. Cookies help with:</p>
      <ul class="privacy-list">
        <li>Session management and authentication.</li>
        <li>Security and fraud prevention.</li>
        <li>Performance analytics and personalization.</li>
        <li>Advertising and marketing (where permitted).</li>
      </ul>

      <div class="privacy-callout">
        <strong>Cookie control:</strong> Most browsers let you control cookies via settings. Disabling cookies may affect functionality (e.g., staying signed in, shopping cart).</div>

      <p>We use the following cookie categories:</p>
      <ul class="privacy-list">
        <li><strong>Essential:</strong> required for the site to operate (e.g., session cookies).</li>
        <li><strong>Functional:</strong> save preferences and improve experience.</li>
        <li><strong>Performance:</strong> analytics and monitoring.</li>
        <li><strong>Advertising:</strong> tracking for ads and retargeting.</li>
      </ul>
    </section>

    <section class="privacy-section">
      <h3>6. Third-Party Services &amp; Data Sharing</h3>
      <p>We may share personal data with trusted third parties to provide the Services. Examples include:</p>

      <div class="thirdparty-list">
        <div class="thirdparty-item"><strong>Payment processors:</strong> Stripe, Razorpay, PayPal — to process payments (they handle secure card data on our behalf).</div>
        <div class="thirdparty-item"><strong>Shipping partners:</strong> courier &amp; fulfillment providers for order delivery and tracking.</div>
        <div class="thirdparty-item"><strong>Analytics &amp; performance:</strong> Google Analytics, Hotjar, or similar for product insights and performance metrics.</div>
        <div class="thirdparty-item"><strong>Identity &amp; fraud tools:</strong> providers used to detect fraud and verify user identities.</div>
        <div class="thirdparty-item"><strong>Marketing services:</strong> email providers, campaign platforms for newsletters and promotional messaging.</div>
      </div>

      <p>We require third parties to protect personal data and use it only for permitted purposes under contract. We may also disclose data if required by law or to protect rights and safety.</p>
    </section>

    <section class="privacy-section">
      <h3>7. International Transfers</h3>
      <p>Our systems, third-party providers, or data processing operations may be located in countries outside your jurisdiction. By using the Services you consent to the transfer of data to countries which may have different data protection laws. Where required, we implement safeguards such as standard contractual clauses to ensure adequate protection.</p>
    </section>

    <section class="privacy-section">
      <h3>8. Data Retention</h3>
      <p>We retain personal data only for as long as necessary to provide Services, comply with legal obligations, resolve disputes, and enforce agreements. Retention periods vary by data type; transactional records and tax-related information may be retained longer as required by law.</p>
    </section>

    <section class="privacy-section">
      <h3>9. Security</h3>
      <p>We implement reasonable technical and organizational measures to protect personal data against accidental or unlawful destruction, loss, alteration, unauthorized disclosure or access. These measures include encryption, access controls, network security, and regular security assessments. However, no system is completely secure; if a breach occurs we will notify affected individuals and authorities as required by law.</p>
    </section>

    <section class="privacy-section">
      <h3>10. Your Rights (Data Subject Rights)</h3>
      <p>Depending on your jurisdiction, you may have the following rights regarding your personal data:</p>
      <ul class="privacy-list">
        <li><strong>Access:</strong> request a copy of the personal data we hold about you.</li>
        <li><strong>Rectification:</strong> correct inaccurate or incomplete data.</li>
        <li><strong>Deletion (Right to be forgotten):</strong> request deletion where permitted by law.</li>
        <li><strong>Restriction:</strong> request limited processing in certain circumstances.</li>
        <li><strong>Data portability:</strong> receive a machine-readable copy of your personal data.</li>
        <li><strong>Object:</strong> object to processing based on legitimate interests or direct marketing.</li>
        <li><strong>Withdraw consent:</strong> withdraw consent to processing where consent was the legal basis.</li>
      </ul>

      <p>To exercise these rights, contact us using the details in the <strong>Contact Us</strong> section below. We may need to verify your identity before fulfilling requests.</p>
    </section>

    <section class="privacy-section">
      <h3>11. Children's Privacy</h3>
      <p>Our Services are not intended for children under 13 (or the minimum age in your jurisdiction). We do not knowingly collect personal data from children. If we become aware we have collected such data, we will promptly delete it. If you believe we have collected data from a child, contact us to request removal.</p>
    </section>

    <section class="privacy-section">
      <h3>12. California Privacy Rights (CCPA)</h3>
      <p>If you are a California resident, you have specific rights under the California Consumer Privacy Act (CCPA), including the right to know what personal information is collected, the right to delete personal information (subject to exceptions), and the right to opt-out of the sale of personal information. To submit a request, contact us through the details below. For verification purposes, we may request additional information.</p>
    </section>

    <section class="privacy-section">
      <h3>13. Changes to This Policy</h3>
      <p>We may update this Policy periodically. We will post the updated Policy with a revised "Last updated" date. Continued use of the Services after changes implies acceptance of the updated Policy.</p>
    </section>

    <section class="privacy-section">
      <h3>14. Contact Us</h3>
      <p>If you have questions about this Policy or wish to exercise your rights, contact our data protection team:</p>
      <p><strong>Email:</strong> privacy@yourmarketplace.com<br>
         <strong>Address:</strong> Your Marketplace Pvt. Ltd., 123 Business Rd., City, Country</p>
      <div class="privacy-callout">
        <strong>Data Protection Officer (DPO):</strong> If applicable, contact our DPO at dpo@yourmarketplace.com
      </div>
    </section>

    <div class="privacy-foot">
      <p>Last updated: <strong>{{ date('F j, Y') }}</strong></p>
      <p>Notes: This Privacy Policy is provided for general informational purposes and should be reviewed by legal counsel to ensure compliance with local laws and regulations, particularly if your business operates in multiple jurisdictions.</p>
    </div>

  </main>

</div>

</x-layouts.site>
