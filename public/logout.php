<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/9/2016
 * Time: 7:47 PM
 */
global $session;

if($session->is_p_logedIn()){
    $session->logout();
    safe_redirect(get_home_url().'/login.php');
}