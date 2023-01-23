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
<div class="nav-holder my-prof-nav">
    <nav>
        <ul>
            <li>
                <div class="head-prof-m">
                    <a href="/moj-profil/">
                        👤 <span>Moj profil</span> <span><img width="9"
                                src="<?php echo get_template_directory_uri() ?>/icons/arrow-down.svg" /></span>
                    </a>
                </div>
                <ul>
                    <?php foreach(wp_get_nav_menu_items('profil') as $key => $value) : ?>
                    <li><a href="<?php echo $value->url ?>"><?php echo $value->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </nav>
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