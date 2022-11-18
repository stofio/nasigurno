<?php
/*
Template Name: Store Locator
*/
?>

<?php get_header('map'); ?>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />


<link rel="stylesheet" type="text/css"
    href="<?php echo get_stylesheet_directory_uri() . '/store-locator/store-locator.css' ?>">

<div class='sidebar'>
    <a href="/">
        <img class="sidebar-logo"
            src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />
    </a>
    <div class="search-container">
        <div class="header-search vis-header-search-map">
            <div class="header-search-input-item">
                <button class="header-search-button left-side"><i class="fa fa-search"></i></button>
                <form id="search" action><input type="search" placeholder="Pretraži na nasigurno" value="" /></form>
                <button class="header-search-button right-side hidden"><i class="fa fa-times"></i></button>
                <ul class="autocomplete-list"></ul>
            </div>
        </div>
    </div>
    <div id='listings' class='listings'>
        <div class="listing">
            <img class="listing-img"
                src="https://media-cdn.tripadvisor.com/media/photo-s/14/71/28/c0/20180902-132907-largejpg.jpg" />
            <h4>Listing name</h4>
            <ul class="info">
                <li>stars</li>
                <li>
                    <div class="wrap">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/pin.svg' ?>"
                            width="18">
                    </div>

                    <a onclick="#" href="#">Mije Kovačevića 10, 11120 Beograd (Palilula)</a>
                </li>
                <li>
                    <div class="wrap"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/phone.svg' ?>"
                            width="15"></div>
                    <a onclick="#" href="tel:011/2442-801">011/2442-801</a>
                </li>
                <li>
                    <div class="wrap"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/web.svg' ?>"
                            width="19"></div>
                    <a href="#">website.com</a>
                </li>
            </ul>
            <a href="#" class="button flex-align-center">
                Dodatne informacije
            </a>
        </div>
    </div>

</div> <!-- sidebar -->

<div class="">
    <div id="nasigurno-map" class="nasigurno-map"></div>
    <img class="map-logo"
        src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />
</div>


<script>
THEME_DIR = "<?php echo get_stylesheet_directory_uri() ?>";
</script>
<script src="<?php echo get_stylesheet_directory_uri() . '/store-locator/store-locator.js' ?>"></script>