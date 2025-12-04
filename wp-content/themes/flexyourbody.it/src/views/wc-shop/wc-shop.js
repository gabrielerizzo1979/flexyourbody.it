/*
 *
 * File JS per checkout
 *
 */

// IMPORT STILE SPECIFICO PAGINA
//--------------------------------------------------------------------//

import './wc-shop.scss';

// IMPORT LIBRERIE ESTERNE
//--------------------------------------------------------------------//
import Swiper from 'swiper/bundle';
//--------------------------------------------------------------------//

// JS SPECIFICO PAGINA
//--------------------------------------------------------------------//

const sliderCategories = () => {
    let allSliderCategories = document.querySelectorAll('.slider-categories');

    if (!allSliderCategories.length) return;

    allSliderCategories.forEach((el, i) => {
        let args = {
            centerInsufficientSlides: true,
            slidesPerView: 'auto',
            spaceBetween: 0,

            scrollbar: {
                el: '.swiper-scrollbar',
                hide: false,
                draggable: true,
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

        new Swiper(el.querySelector('.swiper-container'), args);
    });
};

sliderCategories();

//--------------------------------------------------------------------//
