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
global $session;

public_login();

if($session->is_p_logedIn()){
    safe_redirect(get_home_url());
}
?>

<!-- Breadcrumb area -->
<div class="container-fluid bg-red breadcrumb">
    <div class="container">
        <h3 class="breadcrumb-title"> LOGIN </h3>
    </div>
</div>

<!-- Alert Message -->
<div class="container-fluid alert alert-danger login_error" role="alert">
    <div class="container"> <p> * The username or password you entered was incorrect ! </p></div>
</div>

<?php if(!empty($session->message)): ?>
<div class="container-fluid alert alert-danger" role="alert">
    <div class="container"> <p> <?php echo $session->message(); ?></p></div>
    <!-- /.container -->
</div>
<?php endif; ?>

<section class="container-fluid section bg-gray-img">
    <div class="container">
        <div class="login-form">


            <form id="loginform" class="form-horizontal" method="post" role="form">
                <div class="row">
                    <div class="col-md-2 labels">
                        <p class="text-right login-username"><label for="login-username"> Username :  </label></p>
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
                                <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="Your Email ">
                                <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                            </div>
                            <div  class="input-group">
                                <span class="input-group-addon  mobile-addon "><i class="fa fa-mobile"></i></span>
                                <input id="login-username" type="text" class="form-control" name="mobile" value="" placeholder="Your Mobile No.">
                                <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 labels">
                        <p class="text-right login-password"><label for="login-password"> Password :  </label></p>
                    </div>
                    <div class="col-md-6">
                        <div  class="input-group">
                            <span class="input-group-addon lock-addon"><i class="fa fa-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                        </div>

                        <div  class="submit-btn">
                            <input type="submit" name="login_submit" value="Login" class="form-control btn btn-md  btn-red btn-fluid">
                        </div>
                        <p class="forgot-password text-right"> <span class="fa fa-warning"></span>  <span> <a
                                    href="forgate-password.php" class="color-red"> Forgot Password or Username? </a></span> </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
