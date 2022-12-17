<?php
/*
Template Name: Dodaj oglas
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

<div class="container">
    <section id="novi-oglas">

        <div class="section-title">
            <h1>Objavi novi oglasi</h1>
        </div>


        <div class="box" id="dodajOglas">
            <form id="newOglasForm" action="<?php echo get_template_directory_uri() ?>/scripts/save-user-data.php">
                <div class="oglasi-list row-flex w-100">

                    <div class="col-md-6">
                        <p>
                            <label>Naslov:</label>
                            <input type="text" value="" name="naslov">
                        </p>
                        <p>
                            <label>Opis:</label>
                            <textarea value="" name="opis"></textarea>
                        </p>
                        <p>
                            <label>Kategorija:</label>
                            <select name="parent-cat" id="parent-cat">
                                <option disabled selected>- Izaberite kategoriju -</option>
                                <?php
                                $argspar = array(
                                'orderby'=>'name',
                                'order' => 'ASC',
                                'hide_empty'=>false,
                                'parent'=>0
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
                            <label>Podkategorija:</label>
                            <select name="child-cat" id="child-cat" disabled>
                                <option disabled selected>- Izaberite podkategoriju -</option>
                            </select>
                        </p>

                        <p>
                            <label>Telefon:</label>

                        <table class="table table-bordered table-hover" id="dynamic_field">
                            <tr>
                                <td><input type="text" name="kontakt_osoba[]" placeholder="Kontakt osoba" class="" />
                                </td>
                                <td><input type="text" name="broj_telefona[]" placeholder="Broj telefona" class="" />
                                </td>
                                <td><button type="button" id="addTelefon" class="btn btn-primary">Dodaj još</button>
                                </td>
                            </tr>
                        </table>

                        <script>
                        $(document).ready(function() {

                            var i = 1;
                            var length;

                            $("#addTelefon").click(function() {
                                var rowIndex = $('#dynamic_field').find('tr').length;
                                i++;
                                $('#dynamic_field').append(`<tr id="row` + i + `">	
                                <td><input type="text" name="kontakt_osoba[]" placeholder="Kontakt osoba" class="" />
                                </td>
                                <td><input type="text" name="broj_telefona[]" placeholder="Broj telefona" class="" />
                                </td>
                                <td><button type="button" name="remove" id="` +
                                    i + `" class="btn btn-danger btn_remove">X</button></td>
                                </tr>`);
                            });

                            $(document).on('click', '.btn_remove', function() {
                                var rowIndex = $('#dynamic_field').find('tr').length;
                                var button_id = $(this).attr("id");
                                $('#row' + button_id + '').remove();
                            });

                        });
                        </script>



                        </p>


                    </div>
                    <div class="col-md-6">

                        <style>
                        .upload__box {
                            padding: 40px;
                        }

                        .upload__inputfile {
                            width: 0.1px;
                            height: 0.1px;
                            opacity: 0;
                            overflow: hidden;
                            position: absolute;
                            z-index: -1;
                        }

                        .upload__btn {
                            display: inline-block;
                            font-weight: 600;
                            color: #fff;
                            text-align: center;
                            min-width: 116px;
                            padding: 5px;
                            transition: all 0.3s ease;
                            cursor: pointer;
                            border: 2px solid;
                            background-color: #4045ba;
                            border-color: #4045ba;
                            border-radius: 10px;
                            line-height: 26px;
                            font-size: 14px;
                        }

                        .upload__btn:hover {
                            background-color: unset;
                            color: #4045ba;
                            transition: all 0.3s ease;
                        }

                        .upload__btn-box {
                            margin-bottom: 10px;
                        }

                        .upload__img-wrap {
                            display: flex;
                            flex-wrap: wrap;
                            margin: 0 -10px;
                        }

                        .upload__img-box {
                            width: 200px;
                            padding: 0 10px;
                            margin-bottom: 12px;
                        }

                        .upload__img-close {
                            width: 24px;
                            height: 24px;
                            border-radius: 50%;
                            background-color: rgba(0, 0, 0, 0.5);
                            position: absolute;
                            top: 10px;
                            right: 10px;
                            text-align: center;
                            line-height: 24px;
                            z-index: 1;
                            cursor: pointer;
                        }

                        .upload__img-close:after {
                            content: "✖";
                            font-size: 14px;
                            color: white;
                        }

                        .img-bg {
                            background-repeat: no-repeat;
                            background-position: center;
                            background-size: cover;
                            position: relative;
                            padding-bottom: 100%;
                        }
                        </style>

                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn">
                                    <p>Upload images</p>
                                    <input type="file" multiple="" data-max_length="20" class="upload__inputfile">
                                </label>
                            </div>
                            <div class="upload__img-wrap"></div>
                        </div>

                        <script>
                        jQuery(document).ready(function() {
                            ImgUpload();
                        });

                        function ImgUpload() {
                            var imgWrap = "";
                            var imgArray = [];

                            $('.upload__inputfile').each(function() {
                                $(this).on('change', function(e) {
                                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                                    var maxLength = $(this).attr('data-max_length');

                                    var files = e.target.files;
                                    var filesArr = Array.prototype.slice.call(files);
                                    var iterator = 0;
                                    filesArr.forEach(function(f, index) {

                                        if (!f.type.match('image.*')) {
                                            return;
                                        }

                                        if (imgArray.length > maxLength) {
                                            return false
                                        } else {
                                            var len = 0;
                                            for (var i = 0; i < imgArray.length; i++) {
                                                if (imgArray[i] !== undefined) {
                                                    len++;
                                                }
                                            }
                                            if (len > maxLength) {
                                                return false;
                                            } else {
                                                imgArray.push(f);

                                                var reader = new FileReader();
                                                reader.onload = function(e) {
                                                    var html =
                                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                                        e.target.result +
                                                        ")' data-number='" + $(
                                                            ".upload__img-close").length +
                                                        "' data-file='" + f.name +
                                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                                    imgWrap.append(html);
                                                    iterator++;
                                                }
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                    });
                                });
                            });

                            $('body').on('click', ".upload__img-close", function(e) {
                                var file = $(this).parent().data("file");
                                for (var i = 0; i < imgArray.length; i++) {
                                    if (imgArray[i].name === file) {
                                        imgArray.splice(i, 1);
                                        break;
                                    }
                                }
                                $(this).parent().parent().remove();
                            });
                        }
                        </script>

                    </div>

                </div>
            </form>
        </div>


    </section>
</div>


<script>
$('#parent-cat').on('change', (e) => {
    $('#child-cat').attr('disabled', true); //disable child select
    var term_id = $(e.target).val();
    $.ajax({
        method: "POST",
        url: "<?php echo get_stylesheet_directory_uri() ?>/scripts/getChildOblasti.php",
        data: {
            term_id: term_id
        },
        success: function(data) {
            var children = JSON.parse(data);
            $('#child-cat').empty();
            $.each(children, function(index, item) {
                $('#child-cat').append(
                    `<option value="${item['term_id']}">${item['name']}</option>`);
            });

            $('#child-cat').attr('disabled', false); //enable child select

        }
    });
})
</script>



<?php get_footer(); ?>