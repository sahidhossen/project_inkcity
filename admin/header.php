<?php
require_once(dirname(dirname(__FILE__)) . '/load.php');
global $session;
if(!$session->is_logedIn()){
    safe_redirect(get_home_url().'/supper_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Welcome To Admin </title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap');?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap-theme');?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_files('font-awesome');?>">
<!--    right text editor-->
    <link rel="stylesheet" href="<?php echo admin_stylesheet();?>css/froala_editor.css">
    <link rel="stylesheet" href="<?php echo admin_stylesheet();?>css/froala_style.css">
    <link rel="stylesheet" href="<?php echo admin_stylesheet();?>css/plugins/code_view.css">
    <link rel="stylesheet" href="<?php echo admin_stylesheet();?>css/plugins/image_manager.css">
    <link rel="stylesheet" href="<?php echo admin_stylesheet();?>css/plugins/image.css">
    <link rel="stylesheet" href="<?php echo admin_stylesheet();?>css/plugins/table.css">
    <link rel="stylesheet" href="<?php echo admin_stylesheet();?>css/plugins/video.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

    <link rel="stylesheet" href="<?php echo admin_stylesheet('admin');?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img alt="Brand" class="img-responsive" src="<?php echo admin_url('home') ?>/assets/img/logo.png">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li class="active"><a href="<?php echo get_home_url() ?>/logout.php"> Logout </a></li>

            </ul>
        </div>
    </div>
</div>

<div id="wrapper" class="active">
