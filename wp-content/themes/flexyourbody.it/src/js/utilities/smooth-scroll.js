/**
*	Funzione per gestione smooth scroll-to
*
*	@return {void}
*/

const smoothScroll = () => {
    var allBtnScrollTo = document.querySelectorAll('.scroll-to');

    if (allBtnScrollTo.length === 0) return;

    allBtnScrollTo.forEach(el => {
        el.addEventListener('click', (evt) => {
            evt.preventDefault();
            animateScroll(el);
        });
    });

    const animateScroll = (btn) => {
        let scrollElementId = btn.getAttribute('href');
        let targetElement = document.querySelector(scrollElementId);

        if (!targetElement) return; // Se l'elemento non esiste return;

        const easeInCubic = (t) => { return t*t*t };

        const scrollToElem = (startTime, currentTime, duration, scrollEndElemTop, startScrollOffset) => {
            const runtime = currentTime - startTime;
            let progress = runtime / duration;
            
            progress = Math.min(progress, 1);
            
            const ease = easeInCubic(progress);
            
            window.scroll(0, startScrollOffset + (scrollEndElemTop * ease));

            if(runtime < duration)
            {
                requestAnimationFrame((timestamp) => {
                    const currentTime = timestamp || new Date().getTime();
                    scrollToElem(startTime, currentTime, duration, scrollEndElemTop, startScrollOffset);
                })
            }
        }

        requestAnimationFrame((timestamp) => {
            const stamp = timestamp || new Date().getTime();
            const duration = 1200;
            const start = stamp;
            const topOffset = 100;

            const startScrollOffset = window.pageYOffset;
            const scrollEndElemTop = targetElement.getBoundingClientRect().top - topOffset;

            scrollToElem(start, stamp, duration, scrollEndElemTop, startScrollOffset);
        });
    }
}

export default smoothScroll;