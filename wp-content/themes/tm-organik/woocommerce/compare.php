<?php
/**
 * Woocommerce Compare page
 *
 * @author Your Inspiration Themes
 * @package YITH Woocommerce Compare
 * @version 1.1.4
 */

// remove the style of woocommerce
if ( defined( 'WOOCOMMERCE_USE_CSS' ) && WOOCOMMERCE_USE_CSS ) {
	wp_dequeue_style( 'woocommerce_frontend_styles' );
}

$is_iframe = (bool) ( isset( $_REQUEST['iframe'] ) && $_REQUEST['iframe'] );

wp_enqueue_script( 'jquery-fixedheadertable', YITH_WOOCOMPARE_ASSETS_URL . '/js/jquery.dataTables.min.js', array( 'jquery' ), '1.3', true );
wp_enqueue_script( 'jquery-fixedcolumns', YITH_WOOCOMPARE_ASSETS_URL . '/js/FixedColumns.min.js', array(
	'jquery',
	'jquery-fixedheadertable'
), '1.3', true );

$widths = array();
foreach ( $products as $product ) {
	$widths[] = '{ "sWidth": "205px", resizeable:true }';
}

$table_text = get_option( 'yith_woocompare_table_text' );
yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_table_text', $table_text );
$localized_table_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_table_text', $table_text );

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if !IE]>
<html <?php language_attributes() ?>>
<![endif]-->

