<?php
require_once(dirname(dirname(__FILE__)) . '/load.php');
global $session;
if(!$session->is_logedIn()){
	safe_redirect(get_home_url().'/supper_login.php');
}
 include('views/page_fns.php');
?>

<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>
    <head>
		<title><?php echo ($vars['html_title']?$vars['html_title'].' - '.$lang_msg['HTML_TITLE']:$lang_msg['HTML_TITLE']); ?></title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=geometry"></script>

		<!-- Set initial values for map -->
		<script type="text/javascript">
			var map_default_lat = <?php echo $vars['default_lan']; ?>;
			var map_default_lng = <?php echo $vars['default_lng']; ?>;
			var map_default_zoom = <?php echo $vars['default_zoom']; ?>;
			var map_default_typeid = "<?php echo $vars['default_typeid']; ?>";
		</script>

		<!-- Drawonmaps JS files -->
		<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/gmaps.js"></script>
		<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/prettify.js"></script>
		<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/drawonmaps_markers.js"></script>
		<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/drawonmaps.js"></script>
		<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/drawonmaps_map_display.js"></script>

		<!-- Bootstrap JS -->
		<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/bootstrap.min.js"></script>
		<!--<script type="text/javascript" src="bootstrap/bootstrap-select/bootstrap-select.min.js"></script>-->
		<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/validator.min.js"></script>

		<!-- Drawonmaps CSS files -->


		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap');?>">
        <link rel="stylesheet" href="<?php echo get_stylesheet_files('bootstrap-theme');?>">
        <link rel="stylesheet" href="<?php echo admin_stylesheet('bootstrap-select.min');?>">


		<link href="<?php echo get_stylesheet_files('bootstrap-select.min');?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo get_stylesheet_files('font-awesome');?>">
		<!-- Just for debugging purposes. Don\'t actually copy these 2 lines! -->
		<!--[if lt IE 9]>
		<script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="<?php echo admin_stylesheet();?>js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

        <link rel="stylesheet" href="<?php echo admin_stylesheet('admin');?>">

		<?php
		// do not show all CSS if only map display option is asked
		if ($vars['map_o'])
		{
			?>
			<link href="<?php echo admin_stylesheet('drawonmaps_map_o');?>" rel="stylesheet" type="text/css" />
			<?php
		}
		else {
			?>
			<link href="<?php echo admin_stylesheet('drawonmaps');?>" rel="stylesheet" type="text/css" />
		<?php } ?>
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
