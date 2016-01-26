<?php
/**
 * History table
 */

class History {

    private $table = "history";

    private $file_tbl = 'file';

    public  function get_history( $limit = 10 ){

        global $main_db, $session;
        $query = $main_db->get_results("SELECT * FROM {$this->table} WHERE status=0 AND user={$session->p_userID} ORDER BY id ASC LIMIT {$limit} ");

        if($query)
            return $query;
        return NULL;

    }

    public function count_history(){
        global $main_db;

        $count = $main_db->get_results("SELECT * FROM {$this->table }");

        if($count > 0 )
            return count($count);
        return 0;
    }



    /*
     * Update hisotry rows
     * @param: Post ID
     *
     */
    public function update_history( $data, $where ){

        global $main_db;

        $data['upd'] = date('Y-m-d H:i:s');

        $update = $main_db->update( $this->table, $data, $where );

        if( $update )
            return true;
        return false;

    }


    /*
     * SELECT WITH LIMITATION
     * */

    public function get_history_from($start, $end){
        global $main_db,$session;

        $query = $main_db->get_results("SELECT *FROM {$this->table } WHERE status=0 AND user={$session->p_userID} LIMIT {$start}, {$end}" );

        if($query)
            return $query;
        return NULL;
    }



    /*
     * Upload file into database
     * */

    public function insert_file($data){

        global $main_db,$session;
        $data['upd'] = date('Y-m-d H:i:s');

        $data['user'] = $session->p_userID;

        $insert = $main_db->insert($this->file_tbl, $data);

        if($insert)
            return true;
        return false;

    }

    /*
     * Count files
     */
    public function count_files(){
        global $main_db;

        $count = $main_db->get_results("SELECT * FROM {$this->file_tbl } WHERE status=0");

        if($count > 0 )
            return count($count);
        return 0;
    }

    /*
    * SELECT WITH LIMITATION
    * */

    public function get_file_from($start, $end){
        global $main_db, $session;

        $query = $main_db->get_results("SELECT *FROM {$this->file_tbl } WHERE status=0 AND user={$session->p_userID} LIMIT {$start}, {$end}" );

        if($query)
            return $query;
        return NULL;
    }


    /*
     * Update file rows
     * @param: Post ID
     *
     */
    public function update_file( $data, $where ){

        global $main_db;

        $data['upd'] = date('Y-m-d H:i:s');

        $update = $main_db->update( $this->file_tbl, $data, $where );

        if( $update )
            return true;
        return false;

    }


    /*
     * Get file by ID
     * */
    public function get_file_by_id( $post_id ){
        global $main_db;

        $query = $main_db->get_rows("SELECT *FROM {$this->file_tbl} WHERE id={$post_id} LIMIT 1");

        if($query)
            return $query;
        return NULL;
    }


}