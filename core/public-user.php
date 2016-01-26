<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 23-11-15
 * Time: 21.12
 */

class PublicUser {

    public $user_id;

    private $table = "user";

    public $current_user;

    function __construct()
    {

    }

    /*
     * Get User by ID
     * */
    public function get_user_by_id($user_id){
        global $main_db;

        $query = $main_db->get_rows("SELECT *FROM ".$this->table." WHERE id=".$user_id." LIMIT 1");

        if($query)
            return $query;
        return NULL;
    }
    /*
     * Admin user registration for home page handle
     *
     */
    public function register_user( $data = array() ){
        global $main_db;
        $data['realm'] = 1;
        $data['upd'] = date('Y-m-d H:i:s');
        $data['pass'] = md5($data['pass']);
        $insert = $main_db->insert( $this->table, $data );

        if($insert)
            return true;
        return false;
    }

    /*
     * Check duplicate user
     * @param : email_id
     * */
    public function check_duplicate_user( $user, $type='email' ){
        global $main_db;
        if($type=='email') {
            $user = $main_db->query('SELECT *FROM ' . $this->table . " WHERE email='{$user}'");
        }else {
            $user = $main_db->query('SELECT *FROM ' . $this->table . " WHERE mobile='{$user}'");
        }
        if($user)
            return true;
        return false;
    }
    /*
     * Check login information
     * */
    public function loged_in( $user, $password,$type='email' ){
        global $main_db;
        $password = md5($password);
        if($type=='email') {
            $checkup = $main_db->get_rows("SELECT *FROM " . $this->table . " WHERE email='{$user}' AND pass='{$password}' ");
        }else{
            $checkup = $main_db->get_rows("SELECT *FROM " . $this->table . " WHERE mobile='{$user}' AND pass='{$password}' ");
        }

            if($checkup)
            return $checkup;
        return false;
    }


    /*
     * Get user by email or mobile no
     * if @param = true then get email
     * else get mobile
     * */

    public function get_user_by($value, $status=true ){
        global $main_db;
        if($status==true) {
            $query = $main_db->get_rows("SELECT *FROM " . $this->table . " WHERE email='{$value}' LIMIT 1");
        }else{
            $query = $main_db->get_rows("SELECT *FROM " . $this->table . " WHERE mobile='{$value}' LIMIT 1");
        }

        if($query)
            return $query;
        return NULL;
    }



    /*
    * Update user rows
    * @param: Post ID
    *
    */
    public function update_user( $data, $where ){

        global $main_db;

        $data['upd'] = date('Y-m-d H:i:s');

        $update = $main_db->update( $this->table, $data, $where );

        if( $update )
            return true;
        return false;

    }



}