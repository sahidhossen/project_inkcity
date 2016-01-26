<?php
/**
 * Google Maps Draw Module
 * @package drawonmaps
 * 
 * File: html_menu_top.php
 * Description: Site menu
 */
?>
 
	<nav class="navbar navbar-default " role="navigation">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li<?php echo ($page=='home'?' class="active"':''); ?>><a href="<?php echo admin_url('maps') ?>"><?php echo $lang_msg['MENU_HOME']; ?></a></li>
					<li<?php echo ($page=='map_create'?' class="active"':''); ?>><a href="<?php echo admin_url('maps') ?>?p=map_create"><?php echo $lang_msg['MENU_CREATE_MAP']; ?></a></li>
					<li<?php echo ($page=='maps'?' class="active"':''); ?>><a href="<?php echo admin_url('maps') ?>?p=maps"><?php echo $lang_msg['MENU_BROWSE_MAPS']; ?></a></li>
					<li<?php echo ($page=='map_global'?' class="active"':''); ?>><a href="<?php echo admin_url('maps') ?>?p=map_global"><?php echo $lang_msg['MENU_GLOBAL_MAP']; ?></a></li>

				</ul>

			</div>

	</nav>
 
 
