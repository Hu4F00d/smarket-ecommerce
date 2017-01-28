<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin installation and activation for WordPress themes
 *
 * @package InsightFramework
 * @since   0.9.7
 */
class Insight_Register_Plugins {

	/**
	 * Insight_Register_Plugins constructor.
	 */
	public function __construct() {
		add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
	}

	public function register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'     => esc_html__( 'Insight Core', 'tm-organik' ),
				'slug'     => 'insight-core',
				'source'   => 'https://cloudup.com/files/iq9ma-fdYR8/download',
				'version'  => '1.3.5',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'Visual Composer', 'tm-organik' ),
				'slug'     => 'js_composer',
				'source'   => 'https://bitbucket.org/digitalcreative/thememove-plugins/raw/246cbd85cf16b193cb72818e38c4e51d04862c40/js_composer.zip',
				'version'  => '5.0.1',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'Revolution Slider', 'tm-organik' ),
				'slug'     => 'revslider',
				'source'   => 'https://bitbucket.org/digitalcreative/thememove-plugins/raw/8afd8526fcd2e4921779f1d3b3590dec210ed7af/revslider.zip',
				'version'  => '5.3.1.5',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'WooCommerce', 'tm-organik' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'YITH WooCommerce Compare', 'tm-organik' ),
				'slug'     => 'yith-woocommerce-compare',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'tm-organik' ),
				'slug'     => 'yith-woocommerce-wishlist',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'MailChimp for WordPress', 'tm-organik' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'tm-organik' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
		);

		return $plugins;
	}

}
