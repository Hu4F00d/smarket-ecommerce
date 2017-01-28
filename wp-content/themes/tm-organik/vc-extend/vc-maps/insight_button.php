<?php

class WPBakeryShortCode_Insight_Button extends WPBakeryShortCode {
}

$base_name = 'insight_button';

$group_design = esc_html__( 'Design options', 'tm-organik' );

vc_map( array(
	'name'                      => esc_html__( 'Button', 'tm-organik' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'vc_link',
			'heading'     => esc_html__( 'Link', 'tm-organik' ),
			'param_name'  => 'link',
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'class'       => '',
			'heading'     => 'Style',
			'param_name'  => 'style',
			'value'       => array(
				'Default' => '',
				'Brown'   => 'brown',
			),
			'save_always' => true,
			'description' => 'Select element tag.',
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
