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
                                'taxonomy'  => 'post_tag',
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



                    <article class="merge-media-and-item">
                        <div class="list-single-main-media fl-wrap">
                            <div class="single-slider-wrapper fl-wrap">
                                <div class="fl-wrap">
                                    <div class="slick-slide-item">
                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                                        <img src="<?php echo $image[0]; ?>" alt="">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div>
                            <p><?php the_excerpt(); ?> </p>

                            <div class="post-opt">
                                <ul>
                                    <li><img src="<?php echo get_template_directory_uri() ?>/icons/calendar.svg" />
                                        <span><?php echo get_the_date(); ?></span>
                                    </li>
                                    <li><img src="<?php echo get_template_directory_uri() ?>/icons/tags.svg" />
                                        <a
                                            href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->cat_name ?></a>
                                    </li>
                                </ul>
                            </div>
                            <span class="fw-separator"></span>
                            <a href="<?php the_permalink(); ?>" class="btn transparent-btn float-btn">Pročitaj više
                                →</a>
                        </div>
                    </article>




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