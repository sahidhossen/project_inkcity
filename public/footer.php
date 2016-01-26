<?php
$post = new posts();

$logo = $post->get_single_post_by('footer_logo');
$socials = social_urls();

?>
<!-- Footer section -->

<footer class="container-fluid bg-red">
    <div class="container footer-padding">
        <div class="col-md-4 copyright">
            <p class="text-left">
                <a href="<?php echo get_home_url(); ?>">
                    <?php if(isset($logo->post_content)): ?>
                        <img src="<?php echo upload_dir().$logo->post_content; ?>" alt="">
                    <?php else: ?>
                        <img src="<?php echo get_stylesheet_uri('img') ?>footer-logo.png" alt="">
                    <?php endif; ?>
                </a>
                <span class="copyright-txt"> Allright Reserved <i class="fa fa-copyright"></i>
                    <a href="#">ePrinting.sa</a> 2015 </span>
            </p>
        </div>
        <div class="col-md-4">
            <div class="footer-links">
                <ul>
                    <li><a href="terms_service.php">Terms of use </a></li>
                    <li><a href="terms_service.php"> Privacy </a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <ul class="social_links">
                <li><a href="<?php echo $socials['facebook']; ?>"> <span class="fa fa-facebook"></span></a></li>
                <li><a href="<?php echo $socials['twitter']; ?>"> <span class="fa fa-twitter"></span></a></li>
                <li><a href="<?php echo $socials['youtube']; ?>"> <span class="fa fa-youtube"></span></a></li>
                <li><a href="<?php echo $socials['google']; ?>"> <span class="fa fa-google-plus"></span></a></li>
            </ul>
        </div>
    </div>
</footer>


<div class="popup-shadow" id="success_code_message">
    <div class="popup_main">
        <div class="popup_head">
            <div class="checkbox success">
                <span class="fa fa-check"></span>
                <!-- /.fa fa-check -->
            </div>
            <span class="trash close-modal"> <i class="fa fa-times"></i></span>
            <!-- /.trash -->
            <!-- /.checkbox -->
        </div>
        <div class="popup_body arrow_box">
            <p class="text-center change_success_full_msg"> Your Registration Successfull ! </p>
        </div>
        <div class="popup_footer bg-success">
            <p class="text-center"> <a href="login.php" class="btn btn-red btn-lgx"> Login </a></p>
        </div>
    </div>
</div>
<!-- /.popup-shadow -->
<div class="popup-shadow" id="send_error">
    <div class="popup_main">
        <div class="popup_head">
            <div class="checkbox warn">
                <span class="fa fa-check"></span>
                <!-- /.fa fa-check -->
            </div>
            <span class="trash close-modal"> <i class="fa fa-times"></i></span>
            <!-- /.trash -->
            <!-- /.checkbox -->
        </div>
        <div class="popup_body arrow_box">
            <p class="text-center message color-red sendMessage">Your activation code invalied ! </p>

        </div>
        <div class="popup_footer bg-warning">
            <p class="text-center"> <a href="#" class="btn btn-red btn-lg trash"> TRY AGAIN</a></p>
        </div>
    </div>
</div>
<!-- /.popup-shadow -->


<div class="popup-shadow" id="varification_resend">
    <div class="popup_main">
        <div class="popup_head">
            <div class="checkbox info">
                <span class="fa fa-info-circle"></span>
                <!-- /.fa fa-check -->
            </div>
            <span class="trash close-modal"> <i class="fa fa-times"></i></span>
            <!-- /.trash -->
            <!-- /.checkbox -->
        </div>
        <div class="popup_body arrow_box">
            <p class="text-center message"> Almost done! </p>
            <p class="text-center"> Varification code sended. Please check your message! </p>
        </div>
        <div class="popup_footer bg-info">
            <p class="text-center">
                <!--                <span><a href="#" class="btn btn-red btn-lg trash"> RESEND </a></span>-->
                <!--                <span> OR </span>-->
                <span> <a href="#" class="btn btn-red btn-lg trash"> Ok </a></span>
            </p>
        </div>
    </div>
</div>
<!-- /.popup-shadow -->
<script type="text/javascript">
    var map_default_lat = 23.810332;
    var map_default_lng = 90.412518;
    var map_default_zoom = 12;
    var map_default_typeid = "roadmap";
</script>

<!--main script file-->
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('jquery-1.11.3'); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('owl.carousel.min'); ?>"></script>

