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
                    if($featuredUrlImg) {
                        $mainImgUrl = $featuredUrlImg;
                    }
                    else {
                        $mainImgUrl = get_template_directory_uri() . '/icons/default-oglas-img.jpg';
                    }
                    ?>
                    <img class="single-featured-img" src="<?php echo $mainImgUrl ?>" />


                    <div class="box with-img-top">
                        <div class="breadcrumb-block"><?php get_oglasi_breadcrumb(); ?></div>
                        <h1><?php the_title() ?></h1>

                        <?php
                        $comments = get_comments(array(
                            'post_id' => $post->ID,
                            'status'  => 'approve',
                        ));
                        ?>
                        <?php 
                            $comNum = 0;
                            $ratings = [];
                            ?>
                        <?php foreach($comments as $comment):
                            $comNum++;
                            $r = (int)get_comment_meta($comment->comment_ID, 'stars')[0];
                            array_push($ratings, $r);

                            endforeach; 

                            //get avarage
                            $av = array_filter($ratings);
                            if(count($av)) {
                                $average = array_sum($av)/count($av);
                            }
                            else {
                                $average = 0;
                            }
                        ?>
                        <div class="revStars bigger-stars" style="--rating: <?php echo $average; ?>;">
                            <span>(<?php echo $comNum; ?>)</span>
                        </div>


                        <ul class="info">
                            <?php if(get_field('adresa') != '') : ?>
                            <li>
                                <div class="wrap">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/pin.svg' ?>"
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
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/phone.svg' ?>"
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
                                        src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/web.svg' ?>"
                                        width="15"></div>
                                <a href="<?php the_field('website') ?>"
                                    target="_blank"><?php the_field('website') ?></a>
                            </li>
                            <?php endif; ?>

                            <?php if(get_field('video')  != '') : ?>
                            <li>
                                <div class="wrap"><img
                                        src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/video.svg' ?>"
                                        width="15"></div>
                                <a href="<?php the_field('video') ?>" target="_blank"><?php the_field('video') ?></a>
                            </li>
                            <?php endif; ?>

                            <?php if(get_field('radno_vreme')  != '') : ?>
                            <li>
                                <div class="wrap"><img
                                        src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/clock.svg' ?>"
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
                            <a href="#vidimapi" class="btn transparent-btn float-btn">Vidi na mapi
                                <img src="<?php echo get_template_directory_uri() ?>/icons/map.svg" />
                            </a>
                            <div class="single-share-box">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                    title="Deli na Facebook" class="">
                                    <svg class="h-6 w-6 mx-auto" fill="#222" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta( 'twitter' ); ?>"
                                    class="">
                                    <svg class="h-6 w-6 mx-auto" fill="#222" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                        </path>
                                    </svg>
                                </a>
                                <a href="mailto:?subject=Pogledaj%20ovaj%20članak%20od%20<?php bloginfo('name'); ?>&body=<?php the_title(); ?> - <?php the_permalink(); ?>"
                                    class="" role="button" aria-label="Deli na Email">
                                    <svg class="h-6 w-6 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="#222">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
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
                        $tags = get_the_terms($post, 'oglasi_tagovi');
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
                    <div class="box" id="vidimapi">
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


                    <?php
                        $comments = get_comments(array(
                            'post_id' => $post->ID,
                            'status'  => 'approve',
                        ));
                    ?>

                    <?php if($comments): ?>



                    <div class="box">
                        <div class="h2 flex-align-center">
                            Recenzije
                        </div>
                        <ul class="recenzije items concurrent flex-column">
                            <?php
                            foreach($comments as $comment) {
                                //get comment meta
                                $comm_stars = get_comment_meta($comment->comment_ID, 'stars')[0];


                                $avatarUrl = get_avatar_url($comment->user_id);

                                if(!$avatarUrl) {
                                    $avatarUrl = get_stylesheet_directory_uri() . '/store-locator/icons/avatar.jpg';
                                }
                                ?>

                            <li class="flex">
                                <div class="user-img-wrap">
                                    <img class="user-img" src="<?php echo $avatarUrl; ?>">
                                </div>
                                <div class="header-wrap review-stars">
                                    <a><?php echo $comment->comment_author; ?></a>

                                    <div class="revStars" style="--rating: <?php echo $comm_stars; ?>;"></div>

                                    <p><?php echo $comment->comment_content; ?></p>

                                    <ul class="info info-border-bottom">
                                        <li>
                                            <a name="adresa"><?php echo substr($comment->comment_date, 0, -9); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <?php    
                            }
                            ?>

                        </ul>
                    </div>
                    <?php endif; ?>




                    <div class="box" id="recenzija">
                        <div class="h2 flex-align-center">
                            Napiši recenziju
                        </div>
                        <div id="napisi-recenziju" class="anchor"></div>

                        <?php if(!is_user_logged_in()): ?>

                        <div class="">
                            <p>Da bi ostavio komentar potrebno je da se registruješ.</p>
                        </div>


                        <?php else: ?>

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

                        <?php endif; ?>

                    </div>

                    <script>
                    $('#nova-recenzija .stars a').on('click', function() {
                        $('#nova-recenzija .stars span, .stars a').removeClass('active');

                        $(this).addClass('active');
                        $('#nova-recenzija .stars span').addClass('active');
                        $('#nova-recenzija #add_review_rating').val($(this).html());
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

                    function showReviewGiven() {
                        $('#nova-recenzija').html(
                            'Uspešno ste objavili komentar! <br> Vaš komentar treba biti prvo prihvaćen od strane admina.'
                        );
                    }

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
                        data.append('add_review_text', $('#add_review_text').val());
                        data.append('add_review_rating', $('#add_review_rating').val());


                        $.ajax({
                            method: "POST",
                            url: "<?php echo get_stylesheet_directory_uri() ?>/scripts/saveReview.php",
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                showReviewGiven();
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

                        <?php
                        $terms = get_the_terms( $post->ID , 'oblast' )[0];

                        if($terms->parent) {
                            $parent = get_term( $terms->parent );
                            $termId = $parent->term_id;
                        }
                        else {
                            $termId = $terms->term_id;
                        }

                        $args = array(
                            'post_type' => 'oglasi',
                            'posts_per_page' => 4,
                            'orderby'        => 'rand',
                            'tax_query' => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'oblast',
                                    'field' => 'ID',
                                    'terms' => $termId
                                )
                             ),
                        
                        );

                        $the_query = new WP_Query( $args );
                        ?>

                        <?php if( $the_query->have_posts() ): ?>
                        <ul class="items concurrent flex-column slicne-loc">
                            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

                            <?php 
                            $featuredUrlImg = get_the_post_thumbnail_url();
                            if($featuredUrlImg) {
                                $imgUrl = $featuredUrlImg;
                            }
                            else {
                                $imgUrl = get_template_directory_uri() . '/icons/default-oglas-img.jpg';
                            }
                            ?>

                            <li class="flex">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo $imgUrl; ?>">
                                </a>
                                <div class="header-wrap">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                                    <ul class="info info-border-bottom">
                                        <li>
                                            <span>
                                                <?php the_field('adresa'); 
                                                if(get_field('ogrug') != '') echo ', ' . get_field('ogrug'); 
                                                if(get_field('grad') != '') echo ' (' . get_field('grad') . ')'; 
                                                if(get_field('postanski_broj') != '') echo ', ' . get_field('postanski_broj'); 
                                                if(get_field('drzava') != '') echo ', ' . get_field('drzava'); 
                                                ?>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>


                        <?php wp_reset_query(); ?>

                    </div>


                </div>

            </div> <!-- col-md-8-->

            <div class="col-md-4">

                <aside class="box-widget-wrap full-height">
                    <?php
                    $author_id = get_post_field( 'post_author', $post->ID );
                    $user_ID = get_current_user_id();
                        if($author_id == $user_ID) :
                            ?>
                    <div class="box-widget-content">
                        <ul class="sidebar-opcije">
                            <li><a class="btn transparent-btn red-bord"
                                    href="/izmeni-oglas/?id=<?php echo $post->ID ?>">
                                    Izmeni oglas</a>
                            </li>

                        </ul>
                    </div>
                    <?php
                        endif;
                    ?>
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