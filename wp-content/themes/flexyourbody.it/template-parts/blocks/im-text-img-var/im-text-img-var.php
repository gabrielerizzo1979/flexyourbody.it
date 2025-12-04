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
    <section class="im-text-img-var <?php echo get_field('margine_desktop'); ?> <?php echo get_field('margine_mobile'); ?> <?php echo $className; ?>">
        <div class="im-text-img-var__container basic-container container">
            <div class="im-text-img-var__wrap container-grid-el <?php echo get_field('layout_desktop');?> <?php echo get_field('layout_mobile');?>">
                <div class="im-text-img-var__column im-text-img-var__column-text <?php echo get_field('background_color'); ?>">
                    <div class="im-text-img-var__text-wrap fade">
                        <?php if( !empty(get_field('sottotitolo')) ){ ?>
                        <span class="im-text-img-var__over-head over-head"><?php echo get_field('sottotitolo');?></span>
                        <?php } ?>

                        <?php if( !empty(get_field('titolo')) ){ ?>
                        <h2 class="im-text-img-var__title h2"><?php echo get_field('titolo');?></h2>
                        <?php } ?>

                        <?php if( !empty(get_field('testo')) ){ ?>
                        <div class="im-text-img-var__p common-text-editor-style">
                            <?php echo get_field('testo');?>
                        </div>
                        <?php } ?>

                        <?php if( !empty(get_field('cta')) ){ ?>
                        <a href="<?php echo get_field('cta')['url'];?>" class="im-text-img-var__cta btn-base" title="<?php echo get_field('cta')['title'];?>" target="<?php echo get_field('cta')['target'];?>">
                            <?php echo get_field('cta')['title'];?>
                        </a>
                        <?php } ?>

                    </div>
                </div>
                <?php if( !empty(get_field('immagine')) ){ ?>
                <?php 
                $alt = _ALT_;
                if( !empty(get_field('titolo')) )           $alt = strip_tags(get_field('titolo'));
                if( !empty(get_field('immagine')['alt']) )  $alt = get_field('immagine')['alt'];
                ?>
                <div class="im-text-img-var__column im-text-img-var__column-media">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="<?php echo _THEME_IMG_;?>/spacer/spacer.png" data-srcset="<?php echo get_field('immagine')['sizes']['1920xauto']; ?>">
                        <img src="<?php echo _THEME_IMG_; ?>/spacer/spacer.png"
                            data-src="<?php echo get_field('immagine')['sizes']['800xauto']; ?>"
                            alt="<?php echo $alt ?>" width="800" height="800"
                            class="<?php echo get_field('dimensione_immagine');?> <?php echo get_field('posizionamento_immagine'); ?> lazyload">
                    </picture>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>