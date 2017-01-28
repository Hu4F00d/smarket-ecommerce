<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$accordions = (array) vc_param_group_parse_atts( $accordions );
$rid        = uniqid( 'insight-accordion-' );

if ( count( $accordions ) > 0 ) {
	?>
	<div
		class="insight-accordion <?php echo esc_attr( 'insight-accordion-' . $icon_position ); ?> <?php echo esc_attr( $el_class ); ?>"
		id="<?php echo esc_attr( $rid ); ?>">
		<?php
		$i = 0;
		foreach ( $accordions as $accordion ) { ?>
			<div class="item <?php echo( $i == 0 ? 'active' : '' ); ?>">
				<div class="title">
					<?php echo esc_html( $accordion['title'] ); ?>
					<?php if ( $icon_position != 'none' ) { ?>
						<span class="icon">
							<?php
							if ( $accordion['icon_type'] == 'default' ) {
								echo '<i class="icon-default"></i>';
							} else {
								$icon_class = isset( $accordion[ 'icon_' . $accordion['icon_lib'] ] ) ? esc_attr( $accordion[ 'icon_' . $accordion['icon_lib'] ] ) : 'icon-default';
								echo '<i class="' . esc_attr( $icon_class ) . '"></i>';
							}
							?>
						</span>
					<?php } ?>
				</div>
				<div class="content"><?php echo esc_html( $accordion['content'] ); ?></div>
			</div>
			<?php
			$i ++;
		}
		?>
	</div>
	<script>
		jQuery( document ).ready( function() {
			jQuery( '#<?php echo esc_js( $rid ); ?>' ).insightAccordion();
		} );
	</script>
<?php } ?>