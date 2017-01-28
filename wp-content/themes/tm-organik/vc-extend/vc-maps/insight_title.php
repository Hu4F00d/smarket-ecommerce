<?php

class WPBakeryShortCode_Insight_Title extends WPBakeryShortCode {
}

$base_name = 'insight_title';

$group_design = esc_html__( 'Design options', 'tm-organik' );

vc_map( array(
	'name'                      => esc_html__( 'Title', 'tm-organik' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		Insight_Helper::get_param( 'title' ),
		array(
			'type'       => 'toggle',
			'heading'    => esc_html__( 'Sub title enable', 'tm-organik' ),
			'param_name' => 'sub_title_enable',
			'value'      => '',
			'options'    => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-organik' ),
					'off'   => esc_html__( 'No', 'tm-organik' )
				)
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Sub Title', 'tm-organik' ),
			'param_name'  => 'sub_title',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'sub_title_enable', 'value' => array( 'yes' ) ),
		),
		array(
			'type'       => 'toggle',
			'heading'    => esc_html__( 'Separator enable', 'tm-organik' ),
			'param_name' => 'separator_enable',
			'value'      => '',
			'options'    => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-organik' ),
					'off'   => esc_html__( 'No', 'tm-organik' )
				)
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Style', 'tm-organik' ),
			'param_name' => 'style',
			'value'      => array(
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
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
