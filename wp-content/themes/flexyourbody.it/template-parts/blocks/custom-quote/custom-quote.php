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
if(!$off){
?>
    <section class="custom-quote <?php echo get_field('background_color'); ?> <?php echo get_field('margine'); ?> <?php echo $className; ?>">
        <div class="custom-quote__container basic-container <?php echo get_field('larghezza'); ?> <?php echo get_field('padding'); ?>">
            <div class="custom-quote__wrapper container-grid-el fade">
                <?php if( !empty(get_field('testo')) ){ ?>
                <blockquote class="custom-quote__quote quote"><?php echo get_field('testo');?></blockquote>
                <?php } ?>
                <?php if( !empty(get_field('firma')) || !empty(get_field('ruolo')) ){ ?>
                <cite class="custom-quote__cite">
                    <span class="cite__main over-head"><?php echo get_field('firma');?></span>
                    <span class="cite__sub p-small"><?php echo get_field('ruolo');?></span>
                </cite>
                <?php } ?>
                <?php if( !empty(get_field('cta')) ){ ?>
                <a href="<?php echo get_field('cta')['url'];?>" title="<?php echo get_field('cta')['title'];?>"
                    target="<?php echo get_field('cta')['target'];?>" class="custom-quote__cta btn-base">
                    <?php echo get_field('cta')['title'];?>
                </a>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>