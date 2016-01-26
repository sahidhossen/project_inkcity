<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 18-11-15
 * Time: 20.15
 */
function intial_constant(){

    if(!defined('PUBLIC_DIR'))
        define('PUBLIC_DIR',ABSPATH.'public/');

    if(!defined('ADMIN_DIR'))
        define('ADMIN_DIR',ABSPATH.'admin/');

    if(!defined('UPLOAD_DIR'))
        define( 'UPLOAD_DIR', PUBLIC_DIR.'upload/');
}