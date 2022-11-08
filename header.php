<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Nasigurno
 * @since 1.0
 * @version 1.0
 */
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php wp_head(); ?>

</head>

<body>



    <!-- header-->
    <header class="main-header dark-header fs-header sticky">
        <div class="header-inner">
            <div class="logo-holder">
                <a href="/">
                    <img
                        src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />
                </a>
            </div>
            <div class="header-search vis-header-search">
                <div class="header-search-input-item">
                    <button class="header-search-button left-side">
                        <img src="<?php echo get_template_directory_uri() ?>/icons/search.svg" />
                    </button>
                    <form id="search" action><input type="search" placeholder="Pretraži" value="" /></form>
                    <button class="header-search-button right-side hidden"><i class="fa fa-times"></i></button>
                    <ul class="autocomplete-list"></ul>
                </div>

            </div>
            <div class="show-search-button">
                <img src="<?php echo get_template_directory_uri() ?>/icons/search.svg" />
            </div>
            <div id="headerUserMenu"></div>
            <div class="nav-button-wrap">
                <img src="<?php echo get_template_directory_uri() ?>/icons/menu.svg" />
            </div>
            <div class="nav-holder main-menu">
                <nav>
                    <ul>
                        <div id="logInOut" class="log-in-out">Login
                        </div>
                        <li>
                            <a class="main-menu-map-button" href="http://localhost/nasigurno/store-locator/">Mapa</a>
                        </li>
                        <li>
                            <a name="gradovi meni" href="javascript:void(0);">Lokacije</a>
                            <ul>
                                <li><a href="#">Srbija</a></li>
                                <li><a href="#">Crna Gora</a></li>
                                <li><a href="#">Bosna i Herzegovina</a></li>
                                <li><a href="#">Hrvatska</a></li>
                                <li><a href="#">Slovenija</a></li>
                                <li><a href="#">Makedonija</a></li>
                            </ul>
                        </li>
                        <li>
                            <a name="magazin meni" href="javascript:void(0);">Pomoć<span class="num-new-posts"
                                    style="display: none;"></span></a>
                            <ul>
                                <li><a href="#">Dobre priče</a></li>
                                <li><a href="#">Vesti</a></li>
                                <li><a href="#">Vodič</a></li>
                                <li><a href="#">Zabavnik</a></li>
                                <li><a href="#">Postanite autor</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">Blog</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- navigation  end -->
        </div>
    </header>



    <main id="main">

        <div id="wrapper">