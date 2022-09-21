<?php

include_once '../../../wp-load.php';
global $wpdb;

//echo 'return';
//return;

//$r = $wpdb->get_results( "SELECT * FROM `jos_mt_links` INNER JOIN `jos_mt_cl` on `jos_mt_links`.`link_id` = `jos_mt_cl`.`link_id`" );

//foreach ($r as $key => $value) {
	 //insert post
	/*global $user_ID;
	$new_post = array(
		'post_title' => 'My New Post',
		'post_status' => 'publish',
		'post_author' => $user_ID,
		'post_type' => 'oglasi',
	);
	$post_id = wp_insert_post($new_post);*/

	//set category
	//wp_set_object_terms($post_id, $value->cat_id, 'oblast');

	//setting old IDs 'link_id'
	//add_post_meta( $post_id, 'old_id', $value->cat_name, true );




	//opis
	//update_field('field_6316775a76b65', $value->cat_name, $post_id);

	//adresa
	//update_field('field_6316777676b66', $value->cat_name, $post_id);

	//grad
	//update_field('field_6316779c76b67', $value->cat_name, $post_id);

	//postanski_broj
	//update_field('field_631677a076b68', $value->cat_name, $post_id);

	//ogrug
	//update_field('field_631677d976b69', $value->cat_name, $post_id);

	//drzava
	//update_field('field_631677e476b6a', $value->cat_name, $post_id);

	//porezni_broj
	//update_field('field_631677e976b6b', $value->cat_name, $post_id);

	//kontakt
	//update_field('field_6316785676b6c', $value->cat_name, $post_id);

	//telefon
	//update_field('field_6316785b76b6d', $value->cat_name, $post_id);

	//email
	//update_field('field_6316786c76b6e', $value->cat_name, $post_id);

	//website
	//update_field('field_631678b976b70', $value->cat_name, $post_id);

	//tagovi
	//update_field('field_631678cd76b71', $value->cat_name, $post_id);

	//video
	//update_field('field_631678ea76b72', $value->cat_name, $post_id);

	//slike
	

	//set featured image

	//mapa


//}
//echo 'OK';







/*
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
*/


/* insert user */
/*
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
*/



?>