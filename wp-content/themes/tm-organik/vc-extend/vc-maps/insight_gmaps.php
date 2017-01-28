<?php

class WPBakeryShortCode_Insight_Gmaps extends WPBakeryShortCode {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsScripts();
	}

	public function jsScripts() {
		wp_enqueue_script( 'insight-js-maps', '//maps.google.com/maps/api/js?key=AIzaSyAaYLhJA_5UU2UMd7y2rNL82wEbs10vLww&sensor=false&amp;language=en' );
		wp_enqueue_script( 'insight-js-gmap3', INSIGHT_THEME_URI . '/assets/libs/gmap3/gmap3.min.js' );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Google Maps', 'tm-organik' ),
	'base'     => 'insight_gmaps',
	'category' => sprintf( esc_html__( 'by %s', 'tm-organik' ), INSIGHT_THEME_NAME ),
	'icon'     => 'tm-shortcode-ico default-icon',
	'params'   => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Address or Coordinate', 'tm-organik' ),
			'admin_label' => true,
			'param_name'  => 'address',
			'value'       => '48.8566140,2.1000000',
			'description' => esc_html__( 'Enter address or coordinate.', 'tm-organik' ),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Marker icon', 'tm-organik' ),
			'param_name'  => 'marker_icon',
			'description' => esc_html__( 'Choose a image for marker address', 'tm-organik' ),
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => esc_html__( 'Marker Information', 'tm-organik' ),
			'param_name'  => 'content',
			'description' => esc_html__( 'Content for info window', 'tm-organik' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Height', 'tm-organik' ),
			'param_name'  => 'map_height',
			'value'       => '480',
			'description' => esc_html__( 'Enter map height (in pixels or percentage)', 'tm-organik' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Width', 'tm-organik' ),
			'param_name'  => 'map_width',
			'value'       => '100%',
			'description' => esc_html__( 'Enter map width (in pixels or percentage)', 'tm-organik' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Zoom level', 'tm-organik' ),
			'param_name'  => 'zoom',
			'value'       => '14',
			'description' => esc_html__( 'Map zoom level', 'tm-organik' ),
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Enable Map zoom', 'tm-organik' ),
			'param_name' => 'zoom_enable',
			'value'      => array(
				__( 'Enable', 'tm-organik' ) => 'enable'
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Map type', 'tm-organik' ),
			'admin_label' => true,
			'param_name'  => 'map_type',
			'description' => esc_html__( 'Choose a map type', 'tm-organik' ),
			'value'       => array(
				__( 'Roadmap', 'tm-organik' )   => 'roadmap',
				__( 'Satellite', 'tm-organik' ) => 'satellite',
				__( 'Hybrid', 'tm-organik' )    => 'hybrid',
				__( 'Terrain', 'tm-organik' )   => 'terrain',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Map style', 'tm-organik' ),
			'admin_label' => true,
			'param_name'  => 'map_style',
			'description' => esc_html__( 'Choose a map style. This approach changes the style of the Roadmap types (base imagery in terrain and satellite views is not affected, but roads, labels, etc. respect styling rules', 'tm-organik' ),
			'value'       => array(
				__( 'Default', 'tm-organik' )          => 'default',
				__( 'Grayscale', 'tm-organik' )        => 'style1',
				__( 'Subtle Grayscale', 'tm-organik' ) => 'style2',
				__( 'Apple Maps-esque', 'tm-organik' ) => 'style3',
				__( 'Pale Dawn', 'tm-organik' )        => 'style4',
				__( 'Muted Blue', 'tm-organik' )       => 'style5',
				__( 'Paper', 'tm-organik' )            => 'style6',
				__( 'Light Dream', 'tm-organik' )      => 'style7',
				__( 'Retro', 'tm-organik' )            => 'style8',
				__( 'Avocado World', 'tm-organik' )    => 'style9',
				__( 'Facebook', 'tm-organik' )         => 'style10',
				__( 'Shades of Grey', 'tm-organik' )   => 'style11',
				__( 'Custom', 'tm-organik' )           => 'custom'
			)
		),
		array(
			'type'       => 'textarea_raw_html',
			'heading'    => esc_html__( 'Map style snippet', 'tm-organik' ),
			'param_name' => 'map_style_snippet',
			'dependency' => array(
				'element' => 'map_style',
				'value'   => 'custom',
			)
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
