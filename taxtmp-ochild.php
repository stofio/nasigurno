<?php
/*
Taxonomy oblast CHILD 
*/

?>

<?php get_header(); ?>


<?php

$term_id = get_queried_object()->term_id;

//list all terms from current taxonomy
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'oglasi',
    'posts_per_page' => 20,
    'order' => 'DESC',
    'orderby' => 'post_title',
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'oblast',
            'field' => 'ID',
            'terms' => $term_id
        )
     ),

);
$the_query = new WP_Query( $args );
?>

<div class="container">
    <div class="row row-flex fl">
        <div class="col-md-8">

            <section class="page-main-content oblast-child">
                <div class="box">

                    <?php
                    $imgId = get_term_meta($term_id, 'pozadina', true);
                    $ImgUrl = wp_get_attachment_image_src( $imgId, 'full' )[0];
                    
                    if($ImgUrl) :
                    ?>
                    <img class="tax-featured-img" src="<?php echo $ImgUrl ?>" />
                    <?php endif; ?>

                    <h1><?php echo removeCatBrackets(get_queried_object()->name) ?></h1>

                </div>

                <?php if( $the_query->have_posts() ): ?>
                <ul>
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

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
                </ul>
                <?php endif; ?>

                <?php wp_reset_query(); ?>

                <div class="box cat-pag">
                    <nav>
                        <ul>
                            <li><?php previous_posts_link( '&laquo; Nazad', $cpt_query->max_num_pages) ?></li>
                            <li><?php next_posts_link( 'Napred &raquo;', $cpt_query->max_num_pages) ?></li>
                        </ul>
                    </nav>
                </div>

            </section>

        </div>

        <div class="col-md-4">
            <aside class="box-widget-wrap full-height">

                <div class="sticky-sidebar small-top fl-wrap">
                    <div class="box-widget-item fl-wrap">
                        <div class="box-widget">
                            <div class="box-widget-content">
                                <div class="box-widget-item-header">
                                    <h3>Widget: </h3>
                                </div>
                                <ul class="cat-item">
                                    <li><a href="#">Option</a></li>
                                    <li><a href="#">Option</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>


<?php get_footer(); ?>