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
	<section class="cards-text-on-bg common-title-box--s <?php echo get_field('margine'); ?> <?php echo get_field('altezza'); ?> <?php echo get_field('background_color') ?> <?php echo $className; ?>">
		<div class="cards-text-on-bg__container basic-container <?php echo get_field('larghezza'); ?> <?php echo get_field('padding'); ?>">
			<div class="cards-text-on-bg__sub-container container-grid-el">
				<?php if( !empty( get_field('sottotitolo') ) || !empty( get_field('titolo') ) || !empty( get_field('cta') ) ){ ?>
				<div class="title-box">
					<div class="title-box__container text-left">
						<div class="title-box__first-wrap">
							<?php if( !empty( get_field('sottotitolo') ) ){ ?>
							<span class="title-box__over-head over-head"><?php echo get_field('sottotitolo'); ?></span>
							<?php } ?>
							<?php if( !empty( get_field('titolo') ) ){ ?>
							<h2 class="title-box__title h3"><?php echo get_field('titolo'); ?></h2>
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
				<?php if( !empty(get_field('cards')) ){ ?>
				<?php $n_cards = count(get_field('cards')); ?>
					<div class="cards-text-on-bg__wrap">
						<?php foreach (get_field('cards') as $card) { ?>
							<?php if( !empty($card['cta']) ){ ?>
							<a href="<?php echo $card['cta']['url']?>" target="<?php echo $card['cta']['target']?>" class="card-text-on-bg <?php echo get_field('allineamento_testo')?> <?php echo get_field('padding_int'); ?>">
							<?php }else{	?>
							<div class="card-text-on-bg <?php echo get_field('allineamento_testo')?> <?php echo get_field('padding_int'); ?>">
							<?php }	?>
							<div class="card-text-on-bg__container">
								<?php if( !empty($card['titolo']) || !empty($card['sottotitolo']) || !empty($card['testo']) || !empty($card['cta']) ){ ?>
									<div class="card-text-on-bg__text-wrap fade">
										<div class="card-text-on-bg__text-content">
											<?php if( !empty($card['sottotitolo']) ){ ?>
											<span class="card-text-on-bg__over-head over-head">
												<?php echo $card['sottotitolo']; ?>
											</span>
											<?php }	?>

											<?php if( !empty($card['titolo']) ){ ?>
												<?php if( !empty(get_field('titolo')) ){ ?>
													<h3 class="card-text-on-bg__title <?php echo get_field('dimensione_titolo_card'); ?>">
														<?php echo $card['titolo'];	?>
													</h3>
												<?php }else{?>
													<h2 class="card-text-on-bg__title <?php echo get_field('dimensione_titolo_card'); ?>">
														<?php echo $card['titolo'];	?>
													</h2>
												<?php }	?>
											<?php }	?>

											<?php if( !empty($card['testo']) ){ ?>
											<p class="card-text-on-bg__p">
												<?php echo $card['testo'];	?>
											</p>
											<?php }	?>

											<?php if( !empty($card['cta']) ){ ?>
											<span class="card-text-on-bg__cta btn-base custom-button">
												<?php echo $card['cta']['title']?>
											</span>
											<?php }else{ ?>
											
											<?php }	?>
										</div>
									</div>
								<?php }	?>
								<?php if( !empty($card['immagine']) ){ ?>
									<div class="card-text-on-bg__img-wrap">
										<?php
											$img_d = $card['immagine']['sizes']['1920x1080'];
											if( $n_cards>1 )	$img_d = $card['immagine']['sizes']['800x800'];
											$alt = _ALT_;
											if( !empty($card['titolo']) ){
												$alt = strip_tags($card['titolo']);
											}
											if( $card['immagine']['alt']!='' )	$alt = $card['immagine']['alt'];
											?>
										<picture>
											<source media="(min-width: 768px)" srcset="<?php echo _THEME_IMG_;?>/spacer/spacer.png"
												data-srcset="<?php echo $img_d; ?>">
											<img src="<?php echo _THEME_IMG_ ?>/spacer/spacer.png"
												data-src="<?php echo $card['immagine']['sizes']['800x800']?>"
												alt="<?php echo $alt; ?>" class="lazyload" width="800" height="800">
										</picture>
									</div>
								<?php }	?>
							</div>
							<?php if( !empty($card['cta']) ){ ?>
							</a>
							<?php }else{	?>
							</div>
							<?php }	?>
						<?php } // end foreach	?>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>