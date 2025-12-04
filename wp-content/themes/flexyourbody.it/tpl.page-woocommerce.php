<?php /* Template Name: Woocommerce Page */ ?>
<?php get_header(); ?>
<?php get_template_part('includes/template-parts/part', 'hero-simple'); ?>
<div class="pg-woocommerce">
    <section class="section-wc-content">
        <?php the_content(); ?>
    </section>
</div>
<?php get_footer(); ?>