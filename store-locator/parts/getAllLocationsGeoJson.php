<?php

include_once '../../../../../wp-load.php';
global $wpdb;


$r = $wpdb->get_results( "SELECT link_id, link_name, address, postcode, lat, lng FROM `jos_mt_links` GROUP BY lat, lng" );

//
//filter duplicate coordinates
//
$filteredLocations = array();
foreach ($r as $key => $value) {
    break;
    $toPush = true;

    //check if is already in filtered
    foreach ($filteredLocations as $newKey => $newValue) {
        if($value->lng == $newValue->lng && $value->lat == $newValue->lat) {
            $toPush = false;
            break;
        }
        else {
            $toPush = true;
        }
    }

    //push to filtered
    if($toPush) array_push($filteredLocations, $value); 
}


$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);

foreach ($r as $key => $value) {

	$feature = array(
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                $value->lng,
                $value->lat
            )
        ),
        "properties" => array(
        	"link_id" => $value->link_id,
        	"link_name" => $value->link_name,
        	"address" => $value->address,
        	"postcode" => $value->postcode,
         )       
    );


    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);

}

header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);

?>