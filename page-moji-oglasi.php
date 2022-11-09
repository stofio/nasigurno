<?php
/*
Template Name: Moji oglasi
*/
?>
<?php get_header(); ?>

<div class="container">
    <section>

        <div class="section-title">
            <h1>Podešavanja</h1>
        </div>

        <div class="row-flex fl">
            <div class="col-md-8">

                <div class="box" id="mojiOglasi">
                    <p><input type="submit" class="button button-blue" id="" value="+ Dodaj oglas" name=""></p>
                    <h2>Moji oglasi</h2>
                    <div class="oglasi-list">
                        <ul class="my-oglasi">

                            <?php
                            //get oglasi by current user ID
                            $user_ID = get_current_user_id(); 
                            echo $user_ID;
                            
                            ?>

                            <li class="my-oglas-list">
                                <a href="#" class="my-oglasi-img">
                                    <img
                                        src="https://blooloop.com/wp-content/uploads/2018/02/IMG-worlds-of-adventure.jpg">
                                </a>
                                <div class="my-oglasi-descr">
                                    <a href="#" title="">
                                        <h3>„Bubijada“ u Šapcu | Turistički kalendar Srbije</h3>
                                    </a>
                                    <div class="stars">stars</div>
                                    <ul class="info">
                                        <li>
                                            <div class="wrap">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/pin.svg' ?>"
                                                    width="14">
                                            </div>
                                            <p>Mije Kovačevića 10, 11120 Beograd (Palilula)</p>
                                        </li>
                                        <li>
                                            <div class="wrap"><img
                                                    src="<?php echo get_stylesheet_directory_uri() . '/store-locator/icons/phone.svg' ?>"
                                                    width="11"></div>
                                            <p>011/2442-801</p>
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

                        </ul>
                    </div>
                    <div class="more-btn">
                        <a href="#">Vidi sve moje oglase &#10148;</a>
                    </div>

                </div>

                <div class="box" id="mojProfil">
                    <h2>Moj profil</h2>
                    <form class="theme-form">
                        <p>
                            <label>Puno ime:</label>
                            <input id="" type="text" size="20" value="" name="">
                        </p>
                        <p>
                            <label>Korisničko ime:</label>
                            <input id="" type="text" size="20" value="" name="">
                        </p>
                        <p>
                            <label>Email:</label>
                            <input id="" type="email" size="20" value="" name="">
                        </p>
                        <p><input type="submit" class="button button-blue" id="" value="Sačuvaj podatke" name=""></p>
                    </form>

                </div>

                <div class="box" id="promeniLozinku">
                    <h2>Promeni lozinku</h2>
                    <form class="theme-form change-password">
                        <p>
                            <label>Stara šifra:</label>
                            <input id="" type="password" size="20" value="" name="">
                        </p>
                        <p>
                            <label>Nova šifra:</label>
                            <input id="" type="password" size="20" value="" name="">
                        </p>
                        <p>
                            <label>Ponovljena nova šifra:</label>
                            <input id="" type="password" size="20" value="" name="">
                        </p>
                        <p><input type="submit" class="button button-blue button-disabled" id="" value="Sačuvaj lozinku"
                                name=""></p>
                    </form>

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