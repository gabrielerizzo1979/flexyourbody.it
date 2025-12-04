// IMPORT SCSS PER LA COMPILAZIONE
import './accordion.scss';

// EXPORT COMPONENTE
const accordion = () => {
    /**
     *	buttonsAccordion --> Tutti i pulsanti per l'apertura degli accordion toggle
     */

    let buttonsAccordion = document.querySelectorAll('.im-accordion__toggle');

    if (!buttonsAccordion.length) return;

    /* Funzione di gestione apertura e chiusura degli accordion toggle */
    const manageAccordion = (
        button,
        dataAccordion,
        accordionToOpen,
        heightAccordionContent
    ) => {
        if (accordionBreakpoint(button)) {
            if (button.classList.contains('open')) {
                button.classList.remove('open');
                accordionToOpen.classList.remove('open');
                accordionToOpen.style.height = '0px';
            } else {
                button.classList.add('open');
                accordionToOpen.classList.add('open');
                accordionToOpen.style.height = heightAccordionContent + 'px';
            }
        }
    };

    /* Chiude tutti gli accordion di un gruppo se presente data-close = true */
    const manageGroupAccordion = (group, close) => {
        let allGroupAccordion = document.querySelectorAll(
            '.im-accordion__toggle[data-group="' + group + '"]'
        );
        if (!allGroupAccordion.length) return;

        allGroupAccordion.forEach((element) => {
            if (element.classList.contains('open')) {
                element.click();
            }
        });
    };

    /* Funzione di gestione apertura e chiusura degli accordion toggle */
    const accordionBreakpoint = (accordion) => {
        var dataBreakpoint = accordion.getAttribute('data-breakpoint');

        if (dataBreakpoint == null) return true;

        if (dataBreakpoint.length) {
            var breakpoints = JSON.parse(dataBreakpoint);

            for (var i = 0; i < breakpoints.length; ++i) {
                if (
                    window.innerWidth >= breakpoints[i][0] &&
                    window.innerWidth <= breakpoints[i][1]
                )
                    return true;
            }
        }

        return false;
    };

    /* Funzione per il reset degli elementi al resize  */
    const resetAccordion = () => {
        for (var i = 0; i < buttonsAccordion.length; ++i) {
            if (!accordionBreakpoint(buttonsAccordion[i])) {
                var dataAccordion =
                    buttonsAccordion[i].getAttribute('data-accordion');
                var accordionToOpen = document.querySelector(
                    '.im-accordion__content[data-accordion="' +
                        dataAccordion +
                        '"]'
                );

                buttonsAccordion[i].classList.remove('open');
                accordionToOpen.classList.remove('open');
                accordionToOpen.style.height = '';
            }
        }
    };

    /* Funzione per il ricalcolo delle altezze al resize */
    const recalcAccordionHeights = () => {
        var accordionOpened = document.querySelectorAll(
            '.im-accordion__content.open'
        );

        if (accordionOpened.length) {
            for (var i = 0; i < accordionOpened.length; ++i) {
                var newHeightAccordionContent =
                    accordionOpened[i].children[0].offsetHeight;
                accordionOpened[i].style.height =
                    newHeightAccordionContent + 'px';
            }
        }
    };

    buttonsAccordion.forEach((el) => {
        el.addEventListener('click', function () {
            let dataAccordion = this.getAttribute('data-accordion');
            var accordionToOpen = document.querySelector(
                '.im-accordion__content[data-accordion="' + dataAccordion + '"]'
            );
            var heightAccordionContent = accordionToOpen.querySelector(
                'div[data-wrapper-height]'
            ).offsetHeight;
            let dataGroup = this.getAttribute('data-group');
            let dataClose = this.getAttribute('data-close');

            if (
                dataClose != null &&
                dataClose == 'true' &&
                !this.classList.contains('open')
            ) {
                manageGroupAccordion(dataGroup, dataClose);
            }

            manageAccordion(
                this,
                dataAccordion,
                accordionToOpen,
                heightAccordionContent
            );
        });
    });

    window.onresize = function () {
        resetAccordion();
        recalcAccordionHeights();
    };
};
export default accordion;
