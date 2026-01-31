let current = 1;
const total = 3;

const ghost = document.querySelector('.ghost-slide');
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function changeDot() {
    dots.forEach(d => d.classList.remove('active'));
    dots[current - 1].classList.add('active');
}

function nextSlide() {
    let next = current + 1;
    if (next > total) next = 1;

    runSlider(next);
}

function prevSlide() {
    let next = current - 1;
    if (next < 1) next = total;

    runSlider(next);
}

function runSlider(next) {
    slides.forEach(s => s.classList.remove('active'));

    const nextSlide = document.querySelector(`.slide-${next}`);

    ghost.style.background = window.getComputedStyle(nextSlide).background;

    ghost.style.left = "0";

    setTimeout(() => {
        nextSlide.classList.add("active");
    }, 300);

    setTimeout(() => {
        ghost.style.left = "100%";
    }, 650);

    current = next;
    changeDot();
}

setInterval(nextSlide, 4500);

document.getElementById("nextSlide").onclick = nextSlide;
document.getElementById("prevSlide").onclick = prevSlide;

dots.forEach(dot => {
    dot.addEventListener("click", () => {
        runSlider(parseInt(dot.dataset.slide));
    });
});


