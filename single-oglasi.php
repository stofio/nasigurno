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
                                <!--
                                <a href="whatsapp://send?text=<?php the_permalink(); ?>"
                                    data-action="share/whatsapp/share" class="" role="button"
                                    aria-label="Deli na Whatsapp">
                                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 240 241.19">
                                        <title>whatsapp-color</title>
                                        <path fill="#222"
                                            d="M205,35.05A118.61,118.61,0,0,0,120.46,0C54.6,0,1,53.61,1,119.51a119.5,119.5,0,0,0,16,59.74L0,241.19l63.36-16.63a119.43,119.43,0,0,0,57.08,14.57h0A119.54,119.54,0,0,0,205,35.07v0ZM120.5,219A99.18,99.18,0,0,1,69.91,205.1l-3.64-2.17-37.6,9.85,10-36.65-2.35-3.76A99.37,99.37,0,0,1,190.79,49.27,99.43,99.43,0,0,1,120.49,219ZM175,144.54c-3-1.51-17.67-8.71-20.39-9.71s-4.72-1.51-6.75,1.51-7.72,9.71-9.46,11.72-3.49,2.27-6.45.76-12.63-4.66-24-14.84A91.1,91.1,0,0,1,91.25,113.3c-1.75-3-.19-4.61,1.33-6.07s3-3.48,4.47-5.23a19.65,19.65,0,0,0,3-5,5.51,5.51,0,0,0-.24-5.23C99,90.27,93,75.57,90.6,69.58s-4.89-5-6.73-5.14-3.73-.09-5.7-.09a11,11,0,0,0-8,3.73C67.48,71.05,59.75,78.3,59.75,93s10.69,28.88,12.19,30.9S93,156.07,123,169c7.12,3.06,12.68,4.9,17,6.32a41.18,41.18,0,0,0,18.8,1.17c5.74-.84,17.66-7.21,20.17-14.18s2.5-13,1.75-14.19-2.69-2.06-5.7-3.59l0,0Z" />
                                    </svg>
                                </a>
                                <a href="viber://forward?text=<?php the_permalink(); ?>" class="" role="button"
                                    aria-label="Deli na Viber">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333334 333334"
                                        shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                        image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd">
                                        <path
                                            d="M166667 0c46023 0 87690 18655 117851 48816s48816 71828 48816 117851-18655 87690-48816 117851-71828 48816-117851 48816-87690-18655-117851-48816S0 212690 0 166667 18655 78977 48816 48816 120644 0 166667 0zm22374 119879c5776 1232 10204 3431 13987 6980 4867 4603 7536 10174 8708 18180 792 5219 470 7272-1378 8973-1730 1583-4926 1642-6861 147-1407-1056-1847-2170-2170-5191-381-4017-1085-6832-2287-9442-2581-5542-7126-8416-14808-9354-3607-439-4692-850-5865-2228-2140-2552-1319-6685 1642-8211 1115-557 1584-616 4047-469 1524 88 3783 352 4985 615zm-8269-43397c10087 1261 18239 3695 27182 8064 8796 4311 14426 8386 21874 15805 6979 7008 10850 12316 14955 20555 5718 11494 8973 25158 9529 40201 206 5131 59 6275-1114 7741-2228 2845-7125 2375-8796-820-528-1056-675-1964-850-6070-294-6304-733-10380-1613-15248-3460-19089-12609-34336-27212-45274-12169-9148-24748-13606-41227-14574-5571-322-6539-528-7800-1495-2346-1848-2463-6187-206-8210 1378-1261 2346-1437 7126-1291 2492 88 6157 381 8151 616v-1zm-67031 3167c1027 352 2610 1173 3519 1759 5572 3694 21083 23546 26156 33457 2902 5659 3870 9852 2962 12960-939 3343-2493 5102-9443 10703-2785 2258-5395 4574-5805 5190-1056 1525-1907 4516-1907 6627 30 4897 3196 13781 7361 20614 3225 5307 9002 12110 14719 17330 6715 6157 12638 10350 19324 13664 8591 4281 13841 5366 17681 3577 967-439 1994-1026 2317-1289 293-265 2550-3021 5014-6070 4750-5982 5834-6950 9090-8064 4135-1407 8357-1027 12608 1143 3226 1672 10263 6041 14808 9207 5981 4193 18766 14632 20496 16715 3050 3753 3578 8561 1525 13869-2170 5600-10615 16098-16509 20584-5337 4047-9119 5600-14104 5835-4105 205-5806-147-11055-2317-41169-16978-74039-42312-100136-77118-13635-18180-24015-37034-31112-56593-4134-11406-4339-16362-938-22197 1466-2463 7712-8562 12257-11963 7565-5630 11055-7712 13841-8298 1906-411 5219-88 7330 675zm69054 18092c17799 2609 31581 10879 40612 24309 5073 7565 8239 16450 9324 25979 381 3490 381 9853-29 10909-382 997-1613 2345-2669 2903-1143 586-3576 528-4925-176-2258-1143-2933-2961-2933-7887 0-7595-1965-15600-5366-21816-3871-7096-9500-12960-16361-17037-5894-3519-14603-6128-22550-6774-2874-234-4457-820-5542-2081-1671-1906-1848-4486-440-6627 1525-2375 3870-2756 10879-1701zm90501-37702c-27287-27287-64987-44165-106628-44165-41642 0-79341 16878-106628 44165s-44165 64987-44165 106628c0 41642 16878 79341 44165 106628s64987 44165 106628 44165c41642 0 79341-16878 106628-44165s44165-64987 44165-106628c0-41642-16878-79341-44165-106628z"
                                            fill="#222" fill-rule="nonzero" />
                                    </svg>
                                </a>
                                -->
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