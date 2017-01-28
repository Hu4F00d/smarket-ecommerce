<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $icon_type
 * @var $icon_lib
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $icon_ionicons
 * @var $custom_icon
 * @var $font_size
 * @var $display
 * @var $align
 * @var $color
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Icon
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class . ' ' . $align . ' ' . $display;

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
	$iconClass = isset( ${"icon_" . $icon_lib} ) ? esc_attr( ${"icon_" . $icon_lib} ) : 'ionic';
	$icon_html .= "<i class='" . $iconClass . "' ></i>";
}

//Get style
$icon_style = '';
if ( ! empty( $font_size ) ) {
	$icon_style .= 'font-size: ' . $font_size . 'px;';
}
if ( ! empty( $color ) ) {
	$icon_style .= 'color: ' . $color . ';';
}
if ( ! empty( $display ) ) {
	$icon_style .= 'display: ' . $display . ';';
}
if ( ! empty( $align ) ) {
	$icon_style .= 'text-align: ' . $align . ';';
}

$selector = uniqid( 'insight-icon-' );
Insight_Helper::apply_style( $icon_style, '#' . $selector );

?>
<div id="<?php echo esc_attr( $selector ) ?>" class="insight-icon <?php echo esc_attr( $el_class ) ?>">
	<?php Insight_Helper::output( $icon_html ) ?>
</div>
