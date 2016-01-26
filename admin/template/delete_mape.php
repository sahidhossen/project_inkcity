<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/12/2016
 * Time: 3:38 AM
 */
$map = new Map();
global $session;
if($map->delete_map($_GET['id'])){
    $session->message("Map Delete Successfull! ");
    safe_redirect(admin_url('map'));
}