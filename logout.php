<?php
require( dirname(__FILE__) . '/load.php' );
global $session;
  $session->logout();
if(!$session->is_logedIn()){
    header('Location:'.get_home_url());
    exit();
}
