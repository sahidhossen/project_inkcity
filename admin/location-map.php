<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
global $session;
$post = new posts();
?>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title gray"> <i class="fa fa-home fa-1x"></i> Location Map Area </h3>
                    <?php if(!empty($session->message)): ?>
                        <div class="alert alert-success"> <?php echo $session->message(); ?> </div>
                    <?php endif; ?>
                    <div class="content special">
                        <div class="location_map_container">
                            <p class="text-right"> <a href="<?php echo admin_url('map') ?>?map=create"> + New Map</a> </p>
                           <?php
                           if(isset($_GET['map'])){
                               if($_GET['map']=='create')
                                   include "template/new_location.php";

                               if($_GET['map']=='edit')
                                   include "template/edit_map.php";
                               if($_GET['map']=='delete')
                                   include "template/delete_mape.php";
                           }else {
                               include"template/location.php";
                           }

                           ?>
                        </div>
                    </div>
                    <!-- /.content -->
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>