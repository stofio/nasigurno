<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.css" />

<div class="container">

    <div id="homepage">

        <div class="section-title">
            <h1>Poslovni imenik nasigurno.com</h1>
        </div>

        <div class="home-search-container">
            <div class="home-search">
                <div class="search-input pos-rel">
                    <div class="header-search-input-item">
                        <button class="header-search-button left-side"><i class="fa fa-search"></i></button>
                        <input id="searchInput" name="search" type="search" placeholder="Pretraži na nasigurno"
                            value="" />
                        <button class="header-search-button right-side hidden"><i class="fa fa-times"></i></button>
                    </div>
                    <ul id="searchres" class="autocomplete-list"></ul>
                </div>
            </div>
        </div>

        <div class="home-desc">
            <p>
                Poslovni imenik NaSigurno sadrži preko 270.000 kreiranih profila iz Bosne i Hercegovine, Hrvatske,
                Srbije, Slovenije, Crne Gore i Makedonije.
                Pre nego što kreirate Vaš profil procitajte naše <a href="#">savete.</a>
                <br>Ova usluga je potpuno besplatna.
            </p>
        </div>


        <section class="container">
            <div class="section-title" style="margin-top:20px;">
                <h2 class="subt">Najpopularnije kategorije na nasigurno</h2>
            </div>

            <div class="gallery-items fl-wrap mr-bot spad mob-horizontal-scroll small-padding">
                <?php
            $categorisIdArreay = explode( ',', get_field('field_63727ec0ee60c') ); //najpopularnije_kategorije


            
            $cats = get_terms( array(
                'taxonomy' => 'oblast',
                'include' => $categorisIdArreay,
                'hide_empty'  => false, 
                'orderby' => 'term_id',
              ) );

            foreach($cats as $cat) :

            //get featured image or placeholder

            $imgId = get_term_meta($cat->term_id, 'pozadina', true);
            $imgUrl = wp_get_attachment_image_src( $imgId, 'full' );
            

            if(!$imgUrl) {
                $imgUrl = get_template_directory_uri() . '/icons/default-oglas-img.jpg';
            }
            else {
                $imgUrl = $imgUrl[0];
            }
            ?>
                <div class="gallery-item">
                    <div class="grid-item-holder">
                        <div class="listing-item-grid">
                            <img class="bg" src="<?php echo $imgUrl ?>">
                            <div class="listing-item-cat">
                                <h2><a
                                        href="<?php echo get_term_link($cat->term_id) ?>"><?php echo removeCatBrackets($cat->name) ?></a>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </section>


        <div class="home-flags-section">
            <div class="section-title" style="margin-top:20px;">
                <h2 class="subt">Izaberite državu</h2>
            </div>
            <div class="home-flags">

                <div class="single-flag">
                    <div class="single-flag-img">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() . '/icons/flag-Serbia.jpg' ?>" />
                        </a>
                    </div>
                    <div class="single-flag-title">
                        <a href="#">
                            <h3>Srbija</h3>
                        </a>
                    </div>
                </div>

                <div class="single-flag">
                    <div class="single-flag-img">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() . '/icons/cg.jpg' ?>" />
                        </a>
                    </div>
                    <div class="single-flag-title">
                        <a href="#">
                            <h3>Crna Gora</h3>
                        </a>
                    </div>
                </div>

                <div class="single-flag">
                    <div class="single-flag-img">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() . '/icons/bih.jpg' ?>" />
                        </a>
                    </div>
                    <div class="single-flag-title">
                        <a href="#">
                            <h3>Bosna i Herzegovina</h3>
                        </a>
                    </div>
                </div>

                <div class="single-flag">
                    <div class="single-flag-img">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() . '/icons/hr.jpg' ?>" />
                        </a>
                    </div>
                    <div class="single-flag-title">
                        <a href="#">
                            <h3>Hrvatska</h3>
                        </a>
                    </div>
                </div>

                <div class="single-flag">
                    <div class="single-flag-img">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() . '/icons/sl.jpg' ?>" />
                        </a>
                    </div>
                    <div class="single-flag-title">
                        <a href="#">
                            <h3>Slovenija</h3>
                        </a>
                    </div>
                </div>

                <div class="single-flag">
                    <div class="single-flag-img">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() . '/icons/mk.jpg' ?>" />
                        </a>
                    </div>
                    <div class="single-flag-title">
                        <a href="#">
                            <h3>Makedonija</h3>
                        </a>
                    </div>
                </div>

            </div>
        </div>


        <div class="home-blog">
            <div class="container">
                <div class="section-title">
                    <h2 class="h1">Poslednje sa bloga</h2>
                </div>
                <div class="row home-posts mob-horizontal-scroll list-carousel">

                    <div class="glider-contain">
                        <div class="glider">

                            <?php

                        // The Query
                        $args = array(
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'posts_per_page'=>6,
                                    'order'=>'DESC',
                                    'orderby'=>'date',
                                    );

                        $the_query = new WP_Query( $args );

                        // The Loop
                        if ( $the_query->have_posts() ) {
                        $not_in_next_three = array();
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                        ?>


                            <div class="listing-item">
                                <article class="card-post">
                                    <div class="card-post-img fl-wrap">
                                        <a href="#">
                                            <img src="http://localhost/nasigurno/wp-content/uploads/2022/10/frizer-i-lepota.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="card-post-content fl-wrap">
                                        <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                        <p><?php the_excerpt() ?></p>

                                        <div class="post-opt">
                                            <ul>
                                                <li><img
                                                        src="http://localhost/nasigurno/wp-content/themes/nasigurno/icons/calendar.svg">
                                                    <span><?php echo get_the_date() ?></span>
                                                </li>
                                                <li><img
                                                        src="http://localhost/nasigurno/wp-content/themes/nasigurno/icons/tags.svg">
                                                    <a
                                                        href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->cat_name ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <?php }

                    } else {
                    // no posts found
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();

                    ?>

                        </div>

                        <button aria-label="Previous" class="glider-prev">«</button>
                        <button aria-label="Next" class="glider-next">»</button>
                        <div role="tablist" class="dots"></div>
                    </div>

                </div>
            </div>
        </div>






    </div>

</div>

<script>
var filesPath = '<?php echo get_stylesheet_directory_uri(); ?>';
</script>

<script src="<?php echo get_stylesheet_directory_uri() . '/js/searchbox.js' ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>

<script>
var glider = new Glider(document.querySelector('.glider'), {
    slidesToShow: 3,
    dots: '#dots',
    draggable: true,
    arrows: {
        prev: '.glider-prev',
        next: '.glider-next'
    }
});

function sliderAuto(slider, miliseconds) {
    const slidesCount = slider.track.childElementCount;
    let slideTimeout = null;
    let nextIndex = 1;

    function slide() {
        slideTimeout = setTimeout(
            function() {
                if (nextIndex >= slidesCount) {
                    nextIndex = 0;
                }
                slider.scrollItem(nextIndex++);
            },
            miliseconds
        );
    }

    slider.ele.addEventListener('glider-animated', function() {
        window.clearInterval(slideTimeout);
        slide();
    });

    slide();
}

sliderAuto(glider, 3000)
</script>


<?php get_footer(); ?>