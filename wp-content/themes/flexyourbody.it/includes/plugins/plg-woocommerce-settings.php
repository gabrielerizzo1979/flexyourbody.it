<?php
if ( class_exists('ACF') && class_exists( 'WooCommerce' ) && is_plugin_active('advanced-custom-fields-pro/acf.php') )
{
  
  /* Enable support for Woocommerce
  ----------------------------------------------------------------------*/
  // if( !empty(get_field('wo_dimensione_immagini','options')['thumbnail_image_width']) && !empty(get_field('wo_dimensione_immagini','options')['single_image_width']) ){
  //   add_theme_support(
  //     'woocommerce'
  //     // 'woocommerce',
  //     // [
  //     //   'thumbnail_image_width' => get_field('wo_dimensione_immagini','options')['thumbnail_image_width'],
  //     //   'single_image_width' => get_field('wo_dimensione_immagini','options')['single_image_width'],
  //     //   'product_grid' =>
  //     //     [
  //     //       'default_rows' => 4,
  //     //       'min_rows' => 1,
  //     //       'default_columns' => 5,
  //     //       'min_columns'     => 1,
  //     //       'max_columns'     => 6,
  //     //     ],
  //     // ]
  //   );
  // }
  

  if( !empty(get_field('wo_dimensione_immagini','options')['gallery_zoom']) && get_field('wo_dimensione_immagini','options')['gallery_zoom'] ){
    add_theme_support('wc-product-gallery-zoom');
  }
  if( !empty(get_field('wo_dimensione_immagini','options')['gallery_lightbox']) && get_field('wo_dimensione_immagini','options')['gallery_lightbox'] ){
    add_theme_support('wc-product-gallery-lightbox');
  }
  if( !empty(get_field('wo_dimensione_immagini','options')['gallery_slider']) && get_field('wo_dimensione_immagini','options')['gallery_slider'] ){
    add_theme_support('wc-product-gallery-slider');
  }
  function theme_wc_single_product_carousel_options($args){
    $args['directionNav'] = true;
    return $args;
  }
  if( !empty(get_field('wo_dimensione_immagini','options')['gallery_direction_nav']) && get_field('wo_dimensione_immagini','options')['gallery_direction_nav'] ){
    add_filter('woocommerce_single_product_carousel_options', 'theme_wc_single_product_carousel_options');
  }
  function theme_wc_single_product_dots_options($args){
    $args['controlNav'] = true;
    return $args;
  }
  // if( !empty(get_field('wo_dimensione_immagini','options')['gallery_dots']) && get_field('wo_dimensione_immagini','options')['gallery_dots'] ){
  //   add_filter('woocommerce_single_product_carousel_options', 'theme_wc_single_product_dots_options');
  // }

  add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
      'width' => get_field('wo_dimensione_immagini','options')['thumbnail_witdth'],
      'height' => get_field('wo_dimensione_immagini','options')['thumbnail_height'],
      'crop' => 1,
    );
  });

  

  //
  //
  // Imposto il numero di prodotti correlati e upsell
  function theme_wc_related_products_args( $args )
  {
    $args['posts_per_page'] = get_field('wo_numero_prodotti_correlati','options');
    $args['columns'] = get_field('wo_colonne_prodotti_correlati','options');
    return $args;
  }
  add_filter( 'woocommerce_upsell_display_args', 'theme_wc_related_products_args', 20 );
  add_filter( 'woocommerce_output_related_products_args', 'theme_wc_related_products_args', 20 );
  //
  //
  // Imposto il numero di cross-sells con lo stesso valore dei prodotti correlati
  add_filter('woocommerce_cross_sells_total', 'cartCrossSellTotal');
  function cartCrossSellTotal($total) {
    return get_field('wo_numero_prodotti_correlati','options');
  }
  add_filter( 'woocommerce_cross_sells_columns', 'change_cross_sells_columns' );
  function change_cross_sells_columns( $columns ) {
      return get_field('wo_numero_prodotti_correlati','options');;
  }


  //
  //
  // MODIFICO UPSELL TEXT
  if( !empty(get_field('testo_upsell','options')) ){
    add_filter( 'woocommerce_product_upsells_products_heading', 'db_change_upsell_title_text' );
    function db_change_upsell_title_text() {
       return get_field('testo_upsell','options');
    }
  }
  // MODIFICO RELATED TEXT
  if( !empty(get_field('testo_related','options')) ){
    add_filter( 'woocommerce_product_related_products_heading', 'db_change_related_title_text' );
    function db_change_related_title_text() {
       return get_field('testo_related','options');
    }
  }
  //
  //
  // Disabilito cart collateral
  if( !empty( get_field('wo_nascondi_cross_sells','options') ) ){
    if( get_field('wo_nascondi_cross_sells','options') ){
      remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    }
  }
  
  
  
  //
  //
  // MOSTRO LE CATEGORIE SUI LOOP PRODOTTI
  function theme_wc_category_on_product_card (){
    global $post;
    $terms = get_the_terms( $post->ID, 'product_cat' );
    if ( !empty($terms) ) :
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
        $myterm = get_term($myterms[count($myterms)-1], 'product_cat');
        echo '<p class="categories">' . $myterm->name  . '</p>';
      }
      

    endif;

    global $product;
    $output = '';
    $campo_presente = false;
    $attributo_slug = 'pa_denominazione';
    $attributo = $product->get_attribute($attributo_slug);
    if (!empty($attributo)) {
      $output .= esc_html($attributo);
      $campo_presente = true;
    }
    $attributo_slug = 'pa_vitigno';
    $attributo = $product->get_attribute($attributo_slug);
    if (!empty($attributo)) {
      if ($campo_presente) {
        $output .= '<br/>'.esc_html($attributo);
      }else{
        $output .= esc_html($attributo);
      }
    }
    $attributo_slug = 'pa_metodo-di-produzione';
    $attributo = $product->get_attribute($attributo_slug);
    if (!empty($attributo)) {
      if ($campo_presente) {
        $output .= '<br/>'.esc_html($attributo);
      }else{
        $output .= esc_html($attributo);
      }
    }
    echo '<p class="categories">' . $output . '</p>';
  }
  if( !empty(get_field('wo_mostra_categorie_su_archivio_prodotti','options') ) && get_field('wo_mostra_categorie_su_archivio_prodotti','options') ){
    add_action('woocommerce_shop_loop_item_title', 'theme_wc_category_on_product_card', 3);
  }




  
  
  
  




  //
  //
  // MOSTRO LE CATEGORIE SUI SINGLE PRODOTTI SOTTO IL TITOLO
  // function theme_wc_category_links (){
  //   $terms = get_the_terms( get_the_ID(), 'product_cat' );
  //   if ( !empty($terms) ) :
  //     $last_term_id = 0;
  //     $myterms=array();
  //     foreach( $terms as $category ) {
  //       foreach( $terms as $tmp_category ) {
  //         $parent = $tmp_category->parent;
  //         $term_id = $tmp_category->term_id;
  //         if( $parent == $last_term_id ){
  //           $last_term_id = $term_id;
  //           $myterms[]=$term_id;
  //           break;
  //         }
  //       }
  //     }
  //     if( $myterms && count($myterms)>0 ){
  //       $output_cat = '';
  //       $cat_names = array();
  //       foreach ( $myterms as $term ){
  //         $myterm = get_term($term, 'product_cat');
  //         $cat_names[] = '<a href="' . get_term_link($myterm->term_id) . '" title="' . $myterm->name . '">' . $myterm->name . '</a>';
  //       }
  //       $output_cat = join( " - ", $cat_names );
  //       echo '<div class="product_categories">' . $output_cat  . '</div>';
  //     }
  //   endif;
    
  // }
  // if( get_field('wo_mostra_categorie_su_single_prodotti','options') ){
  //   add_action( 'woocommerce_single_product_summary', 'theme_wc_category_links', 6 );
  // }

  
  //
  // INSERISCO LA DESCRIZIONE LUNGA AL POSTO DELLA SHORT DESCRIPTION
  if( !empty( get_field('wo_desclunga_vs_shortdesc','options') ) ){
    if( get_field('wo_desclunga_vs_shortdesc','options') ){
      function my_woocommerce_template_single_excerpt(){
        if ( !empty(get_the_content()) ) {
          echo '<div class="product_description">';
            echo '<h2>'.__('Descrizione','flexyourbody.it').'</h2>';
            the_content();
            //
          echo '</div>';
        }
      }
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
      add_action( 'woocommerce_single_product_summary', 'my_woocommerce_template_single_excerpt', 20 );
    }
  }
  // if( !empty( get_field('wo_nascondi_tabs_show_attributi','options') ) ){
  //   if( get_field('wo_nascondi_tabs_show_attributi','options') ){
  //     function my_woocommerce_template_single_excerpt(){
  //       if ( !empty(get_the_content()) ) {
  //         echo '<div class="product_description">';
  //           echo '<h2>'.__('Descrizione','flexyourbody.it').'</h2>';
  //           the_content();
  //           //
  //         echo '</div>';
  //       }
  //     }
  //     remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
  //     add_action( 'woocommerce_single_product_summary', 'my_woocommerce_template_single_excerpt', 20 );
  //   }
  // }
  
  

  
  //
  //
  // NASCONDO I META SULLA PAGINA PRODOTTO (COD E CAT)
  if( !empty( get_field('wo_nascondi_meta_prodotto','options') ) ){
    if( get_field('wo_nascondi_meta_prodotto','options') ){
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    }
  }




  //
  //
  // nascondo i tabs ma mostro gli attributi in fondo al summary
  if( !empty( get_field('wo_nascondi_tabs_show_attributi','options') ) ){
    if( get_field('wo_nascondi_tabs_show_attributi','options') ){
      // RIMUOVO I TABS
      function my_woocommerce_output_product_data_tabs(){
        echo '<div style="clear:both"></div>';
      }
      remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
      //add_action( 'woocommerce_after_single_product_summary', 'my_woocommerce_output_product_data_tabs', 10 );
      //
      // mostro gli attributi in fondo al summary
      //
      function theme_wc_open_wrap_additional_information(){
          global $product;
          $add_info = $product->get_attributes();
          $hide_class = '';
          if (empty($add_info))
          {
              $hide_class = 'hide_block';
          }
          echo '<div class="additional_info_wrap ' . $hide_class . '">';
      }
      // add_action( 'woocommerce_single_product_summary', 'theme_wc_open_wrap_additional_information', 6 );
      // add_action( 'woocommerce_single_product_summary', 'woocommerce_product_additional_information_tab', 7 );	
      add_action( 'woocommerce_single_product_summary', 'theme_wc_open_wrap_additional_information', 60 );
      add_action( 'woocommerce_single_product_summary', 'woocommerce_product_additional_information_tab', 61 );

      function theme_wc_close_wrap_additional_information(){
          echo '</div>';
      }
      // add_action( 'woocommerce_single_product_summary', 'theme_wc_close_wrap_additional_information', 7 );
      add_action( 'woocommerce_single_product_summary', 'theme_wc_close_wrap_additional_information', 61 );

      function theme_wc_relabel_additional_information_tab(){
          // return __( 'Dettagli prodotto', 'flexyourbody.it' );
          return "";
      }
      add_filter('woocommerce_product_additional_information_heading', 'theme_wc_relabel_additional_information_tab');
    }
  }
  








  //
  //
  // Nascondo il prezzo se l'utente non è loggato
  function ekolab_hide_price_addcart_not_logged_in( $price, $product ) {
     if ( ! is_user_logged_in() ) {
        if( get_field('wo_nascondi_prezzo_utente_non_loggato','options') ){
          $price = '<div class="login-to-see-price"><a class="button" title="Login to buy" href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">' . __( get_field('wo_etichetta_login','options'), 'flexyourbody.it' ) . '</a></div>';
          remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
          remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        }else{
          //add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        }
     }
     return $price;
  }
  add_filter( 'woocommerce_get_price_html', 'ekolab_hide_price_addcart_not_logged_in', 9999, 2 );
  


  //
  //
  /* Imposto minimo ordine */
  // if( get_field('wo_imposta_minimo_ordine','options') ){
  //   add_action( 'woocommerce_checkout_process', 'wpspecial_imposta_ordine_minimo_importo' );
  //   add_action( 'woocommerce_before_cart' , 'wpspecial_imposta_ordine_minimo_importo' );
  //   add_action( 'woocommerce_before_checkout_form', 'wpspecial_imposta_ordine_minimo_importo' );
  // }
  // function wpspecial_imposta_ordine_minimo_importo() {
  //     $minimo_acquisto = get_field('wo_minimo_ordine','options')/100*122;
  //     $chosen_shipping_methods = explode(':',WC()->session->get('chosen_shipping_methods')[0])[0];
  //     if( 'flat_rate' === $chosen_shipping_methods ){
  //       if ( WC()->cart->total < $minimo_acquisto ) {
  //         if( is_cart() ) {
  //             wc_print_notice(
  //                 sprintf( 'Devi effettuare un acquisto minimo di %s (500€+iva) per completare un ordine, attualmente il tuo ordine è di %s.' ,
  //                     wc_price( $minimo_acquisto ),
  //                     wc_price( WC()->cart->total )
  //                 ), 'error'
  //             );

  //         } else {
  //             wc_add_notice(
  //                 sprintf( 'Devi effettuare un acquisto minimo di %s (500€+iva) per completare un ordine, attualmente il tuo ordine è di %s.' ,
  //                     wc_price( $minimo_acquisto ),
  //                     wc_price( WC()->cart->total )
  //                 ), 'error'
  //             );
  //         }
  //       }
  //     }
      
  // }
  //
  //
  // nascondo titolo di defaul dalla shop page, verrà gestito da simple hero
  // add_filter('woocommerce_show_page_title', 'bbloomer_hide_shop_page_title');
  // function bbloomer_hide_shop_page_title($title) {
  //    if (is_shop() || is_product_category() ) $title = false;
  //    return $title;
  // }
  
  /**
   * Notify admin when a new customer account is created
   */
  // add_action( 'woocommerce_created_customer', 'woocommerce_created_customer_admin_notification' );
  // function woocommerce_created_customer_admin_notification( $customer_id ) {
  //   wp_send_new_user_notifications( $customer_id, 'admin' );
  // }
  //
  



  // MODIFICO OUT OF STOCK TEXT
  //
  //
  add_filter('woocommerce_get_availability_text', 'themeprefix_change_soldout', 10, 2 );
  function themeprefix_change_soldout ( $text, $product) {
    if ( !$product->is_in_stock() ) {
      $text = __('Non disponibile','flexyourbody.it');
    }
    return $text;
  }
  add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 10 );
  function woocommerce_template_loop_stock() {
      global $product;
      // if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
      if ( !$product->is_in_stock() ) {
        $text = __('Non disponibile','flexyourbody.it');
        // echo '<p class="stock out-of-stock">'.$text.'</p>';
        echo '';
      }
  }

  




  //
  //
  // Mostro un form nella pagina prodotto quando non disponibile
  function form_indisponibilita_prodotto(){
    if( !empty( get_field('wo_indisponibilita_prodotto','options') ) ){
      global $product;
      if ( !$product->is_in_stock() ) {
         echo do_shortcode('[contact-form-7 id="'.get_field('wo_indisponibilita_prodotto','options').'"]');
      }
    }
    
  }
  add_action( 'woocommerce_single_product_summary', 'form_indisponibilita_prodotto', 30 );








  function im_search_sidebar_registration() {
    register_sidebar(
      array_merge(
        // $shared_args,
        array(
          'name'        => esc_html__( 'Woocommerce Search', _TEXT_DOMAIN_ ),
          'id'          => 'search-wc',
        )
      )
    );
  }
  add_action( 'widgets_init', 'im_search_sidebar_registration' );
  function im_minicart_sidebar_registration() {
    register_sidebar(
      array_merge(
        // $shared_args,
        array(
          'name'        => esc_html__( 'Woocommerce Minicart', _TEXT_DOMAIN_ ),
          'id'          => 'minicart-wc',
        )
      )
    );
  }
  add_action( 'widgets_init', 'im_minicart_sidebar_registration' );

  function im_sidebar_registration() {
    // Arguments used in all register_sidebar() calls.
    $shared_args = array(
      'before_widget' => '<li id="%1$s" class="widget %2$s">',
      // 'before_title'  => '<div class="widget-title-wrap title-accordion-open"><span class="widget-title">',
      // 'after_title'   => '</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icons-open-down"><use xlink:href="' . _THEME_IMG_ . '/share/icons.svg#open-down"></use></svg></span></div><div class="widget-content-wrap content-accordion"><div data-wrapper-height>',
      'after_widget'  => '</li>',
    );
    // Footer #1.
    register_sidebar(
      array_merge(
        $shared_args,
        array(
          'name'        => esc_html__( 'Woocommerce Sidebar', _TEXT_DOMAIN_ ),
          'id'          => 'sidebar-wc',
          'description' => esc_html__( 'I Widget inseriti saranno mostrati nella pagina Shop.', _TEXT_DOMAIN_ ),
        )
      )
    );
    //
    add_filter( 'widget_block_dynamic_classname', function( $classname, $block_name ) {
      $classname .= ' ' . sanitize_title( $block_name );
      return $classname;
    }, 10, 2);
  }
  if( !empty(get_field('wo_crea_sidebar','options')) ){
    if( get_field('wo_crea_sidebar','options') ){
      add_action( 'widgets_init', 'im_sidebar_registration' );
    }
  }
  add_filter('widget_title','hide_widget_title'); 
  function hide_widget_title($t){
    return null;
  }


  
  if( !empty(get_field('wo_nascondi_add_to_cart_sui_loop','options')) ){
    if( get_field('wo_nascondi_add_to_cart_sui_loop','options') ){
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    }
  }

  if( !empty(get_field('wo_nascondi_add_to_cart_su_pagina_prodotto','options')) ){
    if( get_field('wo_nascondi_add_to_cart_su_pagina_prodotto','options') ){
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
  }

  if( !empty( get_field('wo_nascondi_ordina_prodotti_su_archivio','options') ) ){
    if( get_field('wo_nascondi_ordina_prodotti_su_archivio','options') ){
      remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    }
  }
  
  if( !empty( get_field('wo_nascondi_numero_risultati_su_archivio','options') ) ){
    if( get_field('wo_nascondi_numero_risultati_su_archivio','options') ){
      remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    }
  }

  if( !empty(get_field('wo_nascondi_stock_qty','options')) ){
    if( get_field('wo_nascondi_stock_qty','options') ){
      add_filter( 'woocommerce_get_stock_html', function ( $html, $product ) {
        return '';
      }, 10, 2);
    }
  }







  //
  //
  // FACCIO VISIUALIZZARE SOLO LA SPEDIZIONE GRATUITA QUANDO PRESENTE
  function wpspecial_spedizione_gratuita_automatica( $rates, $package ) {
    $all_free_rates = array();
    $isExistFreeShipping =  false;
    //check exist free shipping
    foreach ( $rates as $rate_id => $rate ) {
      if ( 'free_shipping' === $rate->method_id){
        $isExistFreeShipping = true;
        break;
      }
    }
    if($isExistFreeShipping){
      foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id || 'local_pickup' === $rate->method_id) {
          $all_free_rates[ $rate_id ] = $rate;
        }
      }
      if ( empty( $all_free_rates )) {
        return $rates;
      } else {
        return $all_free_rates;
      }
    }else{
      return $rates;
    }
  }
  add_filter( 'woocommerce_package_rates', 'wpspecial_spedizione_gratuita_automatica', 10, 2 );







  // ordino gli ordini in ordine cronologico
  add_action('pre_get_posts', 'filter_orders_by_date');
  function filter_orders_by_date($query) {
    if (is_admin() && $query->is_main_query() && isset($_GET['post_type']) && $_GET['post_type'] == 'shop_order') {
      $query->set('orderby', 'date');
      $query->set('order', 'DESC');
    }
  }
  //
  //
  //





  //
  //
  // MOSTRO UN TESTO SOTTO LA SHORT DESCRIPTION DI UN PRODOTTO SE L'UTENTE E' LOGGATO O MENO
  add_action('woocommerce_single_product_summary', 'add_text_after_excerpt_single_product', 20);
  function add_text_after_excerpt_single_product() {
    global $product;
    if (is_product()) {
      if( is_user_logged_in() ) {
        if( !empty( get_field('testo_sotto_short_description_utente_loggato','options') ) ){
          echo get_field('testo_sotto_short_description_utente_loggato','options');
        }
      }else{
        if( !empty( get_field('testo_sotto_short_description_utente_non_loggato','options') ) ){
          echo get_field('testo_sotto_short_description_utente_non_loggato','options');
        }
      }
    }
  }










}
