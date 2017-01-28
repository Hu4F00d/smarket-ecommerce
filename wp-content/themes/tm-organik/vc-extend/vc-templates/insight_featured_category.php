<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$woo_cat = get_term_by( 'slug', $category, 'product_cat' );
if ( $woo_cat != false ) {
	?>
	<div class="insight-featured-category <?php echo esc_attr( $el_class ); ?>">
		<a href="<?php echo get_term_link( $woo_cat->term_id, 'product_cat' ); ?>">
			<div class="image">
				<div class="bg" style="background-color: <?php echo esc_attr( $color ); ?>"></div>
				<div class="img">
					<?php echo wp_get_attachment_image( $image, 'full' ); ?>
				</div>
			</div>
			<div class="title"><?php echo esc_html( $woo_cat->name ); ?></div>
		</a>
	</div>
	<?php
}
