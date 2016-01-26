<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
$post = new posts();

$admin_email = $post->get_single_post_by('sender_email');
$location = $post->get_single_post_by('location');
$contact = $post->get_single_post_by('contact');
?>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title gray"> Welcome To Admin Page</h1>
                    <div class="col-md-4">
                        <div class="main_panel">
                            <div class="panel-header">
                                <div class="controls">
                                    <a href="#" class="control-btn control-btn-info"> <i class="fa fa-plus"></i></a>
                                </div>
                                <!-- /.control -->
                                <h3 class="panel-title"> <i class="fa fa-envelope"></i> Email Setting </h3>
                            </div>
                            <div class="panel-body">
                                <p class="message-success color-success hide text-center"> </p>
                                <div class="panel-form">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Email ID" value="<?php echo (isset($admin_email->post_content)) ? $admin_email->post_content : ''; ?>" name="admin_email">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                    <p><a href="#" class="btn btn-info btn-md add_admin_email" data-id="<?php echo (isset($admin_email->id)) ? $admin_email->id : 0; ?>">Submit</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="main_panel">
                            <div class="panel-header">
                                <h3 class="panel-title"> <i class="fa fa-map-marker"></i> Location </h3>
                            </div>
                            <div class="panel-body">
                                <p class="message-success color-success hide text-center"> </p>
                                <?php
                                if($location !=NULL )
                                    $content = explode('&',$location->post_content);

                                ?>
                                <div class="panel-form location_form map">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Latitude" value="<?php echo (isset($location->post_content)) ? $content[0] : ''; ?>" name="lat">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Longtitude" value="<?php echo (isset($location->post_content)) ? $content[1] : ''; ?>" name="lang">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                    <p><a href="#" class="btn btn-info btn-md add_map" data-target="location" data-id="<?php echo (isset($location->id)) ? $location->id : 0; ?>">Submit</a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="main_panel">
                            <div class="panel-header">
                                <h3 class="panel-title"> <i class="fa fa-map-marker"></i> Contact Map </h3>
                            </div>
                            <div class="panel-body">
                                <p class="message-success color-success hide text-center"> </p>
                                <?php
                                if($contact !=NULL )
                                    $c_content = explode('&',$contact->post_content);

                                ?>
                                <div class="panel-form location_form map">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Langitude" value="<?php echo (isset($contact->post_content)) ? $c_content[0] : ''; ?>" name="lat">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Latitude" value="<?php echo (isset($contact->post_content)) ? $c_content[1] : ''; ?>" name="lang">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                    <p><a href="#" class="btn btn-info btn-md add_map" data-target="contact" data-id="<?php echo (isset($contact->id)) ? $contact->id : 0; ?>">Submit</a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>