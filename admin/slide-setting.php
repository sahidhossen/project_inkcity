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
                    <h3 class="title gray"> <i class="fa fa-home fa-1x"></i> Slide Setting Page </h3>
                    <?php if(!empty($session->message)): ?>
                        <div class="alert alert-success"> <?php echo $session->message(); ?> </div>
                    <?php endif; ?>
                    <div class="content special">
                        <div class="fb-section ">
                            <h3 class="title"> Upload Image For Top Slide</h3>
                            <div class="upload_main">
                                <div class="upload-container">
                                    <p class="file_uploadmsg color-red"></p>
                                    <div id="dragandrophandler" class="dragandrophandler">
                                        <p> Drag You File Here ! </p>
                                    </div>
                                    <form enctype="multipart/form-data" class="upload_form" id="yourregularuploadformId">

                                        <div class="fileUpload btn btn-primary">
                                            <span>Upload</span>
                                            <input type="file"   class="upload" name="files[]" multiple="multiple">
                                        </div>
                                    </form>
                                    <div id="progressContainer" class="hide">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                 aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                <span class="sr-only">0% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="filelist" class="upload_file_lists">

                                        <ul>
                                        <?php
                                        $slide_images = $post->get_post_by('slide');
                                        if($slide_images != NULL ):
                                        ?>
                                        <?php foreach($slide_images as $img ): ?>
                                            <li>
                                                <a href="#" data-id="<?php echo $img->id; ?>">
                                                    <span class="media_edit"> <i class="fa fa-edit"></i></span>
                                                    <!-- /.media_edit -->
                                                    <span class="media_trash"> <i class="fa fa-times"></i></span>
                                                    <img src="<?php echo upload_dir(). $img->post_content; ?>" alt="">
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </ul>

                                    </div>
                                    <!-- /#filelist -->
                                </div>
                                <!-- /.upload-container -->
                            </div>
                            <!-- /.option-group -->
                        </div>
                        <div class="fb-section">
                            <h3 class="title"> Upload Image For Customer Slider</h3>
                            <div class="upload_main">
                                <div class="upload-container">
                                    <p class="customer_file_uploadmsg color-red"></p>
                                    <div id="dragandrophandler_customer" class="dragandrophandler">
                                        <p> Drag You File Here ! </p>
                                    </div>
                                    <form enctype="multipart/form-data" class="upload_form text-center" id="customer_slider_form">
                                        <div class="fileUpload btn btn-primary">
                                            <span>Upload</span>
                                            <input type="file" class="upload" name="customers[]" multiple="multiple">
                                        </div>
                                    </form>
                                    <!-- /.dragandrophandler -->
                                    <div id="customer_progressContainer" class="hide">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                 aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                <span class="sr-only">0% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="customer_filelist" class="upload_file_lists">
                                        <?php
                                        $slide_images = $post->get_post_by('cus_slide');
                                        if($slide_images != NULL ):
                                            ?>
                                            <ul>
                                                <?php foreach($slide_images as $img ): ?>
                                                    <li>
                                                        <a href="#" data-id="<?php echo $img->id; ?>">
                                                            <span class="media_edit post_edit"> <i class="fa fa-edit"></i></span>
                                                            <span class="media_trash"> <i class="fa fa-times"></i></span>
                                                            <img src="<?php echo upload_dir(). $img->post_content; ?>" alt="">
                                                        </a>
                                                        <?php

                                                        $data = seperate_slide_item($img->comment);

                                                        ?>
                                                        <div class="slide_modal">
                                                            <h3 class="modal_title"> Slide Settings </h3>
                                                            <!-- /.modal_title -->
                                                            <div class="modal_body">
                                                                <form action="">
                                                                    <p>
                                                                        <label for="slideTitle"> Slide Title</label>
                                                                        <input type="text" class="form-control" value="<?php echo (isset($data['slide_title'])) ? $data['slide_title'] : ''; ?>" placeholder="Slide Title" name="slide_title">
                                                                    </p>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal_body -->
                                                            <div class="modal_footer">
                                                                <p>
                                                                    <a href="#" class="btn btn-simple post_update" data-id="<?php echo $img->id; ?>"> Change </a>
                                                                    <a href="#" class="btn btn-danger modal_hide"> Cancel </a>
                                                                </p>
                                                            </div>
                                                            <!-- /.modal_footer -->
                                                        </div>
                                                        <!-- /.slide_modal -->
                                                    </li>
                                                <?php endforeach; ?>

                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                    <!-- /#filelist -->
                                </div>
                                <!-- /.upload-container -->
                            </div>
                            <!-- /.option-group -->
                        </div>

                        <div class="fb-section">
                            <h3 class="title"> Upload Image For Partner Slider</h3>
                            <div class="upload_main">
                                <div class="upload-container">
                                    <p class="pertner_file_uploadmsg color-red"></p>
                                    <div id="dragandrophandler_pertner" class="dragandrophandler">
                                        <p> Drag You File Here ! </p>
                                    </div>
                                    <form enctype="multipart/form-data" class="upload_form text-center" id="pertner_slider_form">
                                        <div class="fileUpload btn btn-primary">
                                            <span>Upload</span>
                                            <input type="file" class="upload" name="partners[]" multiple="multiple">
                                        </div>
                                    </form>
                                    <!-- /.dragandrophandler -->
                                    <div id="pertner_progressContainer" class="hide">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                 aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                <span class="sr-only">0% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pertner_filelist" class="upload_file_lists">
                                        <?php
                                        $slide_images = $post->get_post_by('pert_slide');

                                            ?>
                                            <ul>
                                                <?php
                                                if($slide_images != NULL ):
                                                foreach($slide_images as $img ): ?>
                                                    <li>
                                                        <a href="#" data-id="<?php echo $img->id; ?>">
                                                            <span class="media_edit post_edit"> <i class="fa fa-edit"></i></span>
                                                            <span class="media_trash"> <i class="fa fa-times"></i></span>
                                                            <img src="<?php echo upload_dir(). $img->post_content; ?>" alt="">
                                                        </a>
                                                        <?php

                                                        $data = seperate_slide_item($img->comment);

                                                        ?>
                                                        <div class="slide_modal">
                                                            <h3 class="modal_title"> Slide Settings </h3>
                                                            <!-- /.modal_title -->
                                                            <div class="modal_body">
                                                                <form action="">
                                                                    <p>
                                                                        <label for="slideTitle"> Slide Title</label>
                                                                        <input type="text" class="form-control" value="<?php echo (isset($data['slide_title'])) ? $data['slide_title'] : ''; ?>" placeholder="Slide Title" name="slide_title">
                                                                    </p>
                                                                    <p>
                                                                        <label for="slideTitle"> Sub Title</label>
                                                                        <input type="text" class="form-control" value="<?php echo (isset($data['slide_sub_title'])) ? $data['slide_sub_title'] : ''; ?>" placeholder="Sub Title" name="slide_sub_title">
                                                                    </p>
                                                                    <p>
                                                                        <label for="slideTitle"> Number</label>
                                                                        <input type="text" class="form-control" value="<?php echo (isset($data['number'])) ? $data['number'] : ''; ?>" placeholder="Sub Title" name="number">
                                                                    </p>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal_body -->
                                                            <div class="modal_footer">
                                                                <p>
                                                                    <a href="#" class="btn btn-simple post_update" data-id="<?php echo $img->id; ?>"> Change </a>
                                                                    <a href="#" class="btn btn-danger modal_hide"> Cancel </a>
                                                                </p>
                                                            </div>
                                                            <!-- /.modal_footer -->
                                                        </div>
                                                        <!-- /.slide_modal -->
                                                    </li>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>

                                    </div>
                                    <!-- /#filelist -->
                                </div>
                                <!-- /.upload-container -->
                            </div>
                            <!-- /.option-group -->
                        </div>
                    </div>
                    <!-- /.content -->
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>