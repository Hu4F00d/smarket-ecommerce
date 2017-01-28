<?php if ( Insight::setting( 'header_visibility' ) == 1 ) { ?>
	<header <?php Insight::header_attributes(); ?>>
		<div class="top-search">
			<div class="container">
				<div class="row row-xs-center">
					<div class="col-md-12">
						<form method="GET" action="<?php echo INSIGHT_SITE_HOME; ?>">
							<input type="search" class="top-search-input" name="s"
							       placeholder="<?php echo esc_html__( 'What are you looking for?', 'tm-organik' ); ?>"/>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container header-container">
			<div class="row row-xs-center">
				<div class="header-left">
					<?php
					if ( is_active_sidebar( 'header-01_left' ) ) {
						dynamic_sidebar( 'header-01_left' );
					}
					?>
				</div>
				<div class="col-md-12 header-center">
					<?php Insight::branding_logo(); ?>
					<?php if ( Insight::setting( 'header_search_enable' ) == 1 ) { ?>
						<li class="top-search-btn"><a href="javascript:void(0);"><i class="ion-search"></i></a></li>
					<?php } ?>
					<nav id="menu" class="menu menu--primary header-01">
						<?php Insight::menu_primary() ?>
					</nav>
				</div>
				<?php if ( Insight::setting( 'header_minicart_enable' ) == 1 ) { ?>
					<div class="header-right mini-cart-wrap">
						<?php echo Insight_Woo::header_cart(); ?>
						<div class="widget_shopping_cart_content"></div>
					</div>
				<?php } ?>
			</div><!-- /.row -->
		</div>
	</header><!-- /.header -->
<?php } ?>
