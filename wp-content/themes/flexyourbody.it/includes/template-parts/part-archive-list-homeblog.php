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
    $type = get_post_type();
    $class='blog';
    global $mostra_excerpt;
    $mostra_excerpt = false;
    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    $sticky = get_option( 'sticky_posts' );
?>


<?php
if($paged==1){
  $args = array(
      'post_type'       => 'post',
      'paged'           => $paged,
      'post__in' => $sticky,
      'ignore_sticky_posts' => -1,
  );
  $the_query = new WP_Query( $args );
?>
<div class="spacer l-margin"> &nbsp; </div>
<div class="featured-news">
  <div class="featured-news__container container">
    <h2 class="featured-news__title h2"><?php _e('In primo piano','flexyourbody.it');?></h2>
    <div class="spacer s-margin ">
  &nbsp;</div>
    <div class="featured-news__wrap-news flex flex-wrap">
        <?php
        $count = 0;
        if ( $the_query->have_posts() ){
          ?>
          <div class="featured-news__first-col col-m-12 col-t-12 col-d-6">
            <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
                if($count==0){
                  $mostra_excerpt=true;
                  get_template_part('includes/template-parts/part', 'card-news');
                  $mostra_excerpt=false;
                }
                $count++;
            endwhile;
          ?></div><?php
        }

        ?>

        <?php

        if ( $the_query->have_posts() ){
          ?>
          <div class="featured-news__second-col m-12 col-t-12  col-d-6">
            <ul>
              <?php
              $count = 0;
              while ( $the_query->have_posts() ) : $the_query->the_post();
                  if($count>0 && $count<4){
                    echo '<li>';
                      get_template_part('includes/template-parts/part', 'card-news');
                    echo '</li>';
                  }
                  $count++;
              endwhile;
              ?>
            </ul>
          </div>
          <?php
        }

        ?>
    </div>
  </div>
</div>
<?php
wp_reset_postdata();
wp_reset_query();
}
?>

<?php

  $args_pagination = array(
    'post_type'       => 'post',
    'paged'           => $paged,
    'ignore_sticky_posts' => 1,
    'post__not_in' => $sticky,
  );
  $the_query = new WP_Query( $args_pagination );
  if ( $the_query->have_posts() ){
    ?>
    <div class="list-section">
        <div class="list-section__container container">
         <div class="list-section__title-filters-wrap flex flex-column-m align-items-center-td justify-content-between-td">
           <h2 class="list-section__title h2"><?php _e('Tutte le notizie','flexyourbody.it');?></h2>
           <?php get_template_part('includes/template-parts/part', 'archive-filters'); ?>
         </div>
            <div class="archive-list">
                <ul class="box-columns flex flex-wrap">
                    <?php
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        ?>
                        <li class="col-m-12 col-t-6 col-d-4">
                            <?php get_template_part('includes/template-parts/part', 'card-news'); ?>
                        </li>
                        <?php

                    endwhile;
                    ?>

                </ul>
                <?php
                    if(theme_check_is_paginated())
                    {
                        theme_pagination_nav();
                    }
                ?>
            </div>
        </div>
    </div>
    <?php

  }
  ?>

  <?php
  wp_reset_postdata();
  wp_reset_query();
?>
