/*
 *
 * File JS list Cards
 *
 */

// IMPORT STILE SPECIFICO PAGINA
//--------------------------------------------------------------------//

import './marquee.scss';

// EXPORT COMPONENTE
//--------------------------------------------------------------------//

const marquee = () => {
    let allMarquee = document.querySelectorAll('.marquee.on');
    if (!allMarquee.length) return;

    allMarquee.forEach((marquee) => {
        let loop_container = marquee.querySelector('.marquee__loop');
        let content = marquee.querySelector('.marquee__content');
        let string = content.innerHTML;

        // Funzione per ripetere il contenuto
        function repeatContent(el, till) {
            let counter = 0;
            while (el.offsetWidth <= till && counter < 100) {
                content.innerHTML += string;
                counter += 1;
            }

            content.innerHTML += content.innerHTML;

            const vel = 50;
            let towidth = el.offsetWidth / 2;
            const duration = towidth / vel;

            marquee.style.setProperty('--to-width', `-${towidth}px`);
            loop_container.style.animationDuration = `${duration}s`;

            loop_container.classList.add('active');
        }

        repeatContent(content, window.innerWidth);

        window.addEventListener('resize', () => {
            content.innerHTML = string;
            repeatContent(content, window.innerWidth);
        });
    });
};

export default marquee;

//--------------------------------------------------------------------//