<!-- START HEAD -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width"/>
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800"/>
	<link rel="stylesheet" href="<?php echo esc_url( YITH_WOOCOMPARE_URL . 'assets/css/colorbox.css' ); ?>"/>
	<link rel="stylesheet" href="<?php echo esc_url( YITH_WOOCOMPARE_URL . 'assets/css/jquery.dataTables.css' ); ?>"/>

	<?php wp_head() ?>

	<style type="text/css">
		body.loading {
			background: url("<?php echo YITH_WOOCOMPARE_URL ?>assets/images/colorbox/loading.gif") no-repeat scroll center center transparent;
		}

		/**
		 * The style of the woocommerce compare products
		 */

		* {
			margin: 0;
			padding: 0;
		}

		body {
			font-family: 'Open Sans', san-serif;
			font-size: 15px;
			line-height: 1.6em;
			color: #747373;
			background: none !important;
			padding-top: 46px;
		}

		ins {
			text-decoration: none;
		}

		table.compare-list {
			margin: 10px;
			table-layout: fixed;
		}

		#growls {
			display: none;
		}

		/* plugin fixedheadertable fix */
		table.compare-list thead, table.compare-list tfoot {
			display: none;
		}

		.table-wrapper {
			width: 100%;
		}

		table.compare-list thead th, h1 {
			background: #5fbd74;
			color: #fff;
			font-weight: 700;
			padding: 0 10px;
			border-bottom: 2px solid #fff;
			display: block;
			text-transform: uppercase;
			font-size: 1.076em;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 46px;
			line-height: 46px;
			z-index: 99;
		}

		table.compare-list thead th a.close, h1 a.close {
			float: right;
			margin-right: 10px;
			font-weight: 600;
			font-size: 0.9em;
			color: #fff;
			text-decoration: none;
		}

		table.compare-list th, table.compare-list td,
		table.compare-list th, table.compare-list .price.repeated td {
			padding: 10px;
		}

		table.compare-list th, table.compare-list td {
			border-bottom: 1px solid #D6D6D6;
		}

		table.compare-list tr.remove th, table.compare-list tr.remove td,
		table.compare-list tr.image th, table.compare-list tr.image td,
		table.compare-list tr.title th, table.compare-list tr.title td,
		table.compare-list tr.price th, table.compare-list tr.price td {
			border-bottom: 0;
			padding-bottom: 0;
		}

		table.compare-list tr.title {
			font-weight: 700;
		}

		table.compare-list tr.image th, table.compare-list tr.image td {
			height: 186px;
		}

		table.compare-list tr.image th, table.compare-list tr.image td,
		table.compare-list tr.title th, table.compare-list tr.title td,
		table.compare-list tr.price th, table.compare-list tr.price td {
			color: #333;
			text-transform: uppercase;
			font-size: 1.076em;
		}

		table.compare-list tr.image th, table.compare-list tr.image td,
		table.compare-list tr.price th, table.compare-list tr.price td,
		table.compare-list tr.add-to-cart th, table.compare-list tr.add-to-cart td {
			padding-top: 4px;
		}

		table.compare-list tr.image th,
		table.compare-list tr.title th,
		table.compare-list tr.price th,
		table.compare-list tr.add-to-cart th {
			text-indent: 150%;
			overflow: hidden;
			white-space: nowrap;
		}

		table.compare-list .remove td a {
			color: #747373;
			text-decoration: none;
		}

		table.compare-list .remove td a:hover {
			color: #f76b6a;
		}

		table.compare-list .remove td a .remove {
			border-radius: 100% 100% 100% 100%;
			color: #f76b6a;
			display: inline-block;
			font-size: 1em;
			font-weight: 400;
			height: 1em;
			line-height: 1em;
			text-align: center;
			text-decoration: none;
			width: 1em;
		}

		.yith-woocompare-widget ul.products-list a.remove {
			float: left;
		}

		table.compare-list .add-to-cart td a {
			display: inline-block;
			margin: 10px 0;
			height: 40px;
			line-height: 40px;
			background-color: #5fbd74;
			border-radius: 2px;
			border: 0 none;
			color: #FFFFFF;
			font-weight: normal;
			padding: 0px 20px;
			text-decoration: none;
			text-transform: uppercase;
		}

		table.compare-list .add-to-cart td a:hover {
			background: #868686;
		}

		table.compare-list .add-to-cart td a.added > div {
			display: none !important;
		}

		table.compare-list .add-to-cart td a.added:after {
			content: '\f383';
			font-family: Ionicons;
			margin-left: 5px;
		}

		table.compare-list .stock td span {
			color: #5fbd74;
		}

		table.compare-list .stock td span.out-of-stock {
			color: #990000;
		}

		table.compare-list .price td {
			text-decoration: none;
		}

		table.compare-list th .fixed-th {
			width: 205px;
		}

		table.compare-list th {
			width: 205px;
			max-width: 205px;
			min-width: 205px;
			overflow: hidden;
			text-align: left;
			font-size: 1.076em;
			color: #333333;
			font-weight: 400;
			text-transform: uppercase;
		}

		table.compare-list td {
			width: 230px;
			max-width: 230px;
			min-width: 230px;
			text-align: center;
		}

		table.compare-list td.odd {
			background: #F7F7F7;
		}

		table.compare-list td.even {
			background: #fff;
		}

		table.compare-list td img {
			background: none repeat scroll 0 0 #FFFFFF;
			border: 1px solid #DADADA;
			height: auto;
			max-width: 100%;
			padding: 3px;
			margin-bottom: 20px;
			max-width: none;
		}

		/** Fixed Header Table Style */
		/*!
		* jquery.fixedHeaderTable. The jQuery fixedHeaderTable plugin
		*
		* Copyright (c) 2011 Mark Malek
		* http://fixedheadertable.com
		*
		* Licensed under MIT
		* http://www.opensource.org/licenses/mit-license.php
		*
		* http://docs.jquery.com/Plugins/Authoring
		* jQuery authoring guidelines
		*
		* Launch  : October 2009
		* Version : 1.3
		* Released: May 9th, 2011
		*
		*
		* all CSS sizing (width,height) is done in pixels (px)
		*/

		/* @group Reset */

		.fht-table,
		.fht-table thead,
		.fht-table tfoot,
		.fht-table tbody,
		.fht-table tr,
		.fht-table th,
		.fht-table td {
			/* position */
			margin: 0;

			/* size */
			padding: 0;

			/* text */
			font-size: 100%;
			font: inherit;
			vertical-align: top;
		}

		.fht-table {
			/* appearance */
			border-collapse: collapse;
			border-spacing: 0;
		}

		/* @end */

		/* @group Content */

		.fht-table-wrapper,
		.fht-table-wrapper .fht-thead,
		.fht-table-wrapper .fht-tfoot,
		.fht-table-wrapper .fht-fixed-column .fht-tbody,
		.fht-table-wrapper .fht-fixed-body .fht-tbody,
		.fht-table-wrapper .fht-tbody {
			/* appearance */
			overflow: hidden;

			/* position */
			position: relative;
		}

		.fht-table-wrapper .fht-fixed-body .fht-tbody,
		.fht-table-wrapper .fht-tbody {
			/* appearance */
			overflow: auto;
		}

		.fht-table-wrapper .fht-table .fht-cell {
			/* appearance */
			overflow: hidden;

			/* size */
			height: 1px;
		}

		.fht-table-wrapper .fht-fixed-column,
		.fht-table-wrapper .fht-fixed-body {
			/* position */
			top: 0;
			left: 0;
			position: absolute;
		}

		.fht-table-wrapper .fht-fixed-column {
			/* position */
			z-index: 1;
		}

		.dataTables_scrollHead, .DTFC_LeftHeadWrapper, .dataTables_scrollFoot, .DTFC_LeftFootWrapper {
			display: none;
		}

		.dataTables_scrollBody {
			overflow: visible !important;
		}

		.added_to_cart {
			display: none !important;
		}

		/* @end */
	</style>
