<?php
/*
Template Name: Login
*/
?>
<?php get_header(); ?>

<div class="container">

    <section>

        <div class="section-title">
            <h1>Pristupite vašem nasigurno.com nalogu</h1>
            <h3 class="go-register">Ili <a href="/registracija">registruj se</a> ako nemaš nalog</h3>
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
            <h3>Prijava</h3>



            <div class="wp_login_error">
                <?php if( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) { ?>
                <p>Pogrešni podaci. Pokušaj ponovo</p>
                <?php } 
	             else if( isset( $_GET['login'] ) && $_GET['login'] == 'empty' ) { ?>
                <p>Usenesite oba polja.</p>
                <?php } ?>
            </div>

            <form class="theme-form" name="loginform" id="loginform" action="<?php echo site_url( '/wp-login.php' ); ?>"
                method="post">
                <p><label>Korisničko ime ili email:</label> <br><input id="user_login" type="text" value="" name="log">
                </p>
                <p><label>Šifra:</label> <br><input id="user_pass" type="password" value="" name="pwd"></p>
                <p class="flex"><input id="rememberme" type="checkbox" value="forever" name="rememberme"><label
                        class="ric" for="rememberme">Zapamti
                        me</label></p>

                <p><input type="submit" class="button button-blue" id="wp-submit" value="Prijavi se" name="wp-submit">
                </p>

                <input type="hidden" value="<?php echo esc_attr( $redirect_to ); ?>" name="redirect_to">
                <!-- <input type="hidden" value="1" name="testcookie"> -->
            </form>


        </div>

        <?php 

}

?>

    </section>

</div>



<?php get_footer(); ?>