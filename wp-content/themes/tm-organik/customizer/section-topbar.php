<?php
$section  = 'topbar';
$priority = 1;
/*--------------------------------------------------------------
# Top bar layout
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_topbar_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Layout', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'topbar_visibility',
	'label'       => esc_html__( 'Visibility', 'tm-organik' ),
	'description' => esc_html__( 'Show/hide top bar.', 'tm-organik' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

/*--------------------------------------------------------------
# Top bar text
--------------------------------------------------------------*/

Kiki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'topbar_text',
	'label'       => esc_html__( 'Text', 'tm-organik' ),
	'description' => esc_html__( 'Non risus fringilla neque at convallis in.', 'tm-organik' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Work time: Monday - Friday: 08AM-06PM', 'tm-organik' ),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '.topbar__text',
			'function' => 'html',
		),
	),
) );

/*--------------------------------------------------------------
# Top bar spacing
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'topbar_general_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Spacing', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 15,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.topbar > .topbar-container',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 15,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.topbar > .topbar-container',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Top bar typography
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_topbar_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Typography', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'typography',
	'settings'    => 'topbar_typo',
	'label'       => esc_html__( 'Font family', 'tm-organik' ),
	'description' => esc_html__( 'These settings control the typography for all top bar text.', 'tm-organik' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => '1.5',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
	),
	'output'      => array(
		array(
			'element' => '.topbar, body #lang_sel a.lang_sel_sel',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_font_size',
	'label'     => esc_html__( 'Font size', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.topbar, body #lang_sel a.lang_sel_sel, body #lang_sel li ul a:link',
			'property' => 'font-size',

			'units' => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Top bar color
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_topbar_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Color', 'tm-organik' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => 'topbar_bg_color',
	'label'     => esc_html__( 'Background', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#444444',
	'output'    => array(
		array(
			'element'  => '.topbar, .topbar > .topbar-container, body #lang_sel li ul a:link, body #lang_sel li ul a:visited',
			'property' => 'background-color',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'topbar_text_color',
	'label'     => esc_html__( 'Text', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#999999',
	'output'    => array(
		array(
			'element'  => '.topbar, body #lang_sel a.lang_sel_sel, body #lang_sel a.lang_sel_sel:hover, body #lang_sel li ul a:link, body #lang_sel li ul a:visited',
			'property' => 'color',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'topbar_link_color',
	'label'     => esc_html__( 'Link normal', 'tm-organik' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#999999',
	'output'    => array(
		array(
			'element'  => '.topbar a',
			'property' => 'color',
		),
	),
) );
