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
	$auto_col = '';
	if( get_field('colonne_automatiche') )	$auto_col = 'auto-col';
    $onecolumn = '';
    if( !empty(get_field('colonna1')) && empty(get_field('colonna2')) ){
        $onecolumn = 'one-column';
    }
?>

<section class="im-text-on-bg <?php echo $onecolumn; ?> <?php echo get_field('margine'); ?> <?php echo get_field('background_color'); ?> <?php echo $className; ?>">
    <div class="im-text-on-bg__container basic-container <?php echo get_field('larghezza'); ?> <?php echo get_field('padding'); ?>">
        <div class="im-text-on-bg__text container-grid-el flex flex-column fade">
                <?php if( !empty(get_field('sottotitolo')) || !empty(get_field('titolo')) ){ ?>
                <div class="im-text-on-bg__title-wrap">
                    <?php if( !empty(get_field('sottotitolo')) ){ ?>
                    <span class="im-text-on-bg__over-head over-head"><?php echo get_field('sottotitolo');?></span>
                    <?php } ?>

                    <?php if( !empty(get_field('titolo')) ){ ?>
                    <h2 class="im-text-on-bg__title h2"><?php echo get_field('titolo');?></h2>
                    <?php } ?>
                </div>
                <?php } ?>

                <?php if( !empty(get_field('testo')) ){ ?>
                <div class="im-text-on-bg__quote-wrap">
                    <p><?php echo get_field('testo');?></p>
                </div>
                <?php } ?>

                <?php if( !empty(get_field('colonna1')) || !empty(get_field('colonna2')) ){ ?>
                <div class="im-text-on-bg__p flex flex-column-m">
                    <?php if( !empty(get_field('colonna1')) ){ ?>
                    <div class="col-text common-text-editor-style <?php echo $auto_col;?>">
                        <?php echo get_field('colonna1');?>
                    </div>
                    <?php } ?>
                    <?php if( !empty(get_field('colonna2')) && $auto_col=='' ){ ?>
                    <div class="col-text common-text-editor-style">
                        <?php echo get_field('colonna2');?>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>

                <?php if( !empty(get_field('cta')) ){ ?>
                <div class="im-text-on-bg__cta-wrap">
                    <a href="<?php echo get_field('cta')['url'];?>" title="<?php echo get_field('cta')['title'];?>"
                        class="im-text-on-bg__cta btn-base"><?php echo get_field('cta')['title'];?></a>
                </div>
                <?php } ?>
            
        </div>
    </div>
</section>
<?php } ?>