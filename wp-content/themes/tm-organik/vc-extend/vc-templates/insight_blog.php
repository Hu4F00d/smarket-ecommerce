<?php
/**
 * Shortcode attributes.
 * @var $atts
 * @var $style
 * @var $item_bg_color
 * @var $number
 * @var $order_by
 * @var $order
 * @var $number
 * @var $excerpt_length
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Insight_Blog
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class . ' ' . $style;

$args = array(
	'post_type' => 'post',
);
if ( ! empty( $number ) ) {
	$args['posts_per_page'] = $number;
}
if ( ! empty( $orderby ) ) {
	$args['orderby'] = $orderby;
}
if ( ! empty( $order ) ) {
	$args['order'] = $order;
}
if ( ! empty( $categories ) ) {
	$args['tax_query'] = array(
		'relation' => 'or',
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => explode( ',', $categories ),
		)
	);
}
$loop = new WP_Query( $args );

//Get style
$item_style = '';
if ( ! empty( $item_bg_color ) ) {
	$item_style .= 'background-color: ' . $item_bg_color . ';';
}

$selector = uniqid( 'insight-item-content-' );
Insight_Helper::apply_style( $item_style, '.' . $selector );

if ( empty( $excerpt_length ) ) {
	$excerpt_length = 25;
}

?>

<div class="insight-blog row <?php echo esc_attr( $el_class ) ?>">
	<?php if ( 'grid' == $style || 'grid_has_padding' == $style ): ?>
		<?php if ( $loop->have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'col-md-4 blog-grid-style' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<img
									src="<?php echo esc_url( Insight_Helper::img_thumb( get_post_thumbnail_id(), array(
										'height' => '250',
										'width'  => '370'
									) ) ) ?>" alt=""/>
							</a>
						</div>
					<?php endif; ?>
					<div class="desc-content <?php echo esc_attr( $selector ) ?>">
						<div class="entry-meta">
							<?php Insight_Templates::posted_on_list(); ?>
						</div>
						<a href="<?php the_permalink(); ?>"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>
						<div class="entry-content">
							<?php echo wp_trim_words( get_the_excerpt(), $excerpt_length ); ?>
						</div>
						<div class="entry-more">
							<?php echo '<a href="' . get_permalink() . '">' . esc_html__( 'Read more', 'tm-organik' ) . '</a>'; ?>
						</div>
					</div>
				</div><!-- #post-## -->
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<div class="col-md-8">
			<?php if ( $loop->have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class( 'row blog-list-style' ); ?>>
						<div class="col-md-6">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'insight-post-list' ); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<div class="entry-meta">
								<?php Insight_Templates::posted_on_list(); ?>
							</div>
							<a href="<?php the_permalink(); ?>"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>
							<div class="entry-content">
								<?php echo get_the_excerpt(); ?>
							</div>
							<div class="entry-more">
								<?php echo '<a href="' . get_permalink() . '">' . esc_html__( 'Read more', 'tm-organik' ) . '</a>'; ?>
							</div>
						</div>

					</div><!-- #post-## -->
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	<?php endif; ?>
</div>
