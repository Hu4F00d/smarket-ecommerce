<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
InsightCore::update_option_count( 'insight_core_view_update' );
?>
<div class="wrap insight-core-wrap">
	<?php
	$insight_core_info = InsightCore::get_info();
	include_once( INSIGHT_CORE_INC_DIR . '/inc/pages-header.php' );
	add_thickbox();
	?>
	<div class="insight-core-body">
		<?php
		$check_theme_update = InsightCore::check_theme_update();
		if ( is_array( $check_theme_update ) && count( $check_theme_update ) > 0 ) {
			?>
			<div class="box">
				<div class="box-header">
					<span class="icon gray"><i class="fa fa-magic"></i></span>
					Update
				</div>
				<div class="box-body">
					<?php echo 'Have the new update of the theme (' . $check_theme_update["version"] . '), please update your theme now.'; ?>
				</div>
			</div>
			<?php
		}
		?>
		<div class="box">
			<div class="box-header">
				<span class="icon gray"><i class="fa fa-magic"></i></span>
				Patcher for <?php echo INSIGHT_CORE_THEME_NAME . ' ' . INSIGHT_CORE_THEME_VERSION; ?>
			</div>
			<div class="box-body">
				<?php
				$patchers = InsightCore::get_patcher();
				//get patcher for only current version
				if ( is_array( $patchers ) && isset( $patchers[ INSIGHT_CORE_THEME_VERSION ] ) ) {
				$patchers_reverse = array_reverse( $patchers[ INSIGHT_CORE_THEME_VERSION ], true );
				?>
				<table class="wp-list-table widefat striped changelogs">
					<thead>
					<tr>
						<th>ID</th>
						<th>Time</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$patchers_status = (array) get_option( 'insight_core_patcher' );
					$i               = 0;
					foreach ( $patchers_reverse as $key => $val ) {
						echo '<tr>';
						echo '<td>#' . $key . '</td>';
						echo '<td>' . $val['time'] . '</td>';
						echo '<td>' . $val['desc'] . '</td>';
						if ( in_array( $key, $patchers_status ) ) {
							echo '<td>Done</td>';
							$patchers_done = false;
							$i             = 0;
						} else {
							if ( $i != 0 ) {
								echo '<td>Please apply previous patch first</td>';
							} else {
								echo '<td id="patcher' . $key . '"><a class="insight-core-patcher" rel="' . $key . '" href="#">Apply</a></td>';
							}
							$i ++;
						}
						echo '</tr>';
					}
					echo '</tbody></table>';
					} else {
						echo 'Have no patcher for this version.';
					}
					?>
			</div>
		</div>
	</div>
	<?php
	include_once( INSIGHT_CORE_INC_DIR . '/inc/pages-footer.php' );
	?>
</div>