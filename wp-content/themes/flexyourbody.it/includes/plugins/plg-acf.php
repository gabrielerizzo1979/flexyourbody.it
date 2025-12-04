<?php

/* ACF OPTION PAGE
*
*  In questa viene creata una pagina opzioni di ACF nel tema.
*
------------------------------------------------------------------------------*/
if ( class_exists('ACF')){
	if( function_exists('acf_add_options_page') ) {
		$settings_option_page = [
			'page_title'    => __('Impostazioni Generali', "flexyourbody.it"),
			'menu_title'    => __('Impostazioni Generali', "flexyourbody.it"),
			'menu_slug'     => 'theme-general-settings',
		];
		acf_add_options_page($settings_option_page);

		$settings_option_page2 = [
			'page_title'    => __('Impostazioni WooCommerce', "flexyourbody.it"),
			'menu_title'    => __('Impostazioni WooCommerce', "flexyourbody.it"),
			'menu_slug'     => 'theme-woocommerce-settings',
		];
		acf_add_options_page($settings_option_page2);

		$settings_option_page3 = [
			'page_title'    => __('Impostazioni Popup', "flexyourbody.it"),
			'menu_title'    => __('Impostazioni Popup', "flexyourbody.it"),
			'menu_slug'     => 'theme-modal-settings',
			'icon_url' 		=> 'dashicons-sticky',
		];
		acf_add_options_page($settings_option_page3);
	}
}
//
