<?php

require_once( dirname( __FILE__ ) . '/importer.php' );

if ( ! empty( $_POST['import_sample_data'] ) ) {

	global $wpdb;

	$ic_importer                 = new InsightCore_Importer( true );
	$ic_importer->generate_thumb = $generate_thumb;

	$start = microtime( true );

	$ic_importer->dispatch();

	$time_elapsed_secs = format_import_time( microtime( true ) - $start );

	echo '<script type="text/javascript">document.title="' . esc_html__( 'Initializing Data', 'insight-core' ) . '";</script>';
}

/**
 * Format import time to human readable
 *
 * @param $time
 *
 * @return string
 */
function format_import_time( $time ) {
	return gmdate( 'H:i:s', $time );;
}