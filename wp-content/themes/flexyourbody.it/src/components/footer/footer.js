// IMPORT SCSS PER LA COMPILAZIONE
import './footer.scss';

// EXPORT COMPONENTE
const footer = () => {
    const allBtnToTop = document.querySelectorAll('.btn-to-top');

    if (!allBtnToTop.length) return;

    allBtnToTop.forEach((el, i) => {
        el.addEventListener('click', (evt) => {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    });
};
export default footer;
