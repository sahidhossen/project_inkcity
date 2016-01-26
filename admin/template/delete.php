<?php
/**
 * Created by PhpStorm.
 * User: sahid
 * Date: 1/5/16
 * Time: 5:49 PM
 */
global $session;
$post= new posts();

if( $post->delete_post( $_GET['id']) ) {
    $session->message('Post Delete Successfull!');
    safe_redirect(admin_url('new-post').'?post='.$_GET['post']);
}else {
    echo $main_db->last_query;
    exit();
}