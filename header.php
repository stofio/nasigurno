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

   

    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/style.css?v=3">
 

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php wp_head(); ?>

</head>

<body>

   

    <!-- header-->
    <header class="main-header dark-header fs-header sticky">
        <div class="header-inner">
            <div class="logo-holder">
               <a href="/">
                   <img src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />
               </a>
            </div>
            <div class="header-search vis-header-search">
                <div class="header-search-input-item">
                    <button class="header-search-button left-side"><i class="fa fa-search"></i></button>
                    <form id="search" action><input type="search" placeholder="Pretraži" value="" /></form>
                    <button class="header-search-button right-side hidden"><i class="fa fa-times"></i></button>
                    <ul class="autocomplete-list"></ul>
                </div>
                
            </div>
            <div class="show-search-button"><i class="fa fa-search"></i> <span>Search</span></div>
            <div id="headerUserMenu"></div>
            <!-- nav-button-wrap-->
            <div class="nav-button-wrap color-bg">
                <span class="num-new-posts" style="display: none;"></span>
                <i class="fa fa-times"></i>
                <i class="fa fa-ellipsis-vertical"></i>
                <i class="fa fa-user"></i>
            </div>
            <!-- nav-button-wrap end-->
            <!--  navigation -->
            <div class="nav-holder main-menu">
                <nav>
                    <ul>
                        <div id="logInOut" class="log-in-out">
                        </div>
                                                <li>
                                <a class="main-menu-map-button" href="http://localhost/nasigurno/store-locator/">Mapa</a>
                            </li>
                        <li>
                            <a name="magazin meni" href="javascript:void(0);">Magazin<span class="num-new-posts" style="display: none;"></span><i class="fa fa-caret-down"></i></a>
                            <ul>
                                <li><a href="#">Svi članci<span class="num-new-posts" style="display: none;"></span></a></li>
                                <li><a href="#">Dobre priče</a></li>
                                <li><a href="#">Vesti</a></li>
                                <li><a href="#">Vodič</a></li>
                                <li><a href="#">Zabavnik</a></li>
                                <li><a href="#">Postanite autor</a></li>
                            </ul>
                        </li>
                        <li>
                            <a name="gradovi meni" href="javascript:void(0);">Gradovi <i class="fa fa-caret-down"></i></a>
                            <ul>
                                <li><a href="#">Beograd</a></li>
                                <li><a href="#">Novi Sad</a></li>
                                <li><a href="#">Niš</a></li>
                                <li><a href="#">Kragujevac</a></li>
                                <li><a href="#">Srbija</a></li>
                                <li><a href="#">Crna Gora</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- navigation  end -->
        </div>
    </header>