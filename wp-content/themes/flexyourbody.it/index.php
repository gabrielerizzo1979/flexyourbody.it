<?php
    $post_type = get_post_type();
    $term = get_queried_object();
    get_header();
?>
<div class="pg-archive">
  <?php get_template_part('includes/template-parts/part', 'hero-simple'); ?>
  
  <?php if (is_home()) { $the_ID = get_queried_object()->ID; } ?>
  
  <?php if (is_home()) { ?>
    <div class="list-section">
      <div class="list-section__container">
        <?php get_template_part('includes/template-parts/part', 'archive-list'); ?>
      </div>
    </div>
  <?php }elseif($post_type=='post'){ ?>
    <div class="list-section">
      <div class="list-section__container">
        <?php get_template_part('includes/template-parts/part', 'archive-list'); ?>
      </div>
    </div>
  <?php } ?>

</div>
<?php get_footer(); ?>
