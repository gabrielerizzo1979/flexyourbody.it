// IMPORT LIBRERIE ESTERNE
import Swiper from 'swiper/bundle';

// IMPORT SCSS PER LA COMPILAZIONE
import './hero-slider.scss';

const heroSlider = () => {
    let heroSliderAll = document.querySelectorAll(
        '.im-hero-slider .swiper-container'
    );
    if (!heroSliderAll.length) return;

    heroSliderAll.forEach((el) => {
        let arrowPrev = el.querySelector('.swiper-button-prev');
        let arrowNext = el.querySelector('.swiper-button-next');

        let pagination = el.querySelector('.swiper-pagination');

        let typePagination = 'bullets';

        if (pagination) {
            switch (true) {
                case pagination.classList.contains('bullets'):
                    typePagination = 'bullets';
                    break;
                case pagination.classList.contains('fraction'):
                    typePagination = 'fraction';
                    break;
                case pagination.classList.contains('progressbar'):
                    typePagination = 'progressbar';
                    break;
                default:
                    typePagination = 'bullets';
                    break;
            }
        }

        let args = {
            slidesPerView: 1,
            spaceBetween: 0,
            navigation: {
                nextEl: arrowNext,
                prevEl: arrowPrev,
            },
            pagination: {
                el: pagination,
                clickable: true,
                type: typePagination,
                dynamicBullets: true,
            },
            a11y: {
                enabled: true,
                prevSlideMessage: 'Previous slide',
                nextSlideMessage: 'Next slide',
                firstSlideMessage: 'This is the first slide',
                lastSlideMessage: 'This is the last slide',
                paginationBulletMessage: 'Go to slide {{index}}',
                notificationClass: 'swiper-notification',
            },
        };

        new Swiper(el, args);
    });
};

export default heroSlider;
