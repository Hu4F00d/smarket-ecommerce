<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $custom_image_size
 * @var $width
 * @var $height
 * @var $title
 * @var $content
 * @var $carousel_images
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_About
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

if ( $image > 0 ) {
	$image = Insight_Helper::img_fullsize( $image );
}

$carousel_images_html = array();
$carousel_images      = explode( ',', $carousel_images );
if ( ! empty( $carousel_images ) && is_array( $carousel_images ) ) {
	foreach ( $carousel_images as $key => $carousel_image ) {
		$carousel_images_html[ $carousel_image ] = Insight_Helper::img_thumb( $carousel_image, array(
			'height' => '97',
			'width'  => '135'
		) );
	}
}
?>

<div class="insight-about row <?php echo esc_attr( $el_class ) ?>">
	<div class="insight-about--main-img col-lg-6">
		<?php if ( ! empty( $image ) && is_string( $image ) ): ?>
			<img src="<?php echo esc_url( $image ) ?>" alt=""/>
		<?php endif; ?>
	</div>
	<div class="insight-about--content col-lg-6">
		<div class="insight-about--content--title">
			<h4><?php echo esc_html( $title ) ?></h4>
			<div class="insight-about--content--title--line"></div>
		</div>

		<div class="insight-about--content--text">
			<p><?php Insight_Helper::output( $content ); ?></p>
		</div>
		<div class="insight-about--carousel">
			<?php if ( ! empty( $carousel_images_html ) && is_array( $carousel_images_html ) ): ?>
				<?php foreach ( $carousel_images_html as $image_id => $carousel_image ): ?>
					<a href="<?php echo esc_attr( Insight_Helper::img_fullsize( $image_id ) ) ?>">
						<img src="<?php echo esc_url( $carousel_image ) ?>" alt=""/>
						<span class="ion-plus-round"></span>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
