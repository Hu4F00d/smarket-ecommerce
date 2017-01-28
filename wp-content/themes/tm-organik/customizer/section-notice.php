<?php
$section  = 'notice';
$priority = 1;
/*--------------------------------------------------------------
# Notice
--------------------------------------------------------------*/

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'notice_cookie_enable',
	'label'       => esc_html__( 'Cookie notice', 'tm-organik' ),
	'description' => esc_html__( 'The notice about cookie auto show when a user visits the site.', 'tm-organik' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'notice_cart_enable',
	'label'       => esc_html__( 'Added to cart notice', 'tm-organik' ),
	'description' => esc_html__( 'Enable the notice when added one product to cart successful.', 'tm-organik' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'notice_wishlist_enable',
	'label'       => esc_html__( 'Added to wishlist notice', 'tm-organik' ),
	'description' => esc_html__( 'Enable the notice when added one product to wish list successful.', 'tm-organik' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );
