<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/10/2016
 * Time: 10:43 PM
 */
$map  = new Map();
$allMap = $map->all_location();
get_map_location();
?>

<!-- Show Map here-->
<div id="new_location" class="location_map">
</div>

<!-- Map infromation box-->
<div class="location_boxes">
    <div class="msg color-red">

    </div>
    <!-- /.msg -->
    <form action="" method="post" id="location_form" class="form form-horizontal">

        <div class="form-group">
            <label for=""> Type your location (<span class="color-red"> * </span>) </label>
                <input type="text" name="map_location" class="form-control location" value="" >
            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for=""> Latitude and Longitude </label>
            <div class="row latlong">
                <div class="col-md-6 padding-l-0">
                    <input type="text" name="lat" readonly class="form-control lat">
                </div>
                <div class="col-md-6 padding-r-0">
                    <input type="text" name="lng" readonly class="form-control lng">
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for=""> Label Title  (<span class="color-red"> * </span> )  </label>
                <input type="text" class="form-control" name="label_title" value="" placeholder="Label Title">
            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for=""> Label Content </label> 

                <textarea name="label_content" id="" class="form-control" cols="30" rows="4"></textarea>
                <!-- /# -->

            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label for=""> Map Position  (<span class="color-red"> * </span> )  </label>
            <select name="map_position" id="" class="form-control">
                <option value="0"> Select Position </option>
                <?php if(count($allMap) < 1 ): ?>
                <option value="1" selected> 1 </option>
                <?php else:
                for($i=0;$i<count($allMap)+1; $i++):
                ?>
                    <option <?php echo ($i==count($allMap)) ? 'selected' : ''; ?> value="<?php echo $i+1; ?>"> <?php echo $i+1; ?></option>
                <?php endfor; endif; ?>
            </select>
            <!-- /#.form-control -->
        </div>
        <!-- /.form-group -->
            <p> <input type="submit" class="btn btn-default" name="map_submit" value="Submit"></p>

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