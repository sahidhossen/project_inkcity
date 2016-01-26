<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
global $session;

$post = new posts();

$current_post = $post->get_single_post_by('address');


if(isset($_POST['submit']) || isset($_POST['update'])){
    $data['post_content'] = $_POST['address_content'];
    $data['post_title'] = $_POST['contact_title'];
    $data['post_type'] = 'address';

    if(isset($_POST['update'])){
        if($post->update_post($data,array('id'=>$current_post->id))){
            $session->message('Contact page update successfull');
            safe_redirect(admin_url('contact'));
        }
    }else {
        if($post->insert_posts($data)){
            $session->message('Address posts successfull! ');
            safe_redirect(admin_url('contact'));
        }else {
            $session->message($main_db->last_query);
            safe_redirect(admin_url('contact'));
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
                            <?php if(isset($_GET['id'])): ?>
                                <a class="control" href="<?php echo admin_url('new-post') ?>?post=tab"> <small>+ New </small></a>
                                <!-- /.control-box -->
                            <?php endif; ?>
                            <!-- /.control -->
                        </h3>
                        <!-- /.title -->


                        <div class="form-section">
                            <form action="" method="post" class="form form-horizontal contactForm">
                                <div class="form-group">

                                    <label for="Tab Title"> Contact Title  <span class="color-red hide error_msg"> <small> (Required *) </small></span> </label>
                                    <div class="form-box">
                                        <input type="text" class="form-control" value="<?php echo (isset($current_post->post_title)) ? $current_post->post_title : ''; ?>" placeholder="Tab Title" name="contact_title">
                                    </div>
                                    <!-- /.form-box -->
                                    <label for="Tab Content"> Address </label>
                                    <div class="form-box">
                                        <textarea name="address_content" id="" class="richText" cols="30" rows="10"> <?php echo (isset($current_post->post_content)) ? $current_post->post_content : ''; ?></textarea>
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