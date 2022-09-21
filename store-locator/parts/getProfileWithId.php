<?php

include_once '../../../../../wp-load.php';
global $wpdb;

$id = $_GET['id'];


$r = $wpdb->get_results( "SELECT * FROM `jos_mt_links` WHERE link_id=" . $id );

echo json_encode($r);



?>