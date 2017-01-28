<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$testimonials = (array) vc_param_group_parse_atts( $testimonials );
$rid          = uniqid( 'insight-testimonials-' );
?>
<div
	class="insight-testimonials <?php echo esc_attr( $el_class ); ?> style<?php echo esc_attr( $style ); ?> <?php echo esc_attr( $enable_carousel != 'true' ? 'list' : '' ); ?>"
	id="<?php echo esc_html( $rid ); ?>">
	<?php foreach ( $testimonials as $testimonial ) { ?>
		<div class="item">
			<div class="text">
				<?php echo esc_html( $testimonial['content'] ); ?>
			</div>
			<div class="info">
				<?php if ( isset( $testimonial['photo'] ) && $testimonial['photo'] ) { ?>
					<div class="photo"><?php echo wp_get_attachment_image( $testimonial['photo'], 'full' ); ?></div>
				<?php } ?>
				<div class="author">
					<span class="name"><?php echo esc_html( $testimonial['name'] ); ?></span>
					<span class="tagline"><?php echo esc_html( $testimonial['tagline'] ); ?></span>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<?php if ( $enable_carousel == 'true' ) { ?>
	<script>
		jQuery( document ).ready( function( $ ) {
			jQuery( "#<?php echo esc_attr( $rid ); ?>" ).slick( {
				<?php if($style == 1) { ?>
				slidesToShow: 1,
				slidesToScroll: 1,
				<?php } else { ?>
				slidesToShow: <?php echo esc_js( $slides_to_display ); ?>,
				slidesToScroll: <?php echo esc_js( $slides_to_display ); ?>,
				<?php } ?>

				<?php if ( $enable_autoplay == 'true' ) { ?>
				autoplay: true,
				autoplaySpeed: 6000,
				<?php } else { ?>
				autoplay: false,
				<?php } ?>

				<?php if ( $display_bullets == 'true' ) { ?>
				dots: true,
				<?php } else { ?>
				dots: false,
				<?php } ?>

				<?php if ( $display_arrows == 'true' ) { ?>
				arrows: true,
				<?php } else { ?>
				arrows: false,
				<?php } ?>

				infinite: true,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			} );
		} );
	</script>
<?php } ?>
