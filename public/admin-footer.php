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


<div class="popup-shadow" id="send_password_success">
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
            <p class="text-center message"> The Password Reset Succesfull </p>
        </div>
        <div class="popup_footer bg-success">
            <p class="text-center"> <a href="login.php" class="btn btn-red btn-lg">LOGIN <i class="fa fa-chevron-right"></i></a></p>
        </div>
    </div>
</div>
<!-- /.popup-shadow -->
<div class="popup-shadow" id="send_password_warning">
    <div class="popup_main">
        <div class="popup_head">
            <div class="checkbox warn">
                <span class="fa fa-ban"></span>
                <!-- /.fa fa-check -->
            </div>
            <span class="trash close-modal"> <i class="fa fa-times"></i></span>
            <!-- /.trash -->
            <!-- /.checkbox -->
        </div>
        <div class="popup_body arrow_box">
            <p class="text-center message"> Email/mobile or password not currect! </p>
        </div>
        <div class="popup_footer bg-warning">
            <p class="text-center"> <a href="#" class="btn btn-red btn-lg trash"> TRY AGAIN</a></p>
        </div>
    </div>
</div>

<div class="popup-shadow" id="send_password_error">
    <div class="popup_main">
        <div class="popup_head">
            <div class="checkbox warn">
                <span class="fa fa-ban"></span>
                <!-- /.fa fa-check -->
            </div>
            <span class="trash close-modal"> <i class="fa fa-times"></i></span>
            <!-- /.trash -->
            <!-- /.checkbox -->
        </div>
        <div class="popup_body arrow_box">
            <p class="text-center message"> Your password not match! </p>
        </div>
        <div class="popup_footer bg-warning">
            <p class="text-center"> <a href="#" class="btn btn-red btn-lg trash"> TRY AGAIN</a></p>
        </div>
    </div>
</div>

<div class="popup-shadow" id="allmost_done_fp">
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
            <p class="text-center"> <small> Varification code sended. Please check your message
                    <!-- /.active_account --></small></p>
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



<!--
============================================
Only For User Admin
============================================
-->

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
            <p class="text-center change_success_full_msg"> The Password Reset Succesfull </p>
        </div>
        <div class="popup_footer bg-success">
            <p class="text-center"> <a href="#" class="btn btn-red btn-lg trash"> Close </a></p>
        </div>
    </div>
</div>
<!-- /.popup-shadow -->

<div class="popup-shadow" id="allmost_done">
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
            <p class="text-center">  Varification code sended. Please check your message! </p>
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
            <p class="text-center message color-red sendMessage">Email/mobile or password not currect</p>

        </div>
        <div class="popup_footer bg-warning">
            <p class="text-center"> <a href="#" class="btn btn-red btn-lg trash"> TRY AGAIN</a></p>
        </div>
    </div>
</div>
<!-- /.popup-shadow -->

<div class="popup-shadow" id="code_note_match">
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
            <p class="text-center message color-red varification_error_msg">Your varification code note match!</p>

        </div>
        <div class="popup_footer bg-warning">
            <p class="text-center"> <a href="#" class="btn btn-red btn-lg trash"> TRY AGAIN</a></p>
        </div>
    </div>
</div>
<!-- /.popup-shadow -->

<div class="file_upload_footer_msg bg-info hide">
    <div class="container">
        <div class="progressbar">

            <div class="progress_sec row">
                <div class="col-md-8">
                    <p> <small> Upload <span class="totalFile"> 1 </span> file <span class="show_length">47.89 KB</span></small></p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
                            <div class="percent" style="left:0%"> <span class="arrow_box">25%</span></div>
                            <!-- /.20 -->
                        </div>
                    </div>
                </div>
                <!-- /.col-md-8 -->
                <div class="col-md-4">
                    <p> <a href="#" class="btn btn-cancel btn-md btn-radius"> Cancel <i class="fa fa-times"></i></a></p>
                </div>
                <!-- /.col-md-4 -->
            </div>
        </div>
    </div>
</div>


<!--
Show only uploaded files
-->

<div class="show_files">

    <div class="modal_main">
        <a href="#" class="close_modal"> <i class="fa fa-times"> </i></a>
        <div class="item">
             <!-- show items -->
        </div>
        <!-- /.item -->
    </div>

</div>


<!--main script file-->
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('jquery-1.11.3'); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('owl.carousel.min'); ?>"></script>

<script type="text/javascript" language="javascript" src="<?php echo get_script_files('bootstrap.min'); ?>"></script>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('core'); ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_script_files('script'); ?>"></script>




</body>
</html>