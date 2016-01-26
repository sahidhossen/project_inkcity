<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/12/2016
 * Time: 2:18 AM
 */
$map  = new Map();

$currentMap = '';
if(isset($_GET['id'])){
    $currentMap =$map->get_map_by_id( $_GET['id']);
}else {
   safe_redirect(admin_url('map'));
}


$allMap = $map->all_location();
update_map_location();
?>

<!-- Show Map here-->
<div id="new_location" class="location_map">
</div>

<!-- Map infromation box-->
<div class="location_boxes">
    <div class="msg color-red">

    </div>
    <!-- /.msg -->
    <form action="" id="location_form" method="post" class="form form-horizontal">

        <div class="form-group">
            <label for=""> Type your location (<span class="color-red"> * </span>) </label>
            <input type="text" name="map_location" class="form-control location" value="<?php echo isset($currentMap->location) ? $currentMap->location : ''; ?>" >
            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for=""> Latitude and Longitude </label>
            <div class="row latlong">
                <div class="col-md-6 padding-l-0">
                    <input type="text" name="lat" readonly value="<?php echo isset($currentMap->lat) ? $currentMap->lat : ''; ?>" class="form-control lat">
                </div>
                <div class="col-md-6 padding-r-0">
                    <input type="text" name="lng" value="<?php echo isset($currentMap->lng) ? $currentMap->lng : ''; ?>" readonly class="form-control lng">
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for=""> Label Title  (<span class="color-red"> * </span> )  </label>
            <input type="text" class="form-control" name="label_title" value="<?php echo isset($currentMap->title) ? $currentMap->title : ''; ?>" placeholder="Label Title">
            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for=""> Label Content </label>

            <textarea name="label_content" id="" class="form-control" cols="30" rows="4"><?php echo isset($currentMap->content) ? $currentMap->content : ''; ?></textarea>
            <!-- /# -->

            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">

            <label for=""> Map Position  (<span class="color-red"> * </span> )  </label>
            <select name="map_position" id="" class="form-control">
                <option value="0"> Select Position </option>
                    <?php
                    for($i=1;$i<=count($allMap); $i++):
                        ?>
                        <option <?php echo ($i==$currentMap->position) ? 'selected' : ''; ?> value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                    <?php endfor;  ?>
            </select>
            <!-- /#.form-control -->
        </div>
        <!-- /.form-group -->
        <p> <input type="submit" class="btn btn-default" name="map_edit" value="Update"></p>

        <!-- /.form-group -->
    </form>


    <div id="map_result">

    </div>
    <!-- /#map_info -->
</div>

<script >
    jQuery(document).ready(function(e){

    });




</script>
