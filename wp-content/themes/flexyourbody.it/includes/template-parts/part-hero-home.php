



<?php if( !empty(get_field('hero_slides')) && count(get_field('hero_slides'))>0 ){ ?>
  <section class="im-hero-slider">
    <div class="im-hero-slider__container basic-container container">
      <div class="swiper-container container-grid-el">
        <div class="swiper-wrapper">
          <?php $count=0; foreach ( get_field('hero_slides') as $slide) { ?>
          <div class="im-hero-slider__slide swiper-slide">
            <div class="im-hero-slider__slide-wrap">
              <div class="im-hero-slider__slide-container">
                <?php $slide_has_video = false; ?>
                <div class="im-hero-slider__slide-content  basic-container container">
                  <div class="im-hero-slider__slide-content-wrapper container-grid-el">
                    <?php if( !empty($slide['sottotitolo']) ){ ?>
                    <span class="im-hero-slider__over-head over-head"><?php echo $slide['sottotitolo'] ?></span>
                    <?php } ?>
                    <?php if( !empty($slide['titolo']) ){ ?>
                      <?php if( $count==0 ){ ?>
                      <h1 class="im-hero-slider__title h1"><?php echo $slide['titolo'] ?></h1>
                      <?php }else{ ?>
                      <h2 class="im-hero-slider__title h1"><?php echo $slide['titolo'] ?></h2>
                      <?php } ?>
                    <?php } ?>
                    <?php if( !empty($slide['testo']) ){ ?>
                    <p class="im-hero-slider__description p"><?php echo $slide['testo'] ?></p>
                    <?php } ?>
                    <?php if( !empty($slide['cta']) ){ ?>
                    <div class="im-hero-slider__cta-wrap">
                      <?php if( !empty($slide['cta']) ){ ?>
                        <a class="btn-base btn--style-white-outline" href="<?php echo $slide['cta']['url'] ?>" title="<?php echo $slide['cta']['title'] ?>" target="<?php echo $slide['cta']['target'] ?>"><?php echo $slide['cta']['title'] ?></a>
                      <?php } ?>
                      <?php if( !empty($slide['cta2']) ){ ?>
                        <a class="btn-base btn--style-white" href="<?php echo $slide['cta2']['url'] ?>" title="<?php echo $slide['cta2']['title'] ?>" target="<?php echo $slide['cta2']['target'] ?>"><?php echo $slide['cta2']['title'] ?></a>
                      <?php } ?>
                    </div>
                    <?php } ?>
                    <?php if(   !empty($slide['video_clip']) && !empty($slide['video_intero']) && !empty($slide['cover_video'])   ){ ?>
                        <button role="button" class="im-modal__open" data-modal="hero-modal-video-<?php echo $count;?>" href="#">
                          <div class="svg-text-badge">
                            <!-- SVG TEXT CIRCLE -->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 500">
                              <title ><?php _e('Guarda il video', 'flexyourbody.it'); ?></title>
                              <defs>
                                <path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle">
                                  <animateTransform attributeName="transform"
                                            begin="0s"
                                            dur="30s"
                                            type="rotate"
                                            from="0 250 250"
                                            to="360 250 250"
                                            repeatCount="indefinite">
                                  </animateTransform>
                                </path>
                              </defs>
                              <text dy="50" textLength="1240">
                                <textPath xlink:href="#textcircle" aria-hidden="true">
                                  <?php _e('Guarda il video - Guarda il video -', 'flexyourbody.it'); ?>
                                </textPath>
                              </text>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                shape-rendering="geometricPrecision"
                                class="">
                              <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_play"></use>
                            </svg>
                          </div>
                        </button>
                    <?php } ?>
                  </div>
                </div>
                
                <?php if( !empty($slide['immagine']) ){  ?>
                  <div class="im-hero-slider__slide-media">
                    <picture>
                      <source
                        media="(min-width: 768px)"
                        srcset="<?php echo _THEME_IMG_; ?>/spacer/spacer.png"
                        data-srcset="<?php echo wp_get_attachment_image_url($slide['immagine']['id'],'1920x1080'); ?>">
                      <img
                        src="<?php echo _THEME_IMG_; ?>/spacer/spacer.png"
                        data-src="<?php echo wp_get_attachment_image_url($slide['immagine']['id'],'800x800'); ?>"
                        alt="<?php echo $title; ?>"
                        class="lazyload" width="800" height="800">
                    </picture>
                  </div>
                <?php }elseif(  !empty($slide['video_clip']) && !empty($slide['cover_video'])   ){  ?>
                  <div class="im-hero-slider__slide-media">
                    <video id="video" autoplay preload muted playsinline loop poster="<?php echo $slide['cover_video']; ?>">
                      <source src="<?php echo $slide['video_clip']; ?>" type="video/mp4" />
                    </video>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php $count++; } ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon-prev">
            <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_prev"></use>
          </svg>
        </div>
        <div class="swiper-button-next">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon-next">
            <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_next"></use>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <?php $count=0; foreach ( get_field('hero_slides') as $slide) { ?>
    <?php if( !empty($slide['video_clip']) && !empty($slide['video_intero']) && !empty($slide['cover_video']) ){ ?>
      <div class="im-modal full hero-modal-video" data-modal="hero-modal-video-<?php echo $count;?>">
        <div class="im-modal__background"></div>
        <div class="im-modal__container container">
          <div class="im-modal__close" data-modal="hero-modal-video-<?php echo $count;?>">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon-close">
              <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_close"></use>
            </svg>
          </div>
          <div class="im-modal__content">
            <video playsinline="" controls="" poster="<?php echo $slide['cover_video']; ?>">
              <source src="<?php echo $slide['video_intero']; ?>" type="video/mp4">
            </video>
          </div>
        </div>
      </div>
    <?php } ?>
  <?php $count++; } ?>

<?php } ?>