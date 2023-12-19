<?php
/**
 * Required Plugins Installation File
 *
 * @link https://github.com/TGMPA/TGM-Plugin-Activation
 *
 * @package dici
 */

require_once get_template_directory() . '/inc/lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'dici_register_required_plugins' );

function dici_register_required_plugins() {

	$plugins = array(

		// Plugins recommended with a theme.
		array(
			'name'               => 'Kirki', // The plugin name.
			'slug'               => 'kirki', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		),

		array(
			'name'               => 'WooCommerce', // The plugin name.
			'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		),

		array(
			'name'               => 'Elementor',
			'slug'               => 'elementor',
			'required'           => false,
		),

		array(
			'name'               => 'DiCi Theme Feature Pack',
			'slug'               => 'dici-feature-pack',
			'source'             => get_template_directory() . '/dummy-data/dici-feature-pack.zip',
			'required'           => true,
			'version'            => '1.0.11',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

        array(
            'name'               => 'Woo Variation Swatches',
            'slug'               => 'woo-variation-swatches',
            'required'           => false,
            'version'            => '1.1.13'
        ),

        array(
            'name'      => 'Revolution Slider',
            'slug'      => 'revslider',
            'required'  => false,
        ),

		array(
			'name'               => 'Contact Form 7',
			'slug'               => 'contact-form-7',
			'required'           => false,
		),

		array(
			'name'               => 'Instagram Feed',
			'slug'               => 'instagram-feed',
			'required'           => false,
		),

		array(
			'name'               => 'One Click Demo Import',
			'slug'               => 'one-click-demo-import',
			'required'           => false,
		),

		array(
			'name'               => 'Force Regenerate Thumbnails',
			'slug'               => 'force-regenerate-thumbnails',
			'required'           => false,
		),

		array(
			'name'               => 'WooCommerce Wishlist Plugin',
			'slug'               => 'ti-woocommerce-wishlist',
			'required'           => false,
		),

		array(
			'name'      => 'Max Mega Menu',
			'slug'      => 'megamenu',
			'required'  => false,
		),

		array(
			'name'      => 'AJAX Login and Registration modal popup',
			'slug'      => 'ajax-login-and-registration-modal-popup',
			'required'  => false,
		),

		array(
			'name'      => 'Comments Widget Plus',
			'slug'      => 'comments-widget-plus',
			'required'  => false,
		),

		array(
			'name'      => 'MailChimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),

		array(
			'name'      => 'Polylang',
			'slug'      => 'polylang',
			'required'  => false,
		),

		array(
			'name'      => 'Recent Posts Widget With Thumbnails',
			'slug'      => 'recent-posts-widget-with-thumbnails',
			'required'  => false,
		),

		array(
			'name'      => 'Recent Posts Widget With Thumbnails',
			'slug'      => 'recent-posts-widget-with-thumbnails',
			'required'  => false,
		),

		array(
			'name'      => 'Related Posts By Taxonomy',
			'slug'      => 'related-posts-by-taxonomy',
			'required'  => false,
		),

		array(
			'name'      => 'Ultimate FAQ',
			'slug'      => 'ultimate-faqs',
			'required'  => false,
		),

		array(
			'name'      => 'VDZ CallBack Plugin',
			'slug'      => 'vdz-call-back',
			'required'  => false,
		),

		array(
			'name'      => 'WooCommerce Currency Switcher',
			'slug'      => 'woocommerce-currency-switcher',
			'required'  => false,
		),


		array(
			'name'      => 'WP Super Cache',
			'slug'      => 'wp-super-cache',
			'required'  => false,
		),

		array(
			'name'      => 'Autoptimize',
			'slug'      => 'autoptimize',
			'required'  => false,
		),





	);

	$config = array(
		'id'           => 'dici',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',          // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
