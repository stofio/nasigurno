<?php
/*
Template Name: Dodaj oglas
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&amp;language=hr&key=AIzaSyAQKBTixull1qUQZ9uJJ4fcmpdqI2hE8Aw">
</script>



<div class="container">
    <section id="novi-oglas">

        <div class="section-title">
            <h1>Objavi novi oglasi</h1>
        </div>

        <div class="box" id="dodajOglas">
            <form id="newOglasForm" action="<?php echo get_template_directory_uri() ?>/scripts/save-user-data.php"
                onkeydown="return event.key != 'Enter';">
                <div class="oglasi-list row-flex w-100">

                    <div class="col-md-6">
                        <p>
                            <label>Naslov: <span class="required">*</span></label>
                            <input type="text" value="" name="naslov">
                        </p>
                        <p class="nasl_sl">
                            <label>Naslovna slika:</label>
                            <button type="button" style=""
                                onclick="document.getElementById('naslovna_slika').click()">Izaberi sliku</button>
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="naslovna_slika"
                                id="naslovna_slika" style="display:none">
                            <img src="" id="preview_naslovna_slika" />
                        </p>
                        <p>
                            <label>Opis: <span class="required">*</span></label>
                            <textarea value="" name="opis"></textarea>
                        </p>
                        <p>
                            <label>Kategorija: <span class="required">*</span></label>
                            <select name="parent_cat" id="parent_cat">
                                <option disabled selected>- Izaberite kategoriju -</option>
                                <?php
                                $argspar = array(
                                    'orderby'=>'name',
                                    'order' => 'ASC',
                                    'hide_empty' => false,
                                    'parent' => 0
                                );
                                $parcat = get_terms( "oblast", $argspar );
                                
                                foreach($parcat as $key=>$value):
                                    var_dump($value->term_id);
                                    var_dump($value->name);
                                ?>
                                <option value="<?php echo $value->term_id ?>"><?php echo $value->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                        <p>
                            <label>Podkategorija: <span class="required">*</span></label>
                            <select name="child_cat" id="child_cat" disabled>
                                <option disabled selected>- Izaberite podkategoriju -</option>
                            </select>
                        </p>

                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn">
                                    <span>Izaberi slike za galeriju</span>
                                    <input type="file" accept="image/png, image/gif, image/jpeg" multiple=""
                                        data-max_length="20" class="upload__inputfile" name="gallery">
                                </label>
                            </div>
                            <div class="upload__img-wrap"></div>
                        </div>


                        <div class="double-input">
                            <div>
                                <label>Website:</label>
                                <input type="text" value="" name="website">
                            </div>
                            <div>
                                <label>Video:</label>
                                <input type="text" value="" name="video">
                            </div>
                        </div>
                        <p>
                            <label>Porezni broj:</label>
                            <input type="text" value="" name="porezni_broj">
                        </p>

                    </div>

                    <div class="col-md-6">

                        <p class="no-line">
                            <label>Lokacija: <span class="required">*</span></label>
                            <input id="pac-input" name="pac-input" type="text" placeholder="Unesi grad, ulicu i broj">
                            <input type="hidden" name="lat" value="" />
                            <input type="hidden" name="lng" value="" />
                        <div id="map-canvas"></div>
                        </p>

                        <p class="no-line">
                        <div><label>Država: <span class="required">*</span></label>
                            <select name="drzava">
                                <option disabled selected>- Izaberi državu -</option>
                                <option value="Srbija">Srbija</option>
                                <option value="Bosna i Hercegovina">Bosna i Hercegovina
                                </option>
                                <option value="Crna Gora">Crna Gora</option>
                                <option value="Hrvatska">Hrvatska</option>
                                <option value="Slovenija">Slovenija</option>
                                <option value="Makedonija">Makedonija</option>
                            </select>
                        </div>
                        </p>

                        <p>
                            <label>Grad: <span class="required">*</span></label>
                            <input type="text" value="" name="grad">
                        </p>


                        <div class="double-input">
                            <div>
                                <label>Ulica: <span class="required">*</span></label>
                                <input type="text" value="" name="ulica">
                            </div>
                            <div>
                                <label>Broj: <span class="required">*</span></label>
                                <input type="text" value="" name="broj">
                            </div>
                        </div>


                        <div class="double-input">
                            <div>
                                <label>Okrug:</label>
                                <input type="text" value="" name="okrug">
                            </div>
                            <div>
                                <label>Poštanski broj: <span class="required">*</span></label>
                                <input type="text" value="" name="po_broj">
                            </div>
                        </div>


                        <div class="repetar-cont">
                            <label>Telefon: <span class="required">*</span></label>
                            <table class="table table-bordered table-hover" id="telefoni">
                                <tr>
                                    <td><input type="text" name="tel_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" />
                                    </td>
                                    <td><input type="text" name="broj_telefona[]" placeholder="Broj telefona"
                                            class="" />
                                    </td>
                                    <td><button type="button" id="addTelefon" class="btn btn-primary">Dodaj
                                            telefon</button>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="repetar-cont">
                            <label>Email: <span class="required">*</span></label>
                            <table class="table table-bordered table-hover" id="emailovi">
                                <tr>
                                    <td><input type="text" name="em_kontakt_osoba[]" placeholder="Kontakt osoba"
                                            class="" />
                                    </td>
                                    <td><input type="text" name="email[]" placeholder="Email adresa" class="" />
                                    </td>
                                    <td><button type="button" id="addEmail" class="btn btn-primary">Dodaj
                                            email</button>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="repetar-cont no-line">
                            <label>Radno vreme:</label>
                            <table class="table table-bordered table-hover" id="termini">
                                <tr>
                                    <td><input type="text" name="radni_dan[]" placeholder="Dan" class="" />
                                    </td>
                                    <td><input type="text" name="radno_vreme[]" placeholder="Vreme" class="" />
                                    </td>
                                    <td><button type="button" id="addTermin" class="btn btn-primary">Dodaj
                                            termin</button>
                                    </td>
                                </tr>
                            </table>
                        </div>


                        <input type="submit" class="button button-blue" id="objaviOglas" value="Objavi oglas" name="">


                    </div>

                </div>
            </form>
        </div>

    </section>
</div>

<script>
THEME_DIR = "<?php echo get_stylesheet_directory_uri() ?>";
</script>

<script src="<?php echo get_stylesheet_directory_uri() . '/js/dodaj-oglas.js' ?>"></script>




<?php get_footer(); ?>