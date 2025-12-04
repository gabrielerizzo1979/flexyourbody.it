// IMPORT SCSS PER LA COMPILAZIONE
import './modal.scss';

// EXPORT COMPONENTE
const modal = () => {
    let buttonsOpenModal = document.querySelectorAll('.im-modal__open');
    let buttonsCloseModal = document.querySelectorAll('.im-modal__close');
    let blockModal = document.querySelectorAll('.im-modal');
    let blockModalContent = document.querySelectorAll('.im-modal__content');
    let backgroundModal = document.querySelectorAll('.im-modal__background');

    if (!blockModal.length) return;

    buttonsOpenModal.forEach((el) => {
        el.addEventListener('click', function (evt) {
            evt.preventDefault();
            let dataModal = this.getAttribute('data-modal');
            let modalToOpen = document.querySelector(
                '.im-modal[data-modal="' + dataModal + '"]'
            );
            manageModal(modalToOpen);
        });
    });

    buttonsCloseModal.forEach((el) => {
        el.addEventListener('click', function (evt) {
            evt.preventDefault();
            let dataModal = this.getAttribute('data-modal');
            let modalToClose = document.querySelector(
                '.im-modal[data-modal="' + dataModal + '"]'
            );

            manageModal(modalToClose);
        });
    });

    backgroundModal.forEach((element) => {
        element.addEventListener('click', () => {
            closeAllModal();
        });
    });

    /**
     *	Funzione di gestione apertura e chiusura dei modal popup
     *
     */

    const manageModal = (modalTarget) => {
        //Seleziona il video della modale se presente
        let isVideo = modalTarget.querySelector('video');

        if (!modalTarget.classList.contains('open')) {
            modalTarget.classList.remove('close');
            modalTarget.classList.add('open');

            //Video in play all'apertura della modale
            if (!isVideo) return;
            isVideo.play();
        } else {
            modalTarget.classList.remove('open');
            modalTarget.classList.add('close');

            //Video in pause alla chiusura della modale
            if (!isVideo) return;
            isVideo.pause();
        }
    };

    /**
     *	Funzione per la chiusura di tutti i modal popup
     *
     */
    const closeAllModal = () => {
        let allModal = document.querySelectorAll('.im-modal');
        document.body.style.overflow = '';
        allModal.forEach((el) => {
            el.classList.remove('open');
            el.classList.add('close');
            let isVideo = el.querySelector('video');
            if (!isVideo) return;
            isVideo.pause();
        });
    };

    /**
     *	Funzione di gestione chiusura dei modal popup digitando ESC
     *
     */
    const closeAllOnKeyup = (e) => {
        if (e.keyCode === 27) {
            document.body.style.overflow = '';
            closeAllModal();
        }
    };

    document.addEventListener('keyup', closeAllOnKeyup);

    /**
     *	Event listener per la chiusura del popup quando si clicca all'esterno
     */
    //blockModal[0].addEventListener('click', function(evt)
    //{
    //
    //    if( !blockModalContent[0].contains(evt.target) )
    //    {
    //        closeAllModal();
    //    }
    //}, true);
};

export default modal;

//--------------------------------------------------------------------//
