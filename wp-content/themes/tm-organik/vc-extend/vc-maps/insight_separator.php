<?php

class WPBakeryShortCode_Insight_Separator extends WPBakeryShortCode {
}

$base_name = 'insight_separator';

$group_design = esc_html__( 'Design options', 'tm-organik' );

vc_map( array(
	'name'                      => esc_html__( 'Separator', 'tm-organik' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-organik' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				__( 'Default color', 'tm-organik' ) => 'default',
				__( 'Custom color', 'tm-organik' )  => 'color'
			),
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Color', 'tm-organik' ),
			'param_name' => 'color',
			'value'      => '#ffffff',
			'dependency' => array( 'element' => 'style', 'value' => array( 'color' ) )
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
