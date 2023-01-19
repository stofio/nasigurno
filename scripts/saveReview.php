<?php

include_once '../../../../wp-load.php';
global $wpdb;

if(!is_user_logged_in()) return;

$user = wp_get_current_user();


//upload images
$gallArray = array();
foreach($_FILES['images']['tmp_name'] as $i => $img) {
//add to gallery
	$gallImgId = uploadFile( $_FILES['images']['tmp_name'][$i], $_FILES['images']['name'][$i] );
	$gallArray[] = $gallImgId;
}

// $attach_id holds the ID of an image I want to attach to the comment in comment_meta

$data = array(
	'comment_post_ID'        => $_POST['oglasId'],
	'comment_author'         => $user->user_nicename,
	'comment_author_email'   => $user->user_email,
	'comment_content'        => $_POST['add_review_text'],
	'comment_type'           => '',
	'comment_date'           => date('Y-m-d H:i:s'),
	'comment_approved'       => 0,
);

$comm_id = wp_insert_comment( $data );

add_comment_meta( $comm_id, 'stars', $_POST['add_review_rating'] );

if(sizeof($gallArray) > 0) {
	//save commentmeta images
	add_comment_meta( $comm_id, 'comment_images', serialize($gallArray) );
}

//save review


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