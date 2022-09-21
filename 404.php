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

<div class="page"  style="padding-bottom: 80px; padding-top: 80px;">

	<div class="container">
		<div class="page-head">
			<div class="row text-center">
				<h1 class="title">404</h1>			
			</div>
		</div>
		<div class="row text-center">
			<a href="<?php echo get_home_url(); ?>" class="btn-outline" style="width: 230px;">Home Page</a>
		</div>
	</div>
</div>

<?php get_footer();
