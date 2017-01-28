<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $sub_title_enable
 * @var $sub_title
 * @var $separator_enable
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Title
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;
?>
<div
	class="insight-title <?php echo esc_attr( $el_class ) ?> <?php echo esc_attr( $style == 'color' ? 'insight-title-color' : '' ); ?>"
	style="<?php echo esc_attr( $style == 'color' ? 'color: ' . $color . '; border-color: ' . $color : '' ); ?>">
	<h2 class="page-title-style"><?php echo esc_attr( $title ) ?></h2>
	<?php if ( $sub_title_enable == 'yes' ): ?>
		<div class="insight-title--subtitle">
			<?php echo esc_attr( $sub_title ) ?>
		</div>
	<?php endif; ?>
	<?php if ( $separator_enable == 'yes' ): ?>
		<div
			class="insight-separator vc_separator wpb_content_element vc_separator_align_center vc_sep_pos_align_center vc_separator-has-text">
			<span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span>
			<div class="insight-separator--icon vc_icon_element vc_icon_element-outer">
				<i class="organik-flower"></i>
			</div>
			<span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
		</div>
	<?php endif; ?>
</div>
