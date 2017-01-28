<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $steps
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Process
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

if ( $style == 'small-icon' ) {
	$el_class .= ' insight-process--small-icon';
}

// Get steps
$steps = vc_param_group_parse_atts( $steps );
if ( is_array( $steps ) && ! empty( $steps ) ):
	?>
	<div class="insight-process <?php echo esc_attr( $el_class ) ?>">
		<?php
		foreach ( $steps as $key => $step ):
			extract( $step );
			// Get icon
			$icon_html = '';
			if ( isset( $custom_icon ) && ! empty( $custom_icon ) && $icon_type == "custom" ) {
				if ( is_numeric( $custom_icon ) ) {
					$custom_icon_src = wp_get_attachment_url( $custom_icon );
				} else {
					$custom_icon_src = $custom_icon;
				}
				$icon_html .= '<img src="' . esc_url( $custom_icon_src ) . '" alt="">';
			} else if ( isset( $icon_lib ) && ! empty( $icon_lib ) ) {
				$iconClass = isset( ${"icon_" . $icon_lib} ) ? esc_attr( ${"icon_" . $icon_lib} ) : 'ionic';
				$icon_html .= "<i class='" . $iconClass . "' ></i>";
			}
			?>
			<?php if ( $style == 'small-icon' ): ?>
			<div class="col-md-3 insight-process--small-icon--step step-<?php echo esc_attr( $key + 1 ) ?>">
				<div class="insight-process--small-icon--step--icon">
					<?php Insight_Helper::output( $icon_html ) ?>
				</div>
				<div class="insight-process--small-icon--step--content">
					<div class="insight-process--small-icon--step--content--title">
						<?php echo esc_html( $title ) ?>
					</div>
					<div class="insight-process--small-icon--step--content--text">
						<?php Insight_Helper::output( $content ) ?>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php if ( $key != 0 ): ?>
				<div class="step-line"></div>
			<?php endif; ?>
			<div class="insight-process--step step-<?php echo esc_attr( $key + 1 ) ?>">
				<div class="insight-process--step--icon">
					<?php Insight_Helper::output( $icon_html ) ?>
					<span class="order"><?php echo esc_html( $key + 1 ) ?></span>
				</div>
				<div class="insight-process--step--title">
					<?php echo esc_html( $title ) ?>
				</div>
				<div class="insight-process--step--text">
					<?php Insight_Helper::output( $content ) ?>
				</div>
			</div>
		<?php endif; ?>
			<?php
		endforeach;
		?>
	</div>
	<?php
endif;
