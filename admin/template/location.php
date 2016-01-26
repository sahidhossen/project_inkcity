<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/11/2016
 * Time: 9:38 PM
 */
$map = new Map();
$allMap = $map->all_location();

?>
<!-- Get all location with map -->
<div id="myLocation" class="location_map">

</div>
<!-- /#myLocation -->

<h3 class="title"> All Map Location </h3>
<!-- /.title -->
<div class="map-table">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th> S.L. </th>
            <th> Location </th>
            <th> Title </th>
            <th> Content </th>
            <th> Lantitude </th>
            <th> Longitude </th>
            <th>  Action </th>
        </tr>
        <?php if($allMap!=NULL ):
            $i=1;
            foreach($allMap as $map ):
            ?>
            <tr>
                <td> <?php echo $i++ ?></td>
                <td> <?php echo $map->location; ?></td>
                <td> <?php echo $map->title; ?></td>
                <td> <?php echo $map->content; ?></td>
                <td> <?php echo $map->lat; ?></td>
                <td> <?php echo $map->lng; ?></td>
                <td>
                    <a href="<?php echo admin_url('map').'?map=edit&id='.$map->id; ?>"> <i class="fa fa-edit"></i></a> |
                    <a href="<?php echo admin_url('map').'?map=delete&id='.$map->id; ?>"> <i class="fa fa-trash"></i></a> |

                </td>
            </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="20"> <h3 class="title text-muted text-center"> Waiting for create your map!  </h3></td>
        </tr>
        <?php endif; ?>
        </thead>
    </table>
    <!-- /.table table-borderd -->
</div>
<!-- /.map-table -->
<?php
if( $allMap !=NULL ) {
    foreach ($allMap as $map) {
        $locations[] = "['{$map->title}',{$map->lat},{$map->lng},{$map->position},'{$map->content}']";
    }
}else{
    $locations[] = "['Dhaka City', 23.810332, 90.4125181, 1,'Bangladesh Capital']";
}
?>

<script >
    jQuery(document).ready(function(e){
        google.maps.event.addDomListener(window, 'load', location_map_intialize);
    });

    var locations = [
       <?php echo implode(', ',$locations); ?>
    ];


    function location_map_intialize() {
        var map = new google.maps.Map(document.getElementById('myLocation'), {
            zoom: 10,
            center: {lat: -33.9, lng: 151.2}
        });

        setMarkers(map,locations)
    }

    // Data for the markers consisting of a name, a LatLng and a zIndex for the
    // order in which these markers should display on top of each other.

    function setMarkers(map,locations){

        var marker, i;

        var image = {
            url: '<?php echo admin_stylesheet() ?>img/location.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(70, 82),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 32)
        };

        var shape = {
            coords: [1, 1, 1, 20, 18, 20, 18, 1],
            type: 'poly'
        };

        for (i = 0; i < locations.length; i++)
        {

            var title = locations[i][0]
            var lat = locations[i][1]
            var long = locations[i][2]
            var contents =  locations[i][4]
            var zIndex = locations[i][3]
            latlngset = new google.maps.LatLng(lat, long);

            var marker = new google.maps.Marker({
                map: map,
                title: title ,
                position: latlngset,
//                icon: image,
                shape: shape,
                zIndex: zIndex,
            });
            map.setCenter(marker.getPosition())


            var content = "<h3> " + title +  '</h3>' + "Address: " + contents

            var infowindow = new google.maps.InfoWindow()

            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                };
            })(marker,content,infowindow));

        }
    };

</script>