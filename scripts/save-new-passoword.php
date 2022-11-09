<?php

include_once '../../../../wp-load.php';
global $wpdb;

$user_id = $_POST['user_id'];

$old_passw = $_POST['old_passw'];
$new_passw = $_POST['new_passw'];
$new_r_passw = $_POST['new_r_passw'];

//check old passw
$r = $wpdb->get_results('SELECT user_pass FROM `wp_users` WHERE ID = ' . $user_id);

$hash = $r[0]->user_pass;

if(wp_check_password($old_passw, $hash)) {
    //old password correct
    update_user_meta($user_id, 'user_pass', $new_passw);
    wp_update_user( array ('ID' => $user_id, 'user_pass' => $new_passw) ) ;   
    echo 'SUCCESS';
}
else {
    //wrong old passw
    echo 'ERROLD';
}


?>