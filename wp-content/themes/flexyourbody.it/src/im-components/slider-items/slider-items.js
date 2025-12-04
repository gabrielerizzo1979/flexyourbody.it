// IMPORT LIBRERIE ESTERNE
import Swiper from 'swiper/bundle';
import lightGallery from 'lightgallery';

// IMPORT SCSS PER LA COMPILAZIONE
import './slider-items.scss';

// EXPORT COMPONENTE
const sliderItems = () => {
    let allSliderItems = document.querySelectorAll('.im-slider-items');

    if (!allSliderItems.length) return;

    allSliderItems.forEach((el, i) => {
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
                0: {
                    slidesPerView: 1.2,
                },
                768: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                },
                1024: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                },
            },
            spaceBetween: 20,
            navigation: {
                nextEl: arrowNext,
                prevEl: arrowPrev,
            },
            pagination: {
                el: pagination,
                clickable: true,
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

        new Swiper(el.querySelector('.swiper-container'), args);

        lightGallery(el.querySelector('.lightgallery'), {
            thumbnail: false,
            animateThumb: false,
            showThumbByDefault: false,
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

export default sliderItems;
