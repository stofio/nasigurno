<?php

//check if logged in
$user = get_user_by( 'id', $user_ID );

if(is_user_logged_in()) {
    //logged in
    global $wpdb;
    $user_ID = get_current_user_id(); 
    $farmacia_ID = get_field('assegna_farmacia', 'user_'. $user_ID );
    $logoUrl = wp_get_attachment_url( get_post_thumbnail_id($farmacia_ID) ); 
    ?>

<div class="head-logged">
    <a href="/moj-profil/">
        👤 Moj profil
    </a>
</div>

<?php
    
} else {
    //not logged in
    ?>
<div class="head-register">
    <a href="/login">
        🔑 Prijava
    </a>
</div>

<?php
}

?>