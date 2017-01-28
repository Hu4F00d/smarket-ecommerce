<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
$pid       = $product->id;
$cat_count = count( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = count( get_the_terms( $post->ID, 'product_tag' ) );

if ( ( Insight::setting( 'shop_single_wishlist' ) == 1 ) && class_exists( 'YITH_WCWL' ) ) {
	echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
}
if ( ( Insight::setting( 'shop_single_compare' ) == 1 ) && class_exists( 'YITH_Woocompare' ) ) {
	echo '<div class="yith-compare-btn hint--top hint--rounded hint--bounce" aria-label="' . esc_html__( 'Compare', 'tm-organik' ) . '"><a href="/?action=yith-woocompare-add-product&amp;id=' . $pid . '" class="compare" data-product_id="' . $pid . '" rel="nofollow">' . esc_html__( 'Compare', 'tm-organik' ) . '</a></div>';
}
?>
<div class="product_meta_wrap">
	<table class="product_meta">

		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<tr class="product_meta_item sku_wrapper">
				<td class="label"><?php esc_html_e( 'SKU', 'tm-organik' ); ?></td>
				<td>
			<span class="sku" itemprop="sku">
				<?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'tm-organik' ); ?>
			</span>
				</td>
			</tr>
		<?php endif; ?>

		<?php echo wp_kses( $product->get_categories( ', ', '<tr class="product_meta_item posted_in"><td class="label">' . _n( 'Category', 'Categories', $cat_count, 'tm-organik' ) . '</td><td> ', '</td></tr>' ), array(
			'tr' => array(
				'class' => array(),
			),
			'td' => array(
				'class' => array(),
			),
			'a'  => array(
				'href' => array(),
				'rel'  => array(),
			),
		) ); ?>

		<?php echo wp_kses( $product->get_tags( ', ', '<tr class="product_meta_item tagged_as"><td class="label">' . _n( 'Tag', 'Tags', $tag_count, 'tm-organik' ) . '</td><td> ', '</td></tr>' ), array(
			'tr' => array(
				'class' => array(),
			),
			'td' => array(
				'class' => array(),
			),
			'a'  => array(
				'href' => array(),
				'rel'  => array(),
			),
		) ); ?>

		<?php if ( Insight::setting( 'shop_single_share' ) == 1 ) { ?>
			<tr class="product_meta_item share">
				<td class="label"><?php esc_html_e( 'Share', 'tm-organik' ); ?></td>
				<td>
					<a target="_blank"
					   href="http://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"><i
							class="fa fa-facebook"></i></a> <a target="_blank"
					                                           href="http://twitter.com/share?text=<?php echo rawurlencode( get_the_title() ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>"><i
							class="fa fa-twitter"></i></a> <a target="_blank"
					                                          href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>"><i
							class="fa fa-google-plus"></i></a>
				</td>
			</tr>
		<?php } ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	</table>
</div>
