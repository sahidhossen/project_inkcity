<?php
/**
 * Created by PhpStorm.
 * User: noyon
 * Date: 1/7/2016
 * Time: 12:34 AM
 */
include('header.php');

/*
 * Confirm if user enter exact code
 * If not then send him code again
 * */

var_dump($_SESSION['new_user']);
?>

<!-- Breadcrumb area -->
<div class="container-fluid bg-red breadcrumb">
    <div class="container">
        <h3 class="breadcrumb-title"> REGISTRATION </h3>
    </div>
</div>

<!-- Alert Message -->
<div class="container-fluid login_error alert alert-danger" role="alert">
    <div class="container"> <p> * Your code or password not matched ! </p></div>
</div>

<section class="container-fluid section bg-gray-img">
    <div class="container">
        <div class="login-form">
            <form id="activate_registration" class="form-horizontal register_form" role="form">

                <div class="row">
                    <div class="col-md-6 registration-labels">
                        <div  class="input-group">
                            <span class="input-group-addon lock-addon"><i class="fa fa-gear"></i></span>
                            <input id="activate" type="text" class="form-control" name="activate_confirm" placeholder="Code">
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                            <!--<span class="box-message color-red"> <span class="arrow_box">Must be at least 6 character long </span></span>-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" value="Activate" class="form-control btn btn-lg btn-red btn-fluid">
                        <a href="#" class="get_invalid_msg_pass hide" data-target="send_error" data-type="slide"></a>
                        <a href="#" class="registration_success hide" data-target="success_code_message" data-type="slide"></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div  class="submit-btn">
                            <p> <a href="#"   class="btn btn-lg  btn-default btn-fluid varification_resend"> Re-send the activation code</a></p>
                            <p class="hide"> <a href="#" data-target="varification_resend"  data-type="slide" class="btn btn-lg  btn-default btn-fluid varification_resend_next"> Re-send the activation code</a></p>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</section>

<?php include('footer.php'); ?>
