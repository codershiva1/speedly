<x-layouts.site :title="__('FAQ')">

<style>
    .faq-card {
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        background: #fff;
    }

    .faq-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        transform: translateY(-3px);
    }

    .faq-header {
        cursor: pointer;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        padding: 0 20px;
        transition: all 0.35s ease;
    }

    .faq-card.active .faq-answer {
        max-height: 200px;
        opacity: 1;
        padding: 10px 20px 20px;
    }

    .rotate-icon {
        transition: transform 0.35s ease;
    }

    .faq-card.active .rotate-icon {
        transform: rotate(180deg);
    }
</style>

<div class="container py-5">

    <h1 class="fw-bold mb-4 text-center">Frequently Asked Questions</h1>
    <p class="text-center text-muted mb-5">
        Here are answers to some of the most common questions customers and vendors ask.
    </p>

    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- FAQ ITEM --}}
            <div class="faq-card mb-3">
                <div class="faq-header">
                    <h6 class="mb-0 fw-semibold">How does this multi-vendor marketplace work?</h6>
                    <i class="fa-solid fa-chevron-down rotate-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>
                        Our platform allows multiple vendors to register, upload their products,
                        manage stock, set pricing, and fulfil orders. Customers get a unified shopping
                        experience and a single checkout process across all vendors.
                    </p>
                </div>
            </div>

            {{-- FAQ ITEM --}}
            <div class="faq-card mb-3">
                <div class="faq-header">
                    <h6 class="mb-0 fw-semibold">How are payments handled?</h6>
                    <i class="fa-solid fa-chevron-down rotate-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>
                        You can enable Cash on Delivery (COD) or integrate online payment gateways
                        such as Razorpay, Stripe, PayPal, or Paytm depending on your business needs.
                        Each vendor receives earnings after the admin commission is deducted.
                    </p>
                </div>
            </div>

            {{-- FAQ ITEM --}}
            <div class="faq-card mb-3">
                <div class="faq-header">
                    <h6 class="mb-0 fw-semibold">Can vendors manage their own products?</h6>
                    <i class="fa-solid fa-chevron-down rotate-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>
                        Yes. Vendors get a dedicated dashboard where they can add new products,
                        upload images, edit details, track orders, view earnings, and manage inventory.
                    </p>
                </div>
            </div>

            {{-- FAQ ITEM --}}
            <div class="faq-card mb-3">
                <div class="faq-header">
                    <h6 class="mb-0 fw-semibold">Do customers receive order updates?</h6>
                    <i class="fa-solid fa-chevron-down rotate-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>
                        Customers automatically receive notifications for order placement, packing,
                        shipping, delivery, returns, and cancellations depending on your setup.
                    </p>
                </div>
            </div>

            {{-- FAQ ITEM --}}
            <div class="faq-card mb-3">
                <div class="faq-header">
                    <h6 class="mb-0 fw-semibold">How does the return & refund process work?</h6>
                    <i class="fa-solid fa-chevron-down rotate-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>
                        Customers can raise a return request, which first goes to the vendor for
                        approval. After verification, refunds are initiated by the admin based on
                        your platform policies. Everything is tracked in the customer dashboard.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    document.querySelectorAll(".faq-card").forEach(card => {
        card.querySelector(".faq-header").addEventListener("click", () => {
            card.classList.toggle("active");
        });
    });
</script>

</x-layouts.site>
