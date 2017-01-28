<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );
if ( ( Insight_Helper::get_post_meta( 'page_layout' ) == 'default' ) || ( Insight_Helper::get_post_meta( 'page_layout' ) == '' ) ) {
	$layout = Insight::setting( 'shop_layout' );
} else {
	$layout = Insight_Helper::get_post_meta( 'page_layout' );
}

$cat_color = array(
	'#ebd3c3',
	'#bed4a0',
	'#e0d1a1',
	'#c6e6f6',
	'#c1c9e6',
	'#dfc2d5',
	'#9bd5b0',
	'#f8c9c2',
);
?>
<?php Insight::page_title(); ?>
<?php Insight::breadcrumbs(); ?>
<div class="container">
	<div id="primary" class="content-area row">
		<?php if ( is_active_sidebar( 'sidebar_shop' ) && ( $layout == 'sidebar-content' ) ) {
			do_action( 'woocommerce_sidebar' );
		} ?>
		<div id="main"
		     class="main <?php echo esc_attr( is_active_sidebar( 'sidebar_shop' ) && ( $layout == 'content-sidebar' || $layout == 'sidebar-content' ) ? 'col-md-9' : 'col-md-12' ); ?>"
		     role="main">
			<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			?>

			<?php if ( have_posts() ) : ?>

				<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				echo '<div class="shop-filter row">';
				do_action( 'woocommerce_before_shop_loop' );
				echo '</div>';
				?>

				<?php woocommerce_product_subcategories( array(
					'before' => '<div class="cats row">',
					'after'  => '</div>'
				) ); ?>

				<?php woocommerce_product_loop_start(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
				?>

			<?php elseif ( ! woocommerce_product_subcategories( array(
				'before' => woocommerce_product_loop_start( false ),
				'after'  => woocommerce_product_loop_end( false )
			) )
			) : ?>
				<?php wc_get_template( 'loop/no-products-found.php' ); ?>
			<?php endif; ?>
		</div>
		<?php if ( is_active_sidebar( 'sidebar_shop' ) && ( $layout == 'content-sidebar' ) ) {
			do_action( 'woocommerce_sidebar' );
		} ?>
	</div>
</div>
<?php get_footer( 'shop' ); ?>
