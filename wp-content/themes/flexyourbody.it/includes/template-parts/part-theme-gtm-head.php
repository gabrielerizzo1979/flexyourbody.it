<?php
if (class_exists('ACF')) {
$seo_custom1 = isset(get_fields('options')['seo_custom1']) ? get_fields('options')['seo_custom1'] : '';
$seo_custom2 = isset(get_fields('options')['seo_custom2']) ? get_fields('options')['seo_custom2'] : '';
if($seo_custom1){
  echo $seo_custom1;
}
if($seo_custom2){
  echo $seo_custom2;
}
}
?>
