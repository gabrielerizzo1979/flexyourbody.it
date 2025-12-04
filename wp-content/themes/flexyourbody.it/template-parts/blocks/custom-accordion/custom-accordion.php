<?php
$className = 'ac0';
if( !empty($block['className']) ) {
	$className = $block['className'];
}
$classes = explode(" ", $className);
$off = false;
foreach ($classes as $myclass) {
	if ( $myclass=='off' && !is_admin() ) {
		$off = true;
	}
}
$class_accordion = '';
if( !empty(get_field('id_accordion')) ){
	$class_accordion = get_field('id_accordion');
}
if($off && is_admin())	$off=false;
if(!$off){
?>
	<section class="custom-accordion common-title-box--m <?php echo get_field('margine'); ?> <?php echo get_field('background_color'); ?> <?php echo $class_accordion; ?> <?php echo $className; ?>">
		<div class="custom-accordion__container basic-container <?php echo get_field('larghezza'); ?> <?php echo get_field('padding'); ?>">
			<div class="custom-accordion__sub-container container-grid-el">
				<?php if(!empty(get_field('sottotitolo')) || !empty(get_field('titolo'))){ ?>
				<div class="title-box fade">
					<div class="title-box__container text-left">
						<div class="title-box__first-wrap">
							<?php if(!empty(get_field('sottotitolo'))){ ?>
							<span class="title-box__over-head over-head"><?php echo get_field('sottotitolo'); ?></span>
							<?php } ?>
							<?php if(!empty(get_field('titolo'))){ ?>
							<h2 class="title-box__title h2"><?php echo get_field('titolo'); ?></h2>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="custom-accordion__accordion-wrap">
					<?php 
					$count=0;
					foreach (get_field('accordion') as $accordion) { ?>
						<?php $open=''; if( $count==0 )	$open='no-auto-open';	?>
						<div class="im-accordion fade">
							<div class="im-accordion__toggle <?php echo $open ?>" data-accordion="accordion-html<?php echo $class_accordion; ?><?php echo $count; ?>" data-group="group-accordion<?php echo $class_accordion; ?>" data-close="true">
								<div class="im-accordion__title">
									<?php if(!empty(get_field('titolo'))){ ?>
									<h3 class="h3"><?php echo $accordion['titolo']; ?></h3>
									<?php }else{ ?>
									<h2 class="h3"><?php echo $accordion['titolo']; ?></h2>
									<?php } ?>
								</div>
								<div class="im-accordion__icon icon-close">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									shape-rendering="geometricPrecision" class="close">
									<use xlink:href="<?php echo _THEME_BUILD_;?>/spritemap.svg#ico_arrow"></use>
									</svg>
								</div>
							</div>
							<div class="im-accordion__content" data-accordion="accordion-html<?php echo $class_accordion; ?><?php echo $count; ?>">
								<div data-wrapper-height>
									<?php if(!empty($accordion['testo']))	echo $accordion['testo']; ?>
								</div>
							</div>
						</div>
						<?php
						$count++;
					}
					?>
				</div>
			</div>
		</div>
	</section>
<?php } ?>