<script type="text/javascript" language="javascript" src="<?php echo get_script_files('bootstrap.min'); ?>"></script>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJL7v3Ur_ecGSapUWBBHwrkwueYAOLxXY&sensor=false"></script>-->
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=geometry"></script>

<script type="text/javascript" language="javascript" src="<?php echo get_script_files('core'); ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('script'); ?>"></script>
<!-- Set initial values for map -->

<!-- Drawonmaps JS files -->
<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/gmaps.js"></script>
<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/prettify.js"></script>
<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/drawonmaps_markers.js"></script>
<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/drawonmaps.js"></script>
<script type="text/javascript" src="<?php echo admin_stylesheet();?>js/drawonmaps_map_display.js"></script>

<?php
$post = new posts();

$footer_map = $post->get_single_post_by('contact');
$lat = '44.5403';
$lang = '-78.5463';
if($footer_map !=NULL ) {
    $footer_map = explode('&', $footer_map->post_content);
    if(is_array($footer_map)){
        $lat = $footer_map[1];
        $lang = $footer_map[0];
    }
}


/*
 * Get all map location
 * */

$map_obj = new SiteMaps();
$map_objects = $map_obj->getMapsObjects();


// get availble map objects for using
$available_objects = SiteConf::$MAP_OBJECTS_AVAILABLE;

?>
<script>
    $(document).ready(function(){
        var objectsBounds = new google.maps.LatLngBounds();
        <?php
            foreach ($map_objects as $obj)	{
        ?>
        var tmp_coords = [];
        var coords = "<?php echo $obj->coords; ?>";
        <?php
                if ($obj->object_id == 1 && is_object_enabled('marker', $available_objects))  {  // load markers if exist and are enable
                    $map_markers_exists = true;
        ?>
        tmp_coords = getDataFromArray(coords);

        loadMarker(tmp_coords[0], tmp_coords[1], "<?php echo $obj->title; ?>", "<?php echo $obj->marker_icon; ?>", false);
        var myLatlng = new google.maps.LatLng(tmp_coords[0],tmp_coords[1]);
        objectsBounds.extend(myLatlng);
        <?php
                }
                else if ($obj->object_id == 2 && is_object_enabled('line', $available_objects))  {  // load polylines if exist and are enable
                    $map_polylines_exists = true;
        ?>
        tmp_coords = getPathFromCoordsArray(coords);
        var getbounds = loadPolyline(tmp_coords, "<?php echo $obj->title; ?>");
        objectsBounds.union(getbounds);

        <?php
                }
                else if ($obj->object_id == 3 && is_object_enabled('polygon', $available_objects))  {  // load polygons if exist and are enable
                    $map_polygons_exists = true;
        ?>
        tmp_coords = getPathFromCoordsArray(coords);
        var getbounds = loadPolygon(tmp_coords, "<?php echo $obj->title; ?>");
        objectsBounds.union(getbounds);
        <?php
                }
                else if ($obj->object_id == 4 && is_object_enabled('rectangle', $available_objects))  {  // load rectangles if exist and are enable
                    $map_rectangles_exists = true;
        ?>
        tmp_coords = getDataFromArray(coords);
        path_rect = [];
        path_rect.push(addCoordsToArray(tmp_coords[0], tmp_coords[1]));
        path_rect.push(addCoordsToArray(tmp_coords[2], tmp_coords[3]));
        var getbounds = loadRectangle(path_rect, "<?php echo $obj->title; ?>");
        objectsBounds.union(getbounds);
        <?php
                }
                else if ($obj->object_id == 5 && is_object_enabled('circle', $available_objects))  {  // load circles if exist and are enable
                    $map_circles_exists = true;
        ?>
        tmp_coords = getDataFromArray(coords);
        var getbounds = loadCircle(tmp_coords[0], tmp_coords[1], parseInt(tmp_coords[2]), "<?php echo $obj->title; ?>");
        objectsBounds.union(getbounds);
        <?php
                }
            }
        ?>

        map.fitBounds(objectsBounds);
    })
</script>
<script>
    jQuery(document).ready(function() {
//        google.maps.event.addDomListener(window, 'load', location_map_intialize);

        google.maps.event.addDomListener(window, 'load', initializes);
    })





    function initializes() {
        var mapCanvas = document.getElementById('contact-map');
        var mapOptions = {
            center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lang; ?>),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(mapCanvas,
            mapOptions);

        var marker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
        });
        var map = new google.maps.Map(mapCanvas, mapOptions)
    }





</script>


</body>
</html>