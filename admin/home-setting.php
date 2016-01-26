<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
global $session;
$post = new posts();
?>
<!-- Page content -->
<div id="page-content-wrapper">
    <!-- Keep all page content within the page-content inset div! -->
    <div class="page-content inset">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title gray"> <i class="fa fa-home fa-1x"></i> Setup Your Home Page </h3>
                <p class="message message-success"> <?php echo $session->message(); ?> </p>
                <div class="display_tables">


                    <div class="row all_settings_metarial">

                        <div class="col-md-12">
                            <h3 class="title">Setup your home page </h3>
                            <div class="fb-section home-setting">
                                <h3 class="title"> Upload Website Logo <small> ( Upload new logo first delete it )</small></h3>
                                <?php
                                $logo = $post->get_single_post_by('logo');
                                if($logo ==NULL ):
                                ?>

                                <p class="logo_message color-red"></p>
                                <form enctype="multipart/form-data" class="upload_form" id="logo_form">
                                    <div class="fileUpload btn btn-primary">
                                        <span>Upload</span>
                                        <input type="file" class="upload" name="logo">
                                    </div>
                                </form>
                                <div id="logo_progress" class="hide">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                            <span class="sr-only">0%</span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <!-- /#logo_progress -->
                                <div id="logo_holder" class="upload_file_lists">


                                    <ul>
                                        <?php if($logo != NULL ): ?>

                                                <li>
                                                    <a href="#" data-id="<?php echo $logo->id; ?>">
                                                        <span class="media_trash"> <i class="fa fa-times"></i></span>
                                                        <img src="<?php echo upload_dir(). $logo->post_content; ?>" alt="">
                                                    </a>
                                                </li>

                                        <?php endif; ?>

                                    </ul>
                                </div>
                                <!-- /.siteTabs -->
                            </div>

                            <!-- Change Hotline Number  -->
                            <div class="fb-section home-setting">
                                <?php $hotline = $post->get_single_post_by('hotline'); ?>
                                <h3 class="title"> Hot Line Number <small> ( Leave blank if no need! )</small></h3>
                                <div class="home_setting_container">
                                    <div class="form-group hotline">
                                        <p class="message-success color-success hide"> </p>
                                        <label for="advance_title"> Hoteline Number </label>
                                        <div class="field-box">
                                            <input type="text" name="hoteline" class="form-control" value="<?php echo (isset($hotline->post_content)) ? $hotline->post_content : ''; ?>" placeholder="Hotline Number">
                                            <input type="submit" class="add_hotline btn btn-default btn-info">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-md-8 -->
                                <!-- /.form-group -->
                            </div>
                            <!-- Site Footer Logo  -->
                            <div class="fb-section home-setting">
                                <h3 class="title"> Upload Footer Logo <small> ( Upload new logo first delete it )</small></h3>
                                <?php
                                $f_logo = $post->get_single_post_by('footer_logo');
                                if($f_logo ==NULL ):
                                    ?>

                                    <p class="footer_logo_message color-red"></p>
                                    <form enctype="multipart/form-data" class="upload_form" id="footer_logo_form">
                                        <div class="fileUpload btn btn-primary">
                                            <span>Upload</span>
                                            <input type="file" class="upload" name="footer_logo">
                                        </div>
                                    </form>
                                    <div id="footer_logo_progress" class="hide">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                 aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                <span class="sr-only">0%</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <!-- /#logo_progress -->
                                <div id="footer_logo_holder" class="upload_file_lists">


                                    <ul>
                                        <?php if($f_logo != NULL ): ?>

                                            <li>
                                                <a href="#" data-id="<?php echo $f_logo->id; ?>">
                                                    <span class="media_trash"> <i class="fa fa-times"></i></span>
                                                    <img src="<?php echo upload_dir(). $f_logo->post_content; ?>" alt="">
                                                </a>
                                            </li>

                                        <?php endif; ?>

                                    </ul>
                                </div>
                                <!-- /.siteTabs -->
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>