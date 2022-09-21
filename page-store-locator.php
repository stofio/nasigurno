<?php
/*
Template Name: Store Locator
*/
?>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />


<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/store-locator/store-locator.css' ?>">

<?php get_header('map'); ?>

<div class='sidebar'>
  <a href="/">
    <img class="sidebar-logo" src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />
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
      <img class="listing-img" src="https://media-cdn.tripadvisor.com/media/photo-s/14/71/28/c0/20180902-132907-largejpg.jpg" />
      <h4>Listing name</h4>
      <ul class="info">
        <li>
            <div class="wrap">
              <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/pin.svg' ?>" width="18">
            </div>
            
            <a onclick="#" href="#">Mije Kovačevića 10, 11120 Beograd (Palilula)</a>
        </li>
        <li>
            <div class="wrap"><img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/phone.svg' ?>" width="15"></div>
            <a onclick="#" href="tel:011/2442-801">011/2442-801</a>
        </li>
            <li>
                <div class="wrap"></div>
                <a onclick="#" href="tel:064/6596-880">064/6596-880</a>
            </li>
                <li>
            <div class="wrap"><img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/clock.svg' ?>" width="15"></div>
            <a class="not-link" name="opening_hours_label" data-opening-hours="[{&quot;id&quot;: 108, &quot;day&quot;: &quot;Ponedeljak&quot;, &quot;shifts&quot;: [&quot;0900:1800&quot;]},{&quot;id&quot;: 109, &quot;day&quot;: &quot;Utorak&quot;, &quot;shifts&quot;: [&quot;0900:1800&quot;]},{&quot;id&quot;: 110, &quot;day&quot;: &quot;Sreda&quot;, &quot;shifts&quot;: [&quot;0900:1800&quot;]},{&quot;id&quot;: 111, &quot;day&quot;: &quot;Četvrtak&quot;, &quot;shifts&quot;: [&quot;0900:1800&quot;]},{&quot;id&quot;: 112, &quot;day&quot;: &quot;Petak&quot;, &quot;shifts&quot;: [&quot;0900:1800&quot;]},{&quot;id&quot;: 113, &quot;day&quot;: &quot;Subota&quot;, &quot;shifts&quot;: [&quot;0900:1500&quot;]},{&quot;id&quot;: 114, &quot;day&quot;: &quot;Nedelja&quot;, &quot;shifts&quot;: [&quot;0900:1500&quot;]}]" data-current-holiday="" href="#radno-vreme"></a>
        </li>
         <li>
            <div class="wrap"><img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/web.svg' ?>" width="19"></div>
            <a href="#">website.com</a>
        </li>
    </ul>
    <a href="#" class="button flex-align-center">
        Informacije
    </a>
    </div>
  </div>

</div> <!-- sidebar -->

<div class="">
  <div id="nasigurno-map" class="nasigurno-map"></div>
    <img class="map-logo" src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />
  <div class="my-location" title="Tvoja lokacija">
      <img src="<?php echo get_stylesheet_directory_uri() ?> /store-locator/my-location.svg">
   </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
   THEME_DIR = "<?php echo get_stylesheet_directory_uri() ?>";
</script>
<script src="<?php echo get_stylesheet_directory_uri() . '/store-locator/store-locator.js' ?>"></script>






