<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Nasigurno
 * @since 1.0
 * @version 1.2
 */

?>

    </div> <!--wrapper-->
</main>
<footer>
    <section>
        <div class="content-wrap">
            <img class="foot-logo" width="80"
                src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />

            <ul class="links flex-wrap">
                <li><a href="#">Mapa</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Pomoć</a></li>
                <li><a href="#">M&V Grupacija</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
        </div>
    </section>
</footer>


<?php wp_footer(); ?>

</body>

</html>