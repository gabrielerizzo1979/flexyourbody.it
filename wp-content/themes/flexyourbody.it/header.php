<!DOCTYPE html>
<?php if (!class_exists('ACF')) { exit(); } ?>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta name="color-scheme" content="light only">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <?php get_template_part('includes/template-parts/part', 'theme-gtm-head'); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_template_part('includes/template-parts/part', 'theme-gtm-body'); ?>

    <header class="header headroom">
        <?php if( !empty(get_field('topbar','options')) ){ ?>
        <?php 
            $active = 'off';
            if( get_field('topbar_scroll','options') )	$active = 'on';
        ?>
            <div class="marquee <?php echo $active ?>">
                <?php if( get_field('topbar_scroll','options') ){ ?>
                <p class="screen-reader-text"><?php echo get_field('topbar','options') ?></p>
                <div class="marquee__loop">
                    <p class="marquee__content" aria-hidden="true"><?php echo get_field('topbar','options') ?></p>
                </div>
                <?php }else{ ?>
                <p class="text"><?php echo get_field('topbar','options') ?></p>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="header__layout header-layout header-wrap">
            <div class="header__container extra-large-container">
                
                <div class="header__logo logo">
                    <a class="logo__link" href="<?php echo _HOME_ ?>"
                        title="<?php _e('Vai alla Homepage', 'flexyourbody.it'); ?>">
                        <img src="<?php echo _THEME_IMG_ ?>/share/logo.svg"  alt="<?php echo _ALT_ ?>" width="130" height="12">
                    </a>
                </div>
                
                <div id="search-mobile" class="search-form-wrap">
                    <div class="search-form-wrap__container">
                        <ul>
                            <?php dynamic_sidebar('search-wc'); ?>
                        </ul>
                    </div>
                    <button class="close-search close-search-mobile"></button>
                </div>
                <div class="header__wrap-wc-menu wrap-wc-menu">
                    <div id="search-desktop" class="search-form-wrap">
                        <div class="search-form-wrap__container">
                            <ul>
                                <?php dynamic_sidebar('search-wc'); ?>
                            </ul>
                        </div>
                        <button class="close-search close-search-desktop"></button>
                    </div>
                    <nav>
                        <div class="woocommerce-menu">
                            <div class="item-wrap search">
                                <button class="toggle-search">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        shape-rendering="geometricPrecision" class="icons-search">
                                        <use xlink:href="<?php echo _THEME_BUILD_;?>/spritemap.svg#ico_search"></use>
                                    </svg>
                                    <span class="screen-reader-text">
                                        <?php _e('Apri la barra di ricerca', 'flexyourbody.it'); ?>
                                    </span>
                                </button>
                            </div>
                            <?php 
							if ( class_exists( 'WooCommerce' ) ) { ?>
                            <?php if (defined( 'YITH_WCWL' )){ ?>
                            <div class="item-wrap wishlist">
                                <a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>"
                                    title="<?php esc_html_e('Wishlist', 'flexyourbody.it'); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        shape-rendering="geometricPrecision" class="icons-heart">
                                        <use xlink:href="<?php echo _THEME_BUILD_;?>/spritemap.svg#ico_favourite"></use>
                                    </svg>
                                </a>
                            </div>
                            <?php } ?>
                            <div class="item-wrap wc-icon">
                                <div class="wc-icon__wrap">
                                    <ul>
                                        <?php dynamic_sidebar('minicart-wc'); ?>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                        if (has_nav_menu('wpml-menu')) {
                            wp_nav_menu( array(
                                'theme_location'  => 'wpml-menu',
                                'container'       => 'ul',
                                'container_class' => 'menu-wpml',
                                'menu_class'      => 'menu-wpml',
                                'menu_id'         => 'menu-wpml-d',
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'          => new WP_Bootstrap_Navwalker(),
                            ) );
                        }
                        ?>
                        <?php
                        if (has_nav_menu('button-menu')) {
                            wp_nav_menu( array(
                                'theme_location'  => 'button-menu',
                                'container'       => 'ul',
                                'container_class' => 'button-menu',
                                'menu_class'      => 'button-menu',
                                'menu_id'         => 'button-menu-d',
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'          => new WP_Bootstrap_Navwalker(),
                            ) );
                        }
                        ?>
                    </nav>
                </div>
                <div class="header__menu-right menu-right">
                    <button class="burger" aria-label="<?php _e('Apri il menu', 'flexyourbody.it'); ?>">
                        <span class="line">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="header__menu menu">
                <div class="menu__main-wrapper">
                    <div class="menu__sub-wrapper extra-large-container">
                        <nav id="block-main-menu" class="main-menu ">
                            <?php
                            if (has_nav_menu('primary')) {
                                wp_nav_menu( array(
                                    'theme_location'  => 'primary',
                                    'container'       => 'ul',
                                    'container_class' => 'main-menu-list',
                                    'menu_class'      => 'main-menu-list',
                                    'menu_id'         => 'main-menu-list',
                                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                    'walker'          => new WP_Bootstrap_Navwalker(),
                                ) );
                            }
                            ?>
                            <?php
                            if (has_nav_menu('wpml-menu')) {
                                wp_nav_menu( array(
                                    'theme_location'  => 'wpml-menu',
                                    'container'       => 'ul',
                                    'container_class' => 'menu-wpml',
                                    'menu_class'      => 'menu-wpml',
                                    'menu_id'         => 'menu-wpml-m',
                                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                    'walker'          => new WP_Bootstrap_Navwalker(),
                                ) );
                            }
                            ?>
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer-menu"></div>
    </header>
    
    <?php include 'includes/template-parts/part-im-modal-cookie.php'; ?>

    <main id="main-content">