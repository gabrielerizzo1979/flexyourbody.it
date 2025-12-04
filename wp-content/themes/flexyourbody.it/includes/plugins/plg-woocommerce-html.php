<?php

/**
* Hook: woocommerce_single_product_summary.
*
* @hooked woocommerce_template_single_title - 5
* @hooked woocommerce_template_single_rating - 10
* @hooked woocommerce_template_single_price - 10
* @hooked woocommerce_template_single_excerpt - 20
* @hooked woocommerce_template_single_add_to_cart - 30
* @hooked woocommerce_template_single_meta - 40
* @hooked woocommerce_template_single_sharing - 50
* @hooked WC_Structured_Data::generate_product_data() - 60
*/
  


if ( class_exists('ACF') && class_exists( 'WooCommerce' ) )
{
  //
  //
  // Aggiungiamo i wrap alla pagina prodotto per Gallery e Summary
  function theme_wc_open_tag_wrapper()
  {
      echo '<div class="product__wrap">';
      if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div class="breadcrumb-product mobile">', '</div>'); }
  }
  add_action( 'woocommerce_before_single_product_summary', 'theme_wc_open_tag_wrapper', 5 );
  function theme_wc_open_tag_gallery_wrapper()
  {
      echo '<div class="column-gallery">';
  }
  add_action( 'woocommerce_before_single_product_summary', 'theme_wc_open_tag_gallery_wrapper', 5 );
  function theme_wc_open_tag_summary_wrapper()
  {
    echo '<div class="column-summary">';
    if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div class="breadcrumb-product desktop">', '</div>'); }
  }
  add_action( 'woocommerce_before_single_product_summary', 'theme_wc_open_tag_summary_wrapper', 40 );
  function theme_wc_close_tag_wrapper()
  {
      echo '</div>';
  }
  add_action( 'woocommerce_before_single_product_summary', 'theme_wc_close_tag_wrapper', 30 );
  add_action( 'woocommerce_after_single_product_summary', 'theme_wc_close_tag_wrapper', 3 );
  add_action( 'woocommerce_after_single_product_summary', 'theme_wc_close_tag_wrapper', 4 );
  //
  //
  //
  // add_filter('woocommerce_get_availability', 'custom_get_availability', 1, 2);
  // function custom_get_availability($availability, $product) {
  //   if ($availability['availability'] == '') {
  //     $availability['availability'] = __('In Stock', 'woocommerce');
  //   }
  //   return 'ciao';
  // }

  


  /* WOOCOMMERCE CUSTOM WRAPPER PRODUCT CARD
  *
  *  In queste funzioni viene aggiunto tramite hook un div wrapper per i testi della product card
  *
  ------------------------------------------------------------------------------*/

  function theme_wc_product_card_before_img ()
  {
      echo '<div class="img-wrap">';
  }
  add_action('woocommerce_before_shop_loop_item_title', 'theme_wc_product_card_before_img', 1);

  function theme_wc_product_card_before_title ()
  {
      echo '</div><div class="text-wrap">';
  }
  add_action('woocommerce_shop_loop_item_title', 'theme_wc_product_card_before_title', 1);

  function theme_wc_product_card_after_price ()
  {
      echo '</div>';
  }
  add_action('woocommerce_after_shop_loop_item_title', 'theme_wc_product_card_after_price', 10);







  //
  //
  // NASCONDI TITOLO DI DEFAULT SULLE PAGINE DI WOOCOMMERCE
  add_filter( 'woocommerce_show_page_title', '__return_false' );
  // if( !empty( get_field('wo_nascondi_titolo_archivi','options') ) ){
  //   if( get_field('wo_nascondi_titolo_archivi','options') ){
  //     add_filter( 'woocommerce_show_page_title', '__return_false' );
  //   }
  // }else{
  //   add_filter( 'woocommerce_show_page_title', '__return_false' );
  //   add_filter('woocommerce_show_page_title', 'my_woocommerce_show_page_title_with_button');
  //   function my_woocommerce_show_page_title_with_button($title) {
  //     $output = '<h1 class="page-title h3">'.woocommerce_page_title(false).'</h1>';
  //     //$output .= '<button class="btn-filters"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon"><use xlink:href="'. _THEME_BUILD_.'/spritemap.svg#ico_sort-by"></use></svg>'.__('Filtri','flexyourbody.it').'</button>';
  //     echo $output;
  //   }
  // }

  //
  //
  //  SPOSTO IL PREZZO SOTTO LA DESCRIZIONE BREVE
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 21 );
  
  //
  //
  // MODIFICO ADD TO CART LABEL
  add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single', 100 ); 
  function woocommerce_add_to_cart_button_text_single() {
    return __( 'Aggiungi al carrello', 'woocommerce' ); 
  }
  // MODIFICO ADD TO CART LABEL
  add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );  
  function woocommerce_add_to_cart_button_text_archives() {
    return __( 'Aggiungi al carrello', 'woocommerce' );
  }
  

  


  //
  //
  // Rimuovo dalla pagina My Account i download e la possibilità di modificare l'indirizzo
  add_filter( 'woocommerce_account_menu_items', 'njengah_remove_address_my_account', 999 );
  function njengah_remove_address_my_account( $items ) {
    // unset($items['edit-address']);
    unset($items['downloads']);
    return $items;
  }


  
  //
  //
  // elimina la visualizzazione del doppio prezzo per i prodotti in offerta
  add_filter( 'woocommerce_get_price_html', 'hide_duplicate_prices_for_sale_products', 10000, 2 );
  function hide_duplicate_prices_for_sale_products( $price, $product ) {
      // Verifica se il prodotto è in offerta
      if ( $product->is_on_sale() ) {
          // Ottieni il prezzo normale e quello di vendita
          $regular_price = $product->get_regular_price();
          $sale_price = $product->get_sale_price();
          
          // Se i prezzi sono uguali, mostra solo un prezzo
          if ( $regular_price == $sale_price ) {
              $price = wc_price( $product->price );
          }
      }
      return $price;
  }


  //
  //
  // SPOSTO IL PREZZO TRA QUANTITY E ADDTOCART
  // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
  // add_action( 'woocommerce_after_add_to_cart_quantity', 'woocommerce_template_single_price' );

  
  //
  //
  // AGGIUNGO LA SHORT DESCRIPTION AL SUMMARY
  function my_woocommerce_template_short_description(){
    global $product;
    echo '<div class="short-description">';
    echo '<h2>'.__('Dettagli prodotto','flexyourbody.it').'</h2>';
    echo '<p>'.$product->post->post_excerpt.'</p>';
    echo '</div>';
 
  }
  // add_action( 'woocommerce_single_product_summary', 'my_woocommerce_template_short_description', 39 );
  //



  //
  //
  // AGGIUNGO UN BOTTONE SOTTO ADD_TO_CART E AGGIUNGO SHORTCODE DELL'ADD TO WISHLIST
  
  function wc_additional_button() {
    $my_page = get_page_by_path('sei-un-buyer');
    ?>
    <a href="<?php echo get_permalink( icl_object_id($my_page->ID, 'page', true) ); ?>" class="btn-base grey-button btn-piva" title="<?php _e('Sei un buyer? Richiedi una quotazione riservata','flexyourbody.it') ?>"><?php _e('Sei un buyer? Richiedi una quotazione riservata','flexyourbody.it') ?></a>
    <?php
    echo '<div class="wishlist-btn-wrapper">'.do_shortcode('[yith_wcwl_add_to_wishlist]').'</div>';
  }
  // add_action( 'woocommerce_single_product_summary', 'wc_additional_button', 35 );
  




  //
  //
  //
  /* WOOCOMMERCE AGGIUNTA LABEL QUANTITÀ
  *
  *  In questa funzione viene stampata la label "quantità" prima dell'input quantity
  *
  ------------------------------------------------------------------------------*/
  // function theme_wc_qty_label(){
  //     echo '<p class="label_qty">' . __( 'Quantità', 'flexyourbody.it' ) . '</p>';
  // }
  // add_action( 'woocommerce_before_add_to_cart_quantity', 'theme_wc_qty_label' );
  //





  // modifico il tag dei titoli dei prodotti differenziando tra archive e shortcode
  function my_woocommerce_template_loop_product_title(){
    if( is_archive() ){
      echo '<h2 class="woocommerce-loop-product__title">'.get_the_title().'</h2>';
    }else{
      echo '<h3 class="woocommerce-loop-product__title">'.get_the_title().'</h3>';
    }
  }
  remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10);
  add_action('woocommerce_shop_loop_item_title','my_woocommerce_template_loop_product_title', 10);





  /* WOOCOMMERCE CAMBIARE LA PAGINAZIONE
  *
  *  In questa funzione vengono aggiunte le icone custom per la paginazione
  *
  ------------------------------------------------------------------------------*/
  function theme_wc_pagination_arrow( $args ){
      $prev = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icons-nav-prev"><use xlink:href="'. _THEME_BUILD_ . '/spritemap.svg#ico_prev"></use></svg> Prev';
      $next = 'Next <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icons-nav-next"><use xlink:href="'. _THEME_BUILD_ . '/spritemap.svg#ico_next"></use></svg>';
      $args['prev_text'] = $prev;
      $args['next_text'] = $next;
      return $args;
  }
  add_filter( 'woocommerce_pagination_args', 	'theme_wc_pagination_arrow' );



  remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
  remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );



  // rimuovo page/1 dalla paginazione di woocommerce
  add_filter('paginate_links', function ($link) {
    return preg_replace('#page/1[^\d\w]#', '', $link);
  });

  
  


} 
?>