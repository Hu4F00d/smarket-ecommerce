<?php

class WPBakeryShortCode_Insight_Product_Carousel extends WPBakeryShortCode {
}

/*** Product Carousel ***/

$base_name = 'insight_product_carousel';

vc_map( array(
	'name'                      => esc_html__( 'Product Carousel', 'tm-organik' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		Insight_Helper::get_param( 'title' ),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Sub Title', 'tm-organik' ),
			'param_name' => 'sub_title',
		),
		Insight_Helper::get_param( 'woo_categories' ),

		array(
			'type'        => 'dropdown',
			'class'       => '',
			'heading'     => 'Product type',
			'param_name'  => 'product_type',
			'value'       => array(
				'Default'               => '',
				'Recent Products'       => 'recent_products',
				'Featured Products'     => 'featured_products',
				'Sale Products'         => 'sale_products',
				'Best-Selling Products' => 'best_selling_products',
				'Related Products'      => 'related_products',
				'Top Rated Products'    => 'top_rated_products',
				'Categories above'      => 'categories',
			),
			'save_always' => true,
		),

		array(
			'type'       => 'number',
			'heading'    => esc_html__( 'Slides to show', 'tm-organik' ),
			'param_name' => 'slide_to_show',
			'min'        => 1,
		),
		array(
			'type'        => 'dropdown',
			'class'       => '',
			'heading'     => 'Order By',
			'param_name'  => 'order_by',
			'value'       => array(
				'Default' => '',
				'Title'   => 'title',
				'Date'    => 'date',
			),
			'save_always' => true,
		),
		array(
			'type'        => 'dropdown',
			'class'       => '',
			'heading'     => 'Order',
			'param_name'  => 'order',
			'value'       => array(
				'Default' => '',
				'ASC'     => 'ASC',
				'DESC'    => 'DESC',
			),
			'save_always' => true,
		),
		array(
			'type'       => 'number',
			'heading'    => esc_html__( 'Number', 'tm-organik' ),
			'param_name' => 'number',
			'min'        => 0,
			'suffix'     => esc_html__( 'Number of product on carousel (0 is all)', 'tm-organik' ),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
