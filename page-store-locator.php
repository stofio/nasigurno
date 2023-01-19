<?php
/*
Template Name: Store Locator
*/
?>

<?php get_header('map'); ?>

<link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>

<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet"
    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
    type="text/css" />


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
                <input id="stLocSearch" autocomplete="no" type="search" data-lat="" data-lng=""
                    placeholder="Pretraži na nasigurno" value="" />
                <button class="header-search-button right-side hidden"><i class="fa fa-times"></i></button>
                <ul class="autocomplete-list-st"></ul>
            </div>
        </div>
    </div>
    <div id='listings' class='listings'>
        <div class="loading" style="display:none"><img
                src="<?php echo get_stylesheet_directory_uri() . '/icons/loading.gif' ?>" /></div>

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