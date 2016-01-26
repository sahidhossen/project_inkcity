<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 18-11-15
 * Time: 20.59
 */


/*
 * Check if the protocol http or https
 * */
function is_ssl() {
    if ( isset($_SERVER['HTTPS']) ) {
        if ( 'on' == strtolower($_SERVER['HTTPS']) )
            return true;
        if ( '1' == $_SERVER['HTTPS'] )
            return true;
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        return true;
    }
    return false;
}


function get_root_folder(){
    $pathInPieces = explode('/', $_SERVER['REQUEST_URI']);
    return $pathInPieces[1];
}
//Home uri folder location
//exmple: http://localhost/blog/public/anyfiles
function get_home_url() {
    $path = preg_replace( '#/[^/]*$#i', '', $_SERVER['PHP_SELF'] );
    $schem = is_ssl() ? 'https://' : 'http://';
    $url = $schem . $_SERVER['HTTP_HOST'] . $path;
    $url = preg_replace('#/includes#', '', $url);
    $url = preg_replace('#/admin#', '', $url);
    return rtrim($url);
}

function public_uri(){
    return get_home_url().'/public/';
}

function upload_dir() {
    $home = get_home_url();
    $uri = $home . '/public/upload/';
    return rtrim($uri);
}

function get_stylesheet_uri($folder_name=""){
    if($folder_name !="")
        return public_uri().'assets/'.$folder_name."/";
    return public_uri().'assets/css';
}

/*
 * Get any stylesheet from style sheet directory
 * */
function get_stylesheet_files($file_name=""){
    return get_stylesheet_uri().'/'.$file_name.'.css';
}


// Get script files
function get_script_files($file_name = "" ){
    return get_stylesheet_uri('js').$file_name.'.js';
}

//only for homepage url
//exmple: http://localhost/blog



function get_link( $page = '' ){

    if($page !='' ) {
        if (my_safe_pages($page))
            $page_name = $page;
        $page_name = 'index';
    }

   if(file_exists(PUBLIC_DIR.$page_name.'.php'))
        return PUBLIC_DIR.$page_name;
    return PUBLIC_DIR.$page_name.'.php';

}


function admin_home(){
    return get_home_url().'/admin/';
}

function admin_stylesheet( $filename = '' ){
    if( $filename =='' )
        return get_home_url().'/admin/assets/';

    return get_home_url()."/admin/assets/css/{$filename}".".css";
}


function admin_url( $page = '' ){
    switch($page){
        case 'home':
            return admin_home();
        break;
        case 'home-setting':
            return admin_home().'home-setting.php';
        break;
        case 'slide_setting':
            return admin_home().'slide-setting.php';
        break;
        case 'new-post':
            return admin_home().'new_post.php';
            break;
        case 'contact':
            return admin_home().'contact.php';
            break;
        case 'terms':
            return admin_home().'terms.php';
            break;
        case 'social':
            return admin_home().'social.php';
            break;
        case 'map':
            return admin_home().'location-map.php';
            break;
        case 'maps':
            return admin_home().'map-settings.php';
            break;
        case 'stylesheet_dir':
            return admin_stylesheet();
        break;
        default:
            return 'ERROR';

    }
}

