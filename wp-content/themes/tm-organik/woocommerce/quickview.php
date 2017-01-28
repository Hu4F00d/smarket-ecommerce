<?php
/**
 * Quickview template
 */

if ( post_password_required() ) {
	echo get_the_password_form();
	die();

	return;
}

global $post, $product;
?>

<div id="woo-quickview">
	<div class="woocommerce container single-product">
		<div class="product product-container">
			<div class="row">
				<div class="col-md-6 images quickview-carousel">
					<?php
					$attachment_ids = $product->get_gallery_attachment_ids();
					if ( sizeof( $attachment_ids ) > 0 ) {
						foreach ( $attachment_ids as $attachment_id ) {
							?>
							<img src="<?php echo esc_attr( wp_get_attachment_url( $attachment_id ) ); ?>" alt=""/>
							<?php
						}
					} else if ( has_post_thumbnail() ) {
						$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
						echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
							'title' => $props['title'],
							'alt'   => $props['alt'],
						) );
					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'tm-organik' ) ), $post->ID );
					}
					?>
				</div>

				<div class="col-md-6 summary entry-summary">
					<div class="summary-inner">
						<?php do_action( 'woocommerce_single_product_summary' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
die();
?>
