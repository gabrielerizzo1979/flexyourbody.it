<?php
function my_theme_register_required_plugins() {
	$plugins = array(
		array(
			'name'               => 'Advanced custom fields pro', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/bundled-plugins/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'Variation Swatches for WooCommerce',
			'slug'      => 'woo-variation-swatches',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'YITH WooCommerce Wishlist',
			'slug'      => 'yith-woocommerce-wishlist',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'Simple Custom Post Order',
			'slug'      => 'simple-custom-post-order',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'Yoast SEO',
			'slug'      => 'wordpress-seo',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'Yoast Duplicate Post',
			'slug'      => 'duplicate-post',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'WPS Hide Login',
			'slug'      => 'wps-hide-login',
			'required'  => true,
			'force_activation'   => false,
		),
    	array(
			'name'      => 'W3 Total Cache',
			'slug'      => 'w3-total-cache',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'CDN Enabler',
			'slug'      => 'cdn-enabler',
			'required'  => true,
			'force_activation'   => false,
		),
		array(
			'name'      => 'Wordfence Security - Firewall & Malware Scan',
			'slug'      => 'wordfence',
			'required'  => true,
			'force_activation'   => false,
		),
	);
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
?>
