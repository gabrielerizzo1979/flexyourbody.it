<?php   get_header();    ?>

<?php
if( !is_product() || is_shop() ){
    //
    get_template_part('includes/template-parts/part', 'hero-simple');
    //
    $term = get_queried_object();
    //
    if( !empty( get_field('mostra_categorie_prodotto_sotto_la_hero','options') ) && get_field('mostra_categorie_prodotto_sotto_la_hero','options') ){
        if( is_product_category() ){
            $term = get_queried_object();
            $parent = $term->parent;
            $term_id = $term->term_id;
            if( $parent == 0 ){
                $product_cats = get_terms(
                    array(
                        'taxonomy'      => 'product_cat',
                        'parent'        => $parent,
                        'hide_empty'    => true,
                    )
                );
            }else{
                $product_cats = get_terms(
                    array(
                        'taxonomy'      => 'product_cat',
                        'parent'        => $parent,
                        'hide_empty'    => true,
                    )
                );
            }
            
            ?>
            <?php if( $product_cats ){  ?>
            <div class="slider-categories common-swiper-el">
                <div class="slider-categories__container container">
                    <div class="swiper-container">
                        <div class="swiper-wrapper product-categories">
                            <?php if( $parent == 0 ){  ?>
                            <div class="swiper-slide">
                                <a href="<?php echo get_permalink(get_option( 'woocommerce_shop_page_id' )) ?>"><?php _e('All', 'flexyourbody.it') ?></a>
                            </div>
                            <?php }else{ ?>
                            <div class="swiper-slide ">
                                <?php 
                                $parent_term = get_term($parent,'product_cat');
                                ?>
                                <a href="<?php echo get_permalink(get_option( 'woocommerce_shop_page_id' )) ?>"><?php _e('All', 'flexyourbody.it') ?></a>
                            </div>
                            <?php } ?>

                            <?php foreach($product_cats as $cat ) { ?>
                                <?php
                                $cat_id = $cat->term_id;
                                $active = '';
                                if(isset($term_id) && $cat_id == $term_id)    $active = 'active';
                                ?>
                                
                                <div class="swiper-slide <?php echo $active ?>">
                                    <a href="<?php echo get_term_link($cat_id) ?>"><?php echo $cat->name;?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
        }elseif( is_shop() ){
            $args = array(
                'taxonomy'     => 'product_cat',
                'parent'       => 0,
            );
            $product_cats = get_categories( $args ); ?>
            <?php if( $product_cats ){  ?>
            <div class="slider-categories common-swiper-el">
                <div class="slider-categories__container container">
                    <div class="swiper-container">
                        <div class="swiper-wrapper product-categories">
                            
                            <div class="swiper-slide active">
                                <a href="<?php echo get_permalink(get_option( 'woocommerce_shop_page_id' )) ?>"><?php _e('All', 'flexyourbody.it') ?></a>
                            </div>

                            <?php foreach($product_cats as $cat ) { ?>
                                <?php
                                $cat_id = $cat->term_id;
                                $active = '';
                                if(isset($term_id) && $cat_id == $term_id)    $active = 'active';
                                ?>
                                <div class="swiper-slide <?php echo $active ?>">
                                    <a href="<?php echo get_term_link($cat_id) ?>"><?php echo $cat->name;?></a>
                                </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php
        }
    }
    ?>
<?php
}
?>


<?php
if( !is_product() && (is_shop() || is_product_category() ) ){
    if( !empty(get_field('wo_crea_sidebar','options')) ){
        if( get_field('wo_crea_sidebar','options') ){
            $output = '<button class="btn-filters"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"';
            $output .= 'shape-rendering="geometricPrecision" class="icon"><use xlink:href="'. _THEME_BUILD_.'/spritemap.svg#ico_sort-by"></use></svg>'.__('Filtri','flexyourbody.it').'</button>';
            echo $output;
        }
    }
}
?>

<?php
$class_sidebar = 'sidebar-off';
if( !empty(get_field('wo_crea_sidebar','options')) ){
    if( get_field('wo_crea_sidebar','options') ){
        $class_sidebar = 'sidebar-on';
    }
}
?>
<div class="pg-woocommerce <?php echo $class_sidebar; ?>">
    <section class="section-wc-content">

        <?php if (!is_product()){
            if( !empty(get_field('wo_crea_sidebar','options')) ){
                if( get_field('wo_crea_sidebar','options') ){ ?>
                    <div class="wc-sidebar-archive">
                        <button class="wc-sidebar-archive__overlay" aria-label="<?php _e('Clicca per chiudere la modale', 'flexyourbody.it'); ?>"></button>
                        <div class="wc-sidebar-archive__container">
                            <button class="wc-sidebar-archive__close" aria-label="<?php _e('Clicca per chiudere la modale', 'flexyourbody.it'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon-close">
                                    <use xlink:href="<?php echo _THEME_BUILD_;?>/spritemap.svg#ico_close"></use>
                                </svg>
                            </button>
                            <ul class="wc-sidebar-archive__wrap">
                                <?php dynamic_sidebar('sidebar-wc'); ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>

        <div class="inner-wc-content">
            <?php woocommerce_content(); ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>