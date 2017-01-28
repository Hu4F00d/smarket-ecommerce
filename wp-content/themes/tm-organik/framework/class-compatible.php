<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prevents theme from running on WordPress versions prior to 4.3,
 *
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.3.
 *
 * @package InsightFramework
 * @since   0.9
 */
class Insight_Compatible {

	/**
	 * The constructor.
	 */
	public function __construct() {
		if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
			add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );
			add_action( 'load-customize.php', array( $this, 'customize' ) );
			add_action( 'template_redirect', array( $this, 'preview' ) );
		}
		if ( version_compare( $GLOBALS['wp_version'], '4.3', '>=' ) ) {
			add_action( 'after_switch_theme', array( $this, 'install_insight_core' ) );
		}
	}

	/**
	 * Prevent switching to this theme on old versions of WordPress.
	 *
	 * Switches to the default theme.
	 *
	 * @since 0.9
	 */
	public function switch_theme() {
		switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

		unset( $_GET['activated'] );

		add_action( 'admin_notices', array( $this, 'upgrade_notice' ) );
	}

	/**
	 * Adds a message for unsuccessful theme switch.
	 *
	 * Prints an update nag after an unsuccessful attempt to switch to
	 * this theme on WordPress versions prior to 4.3.
	 *
	 * @since 0.9
	 *
	 * @global string $wp_version WordPress version.
	 */
	public function upgrade_notice() {
		$message = sprintf( INSIGHT_THEME_NAME . esc_html__( ' requires at least WordPress version 4.3. You are running version %s. Please upgrade and try again.', 'tm-organik' ), $GLOBALS['wp_version'] );
		printf( '<div class="error"><p>%s</p></div>', $message );
	}

	/**
	 * Prevents the Customizer from being loaded on WordPress versions prior to 4.3.
	 *
	 * @since 0.9
	 *
	 * @global string $wp_version WordPress version.
	 */
	public function customize() {
		wp_die( sprintf( INSIGHT_THEME_NAME . esc_html__( ' requires at least WordPress version 4.3. You are running version %s. Please upgrade and try again.', 'tm-organik' ), $GLOBALS['wp_version'] ), '', array(
			'back_link' => true,
		) );
	}

	/**
	 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.3.
	 *
	 * @since 0.9
	 *
	 * @global string $wp_version WordPress version.
	 */
	public function preview() {
		if ( isset( $_GET['preview'] ) ) {
			wp_die( sprintf( INSIGHT_THEME_NAME . esc_html__( ' requires at least WordPress version 4.3. You are running version %s. Please upgrade and try again.', 'tm-organik' ), $GLOBALS['wp_version'] ) );
		}
	}

	/**
	 * Install Insight Core
	 */
	public function install_insight_core() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! class_exists( 'InsightCore' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			if ( file_exists( get_stylesheet_directory() . '/plugins/insight-core.zip' ) ) {
				//install if has file /plugins/insight-core.zip
				$file = get_stylesheet_directory() . '/plugins/insight-core.zip';
				$to   = ABSPATH . 'wp-content/plugins/';
				unzip_file( $file, $to );
				activate_plugin( 'insight-core/insight-core.php' );
			} else {
				//install if has file url
				$core_url = 'https://cloudup.com/files/iNLsFCgurFO/download';
				$_tmp     = wp_tempnam( $core_url );
				@unlink( $_tmp );
				@ob_flush();
				@flush();
				if ( is_writable( ABSPATH . '/wp-content/plugins' ) ) {
					$package = download_url( $core_url, 18000 );
					$unzip   = unzip_file( $package, ABSPATH . '/wp-content/plugins' );
					if ( ! is_wp_error( $package ) && ! is_wp_error( $unzip ) ) {
						activate_plugin( 'insight-core/insight-core.php' );
					}
				}
			}
		}

		echo '<script type="text/javascript">window.location = "' . admin_url( 'admin.php?page=insight-core' ) . '";</script>';
	}
}
