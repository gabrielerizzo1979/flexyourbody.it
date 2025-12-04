/*
 *
 * File JS per product single
 *
 */

// IMPORT STILE SPECIFICO PAGINA
//--------------------------------------------------------------------//
import './wc-product.scss';
//--------------------------------------------------------------------//

// IMPORT LIBRERIE ESTERNE
//--------------------------------------------------------------------//
import Swiper from 'swiper/bundle';
//--------------------------------------------------------------------//

// JS SPECIFICO PAGINA
//--------------------------------------------------------------------//
// const changeQuantity = () => {
//     const quantityWrap = document.querySelector('.column-summary .quantity');
//     if (!quantityWrap) return;

//     const input = quantityWrap.querySelector('.input-text');
//     if (!input) return;

//     const minusButton = document.createElement('button');
//     const plusButton = document.createElement('button');

//     minusButton.textContent = '－';
//     plusButton.textContent = '＋';

//     minusButton.className = 'btn-quantity minus-btn';
//     plusButton.className = 'btn-quantity plus-btn';

//     minusButton.addEventListener('click', (evt) => {
//         if (input.value > 1) {
//             evt.preventDefault();
//             input.value = parseInt(input.value) - 1;
//         } else {
//             evt.preventDefault();
//         }
//     });

//     plusButton.addEventListener('click', (evt) => {
//         evt.preventDefault();
//         input.value = parseInt(input.value) + 1;
//     });

//     quantityWrap.appendChild(minusButton);
//     quantityWrap.appendChild(plusButton);
// };
// changeQuantity();

const changeQuantity = () => {
    const productWrap = document.querySelector('.single-product .product');
    if (!productWrap || productWrap.classList.contains('sold-individually'))
        return;

    const quantityWrap = document.querySelector('.column-summary .quantity');
    if (!quantityWrap) return;

    const input = quantityWrap.querySelector('.input-text');
    if (!input) return;

    const minusButton = document.createElement('button');
    const plusButton = document.createElement('button');

    minusButton.textContent = '－';
    plusButton.textContent = '＋';

    minusButton.className = 'btn-quantity minus-btn';
    plusButton.className = 'btn-quantity plus-btn';

    const updateButtonsState = () => {
        minusButton.disabled = Number(input.value) <= 1;
    };

    const triggerChangeEvent = () => {
        const event = new Event('change', { bubbles: true });
        input.dispatchEvent(event);
    };

    minusButton.addEventListener('click', (evt) => {
        evt.preventDefault();
        let currentValue = Number(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            updateButtonsState();
            triggerChangeEvent();
        }
    });

    plusButton.addEventListener('click', (evt) => {
        evt.preventDefault();
        let currentValue = Number(input.value);
        input.value = currentValue + 1;
        updateButtonsState();
        triggerChangeEvent();
    });

    const fragment = document.createDocumentFragment();
    fragment.appendChild(minusButton);
    fragment.appendChild(plusButton);

    quantityWrap.appendChild(fragment);

    updateButtonsState();
};

changeQuantity();

const tabsProduct = () => {
    const tabsWrapper = document.querySelector('.woocommerce-tabs');
    if (!tabsWrapper) return;

    const originalDescriptionTab = tabsWrapper.querySelector(
        '#tab-title-description a'
    );
    const originalInformationTab = tabsWrapper.querySelector(
        '#tab-title-additional_information a'
    );
    const originalReviewsTab = tabsWrapper.querySelector(
        '#tab-title-reviews a'
    );

    const description = tabsWrapper.querySelector('#tab-description');
    const information = tabsWrapper.querySelector(
        '#tab-additional_information'
    );
    const reviews = tabsWrapper.querySelector('#tab-reviews');

    const createButton = (originalTab, className, contentId, elementId) => {
        const button = document.createElement('button');
        button.id = elementId;
        if (originalTab) {
            button.textContent = originalTab.textContent;
            button.className = `panel-title ${className}`;

            button.addEventListener('click', () => {
                toggleTab(contentId);
            });
        }
        return button;
    };

    let descriptionTab = createButton(
        originalDescriptionTab,
        'description_tab',
        '#tab-description',
        'mobile-tab-description'
    );

    let informationTab = createButton(
        originalInformationTab,
        'additional_information_tab',
        '#tab-additional_information',
        'mobile-tab-additional_information'
    );

    let reviewsTab = createButton(
        originalReviewsTab,
        'reviews_tab',
        '#tab-reviews',
        'mobile-tab-reviews'
    );

    let linkReviews = document.querySelector('a.woocommerce-review-link');

    const manageNewTabTitle = () => {
        if (window.innerWidth < 768) {
            tabsWrapper.classList.add('mobile-v');

            if (description && !descriptionTab.parentNode) {
                tabsWrapper.insertBefore(descriptionTab, description);
            }

            if (information && !informationTab.parentNode) {
                tabsWrapper.insertBefore(informationTab, information);
            }

            if (reviews && !reviewsTab.parentNode) {
                tabsWrapper.insertBefore(reviewsTab, reviews);
            }

            if (linkReviews) {
                linkReviews.href = '#mobile-tab-reviews';
                linkReviews.addEventListener('click', () => {
                    const tabReviews = document.querySelector('#tab-reviews');
                    tabReviews.style.padding = '24px 0';
                    tabReviews.style.maxHeight =
                        tabReviews.scrollHeight + 48 + 'px';
                    reviews.scrollIntoView();
                });
            }
        } else if (
            window.innerWidth >= 768 &&
            tabsWrapper.classList.contains('mobile-v')
        ) {
            tabsWrapper.classList.remove('mobile-v');

            if (description && descriptionTab.parentNode) {
                descriptionTab.parentNode.removeChild(descriptionTab);
                description.style.maxHeight = null;
                description.style.padding = null;
            }

            if (information && informationTab.parentNode) {
                informationTab.parentNode.removeChild(informationTab);
                information.style.maxHeight = null;
                information.style.padding = null;
            }

            if (reviews && reviewsTab.parentNode) {
                reviewsTab.parentNode.removeChild(reviewsTab);
                reviews.style.maxHeight = null;
                reviews.style.padding = null;
            }

            if (linkReviews) {
                linkReviews.href = '#reviews';
            }
        }
    };

    const toggleTab = (contentId) => {
        const tabContent = document.querySelector(contentId);
        // if (tabContent && tabContent.style.maxHeight) {
        //     (tabContent.style.maxHeight = tabContent.style.maxHeight
        //         ? null
        //         : tabContent.scrollHeight + '48px'),
        //         (tabContent.style.padding = '24px 0');
        // }

        if (tabContent) {
            if (tabContent.style.maxHeight) {
                tabContent.style.padding = 0;
                tabContent.style.maxHeight = null;
            } else {
                tabContent.style.padding = '24px 0';
                tabContent.style.maxHeight =
                    tabContent.scrollHeight + 48 + 'px';
            }
        }
    };

    // const toggleTab = (contentId) => {
    //     const tabContent = document.querySelector(contentId);
    //     if (tabContent) {
    //         const allContents = document.querySelectorAll(
    //             '.woocommerce-Tabs-panel'
    //         );

    //         allContents.forEach((content) => {
    //             if (content !== tabContent) {
    //                 content.style.maxHeight = null;
    //             }
    //         });

    //         tabContent.style.maxHeight = tabContent.style.maxHeight
    //             ? null
    //             : tabContent.scrollHeight + 'px';
    //     }
    // };

    manageNewTabTitle();
    window.addEventListener('resize', manageNewTabTitle);
};
tabsProduct();
//--------------------------------------------------------------------//
