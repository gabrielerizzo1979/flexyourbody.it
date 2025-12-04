// IMPORT SCSS PER LA COMPILAZIONE
import lightGallery from 'lightgallery';
import './box-gallery.scss';

// EXPORT COMPONENTE
const boxGallery = () => {
    let allBoxGallery = document.querySelectorAll('.im-gallery');

    if (!allBoxGallery.length) return;

    allBoxGallery.forEach((el) => {
        let thisGallery = el.querySelector('.im-gallery__lightgallery');
        let openGallery = el.querySelector('.im-gallery__media');

        if (thisGallery) {
            lightGallery(thisGallery, {
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

            openGallery.addEventListener('click', (evt, el) => {
                evt.preventDefault();
                thisGallery.querySelector('li:first-child').click();
            });
        }
    });
};

export default boxGallery;
