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
        margin: 10px;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    }

    .mobile-banner img {
        width: 100%;
        height: 180px;
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




<div class="mobile-banner">
    <img 
        src="https://i.pinimg.com/736x/74/d5/d4/74d5d412b22267897b74fefe60f5c28c.jpg" 
        alt="banner"
    >
    <div class="mobile-banner-content">
        <h3>Lightning Fast Delivery ⚡</h3>
        <p>Fresh products in just 8 minutes</p>
        <a href="{{ route('shop.index') }}">Shop Now</a>
    </div>
</div>