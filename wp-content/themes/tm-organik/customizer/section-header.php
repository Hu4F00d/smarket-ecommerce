<?php
$section  = 'header';
$priority = 1;
/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_general_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'General', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'header_type',
	'label'    => esc_html__( 'Header Type', 'tm-organik' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'header-01',
	'choices'  => array(
		'header-01' => 'Header 01',
		'header-02' => 'Header 02 (has Top Bar)',
		'header-03' => 'Header 03',
	)
) );

Kiki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'header_call_number',
	'label'       => esc_html__( 'Header Call Number', 'tm-organik' ),
	'description' => esc_html__( 'Available for Header 03.', 'tm-organik' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( '012 - 88 - 0999', 'tm-organik' ),
	'transport'   => 'postMessage',
) );

/*--------------------------------------------------------------
# Header layout
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_main_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Layout', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_visibility',
	'label'    => esc_html__( 'Visibility', 'tm-organik' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_sticky_enable',
	'label'    => esc_html__( 'Sticky', 'tm-organik' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_minicart_enable',
	'label'    => esc_html__( 'Mini cart', 'tm-organik' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_search_enable',
	'label'    => esc_html__( 'Search', 'tm-organik' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
) );

/*--------------------------------------------------------------
# Header spacing
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_general_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Spacing', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header > .wrapper',
			'property' => 'padding-top',

			'units' => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header > .wrapper',
			'property' => 'padding-bottom',

			'units' => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_margin_top',
	'label'     => esc_html__( 'Margin top', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header',
			'property' => 'margin-top',

			'units' => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_margin_bottom',
	'label'     => esc_html__( 'Margin bottom', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header',
			'property' => 'margin-bottom',

			'units' => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Header color
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_main_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Color', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => 'header_bg_color',
	'label'     => esc_html__( 'Background color', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => 'rgba(255,255,255,.3)',
	'output'    => array(
		array(
			'element'  => '.header',
			'property' => 'background-color',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => 'header_overlay_bg_color',
	'label'     => esc_html__( 'Bachground color for Overlay Header', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => 'rgba(33, 33, 33, 0.2)',
	'output'    => array(
		array(
			'element'  => '.overay-header .header',
			'property' => 'background-color',
		),
	),
) );