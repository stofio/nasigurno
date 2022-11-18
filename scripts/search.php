<?php

// loading wp core 
include_once '../../../../wp-load.php';
global $wpdb;

$tablename = $wpdb->prefix . "nasigurno_lokacije";

if(isset($_POST['input'])) {
    $input = $_POST['input'];
    

    $query = $wpdb->prepare( "SELECT * FROM $tablename WHERE 
                            post_name LIKE '%s' or 
                            grad LIKE '%s' or 
                            address LIKE '%s' 
                            LIMIT 15", "%$input%", "%$input%", "%$input%");
    $result = $wpdb->get_results( $query );

    if(count($result)> 0) {

        foreach($result as $key => $value) {
            $post_name = $value->post_name;
            $drzava = $value->drzava;
            $grad = $value->grad;
            $address = $value->address;
            $url = $value->url;
            
            echo "<li>
                    <a href='$url'>
                        <div class='title'>$post_name</div>
                        <div class='address'>$grad ($drzava)</div>
                    </a> 
                 </li>";
        }
    }
    else {
        echo "<li>Nothiing</li>";
    }
}


?>