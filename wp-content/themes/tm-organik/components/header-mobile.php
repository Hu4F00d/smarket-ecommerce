<header class="header header-mobile">
	<div class="container">
		<div class="row row-xs-center">
			<div class="col-xs-4 header-left">
				<div id="open-left" class=""><i class="ion-navicon"></i></div>
			</div>
			<div class="col-xs-4 header-center">
				<?php Insight::branding_logo( true ); ?>
			</div>
			<div class="col-xs-4 header-right mini-cart-wrap">
				<?php echo Insight_Woo::header_cart(); ?>
				<div class="widget_shopping_cart_content"></div>
			</div>
		</div>
	</div>
</header>
