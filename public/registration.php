<?php
/**
 * Created by PhpStorm.
 * User: noyon
 * Date: 1/7/2016
 * Time: 12:34 AM
 */
include('header.php');
/*
 * Register user and create a $_SESSION['new_user']
 * */

?>

<!-- Breadcrumb area -->
<div class="container-fluid bg-red breadcrumb">
    <div class="container">
        <h3 class="breadcrumb-title"> REGISTRATION </h3>
    </div>
</div>

<!-- Alert Message -->
<div class="container-fluid login_error alert alert-danger" role="alert">
    <div class="container"> <p> * Your Mobile/Email or password not valied ! </p></div>
</div>

<section class="container-fluid section bg-gray-img">
    <div class="container">
        <div class="login-form">


            <form id="loginform" action="<?php echo get_home_url() ?>/step_2.php" class="form-horizontal register_form" method="post" role="form">
                <div class="row">
                    <div class="col-md-2 registration-labels">
                        <p class="text-right"><label for="login-username"> User Name :  </label></p>
                    </div>

                    <div class="col-md-6">
                        <div class="marge-box">
                            <div class="icon-holder">
                                <span class="env"> <i class="fa fa-envelope"></i></span>
                                <span class="or">OR </span>
                                <span class="mob"> <i class="fa fa-mobile"></i></span>
                            </div>
                            <div  class="input-group top-0">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="uemail" type="text" class="form-control" name="email" value="" placeholder="Your Email ">
                                <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                <!--                                <span class="box-message color-red"> <span class="arrow_box"> Please type valied email ID. </span></span>-->
                            </div>
                            <div  class="input-group">
                                <span class="input-group-addon  mobile-addon"><i class="fa fa-mobile"></i></span>
                                <input id="login-username" type="text" class="form-control" name="mobile" value="" placeholder="Your Mobile No.">
                                <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                <!--                                <span class="box-message color-red"> <span class="arrow_box"> Please type only number </span></span>-->

                            </div>
                        </div>


                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2 registration-labels"><p class="text-right dd"><label for="login-password"> Password : </label></p></div>
                    <div class="col-md-6">
                        <div  class="input-group">
                            <span class="input-group-addon lock-addon"><i class="fa fa-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                            <!--                            <span class="box-message color-red"> <span class="arrow_box">Must be at least 6 character long </span></span>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 registration-labels"> <p class="text-right dd"><label for="login-password">Re-Password : </label></p></div>
                    <div class="col-md-6">
                        <div  class="input-group">
                            <span class="input-group-addon lock-addon"><i class="fa fa-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="re_password" placeholder="Retype Password">
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-offset-2 col-md-6 agree-checkbox">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success checkbox-btn">
                                <input type="checkbox" class="iagree" name="iagree" autocomplete="on">
                                <span class="fa fa-check color-success"></span>
                            </label>
                        </div>
                        <span class="agree-txt">  I Agree to The <a target="_blank" href="<?php echo get_home_url() ?>/terms_service.php"> Terms of Service </a></span>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-2 col-md-6">
                        <div  class="submit-btn">
                            <input type="submit" value="REGISTER" name="u_register" class="form-control btn btn-md  btn-red btn-fluid">
                        </div>
                        <p class="forgot-password text-right">   <a href="login.php" class="color-red"> Already Have An Account? Login </a>  </p>
                    </div>
                </div>
            </form>


        </div>
    </div>
</section>
<?php include('footer.php'); ?>
