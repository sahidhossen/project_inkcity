<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/12/2016
 * Time: 1:43 AM
 */

class location_Map{

    private $table = 'location';

    /*
     * Get all location
     * @limit : 50
     * */
    public function all_location( $limit= 50 ){
        global $main_db;

        $query = $main_db->get_results("SELECT *FROM ".$this->table." order by position ASC LIMIT {$limit}");

        if($query)
            return $query;
        return NULL;
    }

    /*
      * Insert into location
      * */
    public function insert_posts( $data ){

        global $main_db;
        $data['upd'] = date('Y-m-d H:i:s');
        $data['create_date'] = date('Y-m-d H:i:s');

        $insert = $main_db->insert($this->table, $data);

        if($insert)
            return true;
        return false;
    }


    /*
     * Update location rows
     * @param: location ID
     *
     */
    public function update_post( $data, $where ){

        global $main_db;

        $data['upd'] = date('Y-m-d H:i:s');

        $update = $main_db->update( $this->table, $data, $where );

        if( $update )
            return true;
        return false;

    }

    /*
     * get map by id
     * @param: ID
     * */

    public function get_map_by_id($map_id){
        global $main_db;
        $query = $main_db->get_rows("SELECT *FROM {$this->table} WHERE id={$map_id} LIMIT 1 ");

        if($query)
            return $query;
        return NULL;
    }
    /*
         * Delete map
         * @param: row_id
         */

    public function delete_map( $id ){
        global $main_db;

        $delete = $main_db->query("DELETE FROM `{$this->table}` WHERE id={$id} LIMIT 1");

        if( $delete )
            return true;
        return false;

    }


}