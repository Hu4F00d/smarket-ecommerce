<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$shop_product_columns = Insight::setting( 'shop_archive_product_columns' );
$column               = 'col-md-' . ( 12 / $shop_product_columns );
?>
<div <?php post_class( 'loop-product product ' . $column, $product->ID ); ?>>
	<?php
	echo '<div class="product-thumb">';
	woocommerce_template_loop_product_link_open();
	do_action( 'woocommerce_before_shop_loop_item_title' );
	woocommerce_template_loop_product_link_close();
	echo '<div class="product-action">';

	woocommerce_template_loop_add_to_cart();
	if ( ( Insight::setting( 'shop_archive_wishlist' ) == 1 ) && class_exists( 'YITH_WCWL' ) ) {
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
	if ( ( Insight::setting( 'shop_archive_quickview' ) == 1 ) && ! wp_is_mobile() ) {
		echo '<div class="quickview-btn hint--top hint--rounded hint--bounce" aria-label="' . esc_html__( 'Quick view', 'tm-organik' ) . '" data-pid="' . esc_attr( $id ) . '" data-pnonce="' . wp_create_nonce( 'woo_quickview' ) . '"><a class="quickview-icon" href="#"></a></div>';
	}
	if ( ( Insight::setting( 'shop_archive_compare' ) == 1 ) && class_exists( 'YITH_Woocompare' ) && ! wp_is_mobile() ) {
		echo '<div class="yith-compare-btn hint--top hint--rounded hint--bounce" aria-label="' . esc_html__( 'Compare', 'tm-organik' ) . '"><a href="/?action=yith-woocompare-add-product&amp;id=' . $id . '" class="compare" data-product_id="' . $id . '" rel="nofollow">' . esc_html__( 'Compare', 'tm-organik' ) . '</a></div>';
	}
	echo '</div>';
	echo '</div>';
	echo '<div class="product-info">';
	woocommerce_template_loop_product_link_open();
	do_action( 'woocommerce_shop_loop_item_title' );
	woocommerce_template_loop_price();
	woocommerce_template_loop_product_link_close();
	echo '<div class="product-rate">';
	woocommerce_template_loop_rating();
	if ( $product->get_rating_count() > 0 ) {
		echo '<span class="text-rating">' . sprintf( _n( '(Based on %s review)', '(Based on %s reviews)', $product->get_rating_count(), 'tm-organik' ), $product->get_rating_count() ) . '</span>';
	}
	echo '</div>';
	echo '<div class="product-desc">';
	woocommerce_template_single_excerpt();
	echo '</div>';
	echo '<div class="product-action-list">';
	woocommerce_template_loop_add_to_cart();
	if ( ( Insight::setting( 'shop_archive_wishlist' ) == 1 ) && class_exists( 'YITH_WCWL' ) ) {
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
	if ( ( Insight::setting( 'shop_archive_quickview' ) == 1 ) && ! wp_is_mobile() ) {
		echo '<div class="quickview-btn hint--top hint--rounded hint--bounce" aria-label="' . esc_html__( 'Quick view', 'tm-organik' ) . '" data-pid="' . esc_attr( $id ) . '" data-pnonce="' . wp_create_nonce( 'woo_quickview' ) . '"><a class="quickview-icon" href="#"></a></div>';
	}
	if ( ( Insight::setting( 'shop_archive_compare' ) == 1 ) && class_exists( 'YITH_Woocompare' ) && ! wp_is_mobile() ) {
		echo '<div class="yith-compare-btn hint--top hint--rounded hint--bounce" aria-label="' . esc_html__( 'Compare', 'tm-organik' ) . '"><a href="/?action=yith-woocompare-add-product&amp;id=' . $id . '" class="compare" data-product_id="' . $id . '" rel="nofollow">' . esc_html__( 'Compare', 'tm-organik' ) . '</a></div>';
	}
	echo '</div>';
	echo '</div>';
	?>
</div>
