/*
 *
 * File JS componente slider products
 *
 */

// IMPORT LIBRERIE ESTERNE
//--------------------------------------------------------------------//

import Swiper from 'swiper/bundle';

// IMPORT SCSS PER LA COMPILAZIONE
//--------------------------------------------------------------------//

import './slider-products.scss';

// EXPORT COMPONENTE
//--------------------------------------------------------------------//

const sliderProducts = () => {
    let allSliderProducts = document.querySelectorAll('.slider-products');

    if (!allSliderProducts.length) return;

    allSliderProducts.forEach((el, i) => {
        let productsList = el.querySelector('.products');
        let products = el.querySelectorAll('.product');
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
            wrapperClass: 'products',
            slideClass: 'product',
            breakpoints: {
                0: {
                    slidesPerView: 1.1,
                    spaceBetween: 8,
                },
                480: {
                    slidesPerView: 1.6,
                    spaceBetween: 8,
                },
                650: {
                    slidesPerView: 2.1,
                    spaceBetween: 8,
                },
                768: {
                    slidesPerView: 2.6,
                    spaceBetween: 16,
                },
                800: {
                    slidesPerView: 3.1,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4.1,
                    spaceBetween: 30,
                },
                1600: {
                    slidesPerView: 5.1,
                    spaceBetween: 30,
                },
                1920: {
                    slidesPerView: 6.1,
                    spaceBetween: 30,
                },
            },
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

        new Swiper(el.querySelector('.woocommerce'), args);
    });
};

export default sliderProducts;
