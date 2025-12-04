<?php
  global $myterm;
  global $termid;
  global $termtitle;
  global $termurl;
?>
<a href="<?php echo $termurl; ?>" title="<?php echo $termtitle; ?>" class="card-text-img">
    <div class="card-text-img__img-content">
      <?php
      $thumb = get_field('immagine', $myterm->taxonomy . '_' . $termid)['sizes']['700x500'];
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
          width="370" height="300" class="lazyload">
      </picture>
    </div>
    <div class="card-text-img__text-content flex flex-column  justify-content-between">
        <div class="card-text-img__wrap">
          <h2 class="card-text-img__title h3"><?php echo $termtitle; ?></h2>
        </div>
        <div class="card-text-img__cta-wrap">
          <span class="card-text-img__cta btn-base"><?php _e('Scopri di più','flexyourbody.it') ?></span>
        </div>
    </div>
</a>