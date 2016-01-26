<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php global $main_db, $main_page, $sesion; 
$sub_page = new sub_page();
?>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
               <?php 

               if($_GET['page']=='main'){
                    $id = $_GET['id']; 
                    if($main_page->delete_page( $id )){ 
                        $sesion->message("Your Page is deleted successful");
                        safe_redirect(admin_url('all-page')); 
                    }

                }
               ?>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>