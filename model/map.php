<?php
/**
 * Google Maps Draw Module
 * @package drawonmaps
 * 
 * Class: Map
 * File: map.php
 * Description: Handler of map's objects
 */
 
	class Map {

		public $id = 0;
		public $title = NULL;
		public $description = NULL;
		public $center_lat = 0;
		public $center_lng = 0;
		public $zoom = 0;
		public $typeid = 0;
		public $user_id = 0;
        private $table = 'maps';
        private $tbl_map_obj = 'map_objects';
		public function __construct($map_id=0)	{

			if (is_numeric($map_id) && $map_id > 0) {
				$map = array();
				$map = $this->loadMap($map_id);

				if ($map) {
					$this->id = $map->id;
					$this->title = $map->title;
					$this->description = $map->description;
					$this->center_lat = $map->center_lat;
					$this->center_lng = $map->center_lng;
					$this->zoom = $map->zoom;
					$this->typeid = $map->typeid;
					$this->user_id = $map->user_id;
				}
				else {
					throw new Exception('Map not found. Invalid map ID: '.$map_id);
				}
			}
			else {
				$this->title = 'Map Title';
				$this->description = '';
				$this->center_lat = SiteConf::$DEFAULT_CENTER_LAN;
				$this->center_lng = SiteConf::$DEFAULT_CENTER_LNG;
				$this->zoom = SiteConf::$DEFAULT_ZOOM;
				$this->typeid = SiteConf::$DEFAULT_TYPEID;
				$this->user_id = '';				
			}
		}			
		
		// method for saving a map object on database
		public function save() {
			global $main_db;


			if ($this->id)	{
				$sql = "update maps set "
					. "title='".mysql_real_escape_string($this->title)."', "
					. "description='".mysql_real_escape_string($this->description)."', "
					. "center_lat=$this->center_lat, "
					. "center_lng=$this->center_lng, "
					. "zoom=$this->zoom, "
					. "typeid='".mysql_real_escape_string($this->typeid)."' "
					. "where id=".$this->id;
			}
			else
			{
				$sql = "insert into maps (title, description, center_lat, center_lng, zoom, typeid) values ("
					. "'".mysql_real_escape_string($this->title)."', "
					. "'".mysql_real_escape_string($this->description)."', "
					. " ".$this->center_lat.", "
					. " ".$this->center_lng.", "
					. " ".$this->zoom.", "
					. "'".mysql_real_escape_string($this->typeid)."')";
			}

			$rs = $main_db->query($sql);
			if ($rs === FALSE) {
				throw new Exception('Error while saving the map: '. $main_db->last_error);
				return false;
			}
			
			if (!$this->id)	{
				$this->id = $main_db->insert_id;
			}
			
			return $this->id; 
		}
		
		// method for deleting a map and the map's objects
		public function delete() {
			
			global $main_db;

			$rs = $main_db->query("DELETE FROM {$this->table} WHERE id=".$this->id );

			if (!$rs) {
				throw new Exception('The deletion of map failed: '. $main_db->last_query);
			}
			else {

                $rs = $main_db->query("DELETE FROM {$this->tbl_map_obj} WHERE map_id=".$this->id );

                if (!$rs) {
					throw new Exception('Error while deleting the map: '.  $main_db->last_query);
				}			
			}
			
			return true;
		}
		
		// retrieve a map from database
		public function loadMap($map_id) {
			global $main_db;
			$sql = "SELECT * FROM maps WHERE id=$map_id";
			$result = $main_db->get_rows($sql);

			return $result;
		}	
		
		// retrieve map's objects of map from database
		public function getMapObjects() {
			global $main_db;

			$sql = "SELECT * FROM map_objects WHERE map_id=$this->id";
            $result = $main_db->get_rows($sql);


			return $result;
		}	
		
		// delete map's objects of map
		public function deleteMapObjects() {
			global $main_db;
			
			$sql = "delete from map_objects where map_id=$this->id";
			$rs = $main_db->query( $sql);

			if (!$rs) {
                echo $main_db->last_query;
                exit();
				throw new Exception('Error while deleting objects of map: '.  $main_db->last_error);
			}
			
			return true;
		}  		
			
		// save map's objects on database
		function updateMapObject($title, $coords, $object_id, $id=null, $marker_icon='') {
			$id = intval($id);
			$coords = trim($coords);
			$object_id = intval($object_id);
			$marker_icon = trim($marker_icon);

			if ($object_id < 1) {
				return array(false, 'Invalid map object on updateMapObject');
			}	

			global $main_db;

			if ($id>0)	{

				$rs = $main_db->query("update map_objects set title='".mysql_real_escape_string($title)."', coords='".mysql_real_escape_string($coords)."', object_id=".$object_id.", map_id=".$this->id.", marker_icon='".mysql_real_escape_string($marker_icon)."' where id=".$id);
			}
			else {
                $rs = $main_db->query("insert into map_objects (title, coords, object_id, map_id, marker_icon) values ('".mysql_real_escape_string($title)."', '".mysql_real_escape_string($coords)."', ".$object_id.", ".$this->id.", '".mysql_real_escape_string($marker_icon)."')");
			}

			if ($rs === FALSE) {
				return array(false, 'Error while saving objects of map: '. $main_db->last_error);
			}

			return array(true, $main_db->insert_id);
		}


        /*
         * Update and return id
         * */

        private function update_map($data,$where){
            global $main_db;
            $update = $main_db->update($this->table, $data, $where );
            if($update)
                return true;
            return NULL;
        }
    }
    
?>
