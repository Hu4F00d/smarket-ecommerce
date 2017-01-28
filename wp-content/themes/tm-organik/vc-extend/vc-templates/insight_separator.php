<?php
/**
 * @var $this WPBakeryShortCode_Insight_Separator
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div
	class="insight-separator-shortcode <?php echo esc_attr( $el_class ) ?> <?php echo esc_attr( $style == 'color' ? 'custom-color' : '' ); ?>"
	style="<?php echo esc_attr( $style == 'color' ? 'color: ' . $color . '; border-color: ' . $color : '' ); ?>">
	<div
		class="insight-separator vc_separator vc_separator_align_center vc_sep_pos_align_center vc_separator-has-text">
		<span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span>
		<div class="insight-separator--icon vc_icon_element vc_icon_element-outer">
			<i class="organik-flower"></i>
		</div>
		<span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
	</div>
</div>
