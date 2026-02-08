import './bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';

// import './homeslider.js';

// at top of app.js (if not already)
import 'swiper/css';
import 'swiper/css/navigation';


import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import { Autoplay } from 'swiper/modules';

// ----------icon slider --------------------

const iconSwiper = new Swiper('.iconSwiper', {
    modules: [Navigation, Autoplay],
    slidesPerView: 4,        // 4 slides visible
    slidesPerGroup: 1,       // move 1 slide at a time
    loop: true,              // enable looping
    loopFillGroupWithBlank: false, // don’t add blank slides
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.icon-swiper-next',
        prevEl: '.icon-swiper-prev',
    },
    spaceBetween: 0,         // no space between slides
    breakpoints: {
        320: { slidesPerView: 1 },  // mobile
        640: { slidesPerView: 2 },  // tablet
        1024: { slidesPerView: 4 }, // desktop
    },
    speed: 600,              // transition speed (optional, smooth)
});


// -------------------category slider------------------
// import Swiper from "swiper";
// import { Navigation, Autoplay, Grid } from "swiper/modules";

const categorySwiper = new Swiper(".categorySwiper", {
    modules: [Navigation, Autoplay],
    slidesPerView: 4,        // 4 slides visible
    slidesPerGroup: 1,       // move 1 slide at a time
    loop: true,              // enable looping
    loopFillGroupWithBlank: false, // don’t add blank slides
    // autoplay: {
    //     delay: 3000,
    //     disableOnInteraction: false,
    // },
   navigation: {
        nextEl: '.cat-next',
        prevEl: '.cat-prev',
    },
    spaceBetween: 0,         // no space between slides
    breakpoints: {
        320: { slidesPerView: 1 },  // mobile
        640: { slidesPerView: 2 },  // tablet
        1024: { slidesPerView: 4 }, // desktop
    },
    speed: 600,              // transition speed (optional, smooth)
});


// -----------------------------------------

const dealsSwiper = new Swiper('.dealsSwiper', {
     modules: [Navigation, Autoplay],
    slidesPerView: 4,        // 4 slides visible
    slidesPerGroup: 1,       // move 1 slide at a time
    loop: true,              // enable looping
    loopFillGroupWithBlank: false, // don’t add blank slides
    // autoplay: {
    //     delay: 3000,
    //     disableOnInteraction: false,
    // },
    navigation: {
        nextEl: '.deals-next',
        prevEl: '.deals-prev',
    },
    spaceBetween: 0,         // no space between slides
    breakpoints: {
        320: { slidesPerView: 1 },  // mobile
        640: { slidesPerView: 2 },  // tablet
        1024: { slidesPerView: 4 }, // desktop
    },
    speed: 600,              // transition speed (optional, smooth)
});


//  import '../css/home.css';



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
