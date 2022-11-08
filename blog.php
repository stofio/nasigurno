<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>

<!--section -->
<section class="gray-section top-padding no-overflow">
    <div class="container">
        <div class="section-title">
            <h1><span>Blog</span></h1>
        </div>
        <div class="row row-flex fl">
            <div class="col-md-8">
                <div class="list-single-main-wrapper fl-wrap">


                    <article class="merge-media-and-item">
                        <div class="list-single-main-media fl-wrap">
                            <div class="single-slider-wrapper fl-wrap">
                                <div class="fl-wrap">
                                    <div class="slick-slide-item"><img
                                            src="https://c4.wallpaperflare.com/wallpaper/138/1015/764/landscape-nature-uk-wiltshire-fall-hd-wallpaper-thumb.jpg"
                                            alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h2><a href="#">Najbolje pite u Beogradu: Omiljena poslastica, užina ili
                                        doručak?</a></h2>
                            </div>
                            <p>Pite su neizostavni deo tradicionalne srpske trpeze. Slane ili slatke, od
                                mešenih ili gotovih kora, pite su za većinu naših ljudi omiljeni doručak,
                                predjelo, a vrlo često i poslastica. </p>

                            <div class="post-opt">
                                <ul>
                                    <li><img src="<?php echo get_template_directory_uri() ?>/icons/calendar.svg" />
                                        <span>25. jun 2022.</span>
                                    </li>
                                    <li><img src="<?php echo get_template_directory_uri() ?>/icons/tags.svg" />
                                        <a href="#">Dobre priče</a>
                                    </li>
                                </ul>
                            </div>
                            <span class="fw-separator"></span>
                            <a href="#" class="btn transparent-btn float-btn">Pročitaj više →</a>
                        </div>
                    </article>


                    <article class="merge-media-and-item">
                        <div class="list-single-main-media fl-wrap">
                            <div class="single-slider-wrapper fl-wrap">
                                <div class="fl-wrap">
                                    <div class="slick-slide-item"><img
                                            src="https://c4.wallpaperflare.com/wallpaper/138/1015/764/landscape-nature-uk-wiltshire-fall-hd-wallpaper-thumb.jpg"
                                            alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h2><a href="#">Najbolje pite u Beogradu: Omiljena poslastica, užina ili
                                        doručak?</a></h2>
                            </div>
                            <p>Pite su neizostavni deo tradicionalne srpske trpeze. Slane ili slatke, od
                                mešenih ili gotovih kora, pite su za većinu naših ljudi omiljeni doručak,
                                predjelo, a vrlo često i poslastica. </p>

                            <div class="post-opt">
                                <ul>
                                    <li><img src="<?php echo get_template_directory_uri() ?>/icons/calendar.svg" />
                                        <span>25. jun 2022.</span>
                                    </li>
                                    <li><img src="<?php echo get_template_directory_uri() ?>/icons/tags.svg" />
                                        <a href="#">Dobre priče</a>
                                    </li>
                                </ul>
                            </div>
                            <span class="fw-separator"></span>
                            <a href="#" class="btn transparent-btn float-btn">Pročitaj više →</a>
                        </div>
                    </article>

                </div>

                <!-- pagination-->
                <div class="row row-flex fl">
                    <div class="col-md-8">
                        <div class="list-single-main-wrapper fl-wrap">
                            <div class="pagination">

                                <a href="#" class="blog-page current-page transition">1</a>
                                <a href="#" class="blog-page transition">2</a>

                                <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
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