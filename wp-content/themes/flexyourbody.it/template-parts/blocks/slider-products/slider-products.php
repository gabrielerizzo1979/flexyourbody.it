<?php
$className = '';
if( !empty($block['className']) ) {
	$className = $block['className'];
}
$classes = explode(" ", $className);
$off = false;
foreach ($classes as $myclass) {
	if ( $myclass=='off' ) {
		$off = true;
	}
}
if($off && is_admin())	$off=false;
if(!$off){
?>

<section class="slider-products bg-common common-swiper-el common-title-box--s <?php echo get_field('margine'); ?> <?php echo $className; ?>">
    <div class="slider-products__container basic-container container">
        <div class="slider-products__sub-container container-grid-el">
            <div class="title-box fade">
                <div class="title-box__container text-left">
                    <div class="title-box__first-wrap">
                        <?php if( !empty(get_field('sottotitolo')) ){ ?>
                        <span class="title-box__over-head over-head">
                            <?php echo get_field('sottotitolo');?>
                        </span>
                        <?php } ?>
                        <?php if( !empty(get_field('titolo')) ){ ?>
                        <h2 class="title-box__title h3">
                            <?php echo get_field('titolo');?>
                        </h2>
                        <?php } ?>
                    </div>
                    <?php if( !empty(get_field('cta')) ){ ?>
                    <div class="title-box__second-wrap">
                        <a href="<?php echo get_field('cta')['url'];?>" title="<?php echo get_field('cta')['title'];?>"
                            target="<?php echo get_field('cta')['target'];?>" class="title-box__cta text-link">
                            <?php echo get_field('cta')['title'];?>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <?php if( !empty(get_field('shortcode_prodotti')) ){ ?>
            <div class="slider-products__wrap fade">
                <div id="theme-custom-wc-notices" class="wc-notices-theme">
                    <div class="home-products">
                    </div>
                </div>
                <?php
                $shortcode = get_field('shortcode_prodotti');
                echo do_shortcode($shortcode);
                ?>
                <div class="slider-products__nav swiper-nav">
                    <div class="swiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            shape-rendering="geometricPrecision" class="icon">
                            <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_prev"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            shape-rendering="geometricPrecision" class="icon">
                            <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_next"></use>
                        </svg>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php } ?>