<?php
/**
 * this file returns a JSON with locations from a Drzava 
 */

include_once '../../../../wp-load.php';
global $wpdb;


$dzava = $_GET['drzava'];

/*
$r = $wpdb->get_results( "SELECT 
                    p.ID, 
                    p.post_title, 
                    address.meta_value as address, 
                    postcode.meta_value as postcode, 
                    mapa.meta_value as mapa, 
                    grad.meta_value as grad, 
                    drzava.meta_value as drzava 
                    FROM `wp_posts` p JOIN `wp_postmeta` address ON p.ID = address.post_id AND address.meta_key = 'adresa' 
                    JOIN `wp_postmeta` drzava ON p.ID = drzava.post_id AND drzava.meta_key = 'drzava' 
                    JOIN `wp_postmeta` grad ON p.ID = grad.post_id AND grad.meta_key = 'grad' 
                    JOIN `wp_postmeta` postcode ON p.ID = postcode.post_id AND postcode.meta_key = 'postanski_broj' 
                    JOIN `wp_postmeta` mapa ON p.ID = mapa.post_id AND mapa.meta_key = 'mapa' 
                    WHERE p.post_type = 'oglasi' AND drzava.meta_value = 'Srbija' 
                    GROUP BY mapa" );
*/

/**
 * get all locations
 */
$r = $wpdb->get_results("SELECT `id`,
                                `post_id`,
                                `post_name`,
                                `drzava`,
                                `grad`,
                                `address`,
                                `postcode`,
                                `url`,
                                ST_X(center_point) as lat, 
                                ST_Y(center_point) as lng 
                                FROM `wp_nasigurno_lokacije` WHERE drzava = '" . $dzava . "' ");

/**
 * filter duplicate coordinates
 */
$filteredLocations = array();
foreach ($r as $key => $value) {
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

foreach ($filteredLocations as $key => $value) {

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