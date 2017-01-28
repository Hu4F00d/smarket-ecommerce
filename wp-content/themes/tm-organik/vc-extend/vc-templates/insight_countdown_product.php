<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $image
 * @var $box_bg_color
 * @var $title_1
 * @var $title_2
 * @var $title_3
 * @var $content
 * @var $link
 * @var $css
 * @var $el_class
 * @var $datetime
 * @var $price
 * @var $day_singular
 * @var $days_plural
 * @var $hour_singular
 * @var $hours_plural
 * @var $minute_singular
 * @var $minutes_plural
 * @var $second_singular
 * @var $seconds_plural
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Featured_Product
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$products = (array) vc_param_group_parse_atts( $products );
$datetime = '2016/11/10 17:39';
$uid      = uniqid( 'insight-countdown-product-' );
$last     = $delim = '';
?>
<div class="insight-countdown-product" id="<?php echo esc_attr( $uid ); ?>">
	<?php
	if ( count( $products ) > 0 ) {
		foreach ( $products as $product ) {
			if ( isset( $product['product_id'] ) ) {
				$product_info = wc_get_product( $product['product_id'] );
				?>
				<div class="item">
					<a href="<?php echo get_permalink( $product['product_id'] ); ?>">
						<div class="product-name">
							<?php echo esc_html( $product_info->get_title() ); ?>
						</div>
						<div class="product-price">
							<?php echo wp_kses( $product_info->get_price_html(), array(
								'del' => array(),
								'ins' => array(),
							) ); ?>
						</div>
						<div class="product-image">
							<?php
							if ( isset( $product['product_image'] ) && $product['product_image'] ) {
								echo wp_get_attachment_image( $product['product_image'], 'full' );
							} else {
								echo get_the_post_thumbnail( $product['product_id'], 'full' );
							}
							?>
						</div>
					</a>
					<div class="product-countdown">
						<?php if ( get_post_meta( $product['product_id'], '_sale_price_dates_to', true ) && ( get_post_meta( $product['product_id'], '_sale_price_dates_to', true ) > time() ) ) { ?>
							<div class="product-countdown-timer"
							     id="<?php echo esc_attr( $uid . '-' . $product['product_id'] ) ?>">
								<?php echo esc_html( date( 'Y/m/d', get_post_meta( $product['product_id'], '_sale_price_dates_to', true ) ) ) ?>
							</div>
						<?php } else {
							if ( get_post_meta( $product['product_id'], '_sale_price_dates_to', true ) ) {
								?>
								<div class="product-countdown-ended">
									<span><?php echo esc_html__( 'Ended at', 'tm-organik' ) . ' ' . esc_html( date( 'Y/m/d', get_post_meta( $product['product_id'], '_sale_price_dates_to', true ) ) ) ?></span>
								</div>
								<?php
							} else {
								echo '<div class="product-countdown-alltime"><span>' . esc_html__( 'All time', 'tm-organik' ) . '</span></div>';
							}
						} ?>
					</div>
				</div>
				<?php
			}
		}
	}
	?>
</div>
<script>
	jQuery( document ).ready( function() {
		jQuery( '.product-countdown-timer' ).each( function() {
			var thisID = jQuery( this ).attr( 'id' );
			var target = new Date( jQuery( this ).text() );
			var current = new Date();
			if ( target.getTime() < current.getTime() ) {
				document.getElementById( thisID ).innerHTML = 'Ended';
				return;
			}

			countdown.resetLabels();
			countdown.setLabels(
				' millisecond| <span><?php echo '' . $second_singular ?></span></span>| <span><?php echo '' . $minute_singular ?></span> | <span><?php echo '' . $hour_singular ?></span> | <span><?php echo '' . $day_singular ?></span> | <span>week</span> | <span>month</span> | <span>year</span> | <span>decade</span> | <span>century</span> | <span>millennium</span>',
				' milliseconds| <span><?php echo '' . $seconds_plural ?></span> | <span><?php echo '' . $minutes_plural ?></span> | <span><?php echo '' . $hours_plural ?></span> | <span><?php echo '' . $days_plural ?></span> | <span>weeks</span> | <span>months</span> | <span>years</span> | <span>decades</span> | <span>centuries</span> | <span>millennia</span>',
				'<?php echo '' . $last ?>',
				'<?php echo '' . $delim ?>',
				'Ended',
				function( n ) {
					if ( n < 10 ) {
						return '0' + n.toString();
					}
					return n.toString();
				} );
			countdown(
				target,
				function( ts ) {
					if ( ts.hours === 0 ) {
						ts.hours = '0';
					}
					if ( ts.minutes === 0 ) {
						ts.minutes = '0';
					}
					if ( ts.seconds === 0 ) {
						ts.seconds = '0';
					}
					if ( ts.days === 0 ) {
						ts.days = '0';
					}
					document.getElementById( thisID ).innerHTML = ts.toHTML( 'div' );
				},
				countdown.HOURS + countdown.MINUTES + countdown.SECONDS
			);
		} );

		jQuery( "#<?php echo esc_attr( $uid ); ?>" ).slick( {
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 6000,
			dots: false,
			arrows: true,
			infinite: true,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		} );
	} );
</script>