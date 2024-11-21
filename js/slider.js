let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const totalSlides = slides.length;

document.querySelector(".slider-nav.left").addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateSlider();
});

document.querySelector(".slider-nav.right").addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateSlider();
});

function updateSlider() {
    const slider = document.querySelector(".slides");
    slider.style.transform = `translateX(-${currentSlide * 100 / totalSlides}%)`;
}
