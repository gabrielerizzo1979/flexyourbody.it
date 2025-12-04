<?php

    /*
    *
    * Template part Archive Filters
    *
    */

    $post_type = get_post_type();
    // print_r($post_type);

    if($post_type=='post'){
      $taxonomyname = 'category';
    }elseif($post_type=='dirigenti'){
      $taxonomyname = 'ruolo';
    }elseif($post_type=='notiziario-sociale'){
      $taxonomyname = 'anno';
    }



    $args = array(
        'style'              => 'list',
        'show_count'         => 1,
        'depth'              => 1,
        'taxonomy'           => $taxonomyname,
        'walker'             => null
    );

    $categories = get_categories( $args );

    $all_posts_selected = '';

    if (is_home()) {
        $all_posts_selected = 'selected';
    }

    $cat_selected = '';

    $current_category = '';




    // if($post_type=='post'){
    if( !is_post_type_archive('notiziario-sociale') ){
      if (get_queried_object() !== null )
      {
          $current_category = get_queried_object()->term_id;
      }
    }
    // }elseif($post_type=='dirigenti'){
    // }

?>

<?php if(count($categories)>1){?>
<div class="archive-filters">
    <span class="label-filters"><?php _e('Filtra per: ', 'flexyourbody.it'); ?></span>

    <select id="select-filters">
        <?php if($post_type=='post' || $post_type=='notiziario-sociale'){
          if($post_type=='post' ) $archive_parmalink = get_permalink(get_option( 'page_for_posts' ));
          if($post_type=='notiziario-sociale' ) $archive_parmalink = get_post_type_archive_link( 'notiziario-sociale' );
        ?>
        <option value="<?php echo $archive_parmalink; ?>" <?php echo $all_posts_selected; ?>><?php _e('Tutto', 'flexyourbody.it'); ?></option>
        <?php } ?>

        <?php foreach($categories as $cat) :
                $cat_selected = $current_category === $cat->term_id ? 'selected' : '';
            ?>
            <option value="<?php echo get_term_link($cat->term_id); ?>" <?php echo $cat_selected; ?>><?php echo $cat->name ?></option>
        <?php endforeach; ?>

    </select>
</div>
<?php } ?>
