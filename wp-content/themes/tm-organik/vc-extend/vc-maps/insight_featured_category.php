<?php

class WPBakeryShortCode_Insight_Featured_Category extends WPBakeryShortCode {
}

$base_name = 'insight_featured_category';

$group_design = esc_html__( 'Design options', 'tm-organik' );

vc_map( array(
		'name'                      => esc_html__( 'Featured Category', 'tm-organik' ),
		'base'                      => $base_name,
		'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
		'icon'                      => 'tm-shortcode-ico default-icon',
		'allowed_container_element' => 'vc_row',
		'params'                    => array(
			array(
				'type'        => 'attach_image',
				'heading'     => 'Image',
				'param_name'  => 'image',
				'save_always' => true,
				'admin_label' => true
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => 'Background Color',
				'param_name' => 'color'
			),
			Insight_Helper::get_param( 'woo_categories_dropdown' ),
			Insight_Helper::get_param( 'el_class' ),
			Insight_Helper::get_param( 'note' ),
		)
	)
);
