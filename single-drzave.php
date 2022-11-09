<?php
/*
Template Name: Single lokacije
*/
?>
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
            $ImgUrl = wp_get_attachment_image_src( $imgId, 'full' )[0];
            

            if(!$imgUrl) {
               // $imgUrl = get_template_directory_uri() . '/icons/placeh.jpg';
            }
            ?>
            <div class="gallery-item">
                <div class="grid-item-holder">
                    <div class="listing-item-grid">
                        <img class="bg" src="<?php echo $ImgUrl ?>">
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


    <!--<section class="container">
            <div class="section-title">
                <h2 class="h1">Najpopularnije lokacije</h2>
            </div>
            <div class="list-carousel home-objects mob-horizontal-scroll card-listing">
                <div class="listing-carousel fl-wrap slick-initialized slick-slider slick-dotted">



                    <div class="slick-list draggable" style="padding: 0px;">
                        <div class="slick-track"
                            style="opacity: 1; width: 1165px; transform: translate3d(0px, 0px, 0px);">
                            <div class="slick-slide-item slick-slide slick-current slick-center" tabindex="0"
                                role="tabpanel" id="slick-slide00" aria-describedby="slick-slide-control00"
                                style="width: 233px;" data-slick-index="0" aria-hidden="true">

                                <div class="listing-item simple-item" data-view="false" data-id="20672"
                                    data-company-id="387">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <div class="no-img s400x300"></div>
                                            <img src="#" title="title" alt="title">
                                            <div class="overlay"></div>

                                        </div>
                                        <div class="geodir-category-content with-logo  no-contacts fl-wrap">
                                            <div class="geodir-category-header">
                                                <h2>
                                                    <a href="#" tabindex="-1">Cvećara Ivona</a>
                                                </h2>
                                            </div>

                                            <div class="geodir-category-options fl-wrap">
                                                <a href="#" class="listing-rating card-popup-rainingvis"
                                                    data-starrating2="4" tabindex="-1"><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star" style="color: #c2c2c2;"></i>
                                                    <span>(1)</span>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <div class="slick-slide-item slick-slide" tabindex="0" role="tabpanel"
                                id="slick-slide01" aria-describedby="slick-slide-control01"
                                style="width: 233px;" data-slick-index="1" aria-hidden="true">

                                <div class="listing-item simple-item" data-view="false" data-id="20672"
                                    data-company-id="387">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <div class="no-img s400x300"></div>
                                            <img src="#" title="title" alt="title">
                                            <div class="overlay"></div>

                                        </div>
                                        <div class="geodir-category-content with-logo  no-contacts fl-wrap">
                                            <div class="geodir-category-header">
                                                <h2>
                                                    <a href="#" tabindex="-1">Cvećara Ivona</a>
                                                </h2>
                                            </div>

                                            <div class="geodir-category-options fl-wrap">
                                                <a href="#" class="listing-rating card-popup-rainingvis"
                                                    data-starrating2="4" tabindex="-1"><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star" style="color: #c2c2c2;"></i>
                                                    <span>(1)</span>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <div class="slick-slide-item slick-slide" tabindex="0" role="tabpanel"
                                id="slick-slide02" aria-describedby="slick-slide-control02"
                                style="width: 233px;" data-slick-index="2" aria-hidden="true">


                                <div class="listing-item simple-item" data-view="false" data-id="20672"
                                    data-company-id="387">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <div class="no-img s400x300"></div>
                                            <img src="#" title="title" alt="title">
                                            <div class="overlay"></div>

                                        </div>
                                        <div class="geodir-category-content with-logo  no-contacts fl-wrap">
                                            <div class="geodir-category-header">
                                                <h2>
                                                    <a href="#" tabindex="-1">Cvećara Ivona</a>
                                                </h2>
                                            </div>

                                            <div class="geodir-category-options fl-wrap">
                                                <a href="#" class="listing-rating card-popup-rainingvis"
                                                    data-starrating2="4" tabindex="-1"><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star" style="color: #c2c2c2;"></i>
                                                    <span>(1)</span>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>

                            </div>
                            <div class="slick-slide-item slick-slide" tabindex="0" role="tabpanel"
                                id="slick-slide03" aria-describedby="slick-slide-control03"
                                style="width: 233px;" data-slick-index="3" aria-hidden="true">

                                <div class="listing-item simple-item" data-view="false" data-id="20672"
                                    data-company-id="387">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <div class="no-img s400x300"></div>
                                            <img src="#" title="title" alt="title">
                                            <div class="overlay"></div>

                                        </div>
                                        <div class="geodir-category-content with-logo  no-contacts fl-wrap">
                                            <div class="geodir-category-header">
                                                <h2>
                                                    <a href="#" tabindex="-1">Cvećara Ivona</a>
                                                </h2>
                                            </div>

                                            <div class="geodir-category-options fl-wrap">
                                                <a href="#" class="listing-rating card-popup-rainingvis"
                                                    data-starrating2="4" tabindex="-1"><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star" style="color: #c2c2c2;"></i>
                                                    <span>(1)</span>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <div class="slick-slide-item slick-slide slick-active slick-center" tabindex="0"
                                role="tabpanel" id="slick-slide04" aria-describedby="slick-slide-control04"
                                style="width: 233px;" data-slick-index="4" aria-hidden="false">

                                <div class="listing-item simple-item" data-view="false" data-id="20672"
                                    data-company-id="387">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <div class="no-img s400x300"></div>
                                            <img src="#" title="title" alt="title">
                                            <div class="overlay"></div>

                                        </div>
                                        <div class="geodir-category-content with-logo  no-contacts fl-wrap">
                                            <div class="geodir-category-header">
                                                <h2>
                                                    <a href="#" tabindex="0">Cvećara Ivona</a>
                                                </h2>
                                            </div>

                                            <div class="geodir-category-options fl-wrap">
                                                <a href="#" class="listing-rating card-popup-rainingvis"
                                                    data-starrating2="4" tabindex="0"><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star" style="color: #c2c2c2;"></i>
                                                    <span>(1)</span>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="slick-dots" role="tablist">
                        <li class="slick-active" role="presentation"><button type="button" role="tab"
                                id="slick-slide-control00" aria-controls="slick-slide00" aria-label="1 of 1"
                                tabindex="0" aria-selected="true">1</button></li>
                    </ul>
                </div>

                <div class="swiper-button-prev sw-btn"><i class="fas fa-long-arrow-alt-left"></i></div>
                <div class="swiper-button-next sw-btn"><i class="fas fa-long-arrow-alt-right"></i></div>
            </div>
        </section> -->


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