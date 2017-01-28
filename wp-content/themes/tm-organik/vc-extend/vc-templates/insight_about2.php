<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $img_icon_bg_color
 * @var $image
 * @var $custom_image_size
 * @var $width
 * @var $height
 * @var $title
 * @var $content
 * @var $link
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_About2
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class . ' ' . $style;

if ( $image > 0 ) {
	if ( $custom_image_size == 'yes' ) {
		$image = Insight_Helper::img_thumb( $carousel_image, array( 'height' => $height, 'width' => $width ) );
	} else {
		$image = Insight_Helper::img_fullsize( $image );
	}
}

// Get link
$link_html   = '';
$link        = vc_build_link( $link );
$link_url    = ( isset( $link['url'] ) ) ? $link['url'] : '';
$link_text   = ( isset( $link['title'] ) ) ? $link['title'] : '';
$link_target = ( isset( $link['target'] ) ) ? $link['target'] : '';
$link_rel    = ( isset( $link['rel'] ) ) ? $link['rel'] : '';
if ( ! empty( $link_text ) ) {
	$link_html = '<a class="link" href="' . $link_url . '" target="' . $link_target . '" rel="' . $link_rel . '"> <span class="ion-plus-round"></span> ' . $link_text . '</a>';
}

$selector_icon = uniqid( 'img-icon-' );
if ( $style == 'icon_on_small_image' ) {
	if ( ! empty( $img_icon_bg_color ) ) {
		$img_icon_bg_color = "background-color:" . $img_icon_bg_color;
		Insight_Helper::apply_style( $img_icon_bg_color, '#' . $selector_icon );
	}
}

// Get first letter
$first_title = ( ! empty( $title ) ) ? substr( $title, 0, 1 ) : '';
?>

<div class="insight-about2 <?php echo esc_attr( $el_class ) ?>">
	<div id="<?php echo esc_attr( $selector_icon ) ?>" class="insight-about2--main-img">
		<?php if ( ! empty( $image ) && is_string( $image ) ): ?>
			<img src="<?php echo esc_url( $image ) ?>" alt=""/>
		<?php endif; ?>
		<div class="insight-about2--main-img--first-title">
			<?php echo esc_html( $first_title ) ?>
		</div>
	</div>
	<div class="insight-about2--content">
		<div class="insight-about2--content--title">
			<h5><?php echo esc_html( $title ) ?></h5>
		</div>
		<div class="insight-about2--content--text">
			<p><?php Insight_Helper::output( $content ); ?></p>
		</div>
		<?php Insight_Helper::output( $link_html ); ?>
	</div>
</div>
