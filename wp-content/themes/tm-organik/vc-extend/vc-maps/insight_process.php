<?php

class WPBakeryShortCode_Insight_Process extends WPBakeryShortCode {
}

$base_name = 'insight_process';

$group_design = esc_html__( 'Design options', 'tm-organik' );

vc_map( array(
	'name'                      => esc_html__( 'Process', 'tm-organik' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'imgradio',
			'admin_label' => true,
			'heading'     => esc_html__( 'Style', 'tm-organik' ),
			'param_name'  => 'style',
			'value'       => array(
				'big-icon'   => array(
					'img'   => INSIGHT_CHILD_THEME_URI . '/assets/admin/images/shortcode-style/process/large-icon.png',
					'title' => 'Big icon style',
				),
				'small-icon' => array(
					'img'   => INSIGHT_CHILD_THEME_URI . '/assets/admin/images/shortcode-style/process/small-icon.png',
					'title' => 'Small icon style',
				),
			),
			'std'         => 'big-icon',
			'admin_label' => true,
		),
		array(
			'type'       => 'param_group',
			'param_name' => 'steps',
			'params'     => array(
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => 'Icon type',
					'param_name'  => 'icon_type',
					'value'       => array(
						'Font icons' => 'font-icons',
						'Custom'     => 'custom',
					),
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Icon library', 'tm-organik' ),
					'std'         => 'ionicons',
					'value'       => array(
						esc_html__( 'Font Awesome', 'tm-organik' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'tm-organik' )  => 'openiconic',
						esc_html__( 'Typicons', 'tm-organik' )     => 'typicons',
						esc_html__( 'Entypo', 'tm-organik' )       => 'entypo',
						esc_html__( 'Linecons', 'tm-organik' )     => 'linecons',
						esc_html__( 'Ionicons', 'tm-organik' )     => 'ionicons',
						esc_html__( 'Organik', 'tm-organik' )      => 'organik',

					),
					'param_name'  => 'icon_lib',
					'description' => esc_html__( 'Select icon library.', 'tm-organik' ),
					'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'font-icons' ) ),
				),
				Insight_Helper::fonticon( 'fontawesome' ),
				Insight_Helper::fonticon( 'openiconic' ),
				Insight_Helper::fonticon( 'typicons' ),
				Insight_Helper::fonticon( 'entypo' ),
				Insight_Helper::fonticon( 'linecons' ),
				Insight_Helper::fonticon( 'fontionicons' ),
				Insight_Helper::fonticon( 'organik' ),
				array(
					'type'       => 'attach_image',
					'class'      => '',
					'heading'    => 'Custom Icon',
					'param_name' => 'custom_icon',
					'dependency' => array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'tm-organik' ),
					'param_name'  => 'title',
					'value'       => 'Step ',
					'admin_label' => true,
				),
				Insight_Helper::get_param( 'content' ),
			)
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
