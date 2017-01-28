<div <?php Insight::copyright_attributes() ?>>
	<div class="container">
		<div class="row row-xs-center">
			<div class="col-md-8 copyright_text">
				<?php echo wp_kses( Insight::setting( 'copyright_text' ), array(
					'a'      => array(
						'href'  => array(),
						'class' => array(),
						'title' => array(),
					),
					'strong' => array(),
					'span'   => array(),
				) ); ?>
			</div>
			<div class="col-md-4 copyright_payment_img">
				<img src="<?php echo esc_url( Insight::setting( 'copyright_payment_img' ) ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>"/>
			</div>
		</div>
	</div>
	<?php if ( Insight::setting( 'copyright_backtotop_visibility' ) == 1 ) { ?>
		<div class="backtotop" id="backtotop">
			<i class="organik-path-footer"></i>
		</div>
	<?php } ?>
</div>
