<?php

class WPBakeryShortCode_Insight_Product_Column extends WPBakeryShortCode {
}

/*** Product Carousel ***/

$base_name = 'insight_product_column';

vc_map( array(
	'name'                      => esc_html__( 'Product Column', 'tm-organik' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'tm-organik' ),
			'param_name'  => 'title',
			'admin_label' => true
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Product Type', 'tm-organik' ),
			'param_name'  => 'type',
			'admin_label' => true,
			'value'       => array(
				__( 'Recent', 'tm-organik' )      => 'recent',
				__( 'Best seller', 'tm-organik' ) => 'bestseller',
				__( 'Top rate', 'tm-organik' )    => 'toprate',
				__( 'Featured', 'tm-organik' )    => 'featured',
				__( 'On sale', 'tm-organik' )     => 'onsale',
				__( 'Category', 'tm-organik' )    => 'category',
			),
		),
		Insight_Helper::get_param( 'woo_categories_dropdown', '', array(
			'element' => 'type',
			'value'   => array( 'category' )
		) ),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Number Products', 'tm-organik' ),
			'param_name' => 'number',
			'value'      => Insight_Helper::get_value_num( 1, 12, 8 ),
		),
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Show on each product', 'tm-organik' ),
			'param_name'  => 'show',
			'value'       => array(
				__( 'Price', 'tm-organik' )        => 'price',
				__( 'Rating stars', 'tm-organik' ) => 'stars',
				__( 'Categories', 'tm-organik' )   => 'categories'
			),
			'std'         => 'price,stars',
			'description' => esc_html__( 'Choose what do you want to show', 'tm-organik' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Enable Carousel', 'tm-organik' ),
			'param_name' => 'enable_carousel',
			'value'      => array(
				__( 'Yes', 'tm-organik' ) => 'true',
				__( 'No', 'tm-organik' )  => 'false'
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Show Arrows', 'tm-organik' ),
			'param_name' => 'display_arrows',
			'value'      => array(
				__( 'Yes', 'tm-organik' ) => 'true',
				__( 'No', 'tm-organik' )  => 'false'
			),
			'dependency' => array( 'element' => 'enable_carousel', 'value' => array( 'true' ) )
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Enable Autoplay', 'tm-organik' ),
			'param_name' => 'enable_autoplay',
			'value'      => array(
				__( 'No', 'tm-organik' )  => 'false',
				__( 'Yes', 'tm-organik' ) => 'true'
			),
			'dependency' => array( 'element' => 'enable_carousel', 'value' => array( 'true' ) )
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Slides to display', 'tm-organik' ),
			'param_name' => 'slides_to_display',
			'value'      => Insight_Helper::get_value_num( 1, 6, 4 ),
			'dependency' => array( 'element' => 'enable_carousel', 'value' => array( 'true' ) )
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
