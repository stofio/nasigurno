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
            <?php if( !is_home() && !is_front_page() ) : ?>
            <div class="header-search vis-header-search">
                <div class="header-search-input-item">
                    <button class="header-search-button left-side">
                        <img src="<?php echo get_template_directory_uri() ?>/icons/search.svg" />
                    </button>
                    <input id="searchInput" type="search" placeholder="Pretraži" value="" />
                    <button class="header-search-button left-side close-s">
                        <img src="<?php echo get_template_directory_uri() ?>/icons/cross.svg" />
                    </button>
                    <button class="header-search-button right-side hidden"><i class="fa fa-times"></i></button>
                    <ul id="searchres" class="autocomplete-list"></ul>
                </div>
            </div>
            <?php endif; ?>
            <?php if(!is_home() && !is_front_page()) : ?>
            <div class="show-search-button">
                <img src="<?php echo get_template_directory_uri() ?>/icons/search.svg" />
            </div>
            <?php endif; ?>
            <div id="headerUserMenu"></div>
            <div class="nav-button-wrap hamb-cont">
                <img class="hamb" src="<?php echo get_template_directory_uri() ?>/icons/menu.svg" />
                <img style="display:none" class="close-hamb"
                    src="<?php echo get_template_directory_uri() ?>/icons/cross.svg" />
            </div>
            <div id="logInOut">
                <?php include(get_template_directory() . '/parts/header-login.php') ?>
            </div>
            <div class="nav-holder main-menu">
                <nav>
                    <ul>
                        <li>
                            <a class="main-menu-map-button" href="http://localhost/nasigurno/store-locator/">Mapa</a>
                        </li>
                        <li>
                            <a name="gradovi meni" href="javascript:void(0);">
                                Lokacije <span><img width="9"
                                        src="<?php echo get_template_directory_uri() ?>/icons/arrow-down.svg" /></span>
                            </a>
                            <ul>
                                <?php foreach(wp_get_nav_menu_items('drzave') as $key => $value) : ?>
                                <li><a href="<?php echo $value->url ?>"><?php echo $value->title ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li>
                            <a name="magazin meni" href="javascript:void(0);">
                                Pomoć <span><img width="9"
                                        src="<?php echo get_template_directory_uri() ?>/icons/arrow-down.svg" /></span>
                            </a>
                            <ul>
                                <?php foreach(wp_get_nav_menu_items('pomoc') as $key => $value) : ?>
                                <li><a href="<?php echo $value->url ?>"><?php echo $value->title ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>

                        <li>
                            <a href="/blog">Blog</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- navigation  end -->
        </div>
    </header>



    <main id="main">

        <div id="wrapper">

            <script>
            // search input on mobile
            $('.show-search-button, .header-search-button').on('click', function() {
                var $searchInput = $('.header-search input');
                if ($(window).width() <= 768) {
                    if ($searchInput.hasClass('mobile-active')) {
                        $searchInput.removeClass('mobile-active');
                        $(".header-search").hide();
                        $(".nav-button-wrap").css('display', 'block');
                        $(".show-search-button").css('display', 'block');
                        $("#logInOut").show();
                    } else {
                        $searchInput.addClass('mobile-active');
                        $(".header-search").show();
                        $(".show-search-button").hide();
                        $(".nav-button-wrap").attr('style', 'display: none !important');
                        $(".show-search-button").attr('style', 'display: none !important');
                        $("#logInOut").hide();
                    }
                }
            });

            $('.nav-button-wrap').on('click', () => {
                var $mobMenu = $('.nav-holder.main-menu');
                if ($(window).width() <= 1180) {
                    if ($mobMenu.hasClass('is-visible')) {
                        $mobMenu.removeClass('is-visible');
                        $('.hamb-cont .hamb').show(0);
                        $('.hamb-cont .close-hamb').hide(0);

                    } else {
                        $mobMenu.addClass('is-visible');
                        $('.hamb-cont .hamb').hide(0);
                        $('.hamb-cont .close-hamb').show(0);
                    }
                }
            });
            </script>