/*
 *
 * File JS componente slider news
 *
 */

// IMPORT LIBRERIE ESTERNE
//--------------------------------------------------------------------//

import Swiper from 'swiper/bundle';

// IMPORT SCSS PER LA COMPILAZIONE
//--------------------------------------------------------------------//

import './slider-news.scss';

// EXPORT COMPONENTE
//--------------------------------------------------------------------//

const sliderNews = () => {
    let allSliderNews = document.querySelectorAll('.slider-news');

    if (!allSliderNews.length) return;

    allSliderNews.forEach((el, i) => {
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
            breakpoints: {
                0: { spaceBetween: 16, slidesPerView: 1.1 },
                500: { spaceBetween: 16, slidesPerView: 1.6 },
                768: { spaceBetween: 30, slidesPerView: 2.2 },
                800: { spaceBetween: 30, slidesPerView: 2.6 },
                1200: { spaceBetween: 30, slidesPerView: 3.4 },
                1400: { spaceBetween: 30, slidesPerView: 4 },
                1600: { spaceBetween: 30, slidesPerView: 5 },
            },
            spaceBetween: 30,
            navigation: {
                nextEl: arrowNext,
                prevEl: arrowPrev,
            },
            pagination: {
                el: pagination,
                clickable: true,
                dynamicBullets: true,
                type: typePagination,
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

        new Swiper(el.querySelector('.swiper'), args);
    });
};

export default sliderNews;
