<?php include('map_head.php'); ?>
<?php include('sidebar.php'); ?>
<?php global $session; ?>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title gray"> <i class="fa fa-home fa-1x"></i> Create New Posts </h3>
                    <?php if(!empty($session->message)): ?>
                        <div class="alert alert-success"> <?php echo $session->message(); ?> </div>
                    <?php endif; ?>
                    <div class="display_post_template">

                        <?php


                        // include language file
                        include_once 'languages/'.$lng.'.php';

                        include "views/html_menu_top.php";

                        if (!empty($vars['error_msg'])) {
                            $vars['page_title'] = $lang_msg['ERROR_PAGE_TITLE'];
                            include_once  'views/error_page.php';
                        }
                        else { 	// include required view as main page
                            include_once 'views/'.$page.'.php';
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
include('map_footer.php');