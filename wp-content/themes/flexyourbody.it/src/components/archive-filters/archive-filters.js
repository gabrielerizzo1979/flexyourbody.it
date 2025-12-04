// IMPORT SCSS PER LA COMPILAZIONE
import './archive-filters.scss';

// EXPORT COMPONENTE
const archiveFilters = () => {
    let archiveFilterBlock = document.querySelector(
        '.pg-archive .archive-filters'
    );
    let selectFilters = document.querySelector('#select-filters');

    if (!archiveFilterBlock) return;

    selectFilters.addEventListener('change', () => {
        let url = selectFilters.value;

        if (url) {
            // require a URL
            window.location = url; // redirect
        }
        return false;
    });
};
export default archiveFilters;
