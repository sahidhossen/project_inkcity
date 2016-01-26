<?php
/*
 * Main index page
 * ALl of the site feature shows from here.
 * */

//Include Header file
 include('header.php');
global $session;
$post = new posts();


?>
<div class="container-fluid bg-gray">
    <div class="row">
       <?php
       /*
        * Top slider
        * */
       include('templates/top-slide.php'); ?>

    </div>
</div>

<!-- Welcom section -->
<section class="container-fluid section bg-gray bg-gray-img">

    <div class="container" id="about">

        <div class="row">
           <?php
           /*
            * Welcome tab Template
            * */
           include('templates/welcome-tab.php');
           ?>
        </div>

        <div class="row padding-20">
            <?php

            /*
             * Advance template
             * */
            include('templates/advance.php');
            ?>
        </div>

    </div>
</section>
<section class="container-fluid bg-white" id="location">
    <div class="container">
        <div class="row">
            <div class="col-md-3 padding-0 location">
                <h3 class="title bg-red"> LOCATION </h3>
                <div class="content">
                    <p class="text-center"> <span class="fa fa-map-marker fa-4x"></span></p>
                    <p class="text-center"> Find the nearest <br> Electronic Printing </p>
                    <div class="subscribe">
                        <form class="form form-location" id="geocoding_form">
                            <div class="input-group">
                                <input class="btn btn-md" name="map-location" id="address" type="text" placeholder="Type Location" required>
                                <button class="btn btn-info btn-md map_location_submit" type="submit"> >> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-9 map-holder padding-left-30">
                <div id="map"></div>
            </div>
        </div>
    </div>
</section>


<!-- Customer and Partner Section -->

<section class="container-fluid bg-gray-img section customer-section" id="how_it_work">
    <div class="container">
        <div class="row">
            <div class="col-md-6 customer-slide-main">
                <div class="content bg-white">
                    <h3 class="title color-red text-center"> OUR CUSTOMERS </h3>

                    <?php
                    /*
                     * Customer slider template
                     * */
                    include('templates/customer-slide.php');
                    ?>

                </div>
            </div>

            <!-- Partner slider -->
            <div class="col-md-6 customer-slide-main">
                <div class="content bg-white">
                    <h3 class="title color-red text-center">OUR PARTNERS </h3>
                    <div class="customer-map">
                        <span class="line"></span>
                    </div>

                     <?php
                     /*
                      * Partner Slide
                      * */
                     include('templates/partner-slide.php');
                     ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid bd-white section contact-section" id="contact">
    <div class="container">
        <?php $contact = $post->get_single_post_by('address'); ?>
        <h3 class="title color-red text-center"> <?php echo (isset($contact->post_title)) ? strtoupper($contact->post_title) : 'CONTACT'; ?> </h3>
        <div class="row">
            <div class="col-md-5">
                <div class="contact-form">
                    <address>
                        <?php echo (isset($contact->post_content)) ? $contact->post_content : 'Post your contact details'; ?>
                    </address>

                    <form class="form-horizontal" id="send_contact" method="post">
                        <div class="message_area">
                            <?php if(!empty($session->message)): ?>
                            <p class="alert alert-success"> <?php echo $session->message; ?></p>
                            <!-- /.alert alert-success -->
                            <?php endif; ?>
                        </div>
                        <!-- /.message_area -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="u_name" placeholder="Your Name">
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" name="u_email" placeholder="E-mail">
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                        </div>
                        <div class="form-group">
                            <select name="u_msg_type"  class="form-control">
                                <option value="0"> Message Type </option>
                                <option value="personal"> Personal </option>
                                <option value="private"> Private </option>
                                <option value="open"> Open  </option>
                            </select>
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                        </div>
                        <div class="form-group"><textarea name="u_comment"  class="form-control" rows="5"></textarea></div>
                        <div class="form-group captcha-holder">
                            <span class="captcha">89533</span> <input type="text" name="captcha" class="form-control">
                            <span class="input-group-addon box-singnal color-success"><i class="fa fa-check"></i></span>
                        </div>
                        <div class="form-group"><input type="submit" name="user_contact_form" class="btn btn-red btn-default btn-lg" value="Send"></div>

                    </form>
                </div>
            </div>

            <div class="col-md-7 contact-map-main padding-left-30">
                <div id="contact-map">
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('footer.php'); ?>
