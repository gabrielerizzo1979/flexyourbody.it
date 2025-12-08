<?php

function theme_login_logo()
{
    $url_img_logo_admin = _THEME_IMG_ . '/admin/logo-admin.png';
	echo	'<style type="text/css">'
				.'#login h1 a, .login h1 a {'
					.'background-image: url(' . apply_filters( 'theme_login_logo_url', $url_img_logo_admin ) . ');'
					.'height:120px;'
					.'width:120px;'
					.'background-size: contain;'
					.'background-repeat: no-repeat;'
					.'padding-bottom: 10px;'
				.'}'
			. '</style>';
}
add_action( 'login_enqueue_scripts', 'theme_login_logo' );
function theme_login_url()
{
	return home_url();
}
add_filter( 'login_headerurl', 'theme_login_url' );
function theme_login_title()
{
	return get_option( 'blogname' );
}
add_filter( 'login_headertext', 'theme_login_title' );
/*----------------------------------------------------------------------------*/



/* THEME FAVICON
*
*  In questa funzione viene incluso il template part per la favicon.
*
------------------------------------------------------------------------------*/
function theme_custom_favicon()
{
	get_template_part('includes/template-parts/part', 'theme-favicon');
}
add_action('login_head', 'theme_custom_favicon');
add_action('admin_head', 'theme_custom_favicon');
add_action('wp_head', 'theme_custom_favicon');
/*----------------------------------------------------------------------------*/



/*  Vengono definiti i ritagli delle immagini*/
add_image_size( '1920x1080', 1920, 1080, true);
add_image_size( '1920xauto', 1920, 99999, false);
add_image_size( '800x800', 800, 800, true );
add_image_size( '800xauto', 800, 9999, false );
add_image_size( '500x400', 500, 400, true );



if ( ! function_exists( 'theme_setup' ) ){
	function theme_setup(){
		/* Make theme available for translation
		----------------------------------------------------------------------*/
		load_theme_textdomain( _TEXT_DOMAIN_ );
		/* Aggiunge il campo Excerpt nelle pagine
		----------------------------------------------------------------------*/
		add_post_type_support( 'page', 'excerpt' );
		/* Enable support for Yoast seo breadcrumbs
		----------------------------------------------------------------------*/
		add_theme_support( 'yoast-seo-breadcrumbs' );
		/* Enable support for Post Thumbnails on posts and pages
		----------------------------------------------------------------------*/
		add_theme_support( 'post-thumbnails' );
		if(!isset($content_width)){
			$content_width = 600;
		}
		/*--------------------------------------------------------------------*/
		//
		/* REGISTER NAV MENU POSITIONS
		----------------------------------------------------------------------*/
		register_nav_menus(
			[
				'primary'    	=> esc_html__( 'Menu Principale', _TEXT_DOMAIN_ ),
				'wpml-menu' 	=> esc_html__( 'WPML Menu', _TEXT_DOMAIN_ ),
				'category-menu' => esc_html__( 'Category Menu', _TEXT_DOMAIN_ ),
				'gdpr-menu'	 	=> esc_html__( 'Gdpr Menu', _TEXT_DOMAIN_ ),
				'button-menu' 	=> esc_html__( 'Button Menu', _TEXT_DOMAIN_ ),
			]
		);
		//
		/*--------------------------------------------------------------------*/
		/* Enable support for custom logo
		----------------------------------------------------------------------*/
		add_theme_support('custom-logo', array
		(
			'height'      => 248,
			'width'       => 248,
			'flex-height' => true,
		));
		/*--------------------------------------------------------------------*/
		  
	}
}
add_action( 'after_setup_theme', 'theme_setup' );



