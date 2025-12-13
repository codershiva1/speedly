import './bootstrap';

import Alpine from 'alpinejs';


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



// -------------------scroll yo top----------------------

    // Get the button
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    // Show button after scrolling 200px
    window.onscroll = function() { scrollFunction(); };

    function scrollFunction() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    }

    // Smooth scroll to top when button clicked
    scrollToTopBtn.addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });



window.Alpine = Alpine;

Alpine.start();
