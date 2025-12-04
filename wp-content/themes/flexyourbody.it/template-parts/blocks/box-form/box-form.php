<?php
$className = '';
if( !empty($block['className']) ) {
	$className = $block['className'];
}
if ( !empty(get_field('cf7')) ){
    $id_form = get_field('cf7');
    $contact_form_title = get_the_title($id_form);
    $shortcode = '[contact-form-7 id="' . $id_form . '" title="' . $contact_form_title . '"]';
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
	<!-- FORM -->
	<section class="box-form <?php echo get_field('margine'); ?> <?php echo get_field('larghezza'); ?> <?php echo get_field('background_color'); ?> <?php echo $className; ?>">
		<div class="box-form__container basic-container <?php echo get_field('larghezza'); ?> <?php echo get_field('padding'); ?>">
			<div class="box-form__sub-container container-grid-el">
				<?php echo do_shortcode($shortcode); ?>
			</div>
		</div>
	</section>
	<!-- // FORM -->
<?php } ?>