function theme_scripts()
{
	//
	if( !is_admin() ){
		// wp_dequeue_style( 'wp-block-library' ); // Wordpress core
		// wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
		// wp_dequeue_style( 'global-styles' );
		// wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'wp-emoji-styles' );
		// wp_dequeue_style('wpml-blocks');
		wp_dequeue_style('wpml-menu-item-0');
		wp_deregister_script('wpml-cookie');
	}
	//
	// fonts
	wp_enqueue_style(_THEME_NAME_ . '-all', _THEME_CUSTOM_FONT_._s_.'all.css', array(), _VERSION_);
	if( class_exists('ACF') && !empty(get_field('opt_font','options')) ){
		if( get_field('opt_font','options') == 'font-eb-garamond' ){
			wp_enqueue_style(_THEME_NAME_ . '-eb-garamond', _THEME_CUSTOM_FONT_._s_.'eb-garamond.css', array(), _VERSION_);
		}elseif( get_field('opt_font','options') == 'font-baskervville-uppercase' ){
			wp_enqueue_style(_THEME_NAME_ . '-baskervville', _THEME_CUSTOM_FONT_._s_.'baskervville.css', array(), _VERSION_);
		}elseif( get_field('opt_font','options') == 'font-work-sans' ){
			wp_enqueue_style(_THEME_NAME_ . '-work-sans', _THEME_CUSTOM_FONT_._s_.'work-sans.css', array(), _VERSION_);
		}
	}
	//
	wp_enqueue_style('immedia-lab-app-style', _THEME_CSS_._s_.'app.css', array(), _VERSION_);
	wp_enqueue_script('appjs', _THEME_JS_ ._s_.'app.js', array(), _VERSION_, true );
    wp_enqueue_style( _THEME_NAME_ . '-general', _THEME_CSS_._s_.'general.css', array(), _VERSION_ );
	wp_enqueue_script('general', _THEME_JS_ ._s_.'general.js', array(), _VERSION_, true );
	//
	if ( is_archive() || is_home() || is_search() || is_tag() ){
		wp_enqueue_style( _THEME_NAME_ . '-archive', _THEME_CSS_._s_.'archive.css', array(), _VERSION_ );
		wp_enqueue_script('archive', _THEME_JS_._s_.'archive.js', array(), _VERSION_, true );
	}
	//
	if( !is_woocommerce() && !is_account_page() && !is_checkout() && !is_cart() && !is_404() && !is_archive() && !is_home() && !is_search())
	{
		wp_enqueue_style( _THEME_NAME_ . '-basic-page', _THEME_CSS_._s_.'basic-page.css', array(), _VERSION_ );
		wp_enqueue_script('basic-page', _THEME_JS_._s_.'basic-page.js', array(), _VERSION_, true );
	}
	if( is_woocommerce() || is_account_page() || is_checkout() || is_cart()  )
	{
		wp_enqueue_style( 'im-woocommerce-style', _THEME_CSS_._s_.'woocommerce.css', array(), _VERSION_ );
		wp_enqueue_script('im-woocommerce-js',_THEME_JS_._s_.'woocommerce.js',array(),_VERSION_, true);
	}
	if(is_shop() || is_product_category() || is_product_tag())
	{
		wp_enqueue_style( 'im-woocommerce-archive-style', _THEME_CSS_._s_.'wc-shop.css', array(), _VERSION_ );
		wp_enqueue_script('im-woocommerce-archive-js',_THEME_JS_._s_.'wc-shop.js',array(),_VERSION_, true);
	}
	if(is_account_page())
	{
		wp_enqueue_style( 'im-woocommerce-account-style', _THEME_CSS_._s_.'wc-account.css', array(), _VERSION_ );
		wp_enqueue_script('im-woocommerce-account-js',_THEME_JS_._s_.'wc-account.js',array(),_VERSION_, true);
	}
	if(is_product())
	{
		wp_enqueue_style( 'im-woocommerce-product-style', _THEME_CSS_._s_.'wc-product.css', array(), _VERSION_ );
		wp_enqueue_script('im-woocommerce-product-js',_THEME_JS_._s_.'wc-product.js',array(),_VERSION_, true);
	}
	if(is_checkout())
	{
		wp_enqueue_style( 'im-woocommerce-checkout-style', _THEME_CSS_._s_.'wc-checkout.css', array(), _VERSION_ );
		wp_enqueue_script('im-woocommerce-checkout-js',_THEME_JS_._s_.'wc-checkout.js',array(),_VERSION_, true);
	}
	if(is_cart())
	{
		wp_enqueue_style( 'im-woocommerce-cart-style', _THEME_CSS_._s_.'wc-cart.css', array(), _VERSION_ );
		wp_enqueue_script('im-woocommerce-cart-js',_THEME_JS_._s_.'wc-cart.js',array(),_VERSION_, true);
	}
	if (is_404())
	{
		wp_enqueue_style( _THEME_NAME_ . '-404', _THEME_CSS_._s_.'404.css', array(), _VERSION_ );
		wp_enqueue_script('404', _THEME_JS_._s_.'404.js', array(), _VERSION_, true );
	}
	if (defined( 'YITH_WCWL' ))
	{
		if (yith_wcwl_is_wishlist_page())
		{
			wp_enqueue_style( 'immedia-lab-wishlist-style', _THEME_CSS_ . _s_ . 'wishlist.css', array(), _VERSION_ );
			wp_enqueue_script('main-wishlist-js',_THEME_JS_ . _s_.'wishlist.js',array(),_VERSION_, true);
		}
	}
	//
	if (is_front_page()){
		//
		// wp_deregister_script( 'wc-add-to-cart' );
		// wp_deregister_script( 'js-cookie' );
		// wp_deregister_script( 'jquery-selectBox' );
		// wp_deregister_script( 'prettyPhoto' );
		// wp_deregister_script( 'jquery-yith-wcwl' );
		// wp_deregister_script( 'sourcebuster-js' );
		// wp_deregister_script( 'wc-order-attribution' );
		// wp_deregister_script( 'underscore' );
		// wp_deregister_script( 'woosg-frontend' );

		// wp_deregister_script( 'wp-polyfill-inert' );
		// wp_deregister_script( 'regenerator-runtime' );
		// wp_deregister_script( 'wp-polyfill' );
		// wp_deregister_script( 'wp-hooks' );
		// wp_deregister_script( 'wp-i18n' );
		// wp_deregister_script( 'wp-url' );
		// wp_deregister_script( 'wp-api-fetch' );
		// wp_deregister_script( 'wc-settings' );
		// wp_deregister_script( 'wc-price-format' );
		// wp_deregister_script( 'wc-mini-cart-block-frontend' );

	}
	//
    /* Rimozione emoji WordPress
    ----------------------------------------------------------------------*/
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );



