<?php
/*
Template Name: Registracija
*/

if(is_user_logged_in()) {
    wp_redirect( '/moj-profil' );
    exit();
}
?>
<?php get_header(); ?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">

</script>

<div class="container">

    <section>

        <div class="section-title">
            <h1>Napravi novi nalog na nasigurno.com</h1>
        </div>

        <?php
            //is logged
            if(is_user_logged_in() && current_user_can('korisnik')) {
                echo '<script>window.location.href = "/moj-profil/";</script>'; //redirect
                die();  
            }
            else {
            //show form

            $redirect_to = get_home_url() . '/moj-profil/'; //redirect after success login

            ?>

        <div class="login-container margin-center">
            <h3>Registracija</h3>

            <form id="regForm" class="theme-form" action="#" method="post">
                <div class="team-input">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="team-input">
                    <label>Korisničko ime</label>
                    <input type="text" name="username" placeholder="Korisničko ime" required>
                </div>

                <div class="team-input">
                    <label>Šifra</label>
                    <input type="password" name="newpassword" placeholder="Šifra" required>
                </div>

                <div class="team-input">
                    <label>Ponovljena šifra</label>
                    <input type="password" name="repeatedpassword" placeholder="Ponovljena šifra" required>
                </div>

                <div class="g-recaptcha" data-sitekey="6LfhJvwiAAAAAJsAxHf4xEPTwlVbvzIqhHOrhWK1"></div>
                <input type="submit" value="Registruj se" class="button button-blue">

            </form>

        </div>

        <?php 
        } //show form
        ?>

    </section>

</div>

<script>
var filesPath = '<?php echo get_stylesheet_directory_uri(); ?>';
</script>

<script src="<?php echo get_stylesheet_directory_uri() . '/js/register.js' ?>"></script>


<?php get_footer(); ?>