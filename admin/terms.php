<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
global $session;

$post = new posts();

$current_post = $post->get_single_post_by('terms');


if(isset($_POST['submit']) || isset($_POST['update'])){
    $data['post_content'] = $_POST['term_content'];
    $data['post_title'] = $_POST['term_title'];
    $data['post_type'] = 'terms';

    if(isset($_POST['update'])){
        if($post->update_post($data,array('id'=>$current_post->id))){
            $session->message('Term and service update successfull');
            safe_redirect(admin_url('terms'));
        }
    }else {
        if($post->insert_posts($data)){
            $session->message('Terms and services posts successfull! ');
            safe_redirect(admin_url('terms'));
        }else {
            $session->message($main_db->last_query);
            safe_redirect(admin_url('terms'));
        }
    }
}

?>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row ">
                <div class="col-md-12 main-content special">
                    <h3 class="title gray"> <i class="fa fa-home fa-1x"></i> Create New Posts </h3>
                    <?php if(!empty($session->message)): ?>
                        <div class="alert alert-success"> <?php echo $session->message(); ?> </div>
                    <?php endif; ?>
                    <div class="col-md-8 col-md-offset-1 ">
                        <h3 class="title"> <i class="fa fa-toggle-on"></i> <?php echo (isset($_GET['id'])) ? 'Update Tab' : 'Create A New Tab'; ?>

                        </h3>
                        <!-- /.title -->


                        <div class="form-section">
                            <form action="" method="post" class="form form-horizontal termForm">
                                <div class="form-group">

                                    <label for="Tab Title"> Terms Title  <span class="color-red hide error_msg"> <small> (Required *) </small></span> </label>
                                    <div class="form-box">
                                        <input type="text" class="form-control" value="<?php echo (isset($current_post->post_title)) ? $current_post->post_title : ''; ?>" placeholder="Tab Title" name="term_title">
                                    </div>
                                    <!-- /.form-box -->
                                    <label for="Tab Content"> Term and Services </label>
                                    <div class="form-box">
                                        <textarea name="term_content" id="" class="richText" cols="30" rows="10"> <?php echo (isset($current_post->post_content)) ? $current_post->post_content : ''; ?></textarea>
                                        <!-- /# -->
                                    </div>
                                    <!-- /.form-box -->
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <p><input type="submit" name="<?php echo (isset($current_post->id)) ? 'update' : 'submit'; ?>" class="btn btn-default btn-md" value="<?php echo (isset($current_post->id)) ? 'Update' : '+Add'; ?>"></p>
                                </div>
                                <!-- /.form-grpup -->
                            </form>
                            <!-- /.form form-horizontal -->
                        </div>
                        <!-- /.form-section -->
                    </div>
                    <!-- /.col-md-8 col-md-offset-1 -->

                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>