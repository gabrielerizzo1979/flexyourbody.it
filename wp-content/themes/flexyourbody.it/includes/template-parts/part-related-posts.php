<?php
    /*
    *
    * Template part Related Posts
    *
    */

    $related = get_posts(
        [
            'post_type' => 'post',
            'category__in' => wp_get_post_categories($post->ID),
            'numberposts' => 3,
            'post__not_in' => [$post->ID]
        ]);

    if( $related ) :
    ?>


    <!-- PART RELATED POSTS -->
    <div class="neo-related-posts list-cards m-t-large">
        <div class="container">
            <h2 class="h2 title-related m-b-small"><?php _e('Leggi anche', _TEXT_DOMAIN_); ?></h2>
            <ul class="list-related box-columns flex flex-wrap">
                <?php
                foreach( $related as $post ) :
                setup_postdata($post);
                ?>
                <li class="item-related wrap-card col-m-12">
                <?php get_template_part('includes/template-parts/part', 'card-news'); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- /PART RELATED POSTS -->

    <?php
    endif;

    wp_reset_postdata();

?>
