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