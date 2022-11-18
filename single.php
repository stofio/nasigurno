<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Nasigurno
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="container">
    <div class="row row-flex fl">
        <div class="col-md-8">

            <section class="page-main-content">
                <?php the_post_thumbnail( 'full' ) ?>
                <div class="box with-img-top">
                    <h1><?php the_title(); ?></h1>
                    <div class="post-opt">
                        <ul>
                            <li><img src="<?php echo get_template_directory_uri() ?>/icons/calendar.svg" />
                                <span><?php echo get_the_date() ?></span>
                            </li>
                            <li><img src="<?php echo get_template_directory_uri() ?>/icons/tags.svg" />
                                <a
                                    href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->cat_name ?></a>
                            </li>
                        </ul>
                    </div>
                    <?php the_content(); ?>

                    <div class="single-share">
                        <div>
                            <span>Podeli: </span> <?php include get_template_directory() . '/parts/share-box.php'; ?>
                        </div>
                    </div>

                    <?php 
                    //TAGS
                        $tags = get_the_tags(get_the_ID());
                        echo '<ul class="single-tags">';
                        echo '<h4>Tagovi</h4>';
                        foreach ($tags as $tag) {
                        echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
                        }
                        echo '</ul>';
                    ?>



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


<?php endwhile; ?>

<?php get_footer();