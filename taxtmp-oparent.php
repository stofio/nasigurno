<?php
/*
Taxonomy oblast PERENT 
*/

//get current taxonomy
$term = get_queried_object(); 

//get child taxonomies
$children = get_terms( $term->taxonomy, array(
    'parent'    => $term->term_id,
    'hide_empty' => true
) ); 

?>
<?php get_header(); ?>

<div class="container">
    <div class="row row-flex fl">
        <div class="col-md-8">

            <section class="page-main-content">
                <div class="box">
                    <h1><?php echo removeCatBrackets($term->name) ?></h1>

                    <ul class="list-categories">
                        <?php
                        if ( $children ) { 
                            foreach( $children as $subcat )
                            {
                                echo '<li><a href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . // wrapped
                                removeCatBrackets($subcat->name) . '<span> (' . $subcat->count . ')</span>' . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
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