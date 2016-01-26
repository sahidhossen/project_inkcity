<?php
/**
 * Created by sahidhossen
 * User: ussoft
 * Date: 18-11-15
 * Time: 20.02
 * This is main config files which contain all of database information
 */

// Your current databsae name
define('DATABASE','ink_city');

define('USER','root');

define('HOST','localhost');

define('PASSWORD','');


$table_prefix="art_";


if(file_exists(ABSPATH.'settings.php')){
    require_once('settings.php');
}

