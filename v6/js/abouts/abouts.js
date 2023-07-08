
const swiper = new Swiper('.author-swiper', {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 16,
    loop: false,
    breakpoints: {
        768: {
            spaceBetween: 24,
            slidesPerView: 2
        },
        1024: {
            spaceBetween: 24,
            slidesPerView: 3
        }
    },
    pagination: {
        el: '#author-pagination',
    },
    navigation: {
        nextEl: '#author-button-next',
        prevEl: '#author-button-prev',
    }
});
