<?php get_header(); ?>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />

<div class="mesto-map" style="height: 400px; background-color: grey; width:100%">
    <div id="drzava-map" class="drzava-map" data-drzava="<?php echo $post->post_name; ?>"></div>
</div>


<div class="gray-section top-padding no-overflow">
    <section class="container">
        <div class="section-title" style="margin-top:20px;">
            <h1><?php echo $post->post_title; ?>: najbolje kategorije</h1>
        </div>

        <div class="gallery-items fl-wrap mr-bot spad mob-horizontal-scroll small-padding">
            <?php
            $categorisIdArreay = explode( ',', get_field('kategorije_ids') );

            
            $cats = get_terms( array(
                'taxonomy' => 'oblast',
                'include' => $categorisIdArreay,
                'hide_empty'  => false, 
                'orderby' => 'term_id',
              ) );

            foreach($cats as $cat) :

            //get featured image or placeholder

            $imgId = get_term_meta($cat->term_id, 'pozadina', true);
            $imgUrl = wp_get_attachment_image_src( $imgId, 'full' );
            

            if(!$imgUrl) {
                $imgUrl = get_template_directory_uri() . '/icons/default-oglas-img.jpg';
            }
            else {
                $imgUrl = $imgUrl[0];
            }
            ?>
            <div class="gallery-item">
                <div class="grid-item-holder">
                    <div class="listing-item-grid">
                        <img class="bg" src="<?php echo $imgUrl ?>">
                        <div class="listing-item-cat">
                            <h2><a
                                    href="<?php echo get_term_link($cat->term_id) ?>"><?php echo removeCatBrackets($cat->name) ?></a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
    </section>
    <!--container-->

    <section class="container">
        <div class="gradovi-list">
            <div class="section-title">
                <h2 class="h1">Pretražite po gradovima</h2>
            </div>

            <div class="list-single-main-wrapper fl-wrap" id="sec2">
                <div class="list-single-main-item small-padding no-margin-bottom fl-wrap">
                    <ul class="list-index fl-wrap">
                        <?php
                        $gradoviArray = preg_split( "/\r\n|\n|\r/", get_field('gradovi') );
                        foreach($gradoviArray as $grad) :
                        ?>
                        <li class="col-lg-3 col-sm-4 col-xs-6">
                            <a href="?grad=<?php echo $grad ?>"><?php echo $grad ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
        </div>
    </section>

</div> <!-- Content end -->

<script>
THEME_DIR = "<?php echo get_stylesheet_directory_uri() ?>";
DRZAVA = "<?php echo $post->post_title ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/drzava.js' ?>"></script>


<?php get_footer(); ?>