<?php

class WPBakeryShortCode_Insight_Our_Services extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Our Services', 'tm-organik' ),
	'base'                      => 'insight_our_services',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon library', 'tm-organik' ),
			'std'         => 'organik',
			'value'       => array(
				esc_html__( 'Organik', 'tm-organik' )      => 'organik',
				esc_html__( 'Font Awesome', 'tm-organik' ) => 'fontawesome',
				esc_html__( 'Ionicons', 'tm-organik' )     => 'ionicons',

			),
			'param_name'  => 'icon_lib',
			'description' => esc_html__( 'Select icon library.', 'tm-organik' ),
		),
		Insight_Helper::fonticon( 'organik' ),
		Insight_Helper::fonticon( 'fontawesome' ),
		Insight_Helper::fonticon( 'fontionicons' ),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'tm-organik' ),
			'param_name'  => 'title',
			'value'       => '',
			'admin_label' => true
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Content', 'tm-organik' ),
			'param_name' => 'content',
			'value'      => ''
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Link', 'tm-organik' ),
			'param_name'  => 'link',
			'value'       => '',
			'admin_label' => true
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
