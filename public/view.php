<?php
/**
 * Created by PhpStorm.
 * User: sahid
 * Date: 1/14/16
 * Time: 9:55 AM
 */
require_once(dirname(dirname(__FILE__)) . '/load.php');

if(isset($_GET['post_id'])){
    $file = new History();

        $postId = $_GET['post_id'];
        $data = array();
        $current_file = $file->get_file_by_id( $postId );
        if($current_file!=NULL){
            $ext = explode(".",$current_file->name);
            $ext = end($ext);
            if($ext=='pdf'){

                header("Content-type: application/pdf");
                header('Content-Disposition: inline; filename="'.$current_file->name.'"');
                header('Content-Transfer-Encoding: binary');
                echo $pdfdata=stripslashes($current_file->obj);
//                echo $pdfdata=base64_encode($current_file->obj);
            }else {
             echo  '<img src="data:image/jpeg;base64,'.base64_encode( $current_file->obj ).'"/>';
            }
        }

}
