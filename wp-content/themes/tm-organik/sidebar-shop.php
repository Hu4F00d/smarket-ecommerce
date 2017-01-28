<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tm-organik
 */

if ( is_active_sidebar( 'sidebar_shop' ) ) {
	?>
	<div id="sidebar"
	     class="sidebar col-md-3 <?php echo esc_attr( Insight::setting( 'shop_hide_sidebar_mobile' ) == 1 ? 'hidden-sm hidden-xs' : '' ); ?>">
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar_shop' ); ?>
		</div>
	</div>
<?php }
