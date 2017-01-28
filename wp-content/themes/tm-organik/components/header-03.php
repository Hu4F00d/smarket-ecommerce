<?php if ( Insight::setting( 'header_visibility' ) == 1 ) { ?>
	<header <?php Insight::header_attributes(); ?>>
		<?php get_template_part( 'components/topbar-full' ); ?>
		<div class="top-search">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<form method="GET" action="<?php echo INSIGHT_SITE_HOME; ?>">
						<input type="search" class="top-search-input" name="s"
						       placeholder="<?php echo esc_html__( 'What are you looking for?', 'tm-organik' ); ?>"/>
					</form>
				</div>
			</div>
		</div>
		<div class="header-container">
			<div class="row row-xs-center">
				<div class="col-md-3 header-left">
					<?php Insight::branding_logo(); ?>
				</div>
				<div class="col-md-9 header-right">
					<nav id="menu" class="menu menu--primary header-02">
						<?php Insight::menu_primary() ?>
					</nav>
					<div class="btn-wrap">
						<?php if ( Insight::setting( 'header_minicart_enable' ) == 1 ) { ?>
							<div class="mini-cart-wrap">
								<?php echo Insight_Woo::header_cart(); ?>
								<div class="widget_shopping_cart_content"></div>
							</div>
						<?php } ?>
						<?php if ( Insight::setting( 'header_search_enable' ) == 1 ) { ?>
							<div class="top-search-btn-wrap">
								<div class="top-search-btn"></div>
							</div>
						<?php } ?>
						<?php if ( Insight::setting( 'header_call_number' ) != '' ) { ?>
							<div class="top-call-btn">
								<?php echo esc_html( Insight::setting( 'header_call_number' ) ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div><!-- /.row -->
		</div>
	</header><!-- /.header -->
<?php } ?>
