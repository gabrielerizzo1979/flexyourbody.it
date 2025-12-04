<?php
  /*
  *
  * Template part for Hero general
  *
  */
  $title = '';
  $the_ID = '';
  $thumbid = '';
  $sottotitolo = '';
  $cta = '';
  if( !empty(get_field('cta')) ){
    $cta = get_field('cta');
  }
  $type = get_post_type();
  $term = get_queried_object();
  if (is_single() || is_page() && !is_home()) {
    $the_ID = get_the_ID();
    if( !empty(get_field('custom_h1',$the_ID)) ){
      $title = get_field('custom_h1',$the_ID);
    }else{
      $title = get_the_title();
    }
    $thumbid = get_post_thumbnail_id($the_ID);
    if(!$thumbid){
      $thumbid = get_field('default','option')['id'];
    }
    if( !empty(get_field('custom_sottotitolo',$the_ID)) ){
      $sottotitolo = get_field('custom_sottotitolo',$the_ID);
    }
  }
  if (is_home()) {
    $the_ID = get_queried_object()->ID;
    if( !empty(get_field('custom_h1')) ){
      $title = get_field('custom_h1');
    }else{
      $title = get_the_title($the_ID);
    }
    $thumbid = get_field('archive_image','option')['id'];
  }
  if (is_archive() ) {
    if($type=='post'){
      $thumbid = get_field('archive_image','option')['id'];
    }
    if(isset(get_queried_object()->labels->name)){
      $title = get_queried_object()->labels->name;
    }else{
      $title = get_queried_object()->name;
    }
    if( is_shop() ){
      $the_ID = get_option( 'woocommerce_shop_page_id' );
      $thumbid = get_post_thumbnail_id($the_ID);
      if(!$thumbid){
        $thumbid = get_field('archive_image','option')['id'];
      }
      if( !empty(get_field('custom_h1',$the_ID)) ){
        $title = get_field('custom_h1',$the_ID);
      }else{
        $title = get_the_title($the_ID);
      }
    }
  }
  if (is_tax()) {
    if(get_queried_object()->taxonomy=='categoria'){
      $term_id = get_queried_object()->term_id;
      $thumbnail = get_field('immagine', 'categoria' . '_' . $term_id);
      if($thumbnail)  $thumbid = $thumbnail['ID'];
      if( $term->description )  $sottotitolo = $term->description;
    }
    if(get_queried_object()->taxonomy=='product_cat'){
      $term_id = get_queried_object()->term_id;
      if( !empty(get_field('custom_h1', 'product_cat' . '_' . $term_id)) ){
        $title = get_field('custom_h1', 'product_cat' . '_' . $term_id);
      }
      
    }
  }
  if (is_tag()) {
    $title = single_tag_title( '', false );
    $the_ID = get_queried_object()->term_id;
    $thumbid = get_field('archive_image','option')['id'];
  }
  if ( is_search()) {
    $title = __( 'Ricerca', _TEXT_DOMAIN_ );
    $thumbid = '';
  }
  if (is_404()) {
    $title = __( '404', _TEXT_DOMAIN_ );
    $thumbid = '';
  }

  if(is_cart() || is_checkout() || is_account_page() || is_shop() ){
    // $thumbid = '';
  }

  if(getBodyClass('no-hero-image')){
    $thumbid = '';
  }
  
  // if( is_woocommerce() ){
  //   $thumbid = '';
  // }

  $noheroimage = '';
  if($thumbid == '')  $noheroimage = 'no-hero-image';

  if( class_exists('ACF') && class_exists( 'WooCommerce' ) && empty( get_field('wo_nascondi_titolo_archivi','options') ) ){
    if( is_woocommerce() && (is_archive() || is_shop() || is_tax()) ){
     // return false;
    }  
  }



  

?>

<?php
if( !is_product() ){
    //
    $term = get_queried_object();
    //
    if( is_shop() ){
        $page_for_posts = get_option( 'woocommerce_shop_page_id' ); 
        $post_content = get_post($page_for_posts);
        $news_content = $post_content->post_content;
        if( $news_content != '' ){
          $sottotitolo = apply_filters('the_content',$news_content); 
        }
    }elseif( is_woocommerce() ){
        if( !empty($term->description) ){
          $sottotitolo = $term->description;
        }
    }
    //
    ?>
<?php
}
?>


<section class="hero">
  <div class="hero__container basic-container small-container">
    <div class="hero__sub-container container-grid-el">
      <?php if ( function_exists('yoast_breadcrumb') ) { ?>
      <div class="breadcrumb"><?php yoast_breadcrumb(); ?></div>
      <?php } ?>
      <?php if( $title != '' ){ ?>
      <h1 class="hero__title h2"><?php echo $title ?></h1>
      <?php } ?>
      <?php if( $sottotitolo != '' ){ ?>
      <p class="hero__p"><?php echo $sottotitolo ?></p>
      <?php } ?>
    </div>
  </div>
</section>