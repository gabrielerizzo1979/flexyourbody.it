<?php
    /*
    *
    * Template part Archive article list
    *
    */
    $args_pagination =
    [
        'prev_text' => '<span class="icon icon-prev"></span>',
        'next_text' => '<span class="icon icon-next"></span>',
    ];
    $post_type = get_post_type();
    $term = get_queried_object();
?>
<?php if( !empty($term->description) ){ ?>
<div class="taxonomy-description cms-content">
  <div class="cms-content__container">
  <?php echo $term->description ?>
  </div>
</div>
<?php } ?>

<?php
if( is_home() ){
  
  $page_for_posts = get_option( 'page_for_posts' );
  $post_content = get_post($page_for_posts);
  $news_content = $post_content->post_content;
  if( $news_content != '' ){
  ?>
    <section class="custom-quote bg-common margin">
        <div class="custom-quote__container basic-container medium-container padding">
            <div class="custom-quote__wrapper container-grid-el fade">
                <blockquote class="custom-quote__quote quote"><?php echo apply_filters('the_content',$news_content); ?></blockquote>
            </div>
        </div>
    </section>
  <?php
  }
}
?>

<!-- SECTION ARCHIVE LIST -->
<div class="archive-list margin-bottom">
  <div class="archive-list__container basic-container container">
    <div class="archive-list__sub-container container-grid-el">
      <?php get_template_part('includes/template-parts/part', 'archive-filters'); ?>
      <?php if ( have_posts() ) { ?>
        <ul class="archive-list__wrap">
          <?php
          while ( have_posts() ) :
            the_post();
            ?>
            <li>
            <?php get_template_part('includes/template-parts/part', 'card-news'); ?>
            </li>
            <?php
          endwhile;
          ?>
        </ul>
        <?php
        if(theme_check_is_paginated()){
          theme_pagination_nav();
        }
      }else{
        echo '<p>No posts found</p>';
      }
      ?>
    </div>
  </div>
</div>
<!-- /SECTION ARCHIVE LIST -->
