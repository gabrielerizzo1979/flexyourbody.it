/*
 *
 * File JS per account page
 *
 */

// IMPORT STILE SPECIFICO PAGINA
//--------------------------------------------------------------------//
import './wc-account.scss';
//--------------------------------------------------------------------//

// IMPORT LIBRERIE ESTERNE
//--------------------------------------------------------------------//
import Swiper from 'swiper/bundle';
//--------------------------------------------------------------------//

// JS SPECIFICO PAGINA
//--------------------------------------------------------------------//
const sliderNav = () => {
    const allSliderNav = document.querySelectorAll(
        '.woocommerce-MyAccount-navigation'
    );

    if (!allSliderNav.length) return;

    allSliderNav.forEach((el, i) => {
        el.classList.add('swiper');

        const menuList = el.querySelector('ul');
        if (!menuList) return;

        const menu = Array.from(menuList.children);
        if (!menu.length) return;

        const arrowPrev = el.querySelector('.swiper-button-prev');
        const arrowNext = el.querySelector('.swiper-button-next');
        const pagination = el.querySelector('.swiper-pagination');

        const typePagination = pagination
            ? pagination.classList.value
            : 'bullets';

        menuList.classList.add('swiper-wrapper');

        menu.forEach((el, i) => {
            el.classList.add('swiper-slide');
        });

        const args = {
            centerInsufficientSlides: true,
            slidesPerView: 'auto',
            spaceBetween: 0,
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

        new Swiper(el, args);
    });
};

sliderNav();
//--------------------------------------------------------------------//
