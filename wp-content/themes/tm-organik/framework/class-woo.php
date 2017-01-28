<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions for WooCommerce
 *
 * @package   InsightFramework
 */
class Insight_Woo {

	/**
	 * The constructor.
	 */
	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'woo_header_cart_fragment' ) );
		add_filter( 'loop_shop_columns', array( $this, 'woo_loop_columns' ) );
		add_filter( 'subcategory_archive_thumbnail_size', array( $this, 'woo_subcategory_archive_thumbnail_size' ) );
		add_action( 'wp_footer', array( $this, 'woo_footer_actions' ) );

		// Hide default wishlist button
		add_filter( 'yith_wcwl_positions', function() {
			return array(
				'add-to-cart' => array( 'hook' => '', 'priority' => 0 ),
				'thumbnails'  => array( 'hook' => '', 'priority' => 0 ),
				'summary'     => array( 'hook' => '', 'priority' => 0 )
			);
		} );

		// Hide default compare button
		add_filter( 'yith_woocompare_remove_compare_link_by_cat', function() {
			return true;
		} );

		// Quick view
		add_action( 'wp_ajax_woo_quickview', array( $this, 'woo_quickview' ) );
		add_action( 'wp_ajax_nopriv_woo_quickview', array( $this, 'woo_quickview' ) );

		// Move section You may be interested in…
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );
	}

	function woo_quickview() {
		if ( ! isset( $_GET['pnonce'] ) || ! wp_verify_nonce( $_GET['pnonce'], 'woo_quickview' ) ) {
			die( esc_html__( 'Permissions check failed', 'tm-organik' ) );
		}
		global $post, $product;
		$post = get_post( $_GET['pid'] );
		setup_postdata( $post );
		$product = wc_get_product( $post->ID );
		get_template_part( 'woocommerce/quickview' );
		wp_reset_postdata();
		die();
	}

	public static function header_cart() {
		if ( class_exists( 'WooCommerce' ) ) {
			$cart_html = '';
			$qty       = WC()->cart->get_cart_contents_count();
			$total     = WC()->cart->get_cart_total();

			$cart_html .= '<div class="mini-cart"><div class="mini-cart-icon" data-count="' . $qty . '"><i class="ion-bag"></i></div>';
			$cart_html .= '<div class="mini-cart-text">' . esc_html__( 'My Cart', 'tm-organik' ) . '<div class="mini-cart-total">' . $total . '</div></div></div>';

			return $cart_html;
		}
	}

	function woo_header_cart_fragment( $fragments ) {
		ob_start();
		echo self::header_cart();
		$fragments['.mini-cart'] = ob_get_clean();

		return $fragments;
	}

	function woo_footer_actions() {
		if ( is_singular( 'product' ) ) {
			?>
			<script>
				jQuery( document ).ready( function() {
					insightMarkProductViewed(<?php echo get_the_ID(); ?>);
				} );
			</script>
			<?php
		}
	}

	function woo_loop_columns() {
		return 3; // 3 products per row
	}

	function woo_subcategory_archive_thumbnail_size() {
		return 'full';
	}
}
