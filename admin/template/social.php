<?php
$post = new posts();
global $session, $main_db;
if(isset($_POST['submit'])){
    $data['post_title'] = $post->social_icons[$_POST['social_name']-1];
    $data['post_content'] = $_POST['url'];
    $data['post_type'] = 'social';
    $data['post_status'] = $_POST['social_name'];
    $data['post_position'] = $_POST['position'];

    if(isset($_GET['id'])){
        if($post->update_post($data,array('id'=>$_GET['id']))){
            $session->message("Your tab update successful! ");
            safe_redirect(admin_url('new-post').'?post=social&id='.$_GET['id']);
        }else {
            var_dump($main_db->last_query);
            exit();
        }
    }else {
        if ($post->insert_posts($data)) {
            $session->message("Your social link has been created!");
            safe_redirect(admin_url('new-post').'?post=social&id='.$main_db->insert_id);
        } else {
            var_dump($main_db->last_query);
            exit();
        }
    }

}

$current_post= NULL;
if(isset($_GET['id'])){
    $current_post =$post->get_post_by_id($_GET['id']);
}

$allPosts = $post->get_post_by('social');
?>

<div class="row main-content special">

    <div class="col-md-8 col-md-offset-1">
        <h3 class="title"> <i class="fa fa-toggle-on"></i> <?php echo (isset($_GET['id'])) ? 'Update Social' : 'Create A New Social Link'; ?>
            <?php if(isset($_GET['id'])): ?>
                <a class="control" href="<?php echo admin_url('new-post') ?>?post=social"> <small>+ New </small></a>
                <!-- /.control-box -->
            <?php endif; ?>
            <!-- /.control -->
        </h3>
        <!-- /.title -->


        <div class="form-section">
            <form action="" method="post" class="form form-horizontal socialForm">
                <div class="form-group">


                    <label for="Tab Title"> Social Site  <span class="color-red hide error_msg"> <small> (Required *) </small></span> </label>
                    <div class="form-box">
                        <select class="form-control" name="social_name" id="">
                            <option value="0">Select</option>
                            <?php

                            for($i=0;$i<count($post->social_icons); $i++ ):
                                $selected = '';
                                if(isset($_GET['id'])){
                                    $selected = ($i==$current_post->post_status-1) ? 'selected' : '';
                                }
                                ?>
                                <option <?php echo $selected;  ?> value="<?php echo $i + 1; ?>"> <?php  echo $post->social_icons[$i]; ?></option>
                            <?php endfor; ?>
                        </select>
                        <!-- /# -->
                    </div>


                    <label for="Tab Title"> Social Url  <span class="color-red hide error_msg"> <small> (Required *) </small></span> </label>
                    <div class="form-box">
                        <input type="text" class="form-control" value="<?php echo (isset($current_post->post_content)) ? $current_post->post_content : ''; ?>" placeholder="Tab Title" name="url">
                    </div>
                    <label for="Position"> Position </label>
                    <div class="form-box">
                        <select name="position" class="form-control" id="">
                            <?php if($allPosts !=NULL ):

                                $count = (isset($_GET['id'])) ? count($allPosts) : count($allPosts) + 1;
                                $selected = (isset($_GET['id'])) ? $current_post->post_position : count($allPosts)+1;
                                for($i = 1; $i<=$count; $i++ ):
                                    ?>
                                    <option <?php echo ($selected==$i) ? 'selected' : ''; ?> value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                                <?php endfor; else: ?>
                                <option value="1">1</option>
                            <?php endif; ?>
                        </select>
                        <!-- /# -->
                    </div>
                    <!-- /.form-box -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <p><input type="submit" name="submit" class="btn btn-default btn-md" value="<?php echo (isset($_GET['id'])) ? 'Update' : '+Add'; ?>"></p>
                </div>
                <!-- /.form-grpup -->
            </form>
            <!-- /.form form-horizontal -->
        </div>
        <!-- /.form-section -->
    </div>
    <!-- /.col-md-8 col-md-offset-1 -->
</div>
<!-- /.row main_content -->

<div class="row main-content special">
    <div class="col-md-8 col-md-offset-1">
        <div class="show_msg hide">
            <p class="msg msg-success"> Successfully Deleted! </p>
        </div>
        <!-- /.show_msg -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th> S.L </th>
                <th> Title </th>
                <th> URL </th>
                <th> Position </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            <?php if($allPosts != NULL ):
                $i=0;
                foreach($allPosts as $post ): $i++;
                    ?>
                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $post->post_title; ?> </td>
                        <td> <?php echo $post->post_content; ?> </td>
                        <td> <?php echo $post->post_position; ?> </td>
                        <td>
                            <p>
                                <a href="<?php echo admin_url('new-post') ?>?post=social&id=<?php echo $post->id; ?>"> <i class="fa fa-refresh"></i></a> |
                                <a  href="<?php echo admin_url('new-post') ?>?post=social&id=<?php echo $post->id; ?>&delete=1"> <i class="fa fa-trash"></i></a> |
                            </p>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="11">
                        <h3 class="null text-center"> Tab list is empty ! </h3>
                        <!-- /.null -->
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-md-8 col-md-offset-1 -->
</div>
<!-- /.row main-content special -->