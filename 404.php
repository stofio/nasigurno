<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Nasigurno
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>



<div class="container" style="padding-bottom: 80px; padding-top: 80px;">

<div class="section-title text-center">
    <h1>404</h1>
	<h2>Stranica nije pronadjena</h2>
	<a href="<?php echo get_home_url(); ?>" class="text-center">Idi na glavnu stranicu</a>
</div>

<?php get_footer();
