<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initial OneClick import for this theme
 *
 * @package   InsightFramework
 */
class Insight_Import {

	/**
	 * The constructor.
	 */
	public function __construct() {
		// Import Demo
		add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );

		// Import package url
		add_filter( 'insight_core_import_package_url', array( $this, 'import_package_url' ) );
	}

	/**
	 * Import Demo
	 *
	 * @since 0.9
	 */
	public function import_demos() {
		return array(
			'organik' => array(
				'screenshot' => INSIGHT_THEME_URI . '/screenshot.png',
				'name'       => INSIGHT_THEME_NAME,
				'url'        => 'https://cloudup.com/files/iVq825_03pm/download',
			),
		);
	}

}
