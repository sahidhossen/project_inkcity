<?php
require_once(dirname(dirname(__FILE__)) . '/load.php');
/**
 * Created by PhpStorm.
 * User: sahid
 * Date: 1/3/16
 * Time: 2:40 PM
 */
$post = new posts();
global $main_db;
if(isset($_FILES['files'])){

    foreach($_FILES['files'] as $key=>$value ){
       if(is_array($value)){
           $fileName = array_values(array_filter($_FILES['files']['name']));
           $tmp_name = array_values(array_filter($_FILES['files']['tmp_name']));
       }
    }


    $id = array();
    for($i=0;$i<count($fileName);$i++){
        $temp = explode(".",  $fileName[$i]);
        $newfilename = round(microtime(true)).$temp[0] . '.' . end($temp);

        $data['post_content'] = $newfilename;
        $data['post_type'] = 'slide';
        $data['post_status'] = 'top';

        if(move_uploaded_file($tmp_name[$i], UPLOAD_DIR . $newfilename)){
            if($post->insert_posts($data)){
                $id[] = $main_db->insert_id;
            }
        }
    }

    $allImg = $post->get_multi_results_by_ID($id);
    $return ='';
    $id = NULL;
    if($allImg !=NULL ){
        foreach($allImg as $img ){
            $src =  upload_dir().$img->post_content;
            $return .='<li> <a href="#" data-id="'.$img->id.'"> <span class="media_trash"> <i class="fa fa-times"></i></span><img src="'.$src.'" alt=""> </a></li>';
        }

        echo $return;
    }else {
        echo $main_db->last_query;
    }
}


if(isset($_FILES['customers'])){

    foreach($_FILES['customers'] as $key=>$value ){
        if(is_array($value)){
            $fileName = array_values(array_filter($_FILES['customers']['name']));
            $tmp_name = array_values(array_filter($_FILES['customers']['tmp_name']));
        }
    }


    $id = array();
    for($i=0;$i<count($fileName);$i++){
        $temp = explode(".",  $fileName[$i]);
        $newfilename = round(microtime(true)).$temp[0] . '.' . end($temp);

        $data['post_content'] = $newfilename;
        $data['post_type'] = 'cus_slide';
        $data['post_status'] = 'left';

        if(move_uploaded_file($tmp_name[$i], UPLOAD_DIR . $newfilename)){
            if($post->insert_posts($data)){
                $id[] = $main_db->insert_id;
            }
        }
    }

    $allImg = $post->get_multi_results_by_ID($id);
    $return ='';
    $id = NULL;
    if($allImg !=NULL ){
        foreach($allImg as $img ){
            $src =  upload_dir().$img->post_content;
            $return .='<li> <a href="#" data-id="'.$img->id.'">';
            $return .= '<span class="media_edit post_edit"> <i class="fa fa-edit"></i></span><span class="media_trash"> <i class="fa fa-times"></i></span>';
            $return .= '<img src="'.$src.'" alt=""> </a>';
            $return .= '<div class="slide_modal">
                        <h3 class="modal_title"> Slide Settings </h3>
                        <!-- /.modal_title -->
                        <div class="modal_body">
                            <form action="">
                                <p>
                                    <label for="slideTitle"> Slide Title</label>
                                    <input type="text" class="form-control" value="" placeholder="Slide Title" name="slide_title">
                                </p>
                            </form>
                        </div>
                        <!-- /.modal_body -->
                        <div class="modal_footer">
                            <p>
                                <a href="#" class="btn btn-simple post_update" data-id="'.$img->id.'"> Change </a>
                                <a href="#" class="btn btn-danger modal_hide"> Cancel </a>
                            </p>
                        </div>
                        <!-- /.modal_footer -->
                    </div>
                    <!-- /.slide_modal -->';
            $return .= '</li>';
        }

        echo $return;
    }else {
        echo $main_db->last_query;
    }
}


/*
 * Upload image for partner slider
 */


