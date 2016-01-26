<?php
require( dirname(__FILE__) . '/load.php' ); ?>
<?php
global $session, $main_db;
//echo $sesion->is_logedIn();
if($session->is_logedIn()){
     safe_redirect(admin_url('home'));
}

$user = new User();
global $main_db;
if(isset($_POST['login-submit'])) {
      $email = $_POST['email_id'];
      $password = $_POST['password'];


    if($current_user = $user->loged_in($email, $password)){
        $_SESSION['username'] = $current_user->id;
        $session->message("Welcome Mr. ".$current_user->username);
        safe_redirect(admin_url('home'));
        
    }else {
        $session->message("Sorry your username and password combination error ".$main_db->last_query);
        safe_redirect(get_home_url().'/supper_login.php');
    
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap'); ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap-theme'); ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('font-awesome'); ?>">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('style') ?>">
</head>
<body>
<div class="shadow">
    <div class="loginform">

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" id="register-form-link">Register</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php if($session->message()): ?>
                                <div class="alert alert-danger">
                                    <p> <?php echo $session->message(); ?></p>
                                </div>
                                <?php endif; ?>
                                <div class="col-lg-12">
                                    <form id="login-form" action="" method="post" role="form" style="display: block;">
                                        <div class="form-group">
                                            <input type="email" name="email_id" id="email_id" tabindex="1" class="form-control" placeholder="Username" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label for="remember"> Remember Me</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="register-form" action="#" method="post" role="form" style="display: none;">
                                        <div class="message_area">
<!--                                            <p class="error_msg"> Username must be greater than 6 character ! </p>-->
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email_id" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" language="javascript" src="<?php echo get_script_files('jquery-1.11.3'); ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('owl.carousel.min'); ?>"></script>

<script type="text/javascript" language="javascript" src="<?php echo get_script_files('bootstrap.min'); ?>"></script>

<script type="text/javascript" language="javascript" src="<?php echo get_script_files('core'); ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('script'); ?>"></script>


</body>
</html>

