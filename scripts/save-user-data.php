<?php

include_once '../../../../wp-load.php';
global $wpdb;

$user_id = $_POST['user_id'];

$name = $_POST['name'];
$surname = $_POST['surname'];
$username = $_POST['username'];


update_user_meta( $user_id, 'first_name', $name );
update_user_meta( $user_id, 'last_name', $surname );

$wpdb->update(
    $wpdb->users, 
    ['user_login' => $username], 
    ['ID' => $user_id]
);


?>