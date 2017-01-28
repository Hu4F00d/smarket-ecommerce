<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $link
 * @var $style
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Button
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' insight-btn ' . $css_class . ' ' . $style;

// Get link
$link_html   = '';
$link        = vc_build_link( $link );
$link_url    = ( isset( $link['url'] ) ) ? $link['url'] : '';
$link_text   = ( isset( $link['title'] ) ) ? $link['title'] : '';
$link_target = ( isset( $link['target'] ) ) ? $link['target'] : '';
$link_rel    = ( isset( $link['rel'] ) ) ? $link['rel'] : '';
if ( ! empty( $link_text ) ) {
	$link_html = '<a class="' . $el_class . '" href="' . $link_url . '" target="' . $link_target . '" rel="' . $link_rel . '">' . $link_text . '</a>';
}

?>
<?php Insight_Helper::output( $link_html ); ?>
