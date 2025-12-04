<?php /* Template Name: FAQ */ ?>

<?php get_header(); ?>

<?php get_template_part('includes/template-parts/part', 'hero-simple'); ?>


<section class="section-content-page">
    
    <div class="custom-accordion common-title-box--s bg-white padding acc0">
        <div class="custom-accordion__container basic-container medium-container fade">
            <div class="title-box container-grid-el">
                <div class="title-box__container text-left">
                    <div class="title-box__title-row">
                        <span class="title-box__over-head over-head">Sottotitolo</span>
                        <h2 class="title-box__title h2">Titolo</h2>
                    </div>
                </div>
            </div>
            <div class="custom-accordion__accordion-wrap container-grid-el">
                <div class="im-accordion fade">
                    <div class="im-accordion__toggle no-auto-open" data-accordion="accordion-htmlacc00"
                        data-group="group-accordionacc0" data-close="true">
                        <div class="im-accordion__title">
                            <h3 class="h3">Titolo titolo</h3>
                        </div>
                        <div class="im-accordion__icon icon-close">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                shape-rendering="geometricPrecision" class="close">
                                <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_arrow">
                                </use>
                            </svg>
                        </div>
                    </div>
                    <div class="im-accordion__content" data-accordion="accordion-htmlacc00">
                        <div data-wrapper-height="">
                            <p>testo testo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>

<?php get_footer(); ?>