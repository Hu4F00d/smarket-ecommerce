<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="insight-our-services <?php echo esc_attr( $el_class ); ?>">
	<?php
	if ( $link != '' ) {
		echo '<a href="' . esc_url( $link ) . '">';
	} ?>
	<div class="icon">
		<?php
		$icon_class = isset( ${'icon_' . $icon_lib} ) ? esc_attr( ${'icon_' . $icon_lib} ) : 'ionic';
		echo '<i class="' . esc_attr( $icon_class ) . '"></i>';
		?>
	</div>
	<div class="title">
		<?php echo esc_html( $title ); ?>
	</div>
	<div class="content">
		<?php echo esc_html( $content ); ?>
	</div>
	<?php
	if ( $link != '' ) {
		echo '<div class="more"><i class="ion-plus-round"></i></div>';
		echo '</a>';
	}
	?>
</div>