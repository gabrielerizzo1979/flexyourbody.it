/*
 *
 * File JS per la parte dei Widget di Woocommerce
 *
 */

// IMPORT COMPONENTI
//--------------------------------------------------------------------//

import initMiniCart from 'components/mini-cart/mini-cart';

//--------------------------------------------------------------------//

// IMPORT STILE SPECIFICO PAGINA
//--------------------------------------------------------------------//

import './woo-widgets.scss';

//--------------------------------------------------------------------//

// INIT COMPONENTI
//--------------------------------------------------------------------//

//--------------------------------------------------------------------//

// JS SPECIFICO PAGINA
//--------------------------------------------------------------------//
const modalFilters = () => {
    const sidebar = document.querySelector('.wc-sidebar-archive');
    if (!sidebar) return;

    const body = document.querySelector('body');
    const sidebarOverlay = sidebar.querySelector(
        '.wc-sidebar-archive__overlay'
    );
    const sidebarContainer = sidebar.querySelector(
        '.wc-sidebar-archive__container'
    );
    const closeBtn = sidebar.querySelector('.wc-sidebar-archive__close');
    const openBtn = document.querySelector('.btn-filters');

    function openModal() {
        sidebar.style.display = 'flex';
        body.style.overflow = 'hidden';
        sidebar.setAttribute('aria-hidden', 'false');

        sidebarContainer.focus();
    }

    function closeModal() {
        sidebar.style.display = 'none';
        sidebar.setAttribute('aria-hidden', 'true');
        body.style.overflow = '';

        openBtn.focus();
    }

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    sidebarOverlay.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) {
        if (
            e.key === 'Escape' &&
            sidebar.style.display === 'flex' &&
            window.innerWidth <= 1024
        ) {
            closeModal();
        }
    });

    const manageSidebar = () => {
        if (window.innerWidth <= 1024) {
            sidebar.style.display = 'none';
            sidebar.setAttribute('aria-hidden', 'true');
        } else {
            sidebar.style.display = 'flex';
            sidebar.setAttribute('aria-hidden', 'false');
        }
    };

    window.addEventListener('resize', manageSidebar);
};

modalFilters();

const checkCategories = () => {
    const categoriesWrap = document.querySelector(
        '.wp-block-woocommerce-product-categories'
    );

    if (!categoriesWrap) return;

    let currentUrl = window.location.href;
    let categoryItems = document.querySelectorAll(
        '.wc-block-product-categories-list-item'
    );

    const checkSubcategories = (parentItem, currentUrl) => {
        var subcategories = parentItem.querySelectorAll(
            '.wc-block-product-categories-list-item'
        );

        subcategories.forEach(function (subCategory) {
            var subCategoryLink = subCategory.querySelector('a');
            var subCategoryUrl = subCategoryLink.getAttribute('href');

            if (currentUrl.includes(subCategoryUrl)) {
                parentItem.classList.add('active');
                subCategory.classList.add('active');
            }

            checkSubcategories(subCategory, currentUrl);
        });
    };

    categoryItems.forEach(function (item) {
        let categoryLink = item.querySelector('a');
        if (!categoryLink) return;
        let categoryUrl = categoryLink.getAttribute('href');
        if (currentUrl.includes(categoryUrl)) {
            item.classList.add('active');
        }
        checkSubcategories(item, currentUrl);
    });
};

checkCategories();
