<?php
global $session, $main_db;
$user = new User();
$post = new posts();
$p_user = new PublicUser();

$hotline = $post->get_single_post_by('hotline');
$logo = $post->get_single_post_by('logo');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title> Ink City </title>
<!--    Twitter bootstrap -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap'); ?>">
     <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap-theme'); ?>">
<!--    Font Awesome -->
     <link rel="stylesheet" href="<?php echo get_stylesheet_files('font-awesome'); ?>">
<!--    owl carousel -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('owl.carousel'); ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('owl.theme'); ?>">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,600,700' rel='stylesheet' type='text/css'>
<!--    Custom Style -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('style') ?>">

</head>
<body>

<!-- Top header section -->
<div class="container-fluid bg-gray">
    <div class="container top-header"> <p class="text-right">  Arabic </p> </div>
</div>

<!-- Header section -->
<header class="container-fluid header bg-white">
    <div class="container">
        <nav class="navbar navbar-default">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                    <?php if(isset($logo->post_content)): ?>
                        <img src="<?php echo upload_dir().$logo->post_content; ?>" alt="">
                    <?php else: ?>
                        <img src="<?php echo get_stylesheet_uri('img') ?>logo.png" alt="">
                    <?php endif; ?>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <?php if(!$session->is_p_logedIn()):

                    ?>
                <div class="pull-right login-section">
                    <?php if(isset($hotline->post_content)): ?>
                    <div class="hotline">  <small class="color-red"> Hotline</small> <span class="special_fonts font-2x"> <?php echo $hotline->post_content; ?> </span>  </div>
                    <?php endif; ?>

                    <div class="registration_buttons">
                        <a class="btn btn-warning btn-red btn-md" href="<?php echo get_home_url(); ?>/login.php">Log in </a>
                        <a href="registration.php" class="btn btn-default btn-simple"> Registration </a>
                    </div>

                </div>
                <?php endif; ?>
                <ul class="nav navbar-nav navbar-right navmenu">
                    <li><a href="<?php echo get_home_url(); ?>#about"><span class="fa fa-simplybuilt fa-3x"></span> About Us </a></li>
                    <li><a href="#location"> <span class="fa fa-map-marker fa-3x"></span>Location </a></li>
                    <li><a href="#how_it_work"> <span class="fa fa-youtube fa-3x"></span>How It Work </a></li>
                    <li><a href="#contact"> <span class="fa fa-envelope fa-3x"></span>Contact Us </a></li>
                    <?php if($session->is_p_logedIn()):
                        $current_user = $p_user->get_user_by_id($session->p_userID);
                        ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <i class="fa fa-angle-down pull-right"></i> <br><small>balance: <?php echo $current_user->bal; ?> points</small></a>
                        <ul class="dropdown-menu">
                            <li data-target="profile" class="active"><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li data-target="upload_files"><a href="<?php echo get_home_url().'/user-admin.php'; ?>"><i class="fa fa-file-text-o"></i> My Document</a></li>
                            <li><a href="<?php echo get_home_url() ?>/logout.php"><i class="fa fa-power-off"> </i> Log Out</a></li>

                        </ul>
                    </li>
                    <?php endif;?>
                </ul>


            </div><!-- /.navbar-collapse -->

        </nav><!-- /.navbar -->
    </div>
</header>