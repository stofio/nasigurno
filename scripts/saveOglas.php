<?php

include_once '../../../../wp-load.php';
global $wpdb;

$current_user; 

//get user id 
if(!get_current_user_id() ) {
    die('return, no user id');
    return;
}


$naslov = $_POST["naslov"];
$opis = $_POST["opis"];
$parent_cat = $_POST["parent_cat"];
$child_catID = $_POST["child_cat"];
$pacinput = $_POST["pac-input"];
$website = $_POST["website"];
$video = $_POST["video"];
$porezni_broj = $_POST["porezni_broj"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$drzava = $_POST["drzava"];
$grad = $_POST["grad"];
$ulica = $_POST["ulica"];
$okrug = $_POST["okrug"];
$broj = $_POST["broj"];
$po_broj = $_POST["po_broj"];


$tel_kontakt_osoba = $_POST["tel_kontakt_osoba"]; //array
$broj_telefona = $_POST["broj_telefona"]; //array

$em_kontakt_osoba = $_POST["em_kontakt_osoba"]; //array
$email = $_POST["email"]; //array

$radni_dan = $_POST["radni_dan"]; //array
$radno_vreme = $_POST["radno_vreme"]; //array


/**
 * backend validation
 */
//.....

/**
 * insert post
 */

$new_post = array(
    'post_title' => $naslov,
    'post_status' => 'publish',
    'post_author' => get_current_user_id(),
    'post_type' => 'oglasi'
);

$post_id = wp_insert_post($new_post);

//set category
wp_set_object_terms($post_id, (int)$child_catID, 'oblast');

//set tags
//wp_set_object_terms($post_id , explode(',', $value->metakey), 'post_tag', false);

/**
 * insert metadata (ACF) & images
 */

//opis
update_field('field_6316775a76b65', $opis, $post_id);

//adresa
update_field('field_6316777676b66', $pacinput, $post_id);

//grad
update_field('field_6316779c76b67', $grad, $post_id);

//broj
update_field('field_63acb08a1fdb1', $broj, $post_id);

//postanski_broj
update_field('field_631677a076b68', $po_broj, $post_id);

//ogrug
update_field('field_631677d976b69', $okrug, $post_id);

//drzava
update_field('field_631677e476b6a', $drzava, $post_id);

//website
update_field('field_631678b976b70', $website, $post_id);

//video
update_field('field_631678ea76b72', $video, $post_id);

//porezni broj
update_field('field_631677e976b6b', $porezni_broj, $post_id);

//mapa 
$coord = array("address" => $pacinput, "lat" => $lat, "lng" => $lng);
update_field('field_6316795176b74', $coord, $post_id);


//telefon
foreach($broj_telefona as $i => $tel) {
    $telefon = $tel;
    $osoba = $tel_kontakt_osoba[$i];
    add_row('field_6316785b76b6d', 
				array(
				'field_6316789776b6f'   => $telefon,
				'field_6349dc2ba9b05'   => $osoba,
            ), 
			$post_id);
}


//email
foreach($email as $i => $em) {
    $email = $em;
    $osoba = $em_kontakt_osoba[$i];
    add_row('field_63a8987b4b73c', 
				array(
				'field_63a8987b4b73d'   => $email,
				'field_63a8987b4b73e'   => $osoba,
            ), 
			$post_id);
}


//radno_vreme
foreach($radni_dan as $i => $rdan) {
    $dan = $rdan;
    $vreme = $radno_vreme[$i];
    add_row('field_639bb1a28f48d', 
				array(
				'field_639bb1fe8f48e'   => $dan,
				'field_639bb2118f48f'   => $vreme,
            ), 
			$post_id);
}


//glavna slika
if($_FILES['naslovna_slika']['tmp_name'] !=="") {
    set_post_thumbnail($post_id, uploadFile( $_FILES['naslovna_slika']['tmp_name'], $_FILES['naslovna_slika']['name'] ));
} 

//galerija
$gallArray = array();
foreach($_FILES['gallery']['tmp_name'] as $i => $img) {
    //add to gallery
    $gallImgId = uploadFile( $_FILES['gallery']['tmp_name'][$i], $_FILES['gallery']['name'][$i] );
    $gallArray[] = $gallImgId;
}
if(sizeof($gallArray) > 0) {
    update_field('field_6316794376b73', $gallArray, $post_id );
}

//locations table
$url = get_permalink($post_id);
$urlNew = str_replace('http://localhost/nasigurno', 'https://nasigurno.com', $url);
$results = $wpdb->get_results( "INSERT INTO wp_nasigurno_lokacije (`post_id`, `post_name`, `drzava`, `grad`, `address`, `postcode`, `center_point`, `url`) 
        VALUES ($post_id, '$naslov', '$drzava', '$grad', '$pacinput', '$po_broj', ST_GeomFromText('POINT($lat $lng)'), '$urlNew' )" );

echo json_encode($urlNew);

function uploadFile( $tmp, $title = null ) {
	require_once( ABSPATH . "/wp-load.php");
	require_once( ABSPATH . "/wp-admin/includes/image.php");
	require_once( ABSPATH . "/wp-admin/includes/file.php");
	require_once( ABSPATH . "/wp-admin/includes/media.php");
	
	$filename = pathinfo($url, PATHINFO_FILENAME);

	// Upload by "sideloading": "the same way as an uploaded file is handled by media_handle_upload"
	$args = array(
		'name' => "$title",
		'tmp_name' => $tmp,
	);
	
	// Do the upload
	$attachment_id = media_handle_sideload( $args, 0, $title);

	// Error uploading
	if ( is_wp_error($attachment_id) ) return false;
	
	// Success, return attachment ID (int)
	return (int) $attachment_id;
}










?>