<?php
vc_add_params( 'vc_custom_heading', array(
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Select Color', 'tm-organik' ),
		'param_name' => 'cst_color',
		'value'      => array(
			__( 'Default', 'tm-organik' )         => '',
			__( 'Primary color', 'tm-organik' )   => 'pri-color',
			__( 'Secondary color', 'tm-organik' ) => 'nd-color',
		),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Special style', 'tm-organik' ),
		'param_name' => 'special_style',
		'value'      => array(
			__( 'None', 'tm-organik' )             => '',
			__( 'Page title style', 'tm-organik' ) => 'page-title-style',
		),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Text Transform', 'tm-organik' ),
		'param_name' => 'text_transform',
		'value'      => array(
			__( 'None', 'tm-organik' )       => 'none',
			__( 'Capitalize', 'tm-organik' ) => 'capitalize',
			__( 'Uppercase', 'tm-organik' )  => 'uppercase',
			__( 'Lowercase', 'tm-organik' )  => 'lowercase',
			__( 'Initial', 'tm-organik' )    => 'initial',
			__( 'Inherit', 'tm-organik' )    => 'inherit',
		),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Font Weight', 'tm-organik' ),
		'param_name' => 'font_weight',
		'value'      => array(
			__( 'Default', 'tm-organik' ) => '',
			100                           => 100,
			200                           => 200,
			300                           => 300,
			400                           => 400,
			500                           => 500,
			600                           => 600,
			700                           => 700,
			800                           => 800,
			900                           => 900,
		),
	),
	array(
		'type'       => 'textfield',
		'heading'    => esc_html__( 'Letter Spacing', 'tm-organik' ),
		'param_name' => 'letter_spacing',
	),
	Insight_Helper::get_param( 'note' ),
) );
vc_map_update( 'vc_custom_heading', array(
	'category' => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'name'     => esc_html__( 'Custom Heading', 'tm-organik' ),
	'icon'     => 'tm-shortcode-ico default-icon',
) );
