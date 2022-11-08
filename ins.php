<?php

die('return');
return;
include_once '../../../wp-load.php';
global $wpdb;

//session_start();

//unset($_SESSION['counter']);
//return;

//$_SESSION['counter'] = 0;

//var_dump($_SESSION['oldstarts']);

function insertOglasi() {

	$r = $wpdb->get_results( "SELECT * FROM `jos_mt_links` INNER JOIN `jos_mt_cl` on `jos_mt_links`.`link_id` = `jos_mt_cl`.`link_id`" );

	$counterInserted = 0;
	
	foreach ($r as $key => $value) {
		 //insert post
		global $user_ID;
		$new_post = array(
			'post_title' => $value->link_name,
			'post_status' => 'publish',
			'post_author' => $user_ID,
			'post_type' => 'oglasi',
			'post_name' => $value->alias
		);
	
		$post_id = wp_insert_post($new_post);
	
		
		//setting old IDs 'link_id'
		add_post_meta( $post_id, 'old_id', $value->link_id, true );
	
		//link hits
		add_post_meta( $post_id, 'link_hits', $value->link_hits, true );
		
		//set category
		wp_set_object_terms($post_id, (int)$value->cat_id, 'oblast');
		
		//set tags
		wp_set_object_terms($post_id , explode(',', $value->metakey), 'post_tag', false);
		
		//opis
		update_field('field_6316775a76b65', $value->link_desc, $post_id);
		
		//adresa
		update_field('field_6316777676b66', $value->address, $post_id);
		
		//grad
		update_field('field_6316779c76b67', $value->city, $post_id);
	
		//postanski_broj
		update_field('field_631677a076b68', $value->postcode, $post_id);
		
		//ogrug
		update_field('field_631677d976b69', $value->state, $post_id);
		
		//drzava
		update_field('field_631677e476b6a', $value->country, $post_id);
		
		//kontakt
		update_field('field_6316785676b6c', $value->contactperson, $post_id); 
		
		//telefon
		update_field('field_6316785b76b6d', $value->telephone, $post_id); 
		
		//email
		update_field('field_6316786c76b6e', $value->email, $post_id);
		
		//website
		update_field('field_631678b976b70', $value->website, $post_id);
		
		//mapa 
		$coord = array("address" => $value->address, "lat" => $value->lat, "lng" => $value->lng);
		update_field('field_6316795176b74', $coord, $post_id);
		
		$counterInserted++;
		$_SESSION['counter'] = $_SESSION['counter'] + 1;
		
	}
	echo 'Inserted '.$counterInserted ;
}
function insertCategories() {
	//insert categories
	$r = $wpdb->get_results( "SELECT * FROM  `jos_mt_cats`" );
	foreach ($r as $key => $value) {
		$id = $value->cat_id;
		$name = $value->cat_name;
		$slug = $value->alias;
		$desc = $value->cat_desc;
		$parentId = $value->cat_parent;

		//insert
		$wpdb->query("INSERT INTO `wp_terms` (`term_id`, `name`, `slug`) VALUES ('$id', '$name', '$slug')");

		$wpdb->query("INSERT INTO `wp_term_taxonomy` (`term_id`, `taxonomy`, `description`, `parent`) VALUES ('$id', 'oblast', '$desc', '$parentId')");
	}
	echo 'OK';
}
function insertUsers() {
	$r = $wpdb->get_results( "SELECT * FROM  `jos_users`" );
	foreach ($r as $key => $value) {
		$oldid = $value->id;
		$name = $value->name;
		$username = $value->username;
		$email = $value->email;
		$password = $value->password;

		$user_data = array(
			'user_pass' => '123',
			'user_login' => $username,
			'display_name' => $name,
			'user_email' => $email,
			'role' => 'korisnik'
		);
		$user_id = wp_insert_user( $user_data );

		$wpdb->query("UPDATE `wp_users` SET `user_pass`='$password' WHERE `ID` = $user_id");

		echo " UPDATE `jos_mt_links` SET `user_id`=$user_id WHERE `user_id`=$oldid -";

	}
}

