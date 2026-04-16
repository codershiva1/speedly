import './bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';

// import './homeslider.js';

// at top of app.js (if not already)
import Swiper from 'swiper';
import { Navigation, Autoplay, EffectCoverflow, Pagination } from 'swiper/modules';

// Make Swiper and modules global
window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// ----------icon slider --------------------
const iconSwiper = new Swiper('.iconSwiper', {
    modules: [Navigation, Autoplay],
    slidesPerView: 4,
    slidesPerGroup: 1,
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.icon-swiper-next',
        prevEl: '.icon-swiper-prev',
    },
    spaceBetween: 0,
    breakpoints: {
        320: { slidesPerView: 1 },
        640: { slidesPerView: 2 },
        1024: { slidesPerView: 4 },
    },
    speed: 600,
});

// -------------------category slider------------------
const categorySwiper = new Swiper(".categorySwiper", {
    modules: [Navigation, Autoplay],
    slidesPerView: 4,
    slidesPerGroup: 1,
    loop: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.cat-next',
        prevEl: '.cat-prev',
    },
    spaceBetween: 0,
    breakpoints: {
        200: { slidesPerView: 2 },
        320: { slidesPerView: 3 },
        440: { slidesPerView: 4 },
        640: { slidesPerView: 5 },
        840: { slidesPerView: 7 },
        1024: { slidesPerView: 9 },
    },
    speed: 600,
});

// -------------------universal product sliders--------------------
document.querySelectorAll('.product-slider-container').forEach((container) => {
    const swiperEl = container.querySelector('.swiper');
    const prevEl = container.querySelector('.swiper-prev');
    const nextEl = container.querySelector('.swiper-next');
    
    if (swiperEl) {
        // Dynamic slides based on container width (e.g. sections with sidebars)
        const desktopSlides = container.dataset.slidesDesktop ? parseInt(container.dataset.slidesDesktop) : 7;
        const tabletSlides = container.dataset.slidesTablet ? parseInt(container.dataset.slidesTablet) : Math.max(2, Math.min(6, desktopSlides - 1));
        const mobileSlides = container.dataset.slidesMobile ? parseInt(container.dataset.slidesMobile) : Math.max(1, Math.min(2, desktopSlides - 1));

        new Swiper(swiperEl, {
            modules: [Navigation, Autoplay],
            slidesPerView: desktopSlides, // Fallback
            slidesPerGroup: 1,
            loop: false,
            autoplay: false,
            spaceBetween: 20, // Increased default
            navigation: {
                nextEl: nextEl,
                prevEl: prevEl,
            },
            breakpoints: {
                320: { slidesPerView: mobileSlides, spaceBetween: 12 },
                640: { slidesPerView: Math.min(4, tabletSlides), spaceBetween: 16 },
                1024: { slidesPerView: tabletSlides, spaceBetween: 20 },
                1280: { slidesPerView: desktopSlides, spaceBetween: 24 },
            },
            speed: 500,
            watchOverflow: true,
        });
    }
});


//  import '../css/home.css';



// -------------------triple banner slider--------------------
// -------------------triple banner slider--------------------
const tripleSwiper = new Swiper('.tripleBannerSwiper', {
    modules: [Navigation, Autoplay, Pagination],
    grabCursor: true,
    centeredSlides: true,
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.tripleBannerPagination',
        clickable: true
    },
    navigation: {
        nextEl: '.triple-next',
        prevEl: '.triple-prev',
    },
    breakpoints: {
        320: { slidesPerView: 1.2, spaceBetween: 10 },
        640: { slidesPerView: 1.5, spaceBetween: 20 },
        1024: { slidesPerView: 1.8, spaceBetween: 30 },
        1280: { slidesPerView: 2.2, spaceBetween: 40 },
    },
    speed: 1000,
});

// ------------------- scroll to top ----------------------

document.addEventListener("DOMContentLoaded", function () {

    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    // ❌ Button not present → do nothing
    if (!scrollToTopBtn) return;

    // Show button after scrolling 200px
    window.addEventListener("scroll", function () {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    });

    // Smooth scroll to top
    scrollToTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

});



document.addEventListener('click', function (e) {

    const btn = e.target.closest('.wishlist-btn');
    if (!btn) return;

    let productId = btn.dataset.productId;
    let icon = btn.querySelector('i');
    const countEl = document.getElementsByClassName('wishlist-count');

    let url = window.wishlistToggleUrl.replace(':id', productId);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(res => {
        if (!res.ok) throw new Error('Request failed');
        return res.json();
    })
    .then(data => {
        // Heart icon
        icon.classList.toggle('text-red-500', data.status === 'added');
        icon.classList.toggle('text-gray-400', data.status === 'removed');

        // 🔥 Update ALL wishlist counts
        const countEls = document.getElementsByClassName('wishlist-count');
        for (let i = 0; i < countEls.length; i++) {
            countEls[i].innerText = data.count;
        }

        Swal.fire({
            toast: true,
            icon: 'success',
            title: data.message,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });
    })
   .catch(() => {
        Swal.fire('Please login to use wishlist');
    });

});


document.addEventListener('click', function (e) {

    const btn = e.target.closest('.cart-btn');
    if (!btn) return;

    let productId = btn.dataset.productId;
    let url = window.CartToggleUrl.replace(':id', productId);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {

        // 🔁 Button UI
        if (data.status === 'added') {
            btn.textContent = 'ADDED';
            btn.classList.remove('hover:bg-green-50');
            btn.classList.add('bg-green-100');
            // Swal.fire('Added!', 'Item added to cart', 'success');
        } else {
            btn.textContent = 'ADD';
            btn.classList.remove('bg-green-100',);
            btn.classList.add('text-green-600');
            // Swal.fire('Removed!', 'Item removed from cart', 'info');
        }

        // 🔢 Update ALL cart counters
        document.querySelectorAll('.cart-count').forEach(el => el.textContent = data.count);

        const floatingcart = document.querySelector('.floatingcart');
        if (floatingcart) {
            floatingcart.style.display = data.count <= 0 ? "none" : "flex";
        }

             // 🔢 Update ALL cart counters
        document.querySelectorAll('.cartTotal').forEach(el => el.textContent = data.amount);
    })
    .catch(() => {
        Swal.fire('Please login to use cart');
    });
});

window.Alpine = Alpine;

Alpine.start();
