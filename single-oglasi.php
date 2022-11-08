<?php get_header(); ?>

<?php
function get_oglasi_breadcrumb() {
    global $post;
    $terms = get_the_terms( $post->ID , 'oblast' )[0];
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";

    if($terms->parent) {
        //get parent and echo
        $parent = get_term( $terms->parent );
        //var_dump($parent);
        echo '<a href="'.get_term_link($parent->term_id).'" rel="nofollow">'. $parent->name .'</a>';
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
    }

    echo '<a href="'.get_term_link($terms->term_id).'" rel="nofollow">'. $terms->name .'</a>';

    echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
    echo get_the_title();

    return;
}

wp_reset_query(); 

?>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />

<!--section -->
<section class="gray-section top-padding no-overflow">
    <div class="container">
        <div class="row row-flex fl">
            <div class="col-md-8">

                <div class="list-single-main-wrapper fl-wrap">

                    <?php
                    //get featured image
                    $featuredUrlImg = get_the_post_thumbnail_url();
                    if($featuredUrlImg) :
                    ?>
                    <img class="single-featured-img" src="<?php echo $featuredUrlImg ?>" />
                    <?php endif; ?>

                    <div class="box with-img-top">
                        <div class="breadcrumb-block"><?php get_oglasi_breadcrumb(); ?></div>
                        <h1><?php the_title() ?></h1>
                        <ul class="star-rating"></ul>
                        <ul class="info">
                            <?php if(get_field('adresa') != '') : ?>
                            <li>
                                <div class="wrap">
                                    <img src="http://localhost/nasigurno/wp-content/themes/nasigurno/store-locator/icons/pin.svg"
                                        width="12">
                                </div>
                                <?php the_field('adresa'); 
                                    if(get_field('ogrug') != '') echo ', ' . get_field('ogrug'); 
                                    if(get_field('grad') != '') echo ' (' . get_field('grad') . ')'; 
                                    if(get_field('postanski_broj') != '') echo ', ' . get_field('postanski_broj'); 
                                    if(get_field('drzava') != '') echo ', ' . get_field('drzava'); 
                                    
                                ?>

                            </li>
                            <?php endif; ?>
                            <?php if(have_rows('telefon')) : ?>
                            <li>
                                <div class="wrap">
                                    <img src="http://localhost/nasigurno/wp-content/themes/nasigurno/store-locator/icons/phone.svg"
                                        width="15">
                                </div>
                                <div class="phones-container">
                                    <?php
                                        while( have_rows('telefon') ) : the_row(); ?>
                                    <div class="">
                                        <a onclick="#"
                                            href="tel:<?php echo get_sub_field('tel') ?>"><?php echo get_sub_field('tel') ?></a>
                                        <?php if(get_sub_field('kont_osob')) echo '('. get_sub_field('kont_osob'). ')' ?>
                                    </div>
                                    <?php
                                        // End loop.
                                        endwhile;
                                        ?>
                                </div>

                            </li>
                            <?php endif; ?>
                            <?php if(get_field('website')  != '') : ?>
                            <li>
                                <div class="wrap"><img
                                        src="http://localhost/nasigurno/wp-content/themes/nasigurno/store-locator/icons/web.svg"
                                        width="15"></div>
                                <a href="<?php the_field('website') ?>"
                                    target="_blank"><?php the_field('website') ?></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <div name="info_action" class="flex-wrap">
                            <a href="#recenzija" class="btn transparent-btn float-btn">Napiši recenziju
                                <img src="<?php echo get_template_directory_uri() ?>/icons/pen.svg" />
                            </a>
                            <a href="#" class="btn transparent-btn float-btn">Vidi na mapi
                                <img src="<?php echo get_template_directory_uri() ?>/icons/map.svg" />
                            </a>
                            <a href="#" class="btn transparent-btn float-btn">Podeli
                                <img src="<?php echo get_template_directory_uri() ?>/icons/share.svg" />
                            </a>
                        </div>
                    </div>


                    <?php
                        $images = get_field('slike'); 
                        if( $images ): ?>
                    <div class="box single-gallery">
                        <div class="h2">Galerija</div>

                        <ul>
                            <?php foreach( $images as $image ): ?>
                            <li>
                                <a href="<?php echo $image['url']; ?>">
                                    <img src="<?php echo $image['sizes']['thumbnail']; ?>"
                                        alt="<?php echo $image['alt']; ?>" />
                                </a>
                                <p><?php echo $image['caption']; ?></p>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if(get_field('opis') || get_the_tags()) : ?>
                    <div class="box">
                        <div class="h2">Detalji</div>
                        <div class="description">
                            <?php the_field('opis') ?>
                        </div>

                        <div class="h2">Tagovi</div>
                        <div class="flex-wrap tagovi">
                            <?php
                                $tags = get_the_tags();
                                if($tags){
                                    foreach($tags as $key => $tag) {
                                        echo '<a class="cat-link" href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
                                    }
                                }    
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(get_field('mapa')['lat'] && get_field('mapa')['lng']) : ?>
                    <div class="box">
                        <div class="h2 flex-align-center">Lokacija</div>
                        <?php
                            //get lat long
                            $lat = get_field('mapa')['lat'];
                            $lng = get_field('mapa')['lng'];
                            $title = get_the_title();
                            $address = get_field('adresa');
                            
                            //show leaflet map  
                            ?>
                        <div id="single-map" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>"
                            data-title="<?php echo $title; ?>" data-address="<?php echo $address; ?>"></div>
                    </div>
                    <?php endif; ?>

                    <div class="box" id="recenzija">
                        <div class="h2 flex-align-center">
                            Napiši recenziju
                        </div>
                        <div id="napisi-recenziju" class="anchor"></div>
                        <div class="flex-align-center">
                            <p>Ocena:</p>
                        </div>
                        <textarea name="add_review_text" cols="40" rows="6" placeholder="Tekst *"></textarea>
                        <input type="hidden" name="add_review_id" value="103154">
                        <div name="review_images" class="gallery flex-wrap"></div>
                        <div class="flex">
                            <div class="flex button-add-photo-wrap">
                                <label>Dodaj sliku:
                                    <input name="image" type="file" accept="image/*" multiple="">
                                </label>
                            </div>
                        </div>
                        <div class="flex">
                            <a href="#" class="button button-blue">Pošalji</a>
                        </div>
                    </div>

                    <div class="box">
                        <div class="h2">Druge slične lokacije</div>
                        <ul class="items concurrent flex-column">
                            <li class="flex">
                                <a onclick="#" href="#">
                                    <img
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png">
                                </a>
                                <div class="header-wrap">
                                    <a onclick="#" href="#">Rent a car Avaco</a>

                                    <ul class="info info-border-bottom">
                                        <li>
                                            <a name="adresa">Trnska 7, 11111 Beograd (Vračar)</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="flex">
                                <a onclick="#" href="#">
                                    <img
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png">
                                </a>
                                <div class="header-wrap">
                                    <a onclick="#" href="#">Rent a car Avaco</a>


                                    <ul class="info info-border-bottom">
                                        <li>
                                            <a name="adresa">Trnska 7, 11111 Beograd (Vračar)</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>


                </div>

            </div> <!-- col-md-8-->

            <div class="col-md-4">

                <aside class="box-widget-wrap full-height">
                    <div class="sticky-sidebar small-top fl-wrap">
                        <div class="box-widget-item fl-wrap">
                            <div class="box-widget">
                                <div class="box-widget-content">
                                    <div class="box-widget-item-header">
                                        <h3>Kategorije: </h3>
                                    </div>
                                    <ul class="cat-item">
                                        <li><a href="#">Vodič</a> <span>(12)</span></li>
                                        <li><a href="#">Zabavnik</a> <span>(1)</span></li>
                                        <li><a href="#">Vesti</a> <span>(6)</span></li>
                                        <li><a href="#">Dobre priče</a> <span>(5)</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

            </div><!-- col-md-4-->
        </div> <!-- col-md-row-->
    </div>
</section>

<script>
THEME_DIR = "<?php echo get_stylesheet_directory_uri() ?>";
</script>

<script src="<?php echo get_template_directory_uri() ?>/js/single-oglas.js"></script>


<?php get_footer(); ?>