function add_footer_styles() {
	wp_enqueue_style( 'im-woocommerce-widgets-style', _THEME_CSS_._s_.'woo-widgets.css', array(), _VERSION_ );
	wp_enqueue_script('im-woocommerce-widgets-js',_THEME_JS_._s_.'woo-widgets' . '.js',array(),_VERSION_);
}
add_action( 'get_footer', 'add_footer_styles' );


//
//
// Aggiorno il CSS nell'area amministratore
function admin_style() {
	$screen = get_current_screen();
	wp_enqueue_style('admin-styles', _URL_.'/assets/css/admin.css');
	if ( $screen->base == 'post' && $screen->post_type != 'product' ){
		wp_enqueue_style( 'admin-block-styles-1', _THEME_CSS_ . '/app.css' );
		wp_enqueue_style( 'admin-block-styles-2', _THEME_CSS_ . '/general.css' );
		wp_enqueue_style( 'admin-block-styles-3', _THEME_CSS_ . '/basic-page.css' );
		wp_enqueue_script('admin-js', _THEME_JS_ . '/app.js' );
		wp_enqueue_script('admin-general-js', _THEME_JS_ . '/general.js' ); 
		wp_enqueue_script('admin-basic-page-js', _THEME_JS_ . '/basic-page.js' );
		wp_enqueue_style( _THEME_NAME_ . '-archive', _THEME_CSS_ . '/archive.css' );
		wp_enqueue_script('archive', _THEME_JS_ . '/archive.js' );
	}
}
add_action('in_admin_footer', 'admin_style');
//
//
//
function theme_browser_json()
{
	$otuput = "<script type=\"text/javascript\">";
	$otuput .=  "/* <![CDATA[ */\n";
	$otuput .=  "var templateUrl = " . wp_json_encode(get_template_directory_uri()) . "\n";
	$otuput .=  "/* ]]> */\n";
	$otuput .= "</script>";

	echo $otuput;
}
add_action('wp_footer', 'theme_browser_json');
//
//
//

