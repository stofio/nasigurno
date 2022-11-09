<?php
/*
Template Name: Moj Profil
*/
?>

<?php 
  $user_ID = get_current_user_id();
  if(!$user_ID) {
    header("Location: /login"); 
    exit();
  }

  global $current_user;
  wp_get_current_user();

?>


<?php get_header(); ?>

<div class="container">
    <section>

        <div class="section-title">
            <h1>Podešavanja</h1>
        </div>

        <div class="row-flex fl w-100">
            <div class="col-md-8">

                <div class="box" id="mojProfil">
                    <h2>Moj profil</h2>

                    <form id="profileForm" class="theme-form"
                        action="<?php echo get_template_directory_uri() ?>/scripts/save-user-data.php">
                        <input type="hidden" name="user_id" value="<?php echo $user_ID ?>" />
                        <p>
                            <label>Ime:</label>
                            <input type="text" size="20" value="<?php echo $current_user->user_firstname ?>"
                                name="name">
                        </p>
                        <p>
                            <label>Prezime:</label>
                            <input type="text" size="20" value="<?php echo $current_user->user_lastname ?>"
                                name="surname">
                        </p>
                        <p>
                            <label>Korisničko ime (login):</label>
                            <input type="text" size="20" value="<?php echo $current_user->user_login ?>"
                                name="username">
                        </p>
                        <p>
                            <label>Email:</label>
                            <input type="email" size="20" value="<?php echo $current_user->user_email ?>" name="email"
                                class="input-disabled" disabled>
                        </p>
                        <p><input type="submit" class="button button-blue" id="" value="Sačuvaj podatke" name=""></p>
                    </form>

                    <script>
                    $(document).ready(function() {
                        var $form = $('#profileForm');
                        $form.submit(function() {
                            $('.errorMsg').remove();
                            $('.successMsg').remove();
                            $.post($(this).attr('action'), $(this).serialize(), function(response) {
                                $form.prepend(
                                    '<p class="successMsg">Uspešno sačuvani podaci</p>');
                                setTimeout(() => {
                                    $('.successMsg').remove();
                                }, 3000);
                            });
                            return false;
                        });
                    });
                    </script>

                </div>

                <div class="box" id="promeniLozinku">
                    <h2>Promeni lozinku</h2>
                    <form id="passwForm" class="theme-form change-password"
                        action="<?php echo get_template_directory_uri() ?>/scripts/save-new-passoword.php">
                        <input type="hidden" name="user_id" value="<?php echo $user_ID ?>" />
                        <p>
                            <label>Stara šifra:</label>
                            <input type="password" size="20" value="" name="old_passw">
                        </p>
                        <p>
                            <label>Nova šifra:</label>
                            <input type="password" size="20" value="" name="new_passw">
                        </p>
                        <p>
                            <label>Ponovljena nova šifra:</label>
                            <input type="password" size="20" value="" name="new_r_passw">
                        </p>
                        <p><input type="submit" class="button button-blue" value="Sačuvaj lozinku" name=""></p>
                    </form>

                    <script>
                    $(document).ready(function() {
                        var $form = $('#passwForm');
                        $form.submit(function(e) {
                            $('.errorMsg').remove();
                            $('.successMsg').remove();

                            //check if passw match
                            var oldP = $(this).find('input[name="old_passw"]').val();
                            var newP = $(this).find('input[name="new_passw"]').val();
                            var newRP = $(this).find('input[name="new_r_passw"]').val();

                            console.log(newP);
                            console.log(newRP);

                            //check lenght of passw
                            if (oldP.length < 5 || newP.length < 5 || newRP.length < 5) {
                                $form.prepend(
                                    '<p class="errorMsg">Šifra mora imati više od 6 karaktera</p>'
                                );
                                e.preventDefault();
                                setTimeout(() => {
                                    $('.errorMsg').remove();
                                }, 3000);
                                return false;
                            } else {
                                //check if new passwords are the same
                                if (newP !== newRP) {
                                    $form.prepend(
                                        '<p class="errorMsg">Ponovljena šifra se ne poklapa sa novom šifrom</p>'
                                    );
                                    e.preventDefault();
                                    setTimeout(() => {
                                        $('.errorMsg').remove();
                                    }, 3000);
                                    return false;
                                } else {
                                    $.post($(this).attr('action'), $(this).serialize(), function(
                                        response) {
                                        console.log(response);
                                        if (response == 'ERROLD') {
                                            //wrong old password
                                            $form.prepend(
                                                '<p class="errorMsg">Pogrešno uneta stara šifra</p>'
                                            );
                                            e.preventDefault();
                                            setTimeout(() => {
                                                $('.errorMsg').remove();
                                            }, 3000);
                                            return false;
                                        } else if (response == 'SUCCESS') {
                                            //success
                                            $form[0].reset();
                                            $form.prepend(
                                                '<p class="successMsg">Uspešno sačuvana lozinka</p>'
                                            );
                                            e.preventDefault();
                                            setTimeout(() => {
                                                $('.errorMsg').remove();
                                            }, 3000);
                                            return false;
                                        } else {
                                            //not success
                                            $form.prepend(
                                                '<p class="errorMsg">Nije moguće promeniti šifru. Kontaktiraj nas</p>'
                                            );
                                            e.preventDefault();
                                            return false;
                                        }
                                    });
                                    return false;
                                }
                            }
                        });
                    });
                    </script>
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