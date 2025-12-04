// IMPORT SCSS PER LA COMPILAZIONE
import './header.scss';
import Headroom from 'headroom.js';

// EXPORT COMPONENTE
const html = document.querySelector('html');
const body = document.querySelector('body');

const header = document.querySelector('header');
const headerWrap = document.querySelector('header .header__layout');
const menuContainer = document.querySelector(
    'header .header__layout .header__menu'
);
const hamburgerBtn = document.querySelector('header .header__layout .burger');
const linksWithSubMenu = document.querySelectorAll(
    'header .header__layout .main-menu > ul > li.dropdown'
);
const anchorLinksSubMenu = document.querySelectorAll(
    'header .header__layout .main-menu > ul > li.dropdown > a'
);
const btnMenu = document.querySelector('.wrap-wc-menu .button-menu');
const btnToggleSearch = header.querySelector('.toggle-search');
const closeSearchMobile = header.querySelector('.close-search-mobile');
const closeSearchDesktop = header.querySelector('.close-search-desktop');
const searchWrapMobile = header.querySelector('#search-mobile');
const searchWrapDesktop = header.querySelector('#search-desktop');
const inputSearch = header.querySelector('.wp-block-search__input');
const iconsWrap = header.querySelector('.woocommerce-menu');

const setHeaderHeightVar = () => {
    body.style.setProperty('--header-height', `${header.clientHeight}px`);
};

// Menu fixed con Headroom
const fixedMenu = () => {
    if (header) {
        const headroom = new Headroom(header, {
            offset: 10,
        });
        headroom.init();
    }
};

// Funzione di gestione apertura/chiusura campo search
const manageSearchComponent = () => {
    const isDesktop = window.innerWidth >= 768;
    const searchWrap = isDesktop ? searchWrapDesktop : searchWrapMobile;
    const closeSearch = isDesktop ? closeSearchDesktop : closeSearchMobile;

    btnToggleSearch.addEventListener('click', () => {
        body.classList.add('open-search');
        searchWrap.classList.add('open');
        iconsWrap.classList.add('hidden');
        if (btnMenu) btnMenu.classList.add('hidden');
        inputSearch.focus();
    });

    closeSearch.addEventListener('click', () => {
        body.classList.remove('open-search');
        searchWrap.classList.remove('open');
        iconsWrap.classList.remove('hidden');
        if (btnMenu) btnMenu.classList.remove('hidden');
        btnToggleSearch.focus();
    });

    if (window.location.href.indexOf('?s=') !== -1) {
        btnToggleSearch.click();
    }
};

// Funzione di gestione apertura/chiusura burger menu
const manageMenu = () => {
    hamburgerBtn.addEventListener('click', () => {
        const isMenuOpen = hamburgerBtn.classList.contains('open');
        header.classList.toggle('open-menu', !isMenuOpen);
        headerWrap.classList.toggle('open-menu', !isMenuOpen);
        hamburgerBtn.classList.toggle('open', !isMenuOpen);
        body.classList.toggle('open-menu-mobile', !isMenuOpen);
        html.classList.toggle('ovfw-hid-nav-mob', !isMenuOpen);
        heightMenu();
    });

    document.addEventListener('keyup', (evt) => {
        if (evt.key === 'Escape' && hamburgerBtn.classList.contains('open')) {
            header.classList.remove('open-menu');
            headerWrap.classList.remove('open-menu');
            hamburgerBtn.classList.remove('open');
            body.classList.remove('open-menu-mobile');
            html.classList.remove('ovfw-hid-nav-mob');
            heightMenu();
        }
    });
};

// Funzione di apertura del submenu
const openSubMenu = (el) => {
    el.classList.add('open');
    headerWrap.classList.add('open-submenu');

    let heightSubmenu = 0;
    let elementsInSub = el.querySelectorAll(':scope > .dropdown-menu > li');

    elementsInSub.forEach((element) => {
        heightSubmenu = heightSubmenu + element.offsetHeight;
    });

    el.querySelector(':scope > .dropdown-menu').style.height =
        heightSubmenu + 'px';
};

// Funzione di chiusura del submenu
const closeSubMenu = (el) => {
    el.classList.remove('open');
    headerWrap.classList.remove('open-submenu');
    el.querySelector(':scope > .dropdown-menu').style.height = '';
};

// Funzione per la gestione dell'apertura/chiusura dei submenu
const manageSubMenu = () => {
    linksWithSubMenu.forEach((el) => {
        el.querySelector('.dropdown-toggle').addEventListener(
            'click',
            (evt) => {
                evt.preventDefault();
                if (el.classList.contains('open')) {
                    closeSubMenu(el);
                } else {
                    openSubMenu(el);
                }
            }
        );
    });
};

// Funzione per calcolo altezza menu
const heightMenu = () => {
    let wHeight = window.innerHeight;
    let wWidth = window.innerWidth;
    let offsetTopElements = 0;

    var topbar = document.querySelector('#top-bar');

    var topbarHeight = topbar ? topbar.offsetHeight : 0;

    if (body.classList.contains('scroll-detect')) {
        offsetTopElements = header.offsetHeight;
    } else {
        offsetTopElements = topbarHeight + header.offsetHeight;
    }

    menuContainer.style.height = wHeight - offsetTopElements + 'px';
};

const initHeader = () => {
    manageMenu();
    manageSubMenu();
    heightMenu();
    fixedMenu();
    manageSearchComponent();
    setHeaderHeightVar();

    window.addEventListener('resize', () => {
        linksWithSubMenu.forEach((el) => el.classList.remove('open'));
        heightMenu();
        manageSearchComponent();
        setHeaderHeightVar();
    });

    document.addEventListener('keydown', (evt) => {
        if (evt.key === 'Escape') {
            linksWithSubMenu.forEach((el) => el.classList.remove('open'));
        }
    });
};

export default initHeader;
