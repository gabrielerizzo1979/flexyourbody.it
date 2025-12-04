/*
 *
 * File JS per general
 *
 */

// IMPORT STILE SPECIFICO PAGINA
//--------------------------------------------------------------------//

import './general.scss';

//--------------------------------------------------------------------//

// IMPORT COMPONENTI
//--------------------------------------------------------------------//

import modal from 'imComponents/modal/modal';
import initHeader from 'components/header/header';
import breadcrumbs from 'components/breadcrumbs/breadcrumbs';
import hero from 'components/hero/hero';
import titleBox from 'components/title-box/title-box';
import accordion from 'imComponents/accordion/accordion';
import boxFrom from 'components/box-form/box-form';

//--------------------------------------------------------------------//
// INIT COMPONENTI
//--------------------------------------------------------------------//
function initAllComponents() {
    initHeader();
    accordion();
    modal();
}
if (document.querySelector('body.wp-admin')) {
    (function ($) {
        var initBlock = function ($block) {
            initAllComponents();
        };
        if (window.acf) {
            window.acf.addAction('render_block_preview', initBlock);
        }
    })(jQuery);
}
initAllComponents();
//--------------------------------------------------------------------//
