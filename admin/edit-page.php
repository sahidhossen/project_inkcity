<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php global $main_db, $main_page; 
$sub_page = new sub_page();

$error = array();

if( isset( $_POST['edit_main_page'])){



    $page_name = $_POST['page_name']; 
    $position = $_POST['position']; 
    $desc   = $_POST['desc']; 


   if($page_name == '' || strlen($page_name) < 4  ){ 
        $error[] = "Please check out page name. Page should be minimum 4 character"; 
    }elseif( $position ==0 ){
        $error[] = "Please select a position"; 
    }elseif( $desc == '' && strlen($desc) <10  ) {
        $error[] = 'Please type about the page description';
    }


    if( count($error) < 1  ){
        $data = array(
                'name'=>$page_name, 
                'desc' =>$desc, 
                'position'=>$position,
                'date'=>date('Y-m-d'),
            );  

        $query = $main_page->edit_page( $data, array('id'=>$_GET['id']) );

        if( $query ){
            $sesion->message("You page has been edited"); 
             safe_redirect(admin_url('all-page'));
           
        }else {
             
            echo "Your page did not edit yet";
        }
    }

}



?>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
                 <div class="col-md-12">
                    <h3 class="title"> Edit Page   </h3>

                     <?php
                    if($_GET['page']=='main'){
                         $current_page = $main_page->get_page_by_id( $_GET['id']); 
                       ?> 
                        <div class="form col-md-8">

                            <form method="post" action="">
                                <div class="row form-group">
                                    <label class="col-md-4"> Page Name </label>
                                    <div class="col-md-8"> 
                                        <input name="page_name" type="text" class="form-control" value="<?php echo $current_page->name; ?>" placeholder="Page Name"> 
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-md-4"> Position </label>
                                    <div class="col-md-8"> 
                                        <?php   $total_page = $main_page->total_page(); ?>
                                        <select name="position" class="form-control">
                                            <option value="0"> Select  </option> 
                                            <?php for($i=1; $i<=$total_page; $i++ ): 
                                                $select = ($current_page->position == $i ) ? $select="selected" : '';
                                            ?>
                                            <option <?php echo $select; ?> value="<?php echo $i; ?>"> <?php echo $i; ?> </option> 
                                        <?php endfor; ?>
                                         
                                        </select>
                                     </div>
                                </div>
                                <div class="row form-group">
                                        <label class="col-md-4"> Descrtion </label>
                                    <div class="col-md-8"> 
                                         <textarea name="desc" class="form-control" rows="8"><?php echo $current_page->desc; ?></textarea> 
                                    </div>

                                </div>

                                <div class="row form-group">
                                    <p class="text-center">  <input name="edit_main_page" type="submit" class="btn btn-success btn-md" value="Submit"></p>

                                </div>

                            </form>
                        </div>

                       <?php 

                    }elseif( $_GET['page']=='sub_page'){
                        $current_page = $sub_page->get_page_by_id($_GET['id']);
                        var_dump($current_page);
                    }
                     ?>
                 </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>