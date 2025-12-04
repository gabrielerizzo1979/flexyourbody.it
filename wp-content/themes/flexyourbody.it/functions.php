<?php
if (class_exists('ACF')) { 
    //
    define('_s_', '/' );
    define('_DIRNAME_', dirname(__FILE__) );
    define('_URI_', get_bloginfo('url') );
    define('_URL_', get_template_directory_uri());
    define('_DIR_', get_template_directory());
    define('_HOME_', trailingslashit( home_url() ));
    define('_TEXT_DOMAIN_', 'flexyourbody.it');
    define('_THEME_NAME_', 'flexyourbody.it');
    define('_THEME_IMG_', _URL_ . '/assets/img');
    define('_THEME_CSS_', _URL_ . '/assets/build/css');
    define('_THEME_CUSTOM_FONT_', _URL_ . '/assets/fonts');
    define('_THEME_JS_', _URL_ . '/assets/build/js');
    define('_THEME_BUILD_', _URL_ . '/assets/build');
    define('_THEME_BLOCKS_', _DIR_ . '/template-parts/blocks');
    //
    if( !empty(get_field('wo_alt','options')) ) {
        define('_ALT_', __(get_field('wo_alt','options'),'easylab-wp'));
    }else{
        define('_ALT_', ''); 
    }
    //
    define('_VERSION_', '0.0.02');
    //
    require_once 'includes/imm_navwalker.php';
    include 'includes/theme-functions.php';
    include 'includes/plugins/plg-acf.php';
    include 'includes/plugins/plg-acf_blocks.php';
    include 'includes/plugins/plg-cf7.php';
    include 'includes/plugins/plg-seo.php';
    include 'includes/plugins/plg-woocommerce.php';
    include 'includes/plugins/plg-woocommerce-settings.php';
    include 'includes/plugins/plg-woocommerce-html.php';
    // include 'includes/plugins/plg-wpml.php';
    include 'includes/theme-custom-widgets.php';
    include 'includes/theme-pagination.php';
    //
    add_filter( 'auto_update_plugin', '__return_true' );
    add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );
    //
}
require_once get_template_directory() . '/class-tgm-plugin-activation.php';
include_once 'required-plugins.php';