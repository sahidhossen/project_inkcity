<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/4/2016
 * Time: 10:27 PM
 */

class posts {


//    Table name
    private $table = 'posts';

//Do not change this
    public $social_icons = array('facebook','twitter','google','youtube');

    /*
     * All posts by post status
     * */

    public function get_post_by( $type = 'post' , $limit=100 ){
        global $main_db;
        $query = $main_db->get_results("SELECT *FROM ".$this->table." WHERE post_type='{$type}' ORDER BY post_position ASC LIMIT {$limit} ");

        if($query)
            return $query;
        return NULL;
    }

    /*
     * Get Post single by post type
     *
     */
    public function get_single_post_by( $type = 'post'){
        global $main_db;
        $query = $main_db->get_rows("SELECT *FROM ".$this->table.  " WHERE post_type='{$type}' LIMIT 1");

        if($query)
            return $query;
        return NULL;
    }
    /*
     * Get post by ID
     *@param: post_id
     * Get a single row
     */

    public function get_post_by_id( $post_id ){
        global $main_db;

        $query = $main_db->get_rows("SELECT *FROM ".$this->table." WHERE id=".$post_id." LIMIT 1");

        if( $query )
            return $query;
        return NULL;
    }

    /*
     * Query with multiple ids
     * */
    public function get_multi_results_by_ID( $post_ids = array() ){
        global $main_db;

        $post_ids = implode(',', $post_ids); // returns 1,2,3,4,5
        $query = $main_db->get_results("SELECT * FROM ".$this->table." WHERE id in ({$post_ids})");

        if($query)
            return $query;
        return NULL;
    }

    /*
     * Get post by post by post_status
     * */
    public function get_post_by_status($type, $post_status ){
        global $main_db;

        $query = $main_db->get_results("SELECT *FROM ".$this->table.  " WHERE post_type='{$type}' AND post_status='{$post_status}'");

        if( $query )
            return $query;
        return NULL;
    }
    /*
     * Delete tab
     * @param: row_id
     */

    public function delete_post( $id ){
        global $main_db;

        $delete = $main_db->query("DELETE FROM `{$this->table}` WHERE id={$id} LIMIT 1");

        if( $delete )
            return true;
        return false;

    }

    /*
     * Insert into posts
     * */
    public function insert_posts( $data ){

        global $main_db,$session;
        $data['post_date'] = date('Y-m-d H:i:s');
        $data['update_date'] = date('Y-m-d H:i:s');
        $data['auth'] = $session->userID;

        $insert = $main_db->insert($this->table, $data);

        if($insert)
            return true;
        return false;
    }


    /*
     * Update post rows
     * @param: Post ID
     *
     */
    public function update_post( $data, $where ){

        global $main_db;

        $data['update_date'] = date('Y-m-d H:i:s');

        $update = $main_db->update( $this->table, $data, $where );

        if( $update )
            return true;
        return false;

    }



}