<?php 
/**
 * Google Maps Draw Module
 * @package drawonmaps
 * 
 * File: maps.php
 * Description: List of maps page
 */

	$maps = new SiteMaps();
	$allObj = $vars['sitemaps'];
?>

		<h3 class="doc_title"><?php echo $vars['page_title']; ?></h3>
		<!-- Main component for a primary marketing message or call to action -->
		<div class="jumbotron">
			<?php
				if (isset($vars['delete_map']) && $vars['delete_map'])	{
					echo  '<p class="text-danger">Map deleted successfully</p>';
				}
			?>
			<table class="table table-hover">
				<th>#</th>
				<th><?php echo $lang_msg['MAPS_TABLE_TITLE']; ?></th>
				<th><?php echo $lang_msg['MAPS_TABLE_ACTIONS']; ?></th>
			<?php
				$i = 0;
			if($allObj !='' ):
				foreach ($allObj as $m)	{
					$i++;

			?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><a href="<?php echo admin_url('maps');?>?p=map_view&map_id=<?php echo $m->id; ?> "><?php echo $m->title; ?></a></td>
						<td>
							<?php echo html_map_options($m->id, $lang_msg); ?>
						</td>
					</tr>
			<?php
				}
			endif;
			?>
			</table>
		</div>

