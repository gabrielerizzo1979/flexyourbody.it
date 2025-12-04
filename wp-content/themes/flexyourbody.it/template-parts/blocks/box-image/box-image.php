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

<section class="box-image common-title-box--m <?php echo get_field('margine'); ?> <?php echo get_field('background_color'); ?> <?php echo $className; ?>">
    <div class="box-image__container basic-container <?php echo get_field('larghezza'); ?> <?php echo get_field('padding'); ?>">
        <div class="box-image__sub-container container-grid-el fade">

            <?php if( !empty(get_field('immagine')) ){ ?>
            <div class="box-image__img">
                <?php
                $alt = _ALT_;
                if( !empty(get_field('titolo')) )	$alt = strip_tags(get_field('titolo'));
                if( !empty(get_field('immagine')['alt']) )	$alt = get_field('immagine')['alt'];
                ?>
                <picture class="<?php echo get_field('dimensione_immagine'); ?>">
                    <source media="(min-width: 768px)" srcset="<?php echo _THEME_IMG_;?>/spacer/spacer.png"
                        data-srcset="<?php echo get_field('immagine')['sizes']['1920xauto']; ?>">
                    <img src="<?php echo _THEME_IMG_; ?>/spacer/spacer.png"
                        data-src="<?php echo get_field('immagine')['sizes']['800xauto']; ?>" alt="<?php echo $alt; ?>"
                        width="800" height="800" class="<?php echo get_field('posizionamento_immagine'); ?> lazyload">
                </picture>
            </div>
            <?php } ?>
           
        </div>
    </div>
</section>
<?php } ?>