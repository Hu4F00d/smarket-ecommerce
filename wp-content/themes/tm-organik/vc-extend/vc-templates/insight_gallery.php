<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $categories
 * @var $order_by
 * @var $order
 * @var $number
 * @var $width
 * @var $height
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Gallery
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

$terms = get_terms( 'gallery_category', array(
	'slug' => explode( ',', $categories ),
) );

Insight_Helper::$class_name = 'col-md-4';

if ( 'masonry' == $style ) {
	$number                     = 7;
	Insight_Helper::$class_name = 'col-md-3';
}

?>

<div class="insight-gallery insight-gallery-grid <?php echo esc_attr( $el_class ) ?>">
	<h2 class="display_none"><?php the_title() ?></h2>
	<div class="insight-gallery-filter">
		<ul data-option-key="filter">
			<li><a class="active" href="#filter"
			       data-option-value=".gallery"><?php esc_html_e( 'All', 'tm-organik' ) ?></a></li>
			<?php foreach ( $terms as $key => $term ): ?>
				<li><a href="#"
				       data-option-value="<?php echo esc_attr( '.' . $term->slug ) ?>"><?php echo esc_html( $term->name ) ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
	$params = array(
		'posts_per_page'      => $number,
		'post_type'           => 'gallery',
		'ignore_sticky_posts' => 1,
		'stock'               => 1,
		'tax_query'           => array(
			'relation' => 'or',
			array(
				'taxonomy' => 'gallery_category',
				'field'    => 'slug',
				'terms'    => explode( ',', $categories ),
			)
		),
	);

	if ( get_query_var( 'paged' ) != '' ) {
		$params['paged'] = get_query_var( 'paged' );
	}
	$loop = new WP_Query( $params );
	?>
	<div class="insight-gallery-images row">
		<?php $count = 0;
		$flag        = false; ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php
			Insight_Helper::$img_width  = $width;
			Insight_Helper::$img_height = $height;
			if ( 'masonry' == $style ) {
				$count ++;
				Insight_Helper::$class_name = 'col-md-3';
				if ( 3 == $count ) {
					Insight_Helper::$img_width  = ( $width * 2 );
					Insight_Helper::$img_height = ( $height * 2 );
					Insight_Helper::$class_name = 'col-md-6 x2';
				} else if ( 4 == $count || 6 == $count ) {
					Insight_Helper::$img_width  = ( $width * 2 );
					Insight_Helper::$class_name = 'col-md-6 w-x2';
				} else if ( $flag == false ) {
					$flag = true;
					Insight_Helper::$class_name .= ' base-item';
				}
			}
			get_template_part( 'components/content', 'gallery-grid' );
			?>
		<?php endwhile;
		wp_reset_postdata(); ?>
	</div>

	<?php Insight::paging_nav_gallery( $loop ); ?>

</div>
