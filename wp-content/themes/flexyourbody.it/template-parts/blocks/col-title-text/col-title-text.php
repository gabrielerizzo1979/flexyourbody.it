<?php
$className = '';
if( !empty($block['className']) ) {
	$className = $block['className'];
}
$classes = explode(" ", $className);
$off = false;
if($off && is_admin())	$off=false;
foreach ($classes as $myclass) {
	if ( $myclass=='off' ) {
		$off = true;
	}
}
if(!$off){
?>
	<section class="col-title-text <?php echo get_field('margine'); ?> <?php echo get_field('background_color'); ?> <?php echo $className; ?>">
		<div class="col-title-text__container basic-container <?php echo get_field('larghezza'); ?> <?php echo get_field('padding'); ?> ">
			<div class="col-title-text__wrap container-grid-el fade">
				<?php if( !empty(get_field('sottotitolo')) || !empty(get_field('titolo')) ){ ?>
				<div class="col-title-text__first-col">
					<?php if( !empty(get_field('sottotitolo')) ){ ?>
					<span class="col-title-text__over-head over-head"><?php echo get_field('sottotitolo');?></span>
					<?php } ?>
					<?php if( !empty(get_field('titolo')) ){ ?>
					<h2 class="col-title-text__title h2"><?php echo get_field('titolo');?></h2>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if( !empty(get_field('testo')) ){ ?>
				<div class="col-title-text__second-col common-text-editor-style">
					<?php echo get_field('testo');?>
				</div>
				<?php } ?>
				<?php if( !empty(get_field('cta')) ){ ?>
				<div class="col-title-text__cta-wrap">
					<a href="<?php echo get_field('cta')['url'];?>" title="<?php echo get_field('cta')['title'];?>" target="<?php echo get_field('cta')['target'];?>" class="col-title-text__button btn-base"><?php echo get_field('cta')['title'];?></a>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>
