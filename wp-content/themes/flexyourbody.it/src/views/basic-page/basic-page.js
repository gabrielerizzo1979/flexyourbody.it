/*
 *
 * File JS per basic page
 *
 */

// IMPORT STILE SPECIFICO PAGINA
//--------------------------------------------------------------------//

import './basic-page.scss';

//--------------------------------------------------------------------//

// IMPORT COMPONENTI
//--------------------------------------------------------------------//

import heroSlider from 'imComponents/hero-slider/hero-slider';
import carouselGallery from 'imComponents/carousel-gallery/carousel-gallery';
import textOnBg from 'imComponents/text-on-bg/text-on-bg';
import textImgVar from 'imComponents/text-img-var/text-img-var';
import customQuote from 'components/custom-quote/custom-quote';
import colTitleText from 'components/col-title-text/col-title-text';
import cardsTextOnBg from 'components/cards-text-on-bg/cards-text-on-bg';
import cmsContent from 'components/cms-content/cms-content';
import sliderProducts from 'components/slider-products/slider-products';
import boxImage from 'components/box-image/box-image';
import textIframe from 'components/text-iframe/text-iframe';
import customAccordion from 'components/custom-accordion/custom-accordion';
import sliderNews from 'components/slider-news/slider-news';
import cardNews from 'components/cards/card-news';

//--------------------------------------------------------------------//
// INIT COMPONENTI
//--------------------------------------------------------------------//
function initAllComponents() {
    if (!document.querySelector('body.wp-admin')) {
        heroSlider();
    }
    carouselGallery();
    sliderNews();
    sliderProducts();
}
if (document.querySelector('body.wp-admin')) {
    (function ($) {
        var initBlock = function ($block) {
            initAllComponents();
        };
        if (window.acf) {
            window.acf.addAction('render_block_preview', initBlock);
        }
    })(jQuery);
}
initAllComponents();
//--------------------------------------------------------------------//
