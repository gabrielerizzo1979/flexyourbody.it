// IMPORT LIBRERIE ESTERNE
//--------------------------------------------------------------------//

import Swiper from 'swiper/bundle';
import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail';
//--------------------------------------------------------------------//

import './carousel-gallery.scss';

const carouselGallery = () => {
    let allCarousel = document.querySelectorAll('.im-carousel-gallery');

    if (!allCarousel.length) return;

    allCarousel.forEach((el, i) => {
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
            spaceBetween: 0,
            breakpoints: {
                0: { spaceBetween: 16, slidesPerView: 1.1 },
                490: { spaceBetween: 16, slidesPerView: 1.4 },
                700: { spaceBetween: 30, slidesPerView: 1.8 },
                1000: { spaceBetween: 30, slidesPerView: 1.7 },
                1300: { spaceBetween: 30, slidesPerView: 2.4 },
                1500: { spaceBetween: 30, slidesPerView: 3.1 },
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

        new Swiper(el.querySelector('.swiper'), args);

        lightGallery(el.querySelector('.lightgallery'), {
            thumbnail: true,
            plugins: [lgThumbnail],
            exThumbImage: 'data-exthumbimage',
            animateThumb: true,
            mobileSettings: {
                showCloseIcon: true,
            },
            download: false,
            hideBarsDelay: 1000000000,
            autoplayControls: false,
            hash: false,
            escKey: true,
            keyPress: true,
            licenseKey: 'WQ63Z-598QW-NZ7D5-WPMTB',
        });
    });
};

export default carouselGallery;
