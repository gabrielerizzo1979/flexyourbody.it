/*
 *
 * File JS per animazione
 *
 */

import ScrollMagic from 'scrollmagic';

// IMPORT SCSS PER LA COMPILAZIONE
//--------------------------------------------------------------------//

import './animate-in.scss';

//--------------------------------------------------------------------//

// EXPORT COMPONENTE
//--------------------------------------------------------------------//

const animateIn = () => {
    let controllerAnimateIn = new ScrollMagic.Controller();
    let fade = document.querySelectorAll('.fade');

    if (!fade) {
        return;
    } else {
        fade.forEach((el) => {
            new ScrollMagic.Scene({
                triggerElement: el,
                triggerHook: 'onEnter',
                reverse: false,
                offset: 80,
            })
                .setClassToggle(el, 'animate')
                .addTo(controllerAnimateIn);
        });
    }
};

export default animateIn;

//--------------------------------------------------------------------//
