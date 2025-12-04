<?php
$className = '';
if( !empty($block['className']) ) {
	$className = $block['className'];
}
$gallery = '';
if( !empty(get_field('gallery')) && count(get_field('gallery'))>0 ) {
    $gallery = get_field('gallery');
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

<section class="im-carousel-gallery common-swiper-el common-title-box--s <?php echo get_field('margine') ?> <?php echo get_field('background_color') ?> <?php echo $className; ?>">
    <div class="im-carousel-gallery__container basic-container container <?php echo get_field('padding'); ?>">
        <div class="im-carousel-gallery__sub-container container-grid-el fade">
            <?php if( !empty(get_field('titolo')) || !empty(get_field('sottotitolo')) ) { ?>
            <div class="title-box">
                <div class="title-box__container text-left">
                    <div class="title-box__first-wrap">
                        <?php if( !empty(get_field('sottotitolo'))) { ?>
                        <span class="title-box__over-head over-head"><?php echo get_field('sottotitolo') ?></span>
                        <?php } ?>
                        <?php if( !empty(get_field('titolo'))) { ?>
                        <h2 class="title-box__title h2"><?php echo get_field('titolo') ?></h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="im-carousel-gallery__wrap">
                <div class="swiper">
                    <div class="swiper-wrapper lightgallery">
                        <?php if( $gallery != '' ){ ?>
                        <?php foreach ($gallery as $image) { ?>
                            <div class="im-carousel-gallery__media swiper-slide"
                                data-exthumbimage="<?php echo $image['sizes']['thumbnail']; ?>"
                                data-src="<?php echo $image['sizes']['1920xauto']; ?>">
                                <?php
                                $alt = _ALT_;
                                if( $image['alt'] != '' )	$alt = $image['alt'];
                                ?>
                                <picture>
                                    <img src="<?php echo _THEME_IMG_; ?>/spacer/spacer.png"
                                        data-src="<?php echo $image['sizes']['800x800']; ?>" alt="<?php echo $alt; ?>"
                                        width="800" height="800" class="lazyload">
                                </picture>
                                <div class="im-carousel-gallery__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon">
                                        <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_fullscreen"></use>
                                    </svg>
                                </div>
                            </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="im-carousel-gallery swiper-nav">
                    <div class="swiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon">
                            <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_prev"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon">
                            <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_next"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>