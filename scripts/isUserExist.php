<?php

// loading wp core 
include_once '../../../../wp-load.php';
global $wpdb;

$user_table = $wpdb->prefix . "users";

$email = $_POST['email'];
$username = $_POST['username'];

//check email
$query = $wpdb->prepare( "SELECT * FROM {$user_table} WHERE user_email = %s", $email );
$result = $wpdb->get_results( $query );

//check username
$query2 = $wpdb->prepare( "SELECT * FROM {$user_table} WHERE user_login = %s", $username );
$result2 = $wpdb->get_results( $query2 );


if(sizeof($result) > 0) {
    //email exist
	echo 'email';
}
else if(sizeof($result2) > 0) {
    //username exist
	echo 'username';
}
else {
    //user doesnt exist
    echo 'false';
}



?>