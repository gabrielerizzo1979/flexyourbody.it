<?php
// add_filter(
//   'wpseo_breadcrumb_links',
//   function ( $links ) {
//     // if(is_product()){
//     //   global $post;
//     //   $terms = get_the_terms( $post->ID, 'product_cat' );
//     //   if ( !empty($terms) ) :
//     //     $myproduct = $links[2];
//     //     array_pop( $links );
//     //     $last_term_id = 0;
//     //     $myterms=array();
//     //     foreach( $terms as $category ) {
//     //       foreach( $terms as $tmp_category ) {
//     //         $parent = $tmp_category->parent;
//     //         $term_id = $tmp_category->term_id;
//     //         if( $parent == $last_term_id ){
//     //           $last_term_id = $term_id;
//     //           $myterms[]=$term_id;
//     //           break;
//     //         }
//     //       }
//     //     }
//     //     if( $myterms && count($myterms)>0 ){
//     //       $output_cat = '';
//     //       $cat_names = array();
//     //       foreach ( $myterms as $term ){
//     //         $myterm = get_term($term, 'product_cat');
//     //         $newlink['url']=get_term_link($myterm->term_id);
//     //         $newlink['text']=$myterm->name;
//     //         $newlink['term_id']=$myterm->term_id;
//     //         $newlink['taxonomy']='product_cat';
//     //         $links[]=$newlink;
//     //       }
//     //       $links[]=$myproduct;
//     //     }
//     //   endif;
//     //   return $links;
//     // }else
    
//     if(is_tax('product_cat')){
//       $myhome = $links[0];
//       $mylink = $links[count($links)-1];
//       array_pop( $links );
//       array_shift( $links );
//       $newlink['url']=get_permalink(get_option( 'woocommerce_shop_page_id' ));
//       $newlink['text']='Shop';
//       $newlink['id']=get_option( 'woocommerce_shop_page_id' );
//       $links[]=$mylink;
      
//       array_unshift($links,$newlink);
//       array_unshift($links,$myhome);

//       return $links;
//     }else{
//       return $links;
//     }
//   }
// );


add_filter(
  'wpseo_breadcrumb_links',
  function ( $links ) {
    if(is_product()){
      global $post;
      $terms = get_the_terms( $post->ID, 'product_cat' );
      if ( !empty($terms) ) :
        $myproduct = $links[2];
        array_pop( $links );
        $last_term_id = 0;
        $myterms=array();
        foreach( $terms as $category ) {
          foreach( $terms as $tmp_category ) {
            $parent = $tmp_category->parent;
            $term_id = $tmp_category->term_id;
            if( $parent == $last_term_id ){
              $last_term_id = $term_id;
              $myterms[]=$term_id;
              break;
            }
          }
        }
        if( $myterms && count($myterms)>0 ){
          $output_cat = '';
          $cat_names = array();
          foreach ( $myterms as $term ){
            $myterm = get_term($term, 'product_cat');
            $newlink['url']=get_term_link($myterm->term_id);
            $newlink['text']=$myterm->name;
            $newlink['term_id']=$myterm->term_id;
            $newlink['taxonomy']='product_cat';
            $links[]=$newlink;
          }
          $links[]=$myproduct;
        }
      endif;
      return $links;
    }elseif(is_tax('product_cat')){
      $myhome = $links[0];
      $mylink = $links[count($links)-1];
      array_pop( $links );
      array_shift( $links );
      $newlink['url']=get_permalink(get_option( 'woocommerce_shop_page_id' ));
      $newlink['text']='Shop';
      $newlink['id']=get_option( 'woocommerce_shop_page_id' );
      $links[]=$mylink;
      
      array_unshift($links,$newlink);
      array_unshift($links,$myhome);

      return $links;
    }else{
      return $links;
    }
    // if ( sizeof( $links ) > 1 ) {
    //   array_pop( $links );
    //   $newlink['url']='';
    //   $newlink['text']='&nbsp;';
    //   $newlink['id']='';
    //   $links[]=$newlink;
    // }
    // return $links;
  }
);
//
//
//
function cl_acf_set_language() {
  return acf_get_setting('default_language');
}
add_filter( 'wpseo_opengraph_image', 'change_opengraph_image_url' );
function change_opengraph_image_url( $url ) {
  add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
  $url = get_field('og_image','options')['url'];
  remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
  return $url;
}
add_theme_support( 'title-tag' );


//
//
// Creo una nuova variabile SEO %%parent_product_cat%% che visualizza la categoria prodotto genitore
// function get_parent_product_cat() {
//   if( get_queried_object()->term_id ){
//     $current_term_id = get_queried_object()->term_id;
//     $current_term = get_term($current_term_id);
//     if ($current_term->parent !== 0){
//       $parent = get_term_by('id', $current_term->parent, 'product_cat');
//       return $parent->name;
//     }else{
//       return '';
//     }
//   }
// }
// function register_custom_yoast_variables() {
//  wpseo_register_var_replacement( 'parent_product_cat', 'get_parent_product_cat' );
// }
// add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');




add_filter( 'wpseo_next_rel_link', 'custom_change_wpseo_rel' );
add_filter( 'wpseo_prev_rel_link', 'custom_change_wpseo_rel' );
function custom_change_wpseo_rel( $oldLink ) {
  return '';
}
