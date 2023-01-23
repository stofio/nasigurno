<?php get_header(); ?>

<!--section -->
<section class="gray-section top-padding no-overflow">
    <div class="container">
        <div class="section-title">
            <h1>Tag: <span><?php echo single_cat_title(); ?></span></h1>
        </div>
        <div class="row row-flex fl">
            <div class="col-md-8">
                <div class="list-single-main-wrapper fl-wrap">


                    <?php


                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $query = new WP_Query( array(
                        'tax_query'      => array(
                            array(
                                'taxonomy'  => 'oglasi_tagovi',
                                'field'     => 'slug',
                                'terms'     => get_queried_object()->slug
                            )
                        ),
                        'posts_per_page' => 5,
                        'paged' => $paged
                    ) );
                    
                    ?>

                    <?php if ( $query->have_posts() ) : ?>

                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>



                    <div class="box">

                        <div class="listing">
                            <?php
                            //get featured image
                            $featuredUrlImg = get_the_post_thumbnail_url();
                            if($featuredUrlImg) :
                            ?>
                            <img class="single-featured-img" src="<?php echo $featuredUrlImg ?>" />
                            <?php endif; ?>

                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

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

                            <?php if(get_field('opis') != ''): ?>
                            <p class="listing-desc">
                                <?php echo wp_trim_words( get_field('opis'), 30, '...' ); ?>
                            </p>
                            <?php endif; ?>

                            <ul class="info">

                                <li>
                                    <div class="wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/pin.svg' ?>"
                                            width="18">
                                    </div>

                                    <?php the_field('adresa'); 
                                    if(get_field('ogrug') != '') echo ', ' . get_field('ogrug'); 
                                    if(get_field('grad') != '') echo ' (' . get_field('grad') . ')'; 
                                    if(get_field('postanski_broj') != '') echo ', ' . get_field('postanski_broj'); 
                                    if(get_field('drzava') != '') echo ', ' . get_field('drzava'); 
                                    ?>

                                </li>

                                <?php if(have_rows('telefon')): ?>
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

                            </ul>
                        </div>
                    </div>





                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                    <?php else : ?>
                    <p><?php _e( 'Nema rezultata.' ); ?></p>
                    <?php endif; ?>


                    <div class="box cat-pag">
                        <nav>
                            <ul>
                                <li><?php previous_posts_link( '&laquo; Nazad', $query->max_num_pages) ?></li>
                                <li><?php next_posts_link( 'Napred &raquo;', $query->max_num_pages) ?></li>
                            </ul>
                        </nav>
                    </div>




                </div>

                <!-- pagination-->
                <!-- <div class="row row-flex fl">
                    <div class="col-md-8">
                        <div class="list-single-main-wrapper fl-wrap">
                            <div class="pagination">

                                <a href="#" class="blog-page current-page transition">1</a>
                                <a href="#" class="blog-page transition">2</a>

                                <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- pagination end-->
            </div> <!-- col-md-8-->

            <div class="col-md-4">

                <aside class="box-widget-wrap full-height">
                    <div class="sticky-sidebar small-top fl-wrap">
                        <div class="box-widget-item fl-wrap">
                            <div class="box-widget">
                                <div class="box-widget-content">
                                    <div class="box-widget-item-header">
                                        <h2>Kategorije: </h2>
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


<?php get_footer(); ?>