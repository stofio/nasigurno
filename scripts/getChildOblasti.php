<?php


include_once '../../../../wp-load.php';
global $wpdb;

$termId = $_POST['term_id'];


$args = array(
    'orderby'=>'name',
    'order' => 'ASC',
    'hide_empty'=>false,
    'parent'=>$termId
);

$allcat = get_terms( "oblast", $args );

echo json_encode($allcat);


?>