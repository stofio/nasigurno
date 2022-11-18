<?php
/*
Template Name: Dodaj oglas
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

<div class="container">
    <section>

        <div class="section-title">
            <h1>Objavi novi oglasi</h1>
        </div>

        <div class="row-flex fl w-100">
            <div class="col-md-12 w-100">

                <div class="box" id="dodajOglas">
                    <div class="oglasi-list">

                        <?php /* acf_form( ['fields' => [
                                            'field_6316775a76b65',
                                            'field_6316794376b73',
                                            'field_6316785676b6c',
                                            'field_6316785b76b6d',
                                            'field_6316786c76b6e',
                                            'field_631677e976b6b',
                                            'field_631678b976b70',
                                            'field_631678ea76b72',
                                            'field_6316777676b66',
                                            'field_6316779c76b67',
                                            'field_631677a076b68',
                                            'field_631677d976b69',
                                            'field_631677e476b6a',
                                            'field_6316795176b74',
                                        ],
                                        'post_id'       => 'new_post',
                                        'new_post'      => array(
                                            'post_type'     => 'oglasi',
                                            'post_status'   => 'publish'
                                            ),
                                         'submit_value' => __("Objavi oglas", 'acf'), 
                                         'updated_message' => __("Oglas uspešno objavljen", 'acf'),
                                         'uploader' => 'basic',
                            ]); */
                        ?>

                        <script>
                        //$(document).ready(() => {
                        //$('.button-primary.acf-gallery-add').html('Dodaj u galeriju');
                        //});
                        </script>


                        <form id="newOglasForm"
                            action="<?php echo get_template_directory_uri() ?>/scripts/save-user-data.php">

                            <input type="hidden" name="user_id" value="<?php echo $user_ID ?>" />

                            <p>
                                <label>Naslov:</label>
                                <input type="text" value="" name="title">
                            </p>

                            <p>
                                <label>Opis:</label>
                                <textarea value="" name="description"></textarea>
                            </p>

                            <div class="d-flex">
                                <p class="bordr">
                                    <label>Naslov:</label>
                                    <input type="text" value="" name="title">
                                </p>
                                <p class="bordr">
                                    <label>Naslov:</label>
                                    <input type="text" value="" name="title">
                                </p>
                                <p>
                                    <label>Naslov:</label>
                                    <input type="text" value="" name="title">
                                </p>
                            </div>

                            <p>
                                <?php  
                                acf_form( [
                                        'fields' => [
                                                'field_6316785b76b6d'
                                            ],
                                        'form' => false,
                                        'post_id' => 'new_post',
                                        'new_post' => false
                                ]); 
                            ?>
                            </p>

                        </form>

                    </div>


                </div>


            </div> <!-- col-md-8-->


        </div>


    </section>
</div>



<?php get_footer(); ?>