function insertImages() {
	global $wpdb;
	$r = $wpdb->get_results( "SELECT DISTINCT `link_id` FROM `jos_mt_images` ORDER BY link_id" );

	
	foreach ($r as $key => $value) {

		$args = array(
			'meta_key' => 'old_id',
			'meta_value' => $value->link_id,
			'post_type' => 'oglasi',
			'post_status' => 'any',
			'posts_per_page' => -1
		);
		$posts = get_posts($args);
		$postid = $posts[0]->ID;

		if(!$postid) continue;

		$array = array();
		
		$images = $wpdb->get_results( "SELECT * FROM `jos_mt_images` where `link_id`=".$value->link_id );
		
		foreach($images as $key2 => $image) {
			if($key2 == 0) {
				//add featured
				set_post_thumbnail($postid, rs_upload_from_url( 'http://localhost/nasigurno/wp-content/themes/nasigurno/m/'.$image->filename, $posts[0]->post_title . '-' . $key2 ));
				echo 'Oglas ID: ' . $postid . ' / - featured - ' , $image->filename;
			}
			else {
				//add to gallery
				$gallImgId = rs_upload_from_url( 'http://localhost/nasigurno/wp-content/themes/nasigurno/m/'.$image->filename, $posts[0]->post_title . '-' . $key2 );
				$array[] = $gallImgId;

				
				
				echo '---- gallery - ' , $image->filename;
			}
			
		}
		if(sizeof($array) > 0) {
			update_field('field_6316794376b73', $array, $postid );
		}
	}
	echo 'DONE';
}


function rs_upload_from_url( $url, $title = null ) {
	require_once( ABSPATH . "/wp-load.php");
	require_once( ABSPATH . "/wp-admin/includes/image.php");
	require_once( ABSPATH . "/wp-admin/includes/file.php");
	require_once( ABSPATH . "/wp-admin/includes/media.php");
	
	// Download url to a temp file
	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) return false;
	
	// Get the filename and extension ("photo.png" => "photo", "png")
	$filename = pathinfo($url, PATHINFO_FILENAME);
	$extension = pathinfo($url, PATHINFO_EXTENSION);
	
	// An extension is required or else WordPress will reject the upload
	if ( ! $extension ) {
		// Look up mime type, example: "/photo.png" -> "image/png"
		$mime = mime_content_type( $tmp );
		$mime = is_string($mime) ? sanitize_mime_type( $mime ) : false;
		
		// Only allow certain mime types because mime types do not always end in a valid extension (see the .doc example below)
		$mime_extensions = array(
			// mime_type         => extension (no period)
			'text/plain'         => 'txt',
			'text/csv'           => 'csv',
			'application/msword' => 'doc',
			'image/jpg'          => 'jpg',
			'image/jpeg'         => 'jpeg',
			'image/gif'          => 'gif',
			'image/png'          => 'png',
			'video/mp4'          => 'mp4',
		);
		
		if ( isset( $mime_extensions[$mime] ) ) {
			// Use the mapped extension
			$extension = $mime_extensions[$mime];
		}else{
			// Could not identify extension
			@unlink($tmp);
			return false;
		}
	}
	
	
	// Upload by "sideloading": "the same way as an uploaded file is handled by media_handle_upload"
	$args = array(
		'name' => "$filename.$extension",
		'tmp_name' => $tmp,
	);
	
	// Do the upload
	$attachment_id = media_handle_sideload( $args, 0, $title);
	
	// Cleanup temp file
	@unlink($tmp);
	
	// Error uploading
	if ( is_wp_error($attachment_id) ) return false;
	
	// Success, return attachment ID (int)
	return (int) $attachment_id;
}


