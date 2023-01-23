<?php
/*
Template Name: Izmeni oglas
*/
if(!is_user_logged_in()) {
    wp_redirect( '/login' );
    exit();
}

if(!$_GET['id']) {
    wp_redirect( '/moji-oglasi' );
    exit();
}

?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&amp;language=hr&key=AIzaSyAQKBTixull1qUQZ9uJJ4fcmpdqI2hE8Aw">
</script>

<?php
$oglasId = $_GET['id'];


//get oglas by id
$args = array('p' => $oglasId, 'post_type' => 'oglasi');
$loop = new WP_Query($args);

?>


<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php global $post; ?>

<div class="container">
    <section id="novi-oglas">

        <div class="section-title">
            <h1>Izmeni oglas: <?php the_title() ?></h1>
        </div>

        <div class="box" id="dodajOglas">
            <form id="newOglasForm" action="<?php echo get_template_directory_uri() ?>/scripts/save-user-data.php"
                onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">
                <input type="hidden" id="oglasId" value="<?php echo $oglasId ?>" />
                <div class="oglasi-list row-flex w-100">

                    <div class="col-md-6">
                        <p>
                            <label>Naslov: <span class="required">*</span></label>
                            <input type="text" value="<?php the_title() ?>" name="naslov">
                        </p>
                        <p class="nasl_sl">
                            <label>Naslovna slika:</label>
                            <button type="button" style=""
                                onclick="document.getElementById('naslovna_slika').click()">Izaberi sliku</button>
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="naslovna_slika"
                                id="naslovna_slika" style="display:none">
                            <img src="<?php echo get_the_post_thumbnail_url() ?>" id="preview_naslovna_slika" />
                        </p>
                        <p>
                            <label>Opis: <span class="required">*</span></label>
                            <textarea name="opis"><?php echo strip_tags(get_field('opis')) ?></textarea>
                        </p>
                        <p>
                            <label>Kategorija: <span class="required">*</span></label>
                            <?php
                            //get parent-child categories
                            $terms = get_the_terms( $post->ID , 'oblast' )[0];
                            $childcatSlug = $terms->slug;
                            $parent = get_term( $terms->parent );
                            $parentCatSlug = $parent->slug;
                            
                            ?>
                            <select name="parent_cat" id="parent_cat">
                                <option disabled>- Izaberite kategoriju -</option>
                                <?php
                                $argspar = array(
                                    'orderby'=>'name',
                                    'order' => 'ASC',
                                    'hide_empty' => false,
                                    'parent' => 0
                                );
                                $parcat = get_terms( "oblast", $argspar );
                                
                                foreach($parcat as $key=>$value):
                                ?>
                                <option value="<?php echo $value->term_id ?>"
                                    <?php if($value->slug == $parentCatSlug) echo 'selected' ?>>
                                    <?php echo $value->name?> </option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                        <p>
                            <label>Podkategorija: <span class="required">*</span></label>
                            <?php
                            $chargs = array(
                                'orderby'=>'name',
                                'order' => 'ASC',
                                'hide_empty'=>false,
                                'parent'=>$parent->term_id
                            );
                            
                            $childCats = get_terms( "oblast", $chargs );
                            
                            
                            ?>
                            <select name="child_cat" id="child_cat">
                                <option disabled>- Izaberite podkategoriju -</option>

                                <?php foreach($childCats as $key=>$value): ?>
                                <option value="<?php echo $value->term_id ?>"
                                    <?php if($value->slug == $childcatSlug) echo 'selected' ?>>
                                    <?php echo $value->name?> </option>
                                <?php endforeach; ?>
                            </select>
                        </p>

                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn">
                                    <span>Izaberi slike za galeriju</span>
                                    <input type="file" accept="image/png, image/gif, image/jpeg" multiple=""
                                        data-max_length="20" class="upload__inputfile" name="gallery[]">
                                </label>
                            </div>
                            <div class="upload__img-wrap">
                                <?php
                                //get gallery images
                                $images = get_field('slike'); 
                                if( $images ): ?>
                                <?php foreach( $images as $image ): ?>

                                <div class="upload__img-box">
                                    <div class="img-bg" style="background-image: url('<?php echo $image['url'] ?>')"
                                        data-gallImgId="<?php echo $image['ID'] ?>">
                                        <div class="upload__img-close"></div>
                                    </div>
                                </div>

                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="double-input">
                            <div>
                                <label>Website:</label>
                                <input type="text" value="<?php echo strip_tags(get_field('website')) ?>"
                                    name="website">
                            </div>
                            <div>
                                <label>Video:</label>
                                <input type="text" value="<?php echo strip_tags(get_field('video')) ?>" name="video">
                            </div>
                        </div>
                        <p>
                            <label>Porezni broj:</label>
                            <input type="text" value="<?php echo strip_tags(get_field('porezni_broj')) ?>"
                                name="porezni_broj">
                        </p>

                    </div>

                    <div class="col-md-6">

                        <p class="no-line">
                            <?php
                            //get map settings
                            ?>
                            <label>Lokacija: <span class="required">*</span></label>
                            <input id="pac-input" name="pac-input" type="text" placeholder="Unesi grad, ulicu i broj"
                                value="<?php echo get_field('mapa')['address'] ?>">
                            <input type="hidden" name="lat" value="<?php echo get_field('mapa')['lat'] ?>" />
                            <input type="hidden" name="lng" value="<?php echo get_field('mapa')['lng'] ?>" />
                        <div id="map-canvas"></div>
                        <script>
                        var map = new google.maps.Map(document.getElementById('map-canvas'), {
                            componentRestrictions: {
                                country: ["IT"]
                            },
                            center: {
                                lat: <?php echo get_field('mapa')['lat'] ?>,
                                lng: <?php echo get_field('mapa')['lng'] ?>
                            },
                            zoom: 12
                        });
                        </script>


                        </p>

                        <p class="no-line">
                        <div><label>Država: <span class="required">*</span></label>
                            <select name="drzava">
                                <option disabled>- Izaberi državu -</option>
                                <option value="Srbija" <?php if(get_field('drzava') == 'Srbija') echo 'selected' ?>>
                                    Srbija</option>
                                <option value="Bosna i Hercegovina"
                                    <?php if(get_field('drzava') == 'Bosna i Hercegovina') echo 'selected' ?>>Bosna i
                                    Hercegovina
                                </option>
                                <option value="Crna Gora"
                                    <?php if(get_field('drzava') == 'Crna Gora') echo 'selected' ?>>Crna Gora</option>
                                <option value="Hrvatska" <?php if(get_field('drzava') == 'Hrvatska') echo 'selected' ?>>
                                    Hrvatska</option>
                                <option value="Slovenija"
                                    <?php if(get_field('drzava') == 'Slovenija') echo 'selected' ?>>Slovenija</option>
                                <option value="Makedonija"
                                    <?php if(get_field('drzava') == 'Makedonija') echo 'selected' ?>>Makedonija</option>
                            </select>
                        </div>
                        </p>

                        <p>
                            <label>Grad: <span class="required">*</span></label>
                            <input type="text" value="<?php echo strip_tags(get_field('grad')) ?>" name="grad">
                        </p>


                        <div class="double-input">
                            <div>
                                <label>Ulica: <span class="required">*</span></label>
                                <input type="text" value="<?php echo strip_tags(get_field('adresa')) ?>" name="ulica">
                            </div>
                            <div>
                                <label>Broj: <span class="required">*</span></label>
                                <input type="text" value="<?php echo strip_tags(get_field('broj')) ?>" name="broj">
                            </div>
                        </div>


                        <div class="double-input">
                            <div>
                                <label>Okrug:</label>
                                <input type="text" value="<?php echo strip_tags(get_field('ogrug')) ?>" name="okrug">
                            </div>
                            <div>
                                <label>Poštanski broj: <span class="required">*</span></label>
                                <input type="text" value="<?php echo strip_tags(get_field('postanski_broj')) ?>"
                                    name="po_broj">
                            </div>
                        </div>


                        <div class="repetar-cont">
                            <label>Telefon: <span class="required">*</span></label>
                            <table class="table table-bordered table-hover" id="telefoni">
                                <?php if(have_rows('telefon')) : 
                                        $count = 1; ?>
                                <?php while( have_rows('telefon') ) : 
                                        the_row(); 
                                        
                                        if($count == 1) :  //the first row     
                                            ?>
                                <tr>
                                    <td><input type="text" name="tel_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" value="<?php echo get_sub_field('kont_osob') ?>" />
                                    </td>
                                    <td><input type="text" name="broj_telefona[]" placeholder="Broj telefona" class=""
                                            value="<?php echo get_sub_field('tel') ?>" />
                                    </td>
                                    <td><button type="button" id="addTelefon" class="btn btn-primary">Dodaj
                                            telefon</button>
                                    </td>
                                </tr>

                                <?php else: ?>

                                <tr id="rowtel<?php echo $count ?>">
                                    <td><input type="text" name="tel_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" value="<?php echo get_sub_field('kont_osob') ?>" />
                                    </td>
                                    <td><input type="text" name="broj_telefona[]" placeholder="Broj telefona" class=""
                                            value="<?php echo get_sub_field('tel') ?>" />
                                    </td>
                                    <td><button type="button" name="remove" id="<?php echo $count ?>"
                                            class="btn btn-danger btn_remove_tel">X</button>
                                    </td>
                                </tr>

                                <?php endif; ?>
                                <?php 
                                        $count++;
                                    endwhile; ?>
                                <?php else: ?>
                                <tr>
                                    <td><input type="text" name="tel_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" value="" />
                                    </td>
                                    <td><input type="text" name="broj_telefona[]" placeholder="Broj telefona" class=""
                                            value="" />
                                    </td>
                                    <td><button type="button" id="addTelefon" class="btn btn-primary">Dodaj
                                            telefon</button>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>

                        <div class="repetar-cont">
                            <label>Email: <span class="required">*</span></label>
                            <table class="table table-bordered table-hover" id="emailovi">
                                <?php if(have_rows('dodatnih_email')) : 
                                        $count = 1; ?>
                                <?php while( have_rows('dodatnih_email') ) : 
                                        the_row(); 
                                        
                                        if($count == 1) :  //the first row     
                                            ?>
                                <tr>
                                    <td><input type="text" name="em_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" value="<?php echo get_sub_field('kont_osob') ?>" />
                                    </td>
                                    <td><input type="text" name="email[]" placeholder="Email adresa" class=""
                                            value="<?php echo get_sub_field('ema') ?>" />
                                    </td>
                                    <td><button type="button" id="addEmail" class="btn btn-primary">Dodaj
                                            email</button>
                                    </td>
                                </tr>

                                <?php else: ?>

                                <tr id="rowemail<?php echo $count ?>">
                                    <td><input type="text" name="em_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" value="<?php echo get_sub_field('kont_osob') ?>" />
                                    </td>
                                    <td><input type="text" name="email[]" placeholder="Email adresa" class=""
                                            value="<?php echo get_sub_field('ema') ?>" />
                                    </td>
                                    <td><button type="button" name="remove" id="<?php echo $count ?>"
                                            class="btn btn-danger btn_remove_email">X</button>
                                    </td>
                                </tr>

                                <?php endif; ?>
                                <?php 
                                        $count++;
                                    endwhile; ?>
                                <?php else: ?>
                                <tr>
                                    <td><input type="text" name="em_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" value="" />
                                    </td>
                                    <td><input type="text" name="email[]" placeholder="Email adresa" class=""
                                            value="" />
                                    </td>
                                    <td><button type="button" id="addEmail" class="btn btn-primary">Dodaj
                                            email</button>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>

                        <div class="repetar-cont no-line">
                            <label>Radno vreme:</label>
                            <table class="table table-bordered table-hover" id="termini">
                                <?php if(have_rows('radno_vreme')) : 
                                        $count = 1; ?>
                                <?php while( have_rows('radno_vreme') ) : 
                                        the_row(); 
                                        
                                        if($count == 1) :  //the first row     
                                            ?>
                                <tr>
                                    <td><input type="text" name="radni_dan[]" placeholder="Dan" class=""
                                            value="<?php echo get_sub_field('dan') ?>" />
                                    </td>
                                    <td><input type="text" name="radno_vreme[]" placeholder="Vreme" class=""
                                            value="<?php echo get_sub_field('vreme') ?>" />
                                    </td>
                                    <td><button type="button" id="addTermin" class="btn btn-primary">Dodaj
                                            termin</button>
                                    </td>
                                </tr>

                                <?php else: ?>

                                <tr id="rowtermin<?php echo $count ?>">
                                    <td><input type="text" name="radni_dan[]" placeholder="Dan" class=""
                                            value="<?php echo get_sub_field('dan') ?>" />
                                    </td>
                                    <td><input type="text" name="radno_vreme[]" placeholder="Vreme" class=""
                                            value="<?php echo get_sub_field('vreme') ?>" />
                                    </td>
                                    <td><button type="button" name="remove" id="<?php echo $count ?>"
                                            class="btn btn-danger btn_remove_termin">X</button>
                                    </td>
                                </tr>

                                <?php endif; ?>
                                <?php 
                                        $count++;
                                    endwhile; ?>
                                <?php else: ?>
                                <tr>
                                    <td><input type="text" name="radni_dan[]" placeholder="Dan" class=""
                                            value="<?php echo get_sub_field('dan') ?>" />
                                    </td>
                                    <td><input type="text" name="radno_vreme[]" placeholder="Vreme" class=""
                                            value="<?php echo get_sub_field('vreme') ?>" />
                                    </td>
                                    <td><button type="button" id="addTermin" class="btn btn-primary">Dodaj
                                            termin</button>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>


                        <input type="submit" class="button button-blue" id="objaviOglas" value="Objavi oglas" name="">


                    </div>

                </div>
            </form>
        </div>

    </section>
</div>

<?php endwhile; ?>

<script>
THEME_DIR = "<?php echo get_stylesheet_directory_uri() ?>";
</script>

<script src="<?php echo get_stylesheet_directory_uri() . '/js/izmeni-oglas.js' ?>"></script>

<script>
var marker = new google.maps.Marker({
    position: {
        lat: <?php echo get_field('mapa')['lat'] ?>,
        lng: <?php echo get_field('mapa')['lng'] ?>
    }
});
marker.setMap(map);
</script>




<?php get_footer(); ?>