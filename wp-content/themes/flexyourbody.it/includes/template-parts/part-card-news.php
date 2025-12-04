<?php
  $postid = get_the_id();
?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="card-news fade swiper-slide">
  <div class="card-news__container">
    <div class="card-news__text-wrap">
      <div class="card-news__row card-news__main-text">
        <p class="card-news__over-head over-head"><?php echo(get_the_category()[0]->name)?></p>
        <h3 class="card-news__title h4"><?php echo truncate(get_the_title(), 66); ?></h3>
      </div>
      <div class="card-news__row card-news__sub-text">
        <span class="card-news__date p-small"><?php echo get_the_date(); ?></span>
      </div>
    </div>
    <div class="card-news__img-wrap">
      <?php if (get_the_post_thumbnail_url(get_the_id(),'500x400')){
        $thumb =  get_the_post_thumbnail_url(get_the_id(),'500x400');
      }else{
        $thumbid = get_field('thumbnail_placeholder','option')['id'];
        $thumb = wp_get_attachment_image_url($thumbid,'500x400');
      }
      ?>
      <picture>
        <img
          src="<?php echo _THEME_IMG_; ?>/spacer/spacer.png"
          data-src="<?php echo $thumb; ?>"
          alt="<?php the_title(); ?>"
          width="500" height="400" class="lazyload">
      </picture>
    </div>
  </div>
</a>