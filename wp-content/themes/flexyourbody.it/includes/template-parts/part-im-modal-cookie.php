<?php if( function_exists('acf_add_options_page') && !empty(get_field('impmod_attiva_popup','options')) && get_field('impmod_attiva_popup','options') ) { ?>
  <div class="im-modal-cookie" data-modal="<?php echo _THEME_NAME_ ?>-site-notice-popup" data-name="<?php echo _THEME_NAME_ ?>-site-notice" data-expire="<?php echo get_field('impmod_durata_cookie','options') ?>">
    <div class="im-modal-cookie__background"></div>
    <div class="im-modal-cookie__container container">
      <div class="im-modal-cookie__close" data-modal="<?php echo _THEME_NAME_ ?>-site-notice-popup">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon-close">
              <use xlink:href="<?php echo _THEME_BUILD_;?>/spritemap.svg#ico_close"></use>
        </svg>
      </div>
      <div class="im-modal-cookie__content text-center">
        <?php if( !empty(get_field('impmod_sovratitolo','options')) ){ ?>
        <span class="im-modal-cookie__over-head over-head"><?php echo get_field('impmod_sovratitolo','options') ?></span>
        <?php } ?>
        <?php if( !empty(get_field('impmod_titolo','options')) ){ ?>
        <h2 class="im-modal-cookie__title h2"><?php echo get_field('impmod_titolo','options') ?></h2>
        <?php } ?>
        <?php if( !empty(get_field('impmod_sottotitolo','options')) ){ ?>
        <h3 class="im-modal-cookie__subtitle h3"><?php echo get_field('impmod_sottotitolo','options') ?></h3>
        <?php } ?>
        <?php if( !empty(get_field('impmod_testo','options')) ){ ?>
        <div class="im-modal-cookie__p">
          <p><?php echo get_field('impmod_testo','options') ?></p>
        </div>
        <?php } ?>
        <?php if( !empty(get_field('impmod_immagine','options')) ){ ?>
        <div class="im-modal-cookie__img-wrap">
          <picture>
            <img src="<?php echo get_field('impmod_immagine','options')['sizes']['800xauto'] ?>"
              alt="<?php echo _ALT_ ?>" width="800" height="800" class="">
          </picture>
        </div>
        <?php } ?>
        <?php if( !empty(get_field('impmod_cta','options')) ){ ?>
        <a href="<?php echo get_field('impmod_cta','options')['url'] ?>" target="<?php echo get_field('impmod_cta','options')['target'] ?>" title="<?php echo get_field('impmod_cta','options')['title'] ?>" class="im-modal-cookie__cta btn-base btn--style-primary"><?php echo get_field('impmod_cta','options')['title'] ?></a>
        <?php } ?>
      </div>
    </div>
  </div>
<?php } ?>