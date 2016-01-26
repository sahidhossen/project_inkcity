<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/2/2016
 * Time: 11:16 PM
 */




/*
 * Insert tab from ajax request and send new insert tab information
 * After send the data append it into the old data
 */

function insert_tab(){
    $post = new posts();
    global $main_db;
    if(isset($_POST['action'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $data['post_title'] = mysql_real_escape_string($title);
        $data['post_content'] = mysql_real_escape_string($content);
        $data['post_type'] = 'tab';
        $data['post_status'] = 'top';
        if($post->insert_posts($data)==true) {
            global $main_db;
            $tab = $post->get_post_by_id($main_db->insert_id);
            ?>
            <div class="fb-section update" id="update_<?php echo $tab->id; ?>">
                <div class="siteTabs">
                    <div class="form-group">
                        <div class="control">
                            <span class="trash-panel" data-ID="<?php echo $tab->id ?>"> <i class="fa fa-trash"></i></span>
                            <span class="update-panel" data-ID="<?php echo $tab->id ?>"> <i class="fa fa-refresh"></i></span>
                            <!-- /.update-panel -->
                        </div>
                        <label for="Title"> Tab Title </label>
                        <div class="field-box">
                            <input type="text" dataID="<?php echo $tab->id; ?>" value="<?php echo $tab->post_title; ?>" name="title_<?php echo $i; ?>" class="form-control" placeholder="Tab Title">
                            <!-- /.form-control -->
                        </div>
                        <!-- /.field-box -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="home_tab_content_holder"> Tab Content </label>
                        <div class="field-box">
                            <textarea dataID="<?php echo $tab->id; ?>" name="tabcontent_<?php echo $i; ?>" class="richText" cols="30" rows="10"> <?php echo $tab->post_content; ?></textarea>
                            <!-- /#editor -->
                        </div>
                        <!-- /.field-box -->
                    </div>

                </div>
                <!-- /.siteTabs -->
            </div>
            <?php
        }else {
            echo 'no';
        }

    }
}


/*
 * Delete the request tab
 * Change it in live
 * @param : post_id
 */

function delete_tab(){
    $post = new posts();
    global $main_db;
    if(isset($_POST['action'])){
        if( $post->delete_post( $_POST['ID']) ) {
            echo '1';
        }else {
            echo $main_db->last_query;
        }
    }
}
/*
 * Delete the request media
 * Change it in live
 * @param : post_id
 */

function delete_media(){
    $post = new posts();
    global $main_db,$session;
    if(isset($_POST['action'])){
        $file = $post->get_post_by_id($_POST['id']);
        unlink(UPLOAD_DIR.$file->post_content);
        if( $post->delete_post( $_POST['id']) ) {
            echo 'yes';
            $session->message('Your media has been deleted');
        }else {
            echo $main_db->last_query;
        }
    }
}

/*
 * Update the tab element
 * @param : id, title and content
 *
 */
function update_tab(){
    global $main_db;
    $post = new posts();

    if(isset( $_POST['action'])){

        $data['post_title'] = mysql_real_escape_string($_POST['title']);
        $data['post_content'] = mysql_real_escape_string($_POST['content']);

        if($post->update_post($data, array('id'=>$_POST['ID']))){
            echo '1';
        }else {
            echo $main_db->last_query;
        }

    }
}

/*
 *
 * Sender email croud
 */
function sender_email(){
    global $main_db;
    $post = new posts();
    if(isset($_POST['action'])){
        $ID = $_POST['id'];
        $data['post_content'] = $_POST['email_id'];
        $data['post_type'] = 'sender_email';

        if($post->get_single_post_by('sender_email') == NULL ){
            if($post->insert_posts($data)){
                echo '1';
            }
        }else {
            if($post->update_post($data,array('id'=>$ID)))
                echo '2';
        }
    }
}


/*
 *
 * location map croud
 */
function location_map(){
    $post = new posts();
    global $main_db;
    if(isset($_POST['action'])){
        $ID = $_POST['id'];
        $data['post_content'] = $_POST['lat'].'&'.$_POST['lang'];
        $data['post_type'] = $_POST['target'];

        if($post->get_single_post_by($_POST['target']) == NULL ){
            if($post->insert_posts($data)){
                echo $main_db->insert_id;
            }
        }else {
            if($post->update_post($data,array('id'=>$ID)))
                echo '2';
        }
    }
}

/*
 *
 * Hotline Croud
 * if already exist then update
 * or insert it
 */
function check_hotline(){
    global $main_db;
    $post = new posts();
    if(isset($_POST['action'])){

        $data['post_content'] = $_POST['hotline'];
        $data['post_type'] = 'hotline';

        $hotline = $post->get_single_post_by('hotline');

        if($hotline == NULL ){
            if($post->insert_posts($data)){
                echo '1';
            }
        }else {
            if($post->update_post($data,array('id'=>$hotline->id)))
                echo '2';
        }
    }
}

/*
 * Catch map location
 * */
  function map_location(){
      if(isset($_POST['action'])){
          $location = $_POST['location'];
          $map_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location);
          $map_json = file_get_contents($map_url);
          $map =  json_decode($map_json);

          $location =  json_encode($map->results['0']->geometry->location);
          echo $location;

      }
  }

/*
 * Add map location in the database
 * */

 function get_map_location(){
    $map = new Map();
     global $session,$main_db;
     if(isset($_POST['map_submit'])){
         $data['location']  = $_POST['map_location'];
         $data['title']     = $_POST['label_title'];
         $data['content'] = $_POST['label_content'];
         $data['lat']       = $_POST['lat'];
         $data['lng']       = $_POST['lng'];
         $data['position']  = $_POST['map_position'];

         if($map->insert_posts($data)){
            $session->message('You map has been created');
             safe_redirect(admin_url('map').'?map=edit&id='.$main_db->insert_id );
         }else {
             var_dump($main_db->last_query );
             exit();
         }

     }
 }


/*
 * Update map
 * */

function update_map_location(){
    $map = new Map();
    global $session,$main_db;
    if(isset($_POST['map_edit'])){
        $id = $_GET['id'];

        $data['location']  = $_POST['map_location'];
        $data['title']     = $_POST['label_title'];
        $data['content'] = $_POST['label_content'];
        $data['lat']       = $_POST['lat'];
        $data['lng']       = $_POST['lng'];
        $data['position']  = $_POST['map_position'];

        if($map->update_post($data, array('id'=>$id))){
            $session->message('Your map has been updated');
            safe_redirect(admin_url('map').'?map=edit&id='.$id );
        }else {
            var_dump($main_db->last_query );
            exit();
        }

    }
}

/*
 * Update custom slide titles and sub title
 * */
function custom_slide_update(){
    $post = new posts();

    if(isset($_POST['action'])){
        $post_id = $_POST['post_id'];
        $fields = $_POST['slide_fields'];
       foreach($fields as $field){
           $post_data[] = $field['name'].'::'.$field['value'].'#';
       }
        $data['comment'] = implode('',$post_data);


       if($post->update_post($data,array('id'=>$post_id))){
           echo 'update';
       }else {
           echo 'error';
       }
    }
}



/*
 * Return slide data
 * */

function seperate_slide_item($strings){
    if(!$strings)
        return false;

    $data = array_filter(explode('#',$strings));

    foreach($data as $d ){
        $fields = array_filter(explode('::',$d));

        $datas[$fields[0]] = isset($fields[1]) ? $fields[1] : '';

    }
  return $datas;
}

