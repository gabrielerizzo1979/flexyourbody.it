// IMPORT UTILITIES JS
import { setCookie, getCookie } from '../../js/utilities/cookie';

// IMPORT SCSS PER LA COMPILAZIONE
import './modal-cookie.scss';

// EXPORT COMPONENTE
const modalCookie = () => {
    let buttonsCloseModal = document.querySelectorAll(
        '.im-modal-cookie__close'
    );
    let blockModal = document.querySelectorAll('.im-modal-cookie');
    let backgroundModal = document.querySelectorAll(
        '.im-modal-cookie__background'
    );

    if (!blockModal.length) return;

    blockModal.forEach((el) => {
        let dataCookieName = el.getAttribute('data-name');

        if (getCookie(dataCookieName) == null) {
            el.classList.add('open');
        }
    });

    buttonsCloseModal.forEach((el) => {
        el.addEventListener('click', function (evt) {
            evt.preventDefault();
            let dataModal = this.getAttribute('data-modal');

            closeThisModal(dataModal);
        });
    });

    backgroundModal.forEach((element) => {
        element.addEventListener('click', () => {
            let dataModal = element
                .closest('.im-modal-cookie')
                .getAttribute('data-modal');

            closeThisModal(dataModal);
        });
    });

    /**
     *	Funzione per la chiusura di tutti i modal popup
     *
     */
    const closeThisModal = (data) => {
        let modalToClose = document.querySelector(
            '.im-modal-cookie[data-modal="' + data + '"]'
        );
        let dataCookieExpire = parseInt(
            modalToClose.getAttribute('data-expire')
        );
        let dataCookieName = modalToClose.getAttribute('data-name');

        document.body.style.overflow = '';
        modalToClose.classList.remove('open');

        setCookie(dataCookieName, 'true', dataCookieExpire);
    };

    /**
     *	Funzione per la chiusura di tutti i modal popup
     *
     */
    const closeAllModal = () => {
        let allModal = document.querySelectorAll('.im-modal-cookie');
        document.body.style.overflow = '';

        allModal.forEach((el) => {
            let dataModal = el.getAttribute('data-modal');
            closeThisModal(dataModal);
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
};

export default modalCookie;

//--------------------------------------------------------------------//
