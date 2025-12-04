<?php
  global $mycat;
  $term_id = $mycat->term_id;
  $name = $mycat->name;
  $description = $mycat->description;
  $term_link = get_term_link($term_id);
  $cat_thumb_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
?>


<a href="<?php echo $term_link; ?>" title="<?php echo $name; ?>" class="card-text-on-bg swiper-slide ">
    <div class="card-text-on-bg__img-content">
      <?php 
      if ( $cat_thumb_id ){
        $thumb =  wp_get_attachment_image_src($cat_thumb_id,'600x400')[0];
      }else{
        $thumbid = get_field('thumbnail_placeholder','option')['id'];
        $thumb = wp_get_attachment_image_url($thumbid,'600x400');
      }
      ?>
      <picture>
        <source
          type="image/webp"
          srcset="<?php echo _THEME_IMG_;?>/spacer/spacer.png"
          data-srcset="<?php echo theme_get_webp_url($thumb); ?>">
        <img
          src="<?php echo _THEME_IMG_; ?>/spacer/spacer.png"
          data-src="<?php echo $thumb; ?>"
          alt="<?php the_title(); ?>"
          width="600" height="400" class="lazyload">
      </picture>
    </div>
    <div class="card-text-on-bg__text-content ">
      <h2 class="card-text-on-bg__title h2"><?php echo $name; ?></h2>
      <p class="card-text-on-bg__p"><?php if($description)  echo $description; ?></p>
      <span class="card-text-on-bg__button btn-base"><?php _e('Scopri','flexyourbody.it'); ?></span>
    </div>
</a>





