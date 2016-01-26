<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
global $session;
?>
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

                        if(isset($_GET['post'])){
                            if(isset($_GET['delete'])==1){
                                include('template/delete.php');
                            }
                            if($_GET['post']=='tab'){
                                include('template/tab.php');
                            }

                            if($_GET['post']=='advance'){
                                include('template/advance.php');
                            }
                            if($_GET['post']=='address'){
                                include('template/contact.php');
                            }
                            if($_GET['post']=='social'){
                                include('template/social.php');
                            }


                        }

                        ?>


                    </div>

                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>