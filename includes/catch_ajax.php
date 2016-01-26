<?php
/**
 * Created by PhpStorm.
 * User: sahid
 * Date: 12/30/15
 * Time: 1:39 PM
 */

require_once( dirname( dirname( __FILE__ ) ) . '/load.php' );

send_origin_headers();

if ( empty( $_REQUEST['action'] ) )
    die( '0' );

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case $action :
            $functionName = "$action";
            return $functionName();
            break;
        case 'blah' : blah();
            break;

    }
}

die( '0' );
