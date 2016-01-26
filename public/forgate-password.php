<?php
/**
 * forget password page
 *
 */
include('header.php');
?>


<!-- Breadcrumb area -->
<div class="container-fluid bg-red breadcrumb">
    <div class="container">
        <h3 class="breadcrumb-title"> Forgotten your Password ?  </h3>
    </div>
</div>

<section class="container-fluid section bg-gray-img">
    <div class="container">

        <div class="forgotten-box">
            <div class="row bg-red">
                <div class="forgetten-title">
                    <h3 class="title"> <span class="fa fa-warning"></span> FORGET PASSWORD ? </h3>
                    <!-- /.title -->
                </div>
            </div>
            <!-- /.row   -->
            <div class="row forgotten-body">
                <div class="col-md-6 left-send-form">
                    <div class="sendForm">
                        <p> Type your email address or mobile </p>
                        <p> number to receive a password resete code</p>
                        <form method="post" class="form-horizontal form-send form-send-code">
                            <span class="or"> OR </span>
                            <!-- /.or -->
                            <div class="row binding-form-box">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="email_id" type="text" class="form-control" placeholder="Your Email">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->
                            <div class="row binding-form-box">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="mobile_no" type="text" class="form-control" placeholder="Mobile No.">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-button">
                                        <button type="submit" class="form-control btn btn-red btn-lg " ><span class="fa fa-check"></span> <span class="btn-txt">
                                    <!-- /.btn-txt --> SEND </span></button>
                                        <a href="#" class="hide show_warning_msg" data-target="send_password_warning" data-type="'slide"> &nbsp;</a>
                                        <a href="#" class="hide show_allmost_done_msg" data-target="allmost_done_fp" data-type="'slide"> &nbsp;</a>
                                    </div>
                                    <!-- /.form-button -->
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->
                        </form>
                        <!-- /.form-horizontal form-send -->
                    </div>
                    <!-- /.sendForm -->
                </div>

                <div class="col-md-6 right-check-form">
                    <div class="form_hover"> &nbsp; </div>
                    <div class="checkForm">
                        <form class="form-horizontal form-send form-change-password">
                            <div class="row binding-form-box">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="code" class="form-control" placeholder="Code">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->
                            <div class="row binding-form-box">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" name="new_pass" class="form-control" placeholder="New Password">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->
                            <div class="row binding-form-box">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" name="re_pass" class="form-control" placeholder="Retype New Password">
                                        <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-button">
                                        <button class="form-control btn btn-red btn-lg"><span class="fa fa-check"></span> CHANGE PASSWORD </button>
                                        <a href="#" class="hide show_success_msg" data-target="send_password_success" data-type="'slide"> &nbsp;</a>
                                        <a href="#" class="hide show_error_msg" data-target="send_password_error" data-type="'slide"> &nbsp;</a>
                                    </div>
                                    <!-- /.form-button -->
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->
                        </form>
                        <!-- /.form-horizontal form-send -->
                    </div>
                    <!-- /.checkform -->
                </div>
            </div>

        </div>
    </div>
</section>
<?php include('admin-footer.php'); ?>
