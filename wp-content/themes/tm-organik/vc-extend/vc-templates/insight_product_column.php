<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$rid    = uniqid( 'insight-product-column-' );
$show   = explode( ',', $show );
$params = array();
switch ( $type ) {
	case 'recent':
		$params = array(
			'posts_per_page'      => $number,
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'stock'               => 1
		);
		break;
	case 'bestseller':
		$params = array(
			'posts_per_page'      => $number,
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'stock'               => 1,
			'meta_key'            => 'total_sales',
			'orderby'             => 'meta_value_num',
			'order'               => 'desc'
		);
		break;
	case 'toprate':
		$params = array(
			'posts_per_page'      => $number,
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'stock'               => 1,
			'meta_key'            => '_wc_average_rating',
			'orderby'             => 'meta_value_num',
			'order'               => 'desc'
		);
		break;
	case 'featured':
		$params = array(
			'posts_per_page'      => $number,
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'stock'               => 1,
			'meta_key'            => '_featured',
			'meta_value'          => 'yes',
		);
		break;
	case 'onsale':
		$params = array(
			'posts_per_page'      => $number,
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'stock'               => 1,
			'meta_query'          => array(
				'relation' => 'or',
				array(
					'key'     => '_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'numeric'
				),
				array(
					'key'     => '_min_variation_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'numeric'
				)
			)
		);
		break;
	case 'category':
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
					'terms'    => $category
				)
			),
		);
		break;
}
$product_loop = new WP_Query( $params );
if ( $product_loop->have_posts() ) {
	?>
	<div class="insight-product-column <?php echo esc_attr( $el_class ); ?>" id="<?php echo esc_html( $rid ); ?>">
		<div class="title">
			<?php echo esc_html( $title ); ?>
		</div>
		<div class="content">
			<div class="item">
				<?php
				$i = 1;
				while ( $product_loop->have_posts() ) :
					$product_loop->the_post();
					global $product;
					?>
					<div class="product-item">
						<div class="product-thumb">
							<?php echo get_the_post_thumbnail( $product_loop->post->ID, 'shop_catalog' ); ?>
						</div>
						<div class="product-info">
								<span class="product-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</span>
							<?php
							if ( in_array( 'price', $show ) ) {
								echo '<div class="product-price">' . $product->get_price_html() . '</div>';
							} ?>
							<?php
							if ( in_array( 'stars', $show ) ) {
								echo '<div class="product-rate">' . $product->get_rating_html() . '</div>';
							} ?>
							<?php
							if ( in_array( 'categories', $show ) ) {
								echo '<div class="product-categories">' . $product->get_categories( ' ' ) . '</div>';
							} ?>
						</div>
					</div>
					<?php
					if ( ( $i % $slides_to_display == 0 ) && ( $i < $product_loop->post_count ) ) {
						echo '</div><div class="item">';
					}
					$i ++;
				endwhile;
				wp_reset_query();
				?>
			</div>
		</div>
	</div>
	<?php if ( $enable_carousel == 'true' ) { ?>
		<script>
			jQuery( document ).ready( function( $ ) {
				jQuery( "#<?php echo esc_attr( $rid ); ?> .content" ).slick( {
					slidesToShow: 1,
					slidesToScroll: 1,
					<?php if ( $enable_autoplay == 'true' ) { ?>
					autoplay: true,
					<?php } else { ?>
					autoplay: false,
					<?php } ?>
					<?php if ( $display_arrows == 'true' ) { ?>
					arrows: true,
					<?php } else { ?>
					arrows: false,
					<?php } ?>
					infinite: true,
				} );
			} );
		</script>
	<?php }
}
