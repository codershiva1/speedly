<style>
    @media (max-width: 768px) {
    .hero-slider,
    .desktop-banner,.custom-slider {
        display: none !important;
    }
}

/* Mobile banner default hidden */
.mobile-banner {
    display: none;
}

/* Mobile view only */
@media (max-width: 768px) {

    .mobile-banner {
        display: block;
        position: relative;
        /* margin: 10px; */
        border-radius:0px 0 25px 25px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    }

    .mobile-banner img {

        object-fit: cover;
    }

    .mobile-banner-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 14px;
        background: linear-gradient(to top, rgba(0,0,0,0.65), transparent);
        color: #fff;
    }

    .mobile-banner-content h3 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
    }

    .mobile-banner-content p {
        font-size: 13px;
        margin: 4px 0 8px;
        opacity: 0.9;
    }

    .mobile-banner-content a {
        display: inline-block;
        background: #16a34a;
        color: #fff;
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 999px;
        text-decoration: none;
    }
}

</style>
<div class="custom-slider">
    <div class="slide slide-1 active">
        <div class="banner-content">
            <h2>Slide One Title</h2>
            <p>This is slide one description.</p>
            <a href="#" class="banner-btn">Shop Now</a>
        </div>
    </div>

    <div class="slide slide-2">
        <div class="banner-content">
            <h2>Slide Two Title</h2>
            <p>This is slide two description.</p>
            <a href="#" class="banner-btn">Learn More</a>
        </div>
    </div>

    <div class="slide slide-3">
        <div class="banner-content">
            <h2>Slide Three Title</h2>
            <p>This is slide three description.</p>
            <a href="#" class="banner-btn">Buy Now</a>
        </div>
    </div>

    <div class="ghost-slide"></div>

    <div class="slider-nav">
        <button id="prevSlide">❮</button>
        <button id="nextSlide">❯</button>
    </div>

    <div class="slider-dots">
        <span class="dot active" data-slide="1"></span>
        <span class="dot" data-slide="2"></span>
        <span class="dot" data-slide="3"></span>
    </div>
</div>




<section class="mobile-banner bg-yellow-400 pt-2 pb-2 px-2 rounded-t-3xl -mt-10" style="background: linear-gradient(135deg, #1FAF5A, #6EDC8A);">

    <!-- TITLE -->
    <div class="flex justify-center mb-4">
        <span class=" text-xs font-semibold px-4 py-1 rounded-full shadow" style="background:white;">
            ✦ OFFERS FOR YOU ✦
        </span>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-2 gap-3">

        <div class="bg-white rounded-xl p-3 shadow-sm flex items-center gap-2">

            <img src="https://cdn-icons-png.flaticon.com/512/3523/3523887.png" class="w-8">

            <div>
                <p class="font-semibold text-sm">
                    Get FLAT ₹50 OFF
                </p>

            </div>

        </div>


        <div class="bg-white rounded-xl p-3 shadow-sm flex items-center gap-2">

            <img src="https://cdn-icons-png.flaticon.com/512/2972/2972185.png" class="w-8">

            <div>
                <p class="font-semibold text-sm">
                    Enjoy FREE delivery
                </p>

            </div>

        </div>

    </div>

</section>