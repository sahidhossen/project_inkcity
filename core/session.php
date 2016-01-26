<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 23-11-15
 * Time: 21.10
 */

class session {

    public $logedIn;

    public $userID;

//    Public use
    public $p_userID;
    public $p_logedIn;

    public $message='';

    public function __construct()
    {
        ob_start();
        session_start();

        $this->p_checkLogin();
        $this->checkLogin();

        $this->check_msg();
    }

    public function is_logedIn( ) {
        return $this->logedIn;
    }

    public function is_p_logedIn(){
        return $this->p_logedIn;
    }
    public function login( $user='') {
        if( $user ) {
            $this->userID = $_SESSION['username'] = $user;

            $this->logedIn = true;
        }
    }


    public function logout( ) {
        unset($_SESSION['username']);
        unset($_SESSION['p_user']);
        unset($this->userName);
        $this->logedIn = false;
        $this->p_logedIn = false;
    }


    private function checkLogin() {
        if( isset($_SESSION['username']) ) {
            $this->userID = $_SESSION['username'];
            $this->logedIn = true;
        }else {
            unset( $this->userID );
            $this->logedIn = false;

        }
    }

    private function p_checkLogin(){
        if(isset($_SESSION['p_user'])) {
            $this->p_userID = $_SESSION['p_user'];
            $this->p_logedIn = true;
        }else {
            unset( $this->p_userID );
            $this->p_logedIn = false;
        }
    }

    public function message($msg='') {
        if( !empty($msg) )
            $_SESSION['message'] = $msg;
        else
            return $this->message;

    }

    private function check_msg() {
        if( isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else {
            $this->message='';
        }
    }


}


global $session;

$session = new session();
