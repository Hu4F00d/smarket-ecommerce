<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $icon_type
 * @var $icon_lib
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $icon_ionicons
 * @var $custom_icon
 * @var $title
 * @var $content
 * @var $element_tag
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Icon_Boxes
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class . ' ' . $style;

// Get icon
$icon_html = '';
if ( $custom_icon != "" && $icon_type == "custom" ) {
	if ( is_numeric( $custom_icon ) ) {
		$custom_icon_src = wp_get_attachment_url( $custom_icon );
	} else {
		$custom_icon_src = $custom_icon;
	}
	$icon_html .= '<img src="' . esc_url( $custom_icon_src ) . '" alt="">';
} else {
	$icon_class = isset( ${'icon_' . $icon_lib} ) ? esc_attr( ${'icon_' . $icon_lib} ) : 'ionic';
	$icon_html .= "<i class='" . $icon_class . "' ></i>";
}

//Get element tag
if ( empty( $element_tag ) ) {
	$element_tag = 'h6';
}

?>
<?php if ( $style == 'icon_on_right' ) : ?>
	<div class="icon-boxes <?php echo esc_attr( $el_class ) ?>">
		<div class="icon-boxes--inner">
			<<?php echo esc_attr( $element_tag ) ?> class="icon-boxes--title">
			<?php echo esc_html( $title ) ?>
		</<?php echo esc_attr( $element_tag ) ?>>
		<div class="icon-boxes--content"><?php Insight_Helper::output( $content ) ?></div>
	</div>
	<div class="icon-boxes--icon"><?php Insight_Helper::output( $icon_html ) ?></div>
	</div>
<?php else : ?>
	<div class="icon-boxes <?php echo esc_attr( $el_class ) ?>">
		<div class="icon-boxes--icon"><?php Insight_Helper::output( $icon_html ) ?></div>
		<div class="icon-boxes--inner">
			<<?php echo esc_attr( $element_tag ) ?> class="icon-boxes--title">
			<?php echo esc_html( $title ) ?>
		</<?php echo esc_attr( $element_tag ) ?>>
		<div class="icon-boxes--content"><?php Insight_Helper::output( $content ) ?></div>
	</div>
	</div>
<?php endif; ?>
