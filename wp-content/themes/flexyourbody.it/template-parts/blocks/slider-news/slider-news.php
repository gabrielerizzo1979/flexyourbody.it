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
    $tipologia = 'post';
    $args = array(
        'post_type'         =>  $tipologia,
        'posts_per_page'    =>  6,
    );
    $the_query = new WP_Query( $args );
    ?>
    <?php if ( $the_query->have_posts() ){ ?>
        <section class="slider-news common-title-box--s common-swiper-el <?php echo get_field('margine') ?> <?php echo get_field('background_color') ?> <?php echo $className; ?>">
            <div class="slider-news__container basic-container container-grid-el container <?php echo get_field('padding') ?>">
                <div class="slider-news__sub-container container-grid-el">
                    <?php if( !empty(get_field('sottotitolo')) || !empty(get_field('titolo')) || !empty(get_field('cta')) ) { ?>
                    <div class="title-box fade">
                        <div class="title-box__container text-left">
                            <div class="title-box__first-wrap">
                                <?php if( !empty(get_field('sottotitolo'))) { ?>
                                    <span class="title-box__over-head over-head"><?php echo get_field('sottotitolo') ?></span>
                                <?php } ?>
                                <?php if( !empty(get_field('titolo'))) { ?>
                                    <h2 class="title-box__title h3"><?php echo get_field('titolo') ?></h3>
                                <?php } ?>
                            </div>
                            <?php if( !empty(get_field('cta'))) { ?>
                            <div class="title-box__second-wrap">
                                <a href="<?php echo get_field('cta')['url'] ?>" title="<?php echo get_field('cta')['title'];?>" target="<?php echo get_field('cta')['target'];?>" class="title-box__cta text-link">
                                        <?php echo get_field('cta')['title'] ?>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="slider-news__wrap fade">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();
                                    echo get_template_part('/includes/template-parts/part', 'card-news');
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                            <div class="slider-news__nav swiper-nav">
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
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>