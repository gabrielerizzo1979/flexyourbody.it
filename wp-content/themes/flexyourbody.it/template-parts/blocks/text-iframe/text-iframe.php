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
	<section class="text-iframe <?php echo get_field('margine_desktop'); ?> <?php echo get_field('margine_mobile'); ?> <?php echo $className; ?>">
		<div class="text-iframe__container  basic-container <?php echo get_field('larghezza'); ?>">
			<div class="text-iframe__wrap container-grid-el <?php echo get_field('layout_desktop');?> <?php echo get_field('layout_mobile');?>">
				<?php if( !empty(get_field('titolo')) || !empty(get_field('sottotitolo')) || !empty(get_field('testo')) ){ ?>
				<div class="text-iframe__column text-iframe__column-text fade">
					<div class="text-iframe__text-wrap ">

						<?php if( !empty(get_field('sottotitolo')) ){ ?>
						<span class="text-iframe__over-head over-head"><?php echo get_field('sottotitolo'); ?></span>
						<?php } ?>
						<?php if( !empty(get_field('titolo')) ){ ?>
						<h2 class="text-iframe__title h2"><?php echo get_field('titolo'); ?></h2>
						<?php } ?>
						
						<?php if( !empty(get_field('testo')) ){ ?>
						<div class="text-iframe__paragraphs  common-text-editor-style">
							<?php echo get_field('testo'); ?>
						</div>
						<?php } ?>

						<?php if( !empty(get_field('cta')) ){ ?>
                        <a href="<?php echo get_field('cta')['url'];?>" class="text-iframe__cta btn-base" title="<?php echo get_field('cta')['title'];?>" target="<?php echo get_field('cta')['target'];?>">
                            <?php echo get_field('cta')['title'];?>
                        </a>
                        <?php } ?>
					</div>
				</div>
				<?php } ?>
				
				<?php if( !empty(get_field('iframe')) ){ ?>
				<div class="text-iframe__column text-iframe__column-media"><?php echo get_field('iframe')?></div>
				<?php } ?>

			</div>
		</div>
	</section>
<?php } ?>