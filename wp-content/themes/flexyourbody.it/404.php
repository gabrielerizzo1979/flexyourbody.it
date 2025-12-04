<?php
    /*
    *
    * Template for 404 page
    *
    */
    get_header();
?>
<?php get_template_part('includes/template-parts/part', 'hero-simple'); ?>
<section class="page-not-found">
    <div class="container">
        <div class="text-content text-center">
            <h2 class="h2"><?php _e('404 - Pagina non trovata','flexyourbody.it'); ?></h2>
            <div class="spacer m-margin ">&nbsp;</div>
            <a href="<?php echo _HOME_ ?>" title="<?php _e('Vai alla homepage','flexyourbody.it'); ?>" class="btn-base btn--style-primary-outline"><?php _e('Vai alla homepage','flexyourbody.it'); ?></a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