if(isset($_FILES['partners'])){

    foreach($_FILES['partners'] as $key=>$value ){
        if(is_array($value)){
            $fileName = array_values(array_filter($_FILES['partners']['name']));
            $tmp_name = array_values(array_filter($_FILES['partners']['tmp_name']));
        }
    }


    $id = array();
    for($i=0;$i<count($fileName);$i++){
        $temp = explode(".",  $fileName[$i]);
        $newfilename = round(microtime(true)).$temp[0] . '.' . end($temp);

        $data['post_content'] = $newfilename;
        $data['post_type'] = 'pert_slide';
        $data['post_status'] = 'right';

        if(move_uploaded_file($tmp_name[$i], UPLOAD_DIR . $newfilename)){
            if($post->insert_posts($data)){
                $id[] = $main_db->insert_id;
            }
        }
    }

    $allImg = $post->get_multi_results_by_ID($id);
    $return ='';
    $id = NULL;
    if($allImg !=NULL ){
        foreach($allImg as $img ){
            $src =  upload_dir().$img->post_content;
            $return .= '<li> <a href="#" data-id="'.$img->id.'"> ';
            $return .= '<span class="media_edit post_edit"> <i class="fa fa-edit"></i></span><span class="media_trash"> <i class="fa fa-times"></i></span>';
            $return .= '<img src="'.$src.'" alt=""> </a>';
            $return .= '<div class="slide_modal">
                        <h3 class="modal_title"> Slide Settings </h3>
                        <!-- /.modal_title -->
                        <div class="modal_body">
                            <form action="">
                                <p>
                                    <label for="slideTitle"> Slide Title</label>
                                    <input type="text" class="form-control" value="" placeholder="Slide Title" name="slide_title">
                                </p>
                                <p>
                                    <label for="slideTitle"> Sub Title</label>
                                    <input type="text" class="form-control" value="" placeholder="Sub Title" name="slide_sub_title">
                                </p>
                                <p>
                                    <label for="slideTitle"> Number</label>
                                    <input type="text" class="form-control" value="" placeholder="Sub Title" name="number">
                                </p>
                            </form>
                        </div>
                        <!-- /.modal_body -->
                        <div class="modal_footer">
                            <p>
                                <a href="#" class="btn btn-simple post_update" data-id="'.$img->id.'"> Change </a>
                                <a href="#" class="btn btn-danger modal_hide"> Cancel </a>
                            </p>
                        </div>
                        <!-- /.modal_footer -->
                    </div>
                    <!-- /.slide_modal -->';
            $return .= '</li>';
        }

        echo $return;
    }else {
        echo $main_db->last_query;
    }
}

/*
 * Logo Upload
 * */

if(isset($_FILES['logo'])){

    $temp = explode(".",  $_FILES['logo']['name']);
    $newfilename = 'sitelogo'.'.' . end($temp);

    $data['post_content'] = $newfilename;
    $data['post_type'] = 'logo';
    $data['post_status'] = 'top';
    $hasLogo = $post->get_single_post_by('logo');

    if($hasLogo !=NULL ){

        unlink(UPLOAD_DIR.$hasLogo->post_content);
         $post->delete_post( $hasLogo->id);
    }


    if(move_uploaded_file($_FILES['logo']['tmp_name'], UPLOAD_DIR . $newfilename)){
        if($post->insert_posts($data)){
            $id[] = $main_db->insert_id;
        }
    }

    $allImg = $post->get_multi_results_by_ID($id);
    $return ='';
    $id = NULL;
    if($allImg !=NULL ){
        foreach($allImg as $img ){
            $src =  upload_dir().$img->post_content;
            $return .='<li> <a href="#" data-id="'.$img->id.'"> <span class="media_trash"> <i class="fa fa-times"></i></span><img src="'.$src.'" alt=""> </a></li>';
        }

        echo $return;
    }else {
        echo $main_db->last_query;
    }
}


/*
 * Logo Upload
 * */

if(isset($_FILES['footer_logo'])){

    $temp = explode(".",  $_FILES['footer_logo']['name']);
    $newfilename = 'site_footer_logo'.'.' . end($temp);

    $data['post_content'] = $newfilename;
    $data['post_type'] = 'footer_logo';
    $data['post_status'] = 'footer';

    $hasLogo = $post->get_single_post_by('footer_logo');

    if($hasLogo !=NULL ){

        unlink(UPLOAD_DIR.$hasLogo->post_content);
        $post->delete_post( $hasLogo->id);
    }


    if(move_uploaded_file($_FILES['footer_logo']['tmp_name'], UPLOAD_DIR . $newfilename)){
        if($post->insert_posts($data)){
            $id[] = $main_db->insert_id;
        }
    }

    $allImg = $post->get_multi_results_by_ID($id);
    $return ='';
    $id = NULL;
    if($allImg !=NULL ){
        foreach($allImg as $img ){
            $src = upload_dir().$img->post_content;
            $return .='<li> <a href="#" data-id="'.$img->id.'"> <span class="media_trash"> <i class="fa fa-times"></i></span><img src="'.$src.'" alt=""> </a></li>';
        }

        echo $return;
    }else {
        echo $main_db->last_query;
    }
}