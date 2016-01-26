<?php
/**
 * Google Maps Draw Module
 * @package drawonmaps
 * 
 * Class: SiteMaps
 * File: sitemaps.php
 * Description: Generic class which load list's of maps
 */
 
	class SiteMaps {
		
		// get list of available maps
		public static function getMaps() {
		 	global $main_db;

			$sql = "SELECT * FROM maps ORDER BY id DESC";
			$result = $main_db->get_results($sql);

			return $result;
		} 
		
		// get list of all available map objects
		public static function getMapsObjects() {
			global $main_db;

			$sql = "SELECT * FROM map_objects";
			$result = $main_db->get_results($sql);

			return $result;
		} 		
				
    }
?>
