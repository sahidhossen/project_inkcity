<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
global $session;
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

                        <div class="col-md-3 tab_list_holder">
                            <div class="content">
                                <h3 class="title"> <i class="fa fa-gear"></i> Settings </h3>
                                <!-- /.title -->
                                <ul class="home_settings_tab_lists">
                                    <li data-target="slideSetting" class="active"> <i class="fa fa-sliders"></i>  <span>Slide Settings</span> </li>
                                    <li data-target="tabSettings"> <i class="fa fa-toggle-on"></i>   <span>Tab Settings </span> </li>
                                    <li data-target="advantage"> <i class="fa fa-sitemap"></i>   <span>Advance Settings </span> </li>
                                </ul>
                            </div>
                            <!-- /.content -->
                        </div>
                        <!-- /.col-md-3 tab_holder -->

                        <div class="col-md-9 tabHolder" id="home_tab_content_holder">
                            <div id="slideSetting" class="active tabcontent">
                                <h3 class="title">
                                   <i class="fa fa-sliders"></i> Slide Settings Title
                                </h3>
                                <!-- /.title -->
                                <div class="content">
                                    <div class="fb-section ">
                                        <h3 class="title"> Upload Image For Top Slide</h3>
                                       <div class="upload_main">
                                            <div class="upload-container">
                                                <div id="dragandrophandler">
                                                    <p> Drag You File Here ! </p>
                                                </div>
                                                <form enctype="multipart/form-data" class="upload_form" id="yourregularuploadformId">

                                                    <div class="fileUpload btn btn-primary">
                                                        <span>Upload</span>
                                                        <input type="file" class="upload" name="files[]" multiple="multiple">
                                                    </div>
                                                </form>
                                                <!-- /.dragandrophandler -->
                                            </div>
                                            <!-- /.upload-container -->
                                       </div>
                                       <!-- /.option-group -->
                                    </div>
                                    <div class="fb-section">
                                        <h3 class="title"> Upload Image For Customer Slider</h3>
                                        <div class="upload_main">
                                            <div class="upload-container">
                                                <div id="dragandrophandler">
                                                    <p> Drag You File Here ! </p>
                                                </div>
                                                <form enctype="multipart/form-data" class="upload_form" id="yourregularuploadformId">

                                                    <div class="fileUpload btn btn-primary">
                                                        <span>Upload</span>
                                                        <input type="file" class="upload" name="files[]" multiple="multiple">
                                                    </div>
                                                </form>
                                                <!-- /.dragandrophandler -->
                                            </div>
                                            <!-- /.upload-container -->
                                        </div>
                                        <!-- /.option-group -->
                                    </div>
                                </div>
                                <!-- /.content -->
                            </div>
                            <!-- /#slideSetting -->

                            <div id="tabSettings" class="tabcontent">
                                <h3 class="title"> <i class="fa fa-toggle-on"> </i> Welcome Tab Settings </h3>
                                <!-- /.title -->

                                <div class="section">

                                        <?php
                                        global $main_db;
                                        $posts = new posts();
                                        $allTab = $posts->get_post_by('tab');
                                       if( NULL !=$allTab ):
                                           $i=0;
                                           foreach( $allTab as $tab ):
                                               $i++;
                                        ?>
                                            <div class="fb-section update" id="update_<?php echo $tab->id; ?>">
                                                <div class="siteTabs">
                                                    <div class="form-group">
                                                        <div class="control">
                                                            <span class="trash-panel" data-ID="<?php echo $tab->id ?>"> <i class="fa fa-trash"></i></span>
                                                            <span class="update-panel" data-ID="<?php echo $tab->id ?>"> <i class="fa fa-refresh"></i></span>
                                                            <!-- /.update-panel -->
                                                        </div>
                                                        <!-- /.control -->
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
                                        <?php endforeach; ?>
                                        <section class="ajaxUpdate">

                                        </section>
                                    <!-- /.ajaxUpdate -->

                                     <?php endif; ?>
                                       <div class="fb-section newTab">
                                           <form class="siteTabs">
                                               <div class="form-group">
                                                   <div class="control">
                                                       <span class="new-panel addTab" data-target="newTab"> <i class=" fa fa-plus"></i></span>
                                                       <!-- /.new-panel -->
                                                   </div>
                                                   <!-- /.control -->
                                                   <label for="Title"> Tab Title <span class="color-red hide error_msg"> <small> (Required *) </small></span> </label>
                                                   <div class="field-box">
                                                       <input type="text" value="" name="title" class="form-control" placeholder="Tab Title">
                                                       <!-- /.form-control -->
                                                   </div>
                                                   <!-- /.field-box -->
                                               </div>
                                               <!-- /.form-group -->
                                               <div class="form-group">
                                                   <label for="home_tab_content_holder"> Tab Content </label>
                                                   <div class="field-box">
                                                       <textarea name="tabcontent" class="richText" cols="30" rows="10"></textarea>
                                                       <!-- /#editor -->
                                                   </div>
                                                   <!-- /.field-box -->
                                               </div>

                                           </form>
                                           <!-- /.siteTabs -->
                                       </div>


                                </div>
                                <!-- /.section -->

                            </div>
                            <!-- /#tabSettings -->
                            <div id="advantage" class="tabcontent">
                                <h3 class="title"> Advance Tab Setting </h3>
                                <!-- /.title -->
                                <div class="fb-section special">

                                        <div class="form-group">
                                            <div class="control">
                                                <span class="control-box update-advance"> <i class="fa fa-refresh"></i> </span>
                                                <!-- /.control-box -->
                                            </div>
                                            <!-- /.control -->
                                            <label for="advance_title"> Title Left </label>
                                            <div class="field-box">
                                                <input type="text" name="title_left" class="form-control" placeholder="Title Left">
                                            </div>
                                            <!-- /.field-box -->
                                            <label for="advance_title"> Advance Left Content </label>
                                            <div class="field-box">
                                                <textarea name="advance_left" id="" class="richText" cols="30" rows="10"></textarea>
                                                <!-- /# -->
                                            </div>
                                            <!-- /.field-box -->
                                            </div>
                                        <!-- /.form-group -->

                                </div>
                                <!-- /.fb-section -->
                                <div class="fb-section special">

                                    <div class="form-group">
                                            <div class="control">
                                                <span class="control-box update-advance"> <i class="fa fa-refresh"></i> </span>
                                                <!-- /.control-box -->
                                            </div>
                                            <!-- /.control -->
                                            <label for="advance_title_left"> Title Right </label>
                                            <div class="field-box">
                                                <input type="text" name="title_right" class="form-control" placeholder="Title Right">
                                            </div>
                                            <!-- /.field-box -->
                                            <label for="advance_title"> Advance Right Content </label>
                                            <div class="field-box">
                                                <textarea name="advance_right" id="" class="richText" cols="30" rows="10"></textarea>
                                                <!-- /# -->
                                            </div>
                                            <!-- /.field-box -->
                                        </div>
                                        <!-- /.form-group -->

                                </div>
                                <!-- /.fb-section -->
                            </div>
                            <!-- /#advantage -->
                        </div>
                        <!-- /.col-md-9 tabHolder -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>