</head>
<!-- END HEAD -->

<?php global $product; ?>

<!-- START BODY -->
<body <?php body_class( 'woocommerce in-iframe' ) ?>>

<h1>
	<?php echo esc_html( $localized_table_text ); ?>
	<?php if ( ! $is_iframe ) : ?><a class="close"
	                                 href="#"><?php esc_html_e( 'Close window [X]', 'tm-organik' ) ?></a><?php endif; ?>
</h1>

<?php //do_action( 'yith_woocompare_before_main_table' ); ?>

<table class="compare-list" cellpadding="0" cellspacing="0"<?php if ( empty( $products ) )
	echo ' style="width:100%"' ?>>
	<thead>
	<tr>
		<th>&nbsp;</th>
		<?php foreach ( $products as $i => $product ) : ?>
			<td></td>
		<?php endforeach; ?>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th>&nbsp;</th>
		<?php foreach ( $products as $i => $product ) : ?>
			<td></td>
		<?php endforeach; ?>
	</tr>
	</tfoot>
	<tbody>

	<?php if ( empty( $products ) ) : ?>

		<tr class="no-products">
			<td><?php esc_html_e( 'No products added in the compare table.', 'tm-organik' ) ?></td>
		</tr>

	<?php else : ?>
		<tr class="remove">
			<th>&nbsp;</th>
			<?php foreach ( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
				<td class="<?php echo esc_attr( $product_class ); ?>">
					<a href="<?php echo esc_url( add_query_arg( 'redirect', 'view', $this->remove_product_url( $product->id ) ) ); ?>"
					   data-product_id="<?php echo esc_attr( $product->id ); ?>"><?php esc_html_e( 'Remove', 'tm-organik' ) ?>
						<span class="remove">x</span></a>
				</td>
			<?php endforeach ?>
		</tr>

		<?php foreach ( $fields as $field => $name ) : ?>

			<tr class="<?php echo esc_attr( $field ); ?>">

				<th>
					<?php echo esc_html( $name ); ?>
					<?php if ( $field == 'image' ) {
						echo '<div class="fixed-th"></div>';
					} ?>
				</th>

				<?php foreach ( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id; ?>
					<td class="<?php echo esc_attr( $product_class ); ?>"><?php
						switch ( $field ) {

							case 'image':
								echo '<div class="image-wrap">' . wp_get_attachment_image( $product->fields[ $field ], 'yith-woocompare-image' ) . '</div>';
								break;

							case 'add-to-cart':
								woocommerce_template_loop_add_to_cart();
								break;

							default:
								echo empty( $product->fields[ $field ] ) ? '&nbsp;' : $product->fields[ $field ];
								break;
						}
						?>
					</td>
				<?php endforeach ?>

			</tr>

		<?php endforeach; ?>

		<?php if ( $repeat_price == 'yes' && isset( $fields['price'] ) ) : ?>
			<tr class="price repeated">
				<th><?php echo esc_html( $fields['price'] ); ?></th>
				<?php foreach ( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
					<td class="<?php echo esc_attr( $product_class ); ?>">
						<?php echo wp_kses( $product->fields['price'], array(
							'del'  => array(),
							'ins'  => array(),
							'span' => array(
								'class' => array(),
							),
						) ); ?>
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endif; ?>

		<?php if ( $repeat_add_to_cart == 'yes' && isset( $fields['add-to-cart'] ) ) : ?>
			<tr class="add-to-cart repeated">
				<th>
					<?php echo esc_html( $fields['add-to-cart'] ); ?>
				</th>
				<?php foreach ( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
					<td class="<?php echo esc_attr( $product_class ); ?>">
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endif; ?>
	<?php endif; ?>
	</tbody>
</table>

<?php //do_action( 'yith_woocompare_after_main_table' ); ?>

<?php if ( wp_script_is( 'responsive-theme', 'enqueued' ) ) wp_dequeue_script( 'responsive-theme' ) ?><?php if ( wp_script_is( 'responsive-theme', 'enqueued' ) ) wp_dequeue_script( 'responsive-theme' ) ?>
<?php do_action( 'wp_print_footer_scripts' ); ?>

<script type="text/javascript">

	jQuery( document ).ready( function( $ ) {
		<?php if ( $is_iframe ) : ?>$( 'a' ).attr( 'target', '_parent' );<?php endif; ?>

		var oTable;
		$( 'body' ).on( 'yith_woocompare_render_table', function() {
			if ( $( window ).width() > 767 ) {
				oTable = $( 'table.compare-list' ).dataTable( {
					"sScrollX": "100%",
					//"sScrollXInner": "150%",
					"bScrollInfinite": true,
					"bScrollCollapse": true,
					"bPaginate": false,
					"bSort": false,
					"bInfo": false,
					"bFilter": false,
					"bAutoWidth": false
				} );

				new FixedColumns( oTable );
				$( '<table class="compare-list" />' ).insertAfter( $( 'h1' ) ).hide();
			}
		} ).trigger( 'yith_woocompare_render_table' );

		// add to cart
		var button_clicked;
		$( document ).on( 'click', 'a.add_to_cart_button', function() {
			button_clicked = $( this );
			button_clicked.block( {
				message: null,
				overlayCSS: {
					background: '#fff url(' + woocommerce_params.ajax_loader_url + ') no-repeat center',
					backgroundSize: '16px 16px',
					opacity: 0.6
				}
			} );
		} );

		// close colorbox if redirect to cart is active after add to cart
		$( 'body' ).on( 'adding_to_cart', function( $thisbutton, data ) {
			if ( wc_add_to_cart_params.cart_redirect_after_add == 'yes' ) {
				wc_add_to_cart_params.cart_redirect_after_add = 'no';
				redirect_to_cart = true;
			}
		} );

		// remove add to cart button after added
		$( 'body' ).on( 'added_to_cart', function( ev, fragments, cart_hash, button ) {

			button_clicked.hide();

			<?php if ( $is_iframe ) : ?>
			$( 'a' ).attr( 'target', '_parent' );

			// Replace fragments
			if ( fragments ) {
				$.each( fragments, function( key, value ) {
					$( key, window.parent.document ).replaceWith( value );
				} );
			}
			<?php endif; ?>
		} );

		// close window
		$( document ).on( 'click', 'a.close', function( e ) {
			e.preventDefault();
			window.close();
		} );

		$( window ).on( 'yith_woocompare_product_removed', function() {
			if ( $( window ).width() > 767 ) {
				oTable.fnDestroy( true );
			}
			$( 'body' ).trigger( 'yith_woocompare_render_table' );
		} );

	} );

</script>

</body>
</html>