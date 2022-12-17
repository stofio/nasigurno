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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
                                    <?php endwhile; ?>
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

                            <?php if(get_field('radno_vreme')  != '') : ?>
                            <li>
                                <div class="wrap"><img
                                        src="http://localhost/nasigurno/wp-content/themes/nasigurno/store-locator/icons/clock.svg"
                                        width="15"></div>
                                <ul class="radno-vreme">
                                    <?php while( have_rows('radno_vreme') ) : the_row(); ?>
                                    <li><b><?php echo get_sub_field('dan') ?></b>:
                                        <span> <?php echo get_sub_field('vreme') ?></span>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
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

                        <?php
                        $tags = get_the_tags();
                        if($tags):
                        ?>
                        <div class="h2">Tagovi</div>
                        <div class="flex-wrap tagovi">
                            <?php
                                foreach($tags as $key => $tag) {
                                    echo '<a class="cat-link" href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
                                }
                            ?>
                        </div>
                        <?php endif; ?>
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

                        <form method="post" id="nova-recenzija">
                            <div class="flex-align-center">
                                <p>Ocena:</p>
                                <p class="stars">
                                    <input id="add_review_rating" name="add_review_rating" type="hidden" value="" />
                                    <span>
                                        <a class="star-1" href="javascript:;">1</a>
                                        <a class="star-2" href="javascript:;">2</a>
                                        <a class="star-3" href="javascript:;">3</a>
                                        <a class="star-4" href="javascript:;">4</a>
                                        <a class="star-5" href="javascript:;">5</a>
                                    </span>
                                </p>
                            </div>
                            <textarea id="add_review_text" name="add_review_text" cols="40" rows="5"
                                placeholder="Tekst *"></textarea>
                            <!--<div name="review_images" class="gallery flex-wrap"></div>-->
                            <div class="flex">
                                <div class="flex button-add-photo-wrap">
                                    <label>Dodaj sliku:
                                        <input id="images" name="images" type="file" accept="image/*" multiple="">
                                    </label>
                                </div>
                            </div>
                            <div class="flex">
                                <input type="submit" class="button button-blue" value="Pošalji">
                            </div>
                        </form>
                    </div>

                    <script>
                    $('.stars a').on('click', function() {
                        $('.stars span, .stars a').removeClass('active');

                        $(this).addClass('active');
                        $('.stars span').addClass('active');
                        $('#add_review_rating').val($(this).html());
                    });

                    $('#nova-recenzija').on('submit', (e) => {
                        e.preventDefault();
                        //check if user has already given review to oglas
                        reviewAlreadyGiven()
                            .then((given) => {
                                if (!given) {
                                    //check if stars and comment are filled
                                    if (isFormValidated(e)) {
                                        saveReview(e);
                                    }
                                }
                            })

                        //ajax
                    });

                    $('#recenzija').on('click', () => {
                        //remove errors
                        $('.form-notice').remove();
                    });

                    function saveReview(e) {
                        var userId = <?php echo get_current_user_id() ?>;
                        var oglasId = <?php echo $post->ID ?>;

                        var data = new FormData();

                        //Form data
                        var form_data = $(e.targe).serializeArray();
                        $.each(form_data, function(key, input) {
                            data.append(input.name, input.value);
                        });

                        //File data
                        var file_data = $('input[name="images"]')[0].files;
                        for (var i = 0; i < file_data.length; i++) {
                            data.append("images[]", file_data[i]);
                        }

                        //Custom data
                        data.append('userId', userId);
                        data.append('oglasId', oglasId);


                        $.ajax({
                            method: "POST",
                            url: "<?php echo get_stylesheet_directory_uri() ?>/scripts/saveReview.php",
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                console.log(data);

                            }
                        });
                    }

                    //return true or false
                    function reviewAlreadyGiven() {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                method: "POST",
                                url: "<?php echo get_stylesheet_directory_uri() ?>/scripts/isReviewGiven.php ",
                                data: {
                                    userId: <?php echo get_current_user_id() ?>,
                                    oglasId: <?php echo $post->ID ?>,
                                },
                                success: function(data) {
                                    //console.log(data);
                                    if (data == 'false') {
                                        resolve(false);
                                    } else if (data == 'true') {
                                        resolve(true);
                                    }

                                }
                            });
                        });
                    }

                    function isFormValidated(e) {
                        let stars = $(e.target).find('#add_review_rating').val();
                        let review = $(e.target).find('#add_review_text').val();

                        if (review == '') {
                            showReviewFromError('review');
                            return false;
                        } else if (stars == '') {
                            showReviewFromError('stars');
                            return false;
                        } else {
                            return true;
                        }

                    }

                    function showReviewFromError(error) {
                        if (error == 'review') {
                            var notice = '<div class="form-notice">Zaboravio si da napišeš recenziju</div>';
                        } else if (error == 'stars') {
                            var notice = '<div class="form-notice">Zaboravio si da oceniš zvezdicama</div>';
                        }
                        $('#nova-recenzija').append(notice);

                    }
                    </script>






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