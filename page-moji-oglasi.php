<?php
/*
Template Name: Moji oglasi
*/
?>

<?php
function get_oglasi_breadcrumb() {
    global $post;
    $terms = get_the_terms( $post->ID , 'oblast' )[0];

    if($terms->parent) {
        //get parent and echo
        $parent = get_term( $terms->parent );
        //var_dump($parent);
        if($parent->name) {
            echo '<a href="'.get_term_link($parent->term_id).'" rel="nofollow">'. $parent->name .'</a>';
        }
    }

    

    return;
}
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
                    <a href="/dodaj-oglas" class="button button-blue dodaj-oglas">+ Dodaj oglas</a>
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
                                        Kategorija:&nbsp
                                        <?php
                                        
                                        get_oglasi_breadcrumb();
                                        ?>
                                    </span>
                                </div>
                                <div class="my-oglas-options">
                                    <img src="<?php echo get_template_directory_uri() ?>/icons/dots.svg">
                                    <ul class="options-menu">
                                        <li><a href="/izmeni-oglas/?id=<?php echo $post->ID ?>">Izmeni oglas</a></li>
                                        <!-- <li><a href="#">Obriši oglas</a></li> -->
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

                <?php include(get_template_directory() . '/parts/sidebar-moj-profil.php') ?>

            </div><!-- col-md-4-->

        </div>


    </section>
</div>


<script>
var filesPath = '<?php echo get_stylesheet_directory_uri(); ?>';
</script>

<script src="<?php echo get_stylesheet_directory_uri() . '/js/moji-oglasi.js' ?>"></script>




<?php get_footer(); ?>