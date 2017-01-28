<?php
/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $image
 * @var $name
 * //@var $role
 * @var $biography
 * @var $link_new_page
 * @var $social_links
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_Team_Member
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'insight-team-member ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if ( $image ) {
	$image = Insight_Helper::img_fullsize( $image );
}

?>

<div class="<?php echo esc_attr( $css_class ) ?>">
	<figure>
		<?php if ( ! empty( $image ) && is_string( $image ) ) { ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>">
		<?php } ?>
	</figure>
	<div>
		<?php if ( $name ) { ?>
			<h5 class="name"><?php echo '' . $name; ?></h5>
		<?php } ?>

		<?php if ( $biography ) { ?>
			<p class="biography"><?php echo '' . $biography; ?></p>
		<?php } ?>

		<?php $social_links_arr = $this->getSocialLinks( $atts ); ?>
		<?php if ( ! empty( $social_links_arr ) ) { ?>
			<ul class="social-list">
				<?php foreach ( $social_links_arr as $key => $link ) { ?>
					<li class="<?php echo esc_attr( $key ); ?> hint--top hint--bounce"
					    aria-label="<?php echo ucfirst( esc_attr( $key ) ); ?>">
						<a href="<?php echo esc_url( $link ) ?>"
						   target="<?php echo esc_attr( $link_new_page == 'yes' ? '_blank' : '_self' ); ?>">
							<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>

	</div>
</div>