//
//
// Aggiungo classe al body tramite ACF
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
	if (class_exists('ACF')) {
		if( !empty(get_field('body_class')) ){
			$classes[] = get_field('body_class');
		}
	}
	if( !is_admin()) {
		$classes[] = 'is-front';
	}
	return $classes;
}
function inline_css() {
	if( class_exists('ACF') && !empty(get_field('opt_stile_colore','options')) ){
		if(  get_field('opt_stile_colore','options') == 'chiaro' && !empty(get_field('opt_colore_1','options')) ){
			echo "<style>
				:root{
					--secondary-color: ".get_field('opt_colore_1','options').";
					--tertiary-color: #ffffff;
				}
			</style>";
		}elseif(  get_field('opt_stile_colore','options') == 'scuro' && !empty(get_field('opt_colore_2','options')) ){
			echo "<style>
				:root{
					--secondary-color: ".get_field('opt_colore_2','options').";
					--tertiary-color: #2D2D2D;
				}
			</style>";
		}
	}
	if( class_exists('ACF') && !empty(get_field('opt_stile_bottoni','options')) ){
		echo "<style>
			:root{
				--radius-btn: ".get_field('opt_stile_bottoni','options').";
			}
		</style>";
	}
	if( class_exists('ACF') && !empty( get_field('wo_dimensione_immagini','options')['ratio_immagine_product_page'] ) ){
		echo "<style>
			:root{
				--aspect-ratio-single-product: ".get_field('wo_dimensione_immagini','options')['ratio_immagine_product_page'].";
			}
		</style>";
	}
}
add_action( 'wp_footer', 'inline_css', 0 );



function getBodyClass($string){
	$bc = get_body_class();
	$ret = false;
	foreach ($bc as $class) {
		if (str_contains($class, $string)) {
			$ret = true;
		}
	}
	return $ret;
}
if( class_exists('ACF') && !empty(get_field('opt_font','options')) ){
	add_filter( 'body_class','my_body_classes1' );
	function my_body_classes1( $classes ) {
		$classes[] = get_field('opt_font','options');
		return $classes;
	}
}
if( class_exists('ACF') && !empty(get_field('opt_allineamento_testi','options')) ){
	add_filter( 'body_class','my_body_classes2' );
	function my_body_classes2( $classes ) {
		$classes[] = get_field('opt_allineamento_testi','options');
		return $classes;
	}
}
//
// Sostituisco il # con javascript:void(0);
add_filter('walker_nav_menu_start_el', 'wpse_226884_replace_hash', 999);
function wpse_226884_replace_hash($menu_item) {
	if (strpos($menu_item, 'href="#"') !== false) {
	  $menu_item = str_replace('href="#"', 'href="javascript:void(0);"', $menu_item);
	}
	return $menu_item;
}



//
//
/* ABILITARE UPLOAD SVG */
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}
	$filetype = wp_check_filetype( $filename, $mimes );
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4 );
function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
function fix_svg() {
	echo '<style type="text/css">
		.attachment-266x266, .thumbnail img {
			width: 100% !important;
			height: auto !important;
		}
		</style>';
}
add_action( 'admin_head', 'fix_svg' );
//
//
//
function modify_upload_mimes ( $mimes_types ) {
    // add your extension to the mimes array as below
    $mimes_types['zip'] = 'application/zip';
    $mimes_types['gz'] = 'application/x-gzip';
    return $mimes_types;
}
add_filter( 'upload_mimes', 'modify_upload_mimes', 99 );

function add_allow_upload_extension_exception( $types, $file, $filename, $mimes ) {
    // Do basic extension validation and MIME mapping
    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext         = $wp_filetype['ext'];
    $type        = $wp_filetype['type'];
    if( in_array( $ext, array( 'zip', 'gz' ) ) ) { // it allows zip files
        $types['ext'] = $ext;
        $types['type'] = $type;
    }
    return $types;
}
add_filter( 'wp_check_filetype_and_ext', 'add_allow_upload_extension_exception', 99, 4 );
//
//
//
function truncate($text, $chars = 25) {
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

//
//
//
// Change the From address.
add_filter( 'wp_mail_from', function ( $original_email_address ) {
	if( !empty(get_field('wp_mail_from','options')) ) {
		$wp_mail_from = get_field('wp_mail_from','options');
	}else{
		$wp_mail_from = 'noreply@flexyourbody.it';
	}
    return $wp_mail_from;
} );
//
// Change the From name.
add_filter( 'wp_mail_from_name', function ( $original_email_from ) {
	if( !empty(get_field('wp_mail_from_name','options')) ) {
		$wp_mail_from_name = get_field('wp_mail_from_name','options');
	}else{
		$wp_mail_from_name = 'Flex Your Body';
	}
    return $wp_mail_from_name;
} );