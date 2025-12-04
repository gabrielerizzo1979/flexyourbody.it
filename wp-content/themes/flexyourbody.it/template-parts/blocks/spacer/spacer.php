<?php
$className = '';
if( !empty($block['className']) ) {
	$className = $block['className'];
}
$size = get_field('spacer');
$content = '&nbsp;';
if($size=='no-margin')  $content = '';
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
  <div <?php if( !empty(get_field('id_spacer')) ) echo 'id="'.get_field('id_spacer').'"'.' '; ?>
    class="spacer <?php echo $size; ?> <?php echo get_field('background_color'); ?> <?php echo $className; ?>">
    <?php echo $content; ?>
    <?php if( is_admin() ){ echo 'Spacer: '.$size; } ?>
  </div>
<?php } ?>