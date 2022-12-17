<?php

include_once '../../../../../wp-load.php';
global $wpdb;

$id = $_GET['id'];


$args = array(
    'post_type' => 'oglasi',
    'p' => $id
);

$post_query = new WP_Query($args);

if($post_query->have_posts() ) {
    while($post_query->have_posts() ) {
        $post_query->the_post();

        $featuredUrlImg = get_the_post_thumbnail_url();
?>

<div class="listing">
    <?php if($featuredUrlImg) : ?>
    <img class="listing-img" src="<?php echo $featuredUrlImg ?>" />
    <?php else: ?>
    <img class="listing-img def" src="<?php echo get_stylesheet_directory_uri() . '/icons/default-oglas-img.jpg' ?>" />
    <?php endif; ?>
    <h4><?php the_title() ?></h4>

    <ul class="info">
        <li>stars</li>
        <li>
            <div class="wrap">
                <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/pin.svg' ?>" width="18">
            </div>

            <?php the_field('adresa'); 
                    if(get_field('ogrug') != '') echo ', ' . get_field('ogrug'); 
                    if(get_field('grad') != '') echo ' (' . get_field('grad') . ')'; 
                    if(get_field('postanski_broj') != '') echo ', ' . get_field('postanski_broj'); 
                    if(get_field('drzava') != '') echo ', ' . get_field('drzava'); 
                    
                ?>
        </li>
        <?php if(have_rows('telefon')) : ?>
        <li>
            <div class="wrap">
                <div class="wrap"><img
                        src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/phone.svg' ?>"
                        width="15"></div>
            </div>
            <div class="phones-container">
                <?php
                        while( have_rows('telefon') ) : the_row(); ?>
                <div class="">
                    <a onclick="#" href="tel:<?php echo get_sub_field('tel') ?>"><?php echo get_sub_field('tel') ?></a>
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
            <div class="wrap"><img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/web.svg' ?>"
                    width="19"></div>
            <a href="<?php the_field('website') ?>"><?php the_field('website') ?></a>
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
    <a href="<?php the_permalink() ?>" class="button flex-align-center">
        Dodatne informacije
    </a>
</div>
<?php
        }
    }



?>