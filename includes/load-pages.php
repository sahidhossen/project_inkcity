<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 18-11-15
 * Time: 20.33
 */

//include (PUBLIC_DIR.'index.php');



$page =  get_page_name();

if(my_safe_pages($page)) {

    include(PUBLIC_DIR . $page . '.php');
}else {
    include(PUBLIC_DIR.'404-error.php');
}