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

</div>
<!--wrapper-->
</main>
<footer>
    <section>
        <div class="content-wrap container">
            <img class="foot-logo" width="80"
                src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" />

            <div class="links">
                <ul class=" flex-wrap">
                    <li><a href="#">Mapa</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Pomoć</a></li>
                    <li><a href="#">M&V Grupacija</a></li>
                    <li><a href="#">Kontakt</a></li>
                </ul>

                <ul class=" flex-wrap">
                    <?php if(!is_user_logged_in()): ?>
                    <li><a href="/login"><b>Login</b></a></li>
                    <li><a href="/registracija"><b>Registracija</b></a></li>
                    <?php else: ?>
                    <li><a href="/moj-profil"><b>Moj profil</b></a></li>
                    <li><a href="/moji-oglasi"><b>Moji oglasi</b></a></li>
                    <?php endif; ?>
                </ul>

            </div>

        </div>
    </section>
</footer>

<script>
var filesPath = '<?php echo get_stylesheet_directory_uri(); ?>';
</script>

<script src="<?php echo get_stylesheet_directory_uri() . '/js/searchbox.js' ?>"></script>

<?php wp_footer(); ?>

</body>

</html>