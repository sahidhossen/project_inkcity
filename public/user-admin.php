<?php


/*
* This is User Admin page
* ALl of the site feature shows from here.
 * */
include ('header.php');
global $session;
if(!$session->is_p_logedIn()){
    safe_redirect(get_home_url().'/login.php');
}

global $main_db;
$history = new history();
?>

<section class="container-fluid admin-section section bg-gray-img">
    <div class="container">
        <div class="row">
            <div class="col-md-3 leftbar">
                <div class="content">
                    <ul class="admin_tab_list">
                        <li data-target="upload_files" class="active"> <i class="fa fa-file fa-2x"></i> My Documents </li>
                        <li data-target="history"> <i class="fa fa-history fa-2x"></i> History </li>
                        <li data-target="profile"> <i class="fa fa-user fa-2x"></i> Profile </li>
                        <li data-target="help"> <i class="fa fa-dribbble fa-2x"></i> Help </li>
                        <li><a href="<?php echo get_home_url() ?>/logout.php"><i class="fa fa-power-off fa-2x"></i> Log Out</a> </li>
                    </ul>
                </div>
                <!-- /.content -->
            </div>
            <!-- /.col-md-3 leftbar -->

            <div class="col-md-9 tab-content">
                <div class="content" id="admin_tab_holder">
                    <div class="tabcontent active" id="upload_files">
                        <div class="row bg-white ">
                            <div class="col-md-12 history-table" id="ajaxpdfList">
                                <!--Ajax file list -->
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <div class="row upload-top-section bg-white">
                            <div class="col-md-6 upload-button-top">
                                <p class="ajaxMsg"></p>

                                <form action="" id="fileploadForm" enctype="multipart/form-data">
                                <p>
                                    <a href="#" class="btn btn-default btn-upload btn-lg upload">
                                        <i class="fa fa-cloud-upload"></i> Upload
                                    </a>
                                    <input class="fileupload" name="upload_file[]" type="file" multiple>
                                </p>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div id="custom-search-input">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-lg" placeholder="Search" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-lg" type="button">
                                                <i class="fa fa-search fa-2x"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                            <!-- /.col-md-6 -->
                        </div>
                        <!-- /.row -->
                        <div class="row upload_file_info upload_data">
                            <?php echo get_pageniation_result(); ?>
                            <!-- /.table table-bordered -->
                        </div>
                        <!-- /.row upload_file_info -->

                        <!-- /.row pagination_box -->

                    </div>
                    <!-- /.tabcontent -->
                    <div class="tabcontent" id="history">
                        <p class="text-right clearhistory"> <a href="#" class="color-red">  Clear all my history</a></p>
                        <!-- /.text-right -->
                        <div class="row upload_file_info">
                            <table class="table table-bordered history-data">
                                <thead>
                                <tr>
                                    <th> Action </th>
                                    <th> Timesstamp </th>
                                    <th> Details </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $all_history = $history->get_history(10);
                                if($all_history != NULL ):
                                    foreach($all_history as $item ):
                                ?>
                                <tr data-id="<?php echo $item->id ?>">
                                    <td> <p>  <?php echo $item->action; ?> </p></td>
                                    <td> <p> <?php echo date('H:i A',strtotime($item->upd)); ?>  / <?php echo date('m-d-y',strtotime($item->upd)) ?></p></td>
                                    <td>
                                        <p class="pull-left color-red"> File Name : <?php echo $item->descr; ?> - 23 pages - 30 points </p>
                                        <p class="pull-right">
                                            <a href="#"><span class="fa fa-eye fa-2x"></span></a> &nbsp;
                                            <a href="#" class="cancel btn btn-radius btn-cancel delete_history"><span class="fa fa-times fa-1x"></span></a>
                                        </p>
                                    </td>
                                </tr>
                                    <?php endforeach; else: ?>
                                <tr>
                                   <td colspan="11">
                                       <h3 class="empty-title blank-template text-center"> Your history is cleaned! </h3>
                                   <!-- /.empty -->
                                   </td>
                                </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                            <!-- /.table table-bordered -->
                        </div>
                        <!-- /.row upload_file_info -->

                    </div>
                    <!-- /.history -->
                    <div class="tabcontent" id="profile">
                        <div class="profilemain">
                            <div class="profile-title bg-gray-dark"> <h3 class="title"> My Profile </h3> </div>
                            <!-- /.profile-title -->
                            <div class="profile-body bg-white">
                                <div class="form-section1">
                                    <h3 class="form-title"> Change Account (Email/Mobile) </h3>

                                    <!-- /.form-title -->
                                    <div class="form-elements">
                                        <form method="post" class="form form-horizontal send_code_email">
                                            <p class="alert alert-danger login_error admin_error"> Please check your password or email ! </p>
                                            <div class="row form-group">
                                                <div class="col-md-3 label-area"> <label for="currentEmail"> Current Email </label></div>
                                                <!-- /.col-md-2 label-area -->
                                                <div class="col-md-8 elements">
                                                    <div class="input-group">
                                                        <input type="text" name="current_email" class="form-control" value="" placeholder="m******@yahoo.com">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-3 label-area"> <label for="currentEmail"> New Email </label></div>
                                                <!-- /.col-md-2 label-area -->
                                                <div class="col-md-8 elements">
                                                    <div class="input-group">
                                                        <input type="text" name="new_email" class="form-control" value="" placeholder="">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-offset-3 col-md-8 elements">
                                                    <div class="col-md-6 col-sm-6 col-xs-6  padding-0">
                                                        <a href="#" class="get_invalid_msg hide" data-target="send_error" data-type="slide"></a>
                                                        <a href="#" class="allmost_done_msg hide" data-target="allmost_done" data-type="slide"></a>
                                                        <input type="submit" name="get_code" value="Get Activate Code" class="btn btn-success btn-lg btn-simple get_code">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>

                                                    </div>
                                                   <div class="col-md-6 col-sm-6 col-xs-6 padding-0 special_box">
                                                       <span class="input-group-addon box-singnal color-success"> <i class="fa fa-check"> </i></span>
                                                      <input type="text" name="email_varification_code" class="form-control varification_code" value="" placeholder="">

                                                   </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-offset-3 col-md-8 elements">
                                                    <a href="#" class="email_change_success hide" data-target="success_code_message" data-type="slide"></a>
                                                    <a href="#" class="email_change_code_invalied hide" data-target="code_note_match" data-type="slide"></a>
                                                    <input type="submit" name="email_change" class="btn btn-danger btn-danger-dark btn-lg" value="Save">
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                        </form>
                                        <!-- /.form form-horizontal -->
                                    </div>
                                    <!-- /.form-elements -->
                                </div>
                                <!-- /.form-section1 -->
                                <div class="form-section2">

                                    <div class="form-elements">
                                        <form method="post" class="form form-horizontal send_code_mobile">
                                            <p class="alert alert-danger login_error admin_error"> Please check your password or email ! </p>
                                            <div class="row form-group">
                                                <div class="col-md-3 label-area"> <label for="currentEmail"> Current Mobile </label></div>
                                                <!-- /.col-md-2 label-area -->
                                                <div class="col-md-8 elements">
                                                    <div class="input-group">
                                                        <input type="text" name="current_mobile" class="form-control" value="" placeholder=" ">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-3 label-area"> <label for="currentEmail"> New Mobile </label></div>
                                                <!-- /.col-md-2 label-area -->
                                                <div class="col-md-8 elements">
                                                    <div class="input-group">
                                                        <input type="text" name="new_mobile" class="form-control" value="" placeholder="">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-offset-3 col-md-8 elements">
                                                    <div class="col-md-6 col-sm-6 col-xs-6 padding-0">
                                                        <input type="submit" name="get_code_no" value="Get Activate Code" class="btn btn-success btn-lg btn-simple get_code_no">
                                                        <a href="#" class="get_invalid_msg hide" data-target="send_error" data-type="slide"></a>
                                                        <a href="#" class="allmost_done_msg hide" data-target="allmost_done" data-type="slide"></a>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 padding-0 special_box">
                                                        <span class="input-group-addon box-singnal color-success"> <i class="fa fa-check"> </i></span>
                                                        <input type="text" class="form-control varification_code" value="As5TK89" placeholder="">

                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-offset-3 col-md-8 elements">
                                                    <input type="submit" name="mobile_change" class="btn btn-danger btn-danger-dark btn-lg" value="Save">
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                        </form>
                                        <!-- /.form form-horizontal -->
                                    </div>
                                    <!-- /.form-elements -->
                                </div>
                                <!-- /.form-section2 -->
                                <div class="form-section3">
                                    <h3 class="form-title"> Change Password  </h3>
                                    <!-- /.form-title -->
                                    <div class="form-elements">
                                        <form  class="form form-horizontal change_password">
                                            <p class="alert alert-danger login_error admin_error"> Please check your password or email ! </p>
                                            <div class="row form-group">
                                                <div class="col-md-3 label-area"> <label for="currentEmail">Current Password </label></div>
                                                <!-- /.col-md-2 label-area -->
                                                <div class="col-md-8 elements">
                                                    <div class="input-group">
                                                        <input type="password" name="current_password" class="form-control" value="" placeholder="">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-3 label-area"> <label for="currentEmail"> New Password </label></div>
                                                <!-- /.col-md-2 label-area -->
                                                <div class="col-md-8 elements">
                                                    <div class="input-group">
                                                        <input type="password" name="new_password" class="form-control" value="" placeholder="">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-3 label-area"> <label for="currentEmail">Re-New Password </label></div>
                                                <!-- /.col-md-2 label-area -->
                                                <div class="col-md-8 elements">
                                                    <div class="input-group">
                                                        <input type="password" name="re_new_pass" class="form-control" value="" placeholder="">
                                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="row form-group">
                                                <div class="col-md-offset-3 col-md-8 elements">
                                                    <a href="#" class="get_invalid_msg_pass hide" data-target="send_error" data-type="slide"></a>
                                                    <a href="#" class="success_msg hide" data-target="success_code_message" data-type="slide"></a>
                                                    <input type="submit" name="submit" class="btn btn-danger btn-danger-dark btn-lg" value="Save">
                                                </div>
                                                <!-- /.col-md-8 elements -->
                                            </div>
                                            <!-- /.form-group -->
                                        </form>
                                        <!-- /.form form-horizontal -->
                                    </div>
                                    <!-- /.form-elements -->
                                </div>
                                <!-- /.form-section2 -->
                            </div>
                            <!-- /.profile-body -->
                        </div>
                        <!-- /.profilemain -->
                    </div>
                    <!-- /.history -->
                    <div class="tabcontent" id="help">
                        <div class="helpmain">
                            <div class="helptitle bg-gray-dark">
                                <h3 class="title">  Help </h3>
                            </div>
                            <!-- /.helptitle -->
                            <div class="help-body bg-white">
                                <div class="section1">
                                    <h3 class="title color-red"> Prices </h3>
                                    <!-- /.title color-red -->
                                    <div class="content">
                                        <p> * <span class="color-red">1</span>SAR = <span class="color-red">3</span> Point</p>
                                        <p> * <span class="color-red">1</span>Point = <span class="color-red">1</span>Page in Color or Black & Black</p>
                                        <p> * We Accepts <span class="color-red">1</span>SAR, <span class="color-red">5</span>SAR, <span class="color-red">5</span>SAR, <span class="color-red">100</span>SAR  Bills</p>
                                        <p> You can Insert Bills at any Time When using your Service</p>
                                    </div>
                                    <!-- /.content -->
                                    <h3 class="title color-red"> My Documents </h3>
                                    <div class="content">
                                        <p> * <span class="color-red">1</span>SAR = <span class="color-red">3</span> Point</p>
                                        <p> * <span class="color-red">1</span>Point = <span class="color-red">1</span>Page in Color or Black & Black</p>
                                        <p> * We Accepts <span class="color-red">1</span>SAR, <span class="color-red">5</span>SAR, <span class="color-red">5</span>SAR, <span class="color-red">100</span>SAR  Bills</p>
                                        <p> You can Insert Bills at any Time When using your Service</p>
                                    </div>
                                    <!-- /.content -->
                                    <h3 class="title color-red"> USB </h3>
                                    <div class="content">
                                        <p> * <span class="color-red">1</span>SAR = <span class="color-red">3</span> Point</p>
                                        <p> * <span class="color-red">1</span>Point = <span class="color-red">1</span>Page in Color or Black & Black</p>
                                        <p> * We Accepts <span class="color-red">1</span>SAR, <span class="color-red">5</span>SAR, <span class="color-red">5</span>SAR, <span class="color-red">100</span>SAR  Bills</p>
                                        <p> You can Insert Bills at any Time When using your Service</p>
                                    </div>
                                    <!-- /.content -->
                                </div>
                                <!-- /.section1 -->
                            </div>
                            <!-- /.help-body -->
                        </div>
                    </div>
                    <!-- /.history -->
                    <div class="tabcontent" id="logout">
<!--                        This is Logout-->
                    </div>

                </div>
                <!-- /.content -->
            </div>
            <!-- /.col-md-9 tab-content -->
        </div>
        <!-- /.row -->
    </div>
</section>
<?php include('admin-footer.php') ?>