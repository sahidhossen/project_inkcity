<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 18-11-15
 * Time: 20.14
 */

/*
 * My All pages neet to insert into this array
 * */

global $safe_pages;
$safe_pages = array("user", "term", "index", "about","login","logout","user-admin", "terms_service", "forgate-password", "registration","step_2","view");

function my_safe_pages( $page ){

    global $safe_pages ;

    if($page !='') {
    if (in_array($page, $safe_pages))
        return true;
    return false;
    }
    return false;
}

// Get requested page name from url

function get_page_name()
{

    $params = explode("/", $_SERVER['REQUEST_URI']);

    array_shift($params);

    $page_name = isset($params[1]) && !empty($params[1]) ? $params[1] : 'index';

    $extension = explode('.', $page_name);

    if (count($extension) > 1)
        $page_name = $extension[0];

    return $page_name;
}




function create_db_connect(){
    global $main_db;

    require_once(CORE_F.'/main-db.php');
    if(!$main_db) {
        $main_db = new main_db(DATABASE, USER, HOST, PASSWORD);
    }else{
        return;
    }
}





function gus_url(){
    //echo $abspath_fix = str_replace( '\\', '/', ABSPATH );
    //echo $script_filename_dir = dirname( $_SERVER['SCRIPT_FILENAME'] );
    $path = preg_replace( '#/[^/]*$#i', '', $_SERVER['PHP_SELF'] );
    $shema = is_ssl() ? 'https://' : 'http://';
    $url = $shema . $_SERVER['HTTP_HOST'] . $path;
    return rtrim($url);
}   

function safe_redirect($location, $status=302){

    if( !$location ) {
        return false; 
    }else {
        $location = make_clean_redirect($location);
        header("Location: $location", true, $status);
        return true;
    }

}
/*
----------------------- 
Deferent location
*/




if ( !function_exists('make_clean_redirect') ) :
 
function make_clean_redirect($location) {
    $location = preg_replace('|[^a-z0-9-~+_.?#=&;,/:%!*]|i', '', $location);
    $location = remove_invalid_control($location);

    // remove %0d and %0a from location
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $location = _deep_replace($strip, $location);
    return $location;
}
endif;


function remove_invalid_control($string) {
    $string = preg_replace( '/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', $string); 
    $string = preg_replace( '/(\\\\0)+/', '', $string ); 
    return $string;
}


function _deep_replace( $search, $subject ) {
  $subject = (string) $subject;

  $count = 1;
  while ( $count ) {
    $subject = str_replace( $search, '', $subject, $count );
  }

  return $subject;
}
