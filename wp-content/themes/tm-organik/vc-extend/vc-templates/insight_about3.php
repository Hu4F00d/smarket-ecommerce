<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $image1
 * @var $image2
 * @var $image3
 * @var $image4
 * @var $title
 * @var $sub_title
 * @var $quote_text
 * @var $quote_author
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_About3
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

if ( $image1 > 0 ) {
	$height = 420;
	$width  = 670;
	$image1 = Insight_Helper::img_thumb( $image1, array( 'height' => $height, 'width' => $width ) );
}
if ( $image2 > 0 ) {
	$height = 355;
	$width  = 268;
	$image2 = Insight_Helper::img_thumb( $image2, array( 'height' => $height, 'width' => $width ) );
}
if ( $image3 > 0 ) {
	$height = 370;
	$width  = 370;
	$image3 = Insight_Helper::img_thumb( $image3, array( 'height' => $height, 'width' => $width ) );
}
if ( $image4 > 0 ) {
	$image4 = Insight_Helper::img_fullsize( $image4 );
}
?>

<div class="insight-about3">
	<div class="row">
		<div class="col-md-8 image1">
			<?php if ( ! empty( $image1 ) && is_string( $image1 ) ): ?>
				<img src="<?php echo esc_url( $image1 ) ?>" alt=""/>
			<?php endif; ?>
		</div>
		<div class="col-md-4 image2">
			<?php if ( ! empty( $image2 ) && is_string( $image2 ) ): ?>
				<img src="<?php echo esc_url( $image2 ) ?>" alt=""/>
			<?php endif; ?>
		</div>
	</div>
	<div class="row row-bottom">
		<div class="col-md-4 about3-title">
			<h2 class="special-heading"><?php echo esc_html( $title ) ?></h2>
			<h3 class="sub-title"><?php echo esc_html( $sub_title ) ?></h3>
			<?php if ( ! empty( $image4 ) && is_string( $image4 ) ): ?>
				<img src="<?php echo esc_url( $image4 ) ?>" alt=""/>
			<?php endif; ?>
		</div>
		<div class="col-md-4 image3">
			<?php if ( ! empty( $image3 ) && is_string( $image3 ) ): ?>
				<img src="<?php echo esc_url( $image3 ) ?>" alt=""/>
			<?php endif; ?>
		</div>
		<div class="col-md-4">
			<div class="about3-quote">
				<span class="ion-quote small"></span>
				<span class="ion-quote big"></span>
				<div class="about3-quote-text">
					<?php echo esc_html( $quote_text ) ?>
				</div>
				<div class="about3-quote-author">
					<?php echo esc_html( $quote_author ) ?>
				</div>
			</div>
		</div>
	</div>
</div>
