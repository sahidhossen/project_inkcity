<?php
define('CORE_F',ABSPATH.'core/');
define('INC','includes');


if(!isset($page_header)) {

    $page_header = true;

    require_once( dirname(__FILE__).'/load.php' );

    require_once( ABSPATH . INC . '/load-pages.php' );
}


