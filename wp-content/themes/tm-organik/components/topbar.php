<?php if ( Insight::setting( 'topbar_visibility' ) == 1 ) { ?>
	<div <?php Insight::topbar_attributes(); ?>>
		<div class="container topbar-container">
			<div class="row row-xs-center">
				<div class="col-md-6">
					<div class="topbar__text">
						<?php echo wp_kses( Insight::setting( 'topbar_text' ), array(
							'a'      => array(
								'href'  => array(),
								'class' => array(),
								'title' => array(),
							),
							'strong' => array(),
							'span'   => array(),
						) ); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="topbar__menu">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'top',
							'menu_class'     => 'topbar-menu',
							'container'      => false
						) );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>