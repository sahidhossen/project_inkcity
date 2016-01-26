<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 18-11-15
 * Time: 20.40
 */


function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';

        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link

        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
            for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                if($i > 0){
                    $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                }
            }
            $first_link = false; //set first link to false
        }

        if($first_link){ //if current active page is first link

            $pagination .= '<li class="first active"> <a href="#">'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active"> <a href="#">'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active"><a href="#">'.$current_page.'</a> </li>';
        }

        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
            $next_link = ($i > $total_pages)? $total_pages : $i;
            $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
            $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}


function get_pageniation_result(){

    $history = new History();
    global $main_db;

    $item_per_page = 5;

//Get page number from Ajax
    if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

//get total number of records from database

    $get_total_rows = $history->count_files(); //hold total records in variable
//break records into pages
    $total_pages = ceil($get_total_rows/$item_per_page);

//position of records

    $page_position = (($page_number-1) * $item_per_page);

//Limit our results within a specified range.
    $results = $history->get_file_from(abs($page_position), $item_per_page);


//Display records fetched from database.
    ?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th> File Name </th>
            <th> Page </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($results !=NULL ):
        foreach($results as $item): ?>
        <tr data-id="<?php echo $item->id; ?>">
            <td> <p> <?php echo $item->name; ?> </p></td>
            <td> <p> <?php echo $item->pages; ?> </p></td>
            <td>
                <p>
                    <a target="_blank" href="<?php echo get_home_url() ?>/view.php?post_id=<?php echo $item->id ?>"><span class="fa fa-eye fa-2x"></span> </a>&nbsp;
                    <a href="#"><span class="fa fa-cloud-upload fa-2x"></span></a> &nbsp;
                    <a class="delete_file" href="#"><span class="fa fa-trash fa-2x"></span></a>
                </p>
            </td>
        </tr>
        <?php endforeach; endif; ?>

        </tbody>
    </table>

<?php
    echo '<div align="center">';
// To generate links, we call the pagination function here.
    echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
    echo '</div>';
}


/*
 * Change file status 0 to 1
 * @param : file ID
 *
 */

 function update_file_status(){
     global $main_db;
     $file = new History();

     if(isset($_POST['action'])){
        $file_id = $_POST['id'];

         $data['status']=1;
        if($file->update_file($data, array('id'=>$file_id,'status'=>0))){
            echo 'yes';
        }else {
            echo 'no';
        }


     }
 }


/*
 * Change history status 0 to 1
 * @param : file ID
 *
 */

function update_history_status(){
    global $main_db;
    $file = new History();

    if(isset($_POST['action'])){
        $file_id = $_POST['id'];

        $data['status']=1;
        if($file->update_history($data, array('id'=>$file_id,'status'=>0))){
            echo 'yes';
        }else {
            echo 'no';
        }


    }
}




/*
 * Change all history status 0 to 1
 * @param : all
 *
 */

function update_all_history_status(){
    global $main_db;
    $file = new History();

    if(isset($_POST['action'])){
        $file_id = $_POST['status'];
        $data['status']=1;
        if($file->update_history($data, array('status'=>0))){
            echo 'yes';
        }else {
            echo 'no';
        }


    }
}
