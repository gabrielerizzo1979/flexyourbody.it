/*
 *
 * File JS Principale
 *
 */
// IMPORT JQUERY
//--------------------------------------------------------------------//

// import $ from "jquery";

// IMPORT SCSS PER LA COMPILAZIONE
//--------------------------------------------------------------------//
import 'swiper/css/bundle';
import 'lightgallery/css/lightgallery-bundle.min.css';
import 'scss/app.scss';

//--------------------------------------------------------------------//

// Libreria Lazysizes
//--------------------------------------------------------------------//

import 'lazysizes';

//--------------------------------------------------------------------//

// Import Utilies
//--------------------------------------------------------------------//

// import { initSvgImage } from "./utilities/img-svg";
// import smoothScroll from './utilities/smooth-scroll';

//--------------------------------------------------------------------//

// Init Utilies
//--------------------------------------------------------------------//

// initSvgImage();

// smoothScroll();

//--------------------------------------------------------------------//

// Import Componenti
//--------------------------------------------------------------------//

import marquee from 'components/marquee/marquee';
import modalCookie from 'imComponents/modal-cookie/modal-cookie';
import button from 'components/buttons/buttons';
import animateIn from 'animations/animate-in/animate-in';
import footer from 'components/footer/footer';

//--------------------------------------------------------------------//

// Init Componenti
//--------------------------------------------------------------------//
if (!document.querySelector('body.wp-admin')) {
    modalCookie();
    marquee();
}
animateIn();
footer();

//--------------------------------------------------------------------//