function addAdditionalData() { //kont osoba, tel, 
	global $wpdb;

	$r = $wpdb->get_results( " SELECT * FROM `jos_mt_cfvalues` ORDER BY link_id" );

	$countTotalLinks = 0;
	$countTags = 0;
	$countOsoba = 0;
	$countTel = 0;
	$countVideo = 0;

	foreach ($r as $key => $value) {
		$cfId = $value->cf_id;
		$linkid = $value->link_id;
		$value = $value->value;
		//get id
		$postId = $wpdb->get_results( " SELECT `post_id` FROM `wp_postmeta` WHERE `meta_key`='old_id' and `meta_value`= " . $linkid  );


		if($cfId == 28) {
			//tags
			wp_set_object_terms($postId[0]->post_id , explode(',', $value), 'post_tag', false);
			$countTags++;
		}
		if($cfId == 109) {
			//kontact osoba
			update_field('field_6316785676b6c', $value, $postId[0]->post_id); 
			$countOsoba++;
		}
		if($cfId == 112) {
			//tel
			add_row('field_6316785b76b6d', 
				array(
				'field_6316789776b6f'   => $value), 
			$postId[0]->post_id);	
			$countTel++;	
		}
		if($cfId == 120) {
			//video
			update_field('field_631678ea76b72', $value, $postId[0]->post_id); 
			$countVideo++;
		}

		$countTotalLinks++;
	}

	echo $countTotalLinks . '<br>';
	echo $countTags . '<br>';
	echo $countOsoba . '<br>';
	echo $countTel . '<br>';
	echo $countVideo . '<br>';


}
//addAdditionalData();


function addMissingPhonesAndContactOsoba() {

		global $wpdb;

		$r = $wpdb->get_results( "SELECT `link_id`, `telephone`, `contactperson` FROM `jos_mt_links` WHERE `telephone` != '' ORDER BY `jos_mt_links`.`contactperson` DESC;
		" );
	
		foreach ($r as $key => $value) {
			$phone = $value->telephone;
			$linkid = $value->link_id;

			//get id
			$postId = $wpdb->get_results( " SELECT `post_id` FROM `wp_postmeta` WHERE `meta_key`='old_id' and `meta_value`= " . $linkid  );

			//tel
			add_row('field_6316785b76b6d', 
				array(
				'field_6316789776b6f'   => $phone), 
			$postId[0]->post_id);

			echo $postId[0]->post_id . '<br>';
		}

		
}


function populateLocationsTable() {
	global $wpdb;
    $r = $wpdb->get_results( "SELECT p.ID, p.post_title, address.meta_value as address, postcode.meta_value as postcode, mapa.meta_value as mapa, grad.meta_value as grad, drzava.meta_value as drzava FROM `wp_posts` p JOIN `wp_postmeta` address ON p.ID = address.post_id AND address.meta_key = 'adresa' JOIN `wp_postmeta` drzava ON p.ID = drzava.post_id AND drzava.meta_key = 'drzava' JOIN `wp_postmeta` grad ON p.ID = grad.post_id AND grad.meta_key = 'grad' JOIN `wp_postmeta` postcode ON p.ID = postcode.post_id AND postcode.meta_key = 'postanski_broj' JOIN `wp_postmeta` mapa ON p.ID = mapa.post_id AND mapa.meta_key = 'mapa' 
	WHERE p.post_type = 'oglasi' AND mapa.meta_value != '' 
	GROUP BY mapa.meta_value ORDER BY p.ID" );

    foreach($r as $post) {
		$post_id = $post->ID;
		$post_title = $post->post_title;
		$address = $post->address;
		$postcode = $post->postcode;
		$lat = unserialize($post->mapa)['lat'];
  		$lng = unserialize($post->mapa)['lng'];
		$grad = $post->grad;
		$drzava = $post->drzava;
		$url = get_permalink($post_id);
		$urlNew = str_replace('http://localhost/nasigurno', 'https://nasigurno.com', $url);

		$results = $wpdb->get_results( "INSERT INTO wp_nasigurno_lokacije (`post_id`, `post_name`, `drzava`, `grad`, `address`, `postcode`, `center_point`, `url`) 
        VALUES ($post_id, '$post_title', '$drzava', '$grad', '$address', '$postcode', ST_GeomFromText('POINT($lat $lng)'), '$urlNew' )" );


		error_log(print_r( $post_id, true ));
    }
}
//populateLocationsTable();







?>