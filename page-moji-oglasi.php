<?php
/*
Template Name: Moji oglasi
*/
?>
<?php get_header(); ?>

<div class="container">
    <section>

        <div class="section-title">
            <h1>Moji oglasi</h1>
        </div>

        <div class="row-flex fl w-100">
            <div class="col-md-8">

                <div class="box" id="mojiOglasi">
                    <p><input type="submit" class="button button-blue" id="" value="+ Dodaj oglas" name=""></p>
                    <h2>Moji oglasi</h2>
                    <div class="oglasi-list">
                        <ul class="my-oglasi">

                            <?php
                            //get oglasi by current user ID
                            $user_ID = get_current_user_id(); 

                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array( 
                                'post_type' => 'oglasi',
                                'author'    =>  $user_ID, 
                                'post_status' => 'publish',
                                'post_per_page' => '4',
                                'order'         =>  'ASC',
                                'paged' => $paged,
                            );

                            $the_query = new WP_Query( $args );

                            ?>


                            <?php if( $the_query->have_posts() ): ?>


                            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

                            <li class="my-oglas-list">
                                <a href="<?php the_permalink(); ?>" class="my-oglasi-img">
                                    <?php
                                    //get featured image
                                    $featuredUrlImg = get_the_post_thumbnail_url();
                                    if($featuredUrlImg) :
                                    ?>
                                    <img src="<?php echo $featuredUrlImg ?>" />
                                    <?php else: ?>
                                    <img
                                        src="<?php echo get_stylesheet_directory_uri() . '/icons/default-oglas-img.jpg' ?>" />
                                    <?php endif; ?>
                                </a>
                                <div class="my-oglasi-descr">
                                    <a href="<?php the_permalink(); ?>" title="">
                                        <h3><?php the_title(); ?></h3>
                                    </a>
                                    <div class="stars">stars</div>

                                    <ul class="info">

                                        <li>
                                            <div class="wrap">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/pin.svg' ?>"
                                                    width="14">
                                            </div>
                                            <p><?php the_field('adresa'); 
                                                if(get_field('ogrug') != '') echo ', ' . get_field('ogrug'); 
                                                if(get_field('grad') != '') echo ' (' . get_field('grad') . ')'; 
                                                if(get_field('postanski_broj') != '') echo ', ' . get_field('postanski_broj'); 
                                                if(get_field('drzava') != '') echo ', ' . get_field('drzava'); 
                                            ?></p>
                                        </li>


                                    </ul>

                                    <span class="my-oglasi-date">
                                        <img src="<?php echo get_template_directory_uri() ?>/icons/tags.svg" />
                                        Kategorija:
                                    </span>
                                </div>
                                <div class="my-oglas-options">
                                    <img src="<?php echo get_template_directory_uri() ?>/icons/dots.svg">
                                    <ul class="options-menu">
                                        <li><a href="#">Izmeni oglas</a></li>
                                        <li><a href="#">Obriši oglas</a></li>
                                    </ul>
                                </div>

                            </li>

                            <?php endwhile; ?>

                            <?php endif; ?>

                        </ul>
                    </div>
                    <?php wp_reset_query(); ?>

                    <div class="box cat-pag">
                        <nav>
                            <ul>
                                <li><?php previous_posts_link( '&laquo; Nazad', $the_query->max_num_pages) ?></li>
                                <li><?php next_posts_link( 'Napred &raquo;', $the_query->max_num_pages) ?></li>
                            </ul>
                        </nav>
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
                                        <h3>Opcije: </h3>
                                    </div>
                                    <ul class="sidebar-opcije">
                                        <li><a href="#mojiOglasi">Moji oglasi</a></li>
                                        <li><a href="#mojProfil">Moj profil</a></li>
                                        <li><a href="#promeniLozinku">Promeni lozinku</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>

            </div><!-- col-md-4-->

        </div>


    </section>
</div>



<?php get_footer(); ?>