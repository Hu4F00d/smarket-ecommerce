<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $sub_title
 * @var $categories
 * @var $product_type
 * @var $slide_to_show
 * @var $order_by
 * @var $order
 * @var $number
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Product_Carousel
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

$data_slick                   = array();
$data_slick['arrows']         = true;
$data_slick['slidesToShow']   = (int) $slide_to_show;
$data_slick['slidesToScroll'] = (int) $slide_to_show;
$data_slick['responsive']     = array(
	array(
		'breakpoint' => 480,
		'settings'   => array(
			'slidesToShow'   => 2,
			'slidesToScroll' => 2
		)
	)
);

$slide_to_show = ( ! empty( $slide_to_show ) ) ? $slide_to_show : 3;

$terms = get_terms( 'product_cat', array(
	'slug' => explode( ',', $categories ),
) );

?>

<div class="insight-product-carousel insight-woo <?php echo esc_attr( $el_class ) ?>"
     data-slickkkk='<?php echo wp_json_encode( $data_slick ) ?>'
     data-slide-to-show="<?php echo esc_attr( $slide_to_show ) ?>">

	<?php if ( ! empty( $title ) ): ?>
		<h3 class="special-heading insight-title"><?php echo esc_html( $title ) ?></h3>
	<?php endif; ?>
	<?php if ( ! empty( $sub_title ) ): ?>
		<h4 class="insight-sub-title"><?php echo esc_html( $sub_title ) ?></h4>
	<?php endif; ?>

	<div class="insight-filter">
		<ul data-option-key="filter">
			<li><a class="active" href="#filter"
			       data-option-value=".product"><?php echo esc_html__( 'All', 'tm-organik' ) ?></a></li>
			<?php foreach ( $terms as $key => $term ): ?>
				<li><a href="#"
				       data-option-value="<?php echo '.product_cat-' . $term->slug ?>"><?php echo '' . $term->name ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
	if ( empty( $product_type ) || 'categories' == $product_type ):
		$params = array(
			'posts_per_page'      => $number,
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'stock'               => 1,
			'tax_query'           => array(
				'relation' => 'or',
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => explode( ',', $categories )
				)
			),
		);
		$product_loop = new WP_Query( $params );
		?>
		<div class="products">
			<?php
			while ( $product_loop->have_posts() ) :
				$product_loop->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php
	else:
		echo do_shortcode( '[' . $product_type . ' columns="' . $slide_to_show . '" per_page="' . $number . '" orderby="' . $order_by . '" order="' . $order . '"]' );
	endif;
	?>

</div>
