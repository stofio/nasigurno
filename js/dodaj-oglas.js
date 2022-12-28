(function() {

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


    $(document).ready(function() {

        var i = 1;
        var length;

        $("#addEmail").click(function() {
            var rowIndex = $('#emailovi').find('tr').length;
            i++;
            $('#emailovi').append(`<tr id="rowemail` + i + `">	
        <td><input type="text" name="em_kontakt_osoba[]" placeholder="Kontakt osoba" class="" />
        </td>
        <td><input type="text" name="email[]" placeholder="Email adresa" class="" />
        </td>
        <td><button type="button" name="remove" id="` +
                i + `" class="btn btn-danger btn_remove_email">X</button></td>
        </tr>`);
        });

        $(document).on('click', '.btn_remove_email', function() {
            var rowIndex = $('#emailovi').find('tr').length;
            var button_id = $(this).attr("id");
            $('#rowemail' + button_id + '').remove();
        });

    });


    $(document).ready(function() {

        var i = 1;
        var length;

        $("#addTelefon").click(function() {
            var rowIndex = $('#telefoni').find('tr').length;
            i++;
            $('#telefoni').append(`<tr id="rowtel` + i + `">	
        <td><input type="text" name="tel_kontakt_osoba[]" placeholder="Kontakt osoba" class="" />
        </td>
        <td><input type="text" name="broj_telefona[]" placeholder="Broj telefona" class="" />
        </td>
        <td><button type="button" name="remove" id="` +
                i + `" class="btn btn-danger btn_remove_tel">X</button></td>
        </tr>`);
        });

        $(document).on('click', '.btn_remove_tel', function() {
            var rowIndex = $('#telefoni').find('tr').length;
            var button_id = $(this).attr("id");
            $('#rowtel' + button_id + '').remove();
        });

    });


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


    $('#naslovna_slika').on('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#preview_naslovna_slika').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });


    /**
     * MAP
     */
    $(document).ready(function() {
 
        function init() {
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
              componentRestrictions: {country: ["IT"]},
              center: {
                lat: 43.85643,
                lng: 18.413420
              },
              zoom: 12
            });
         
            var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
           // map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
            
            google.maps.event.addListener(searchBox, 'places_changed', function() {
              searchBox.set('map', null);
         
              var places = searchBox.getPlaces();

              setAddressSeparatedInputs(places[0].address_components);
         
              var bounds = new google.maps.LatLngBounds();
              var i, place;
              for (i = 0; place = places[i]; i++) {
                (function(place) {
                  var marker = new google.maps.Marker({
         
                    position: place.geometry.location
                  });
                  marker.bindTo('map', searchBox, 'map');
                  google.maps.event.addListener(marker, 'map_changed', function() {
                    if (!this.getMap()) {
                      this.unbindAll();
                    }
                  });
                  bounds.extend(place.geometry.location);
         
         
                }(place));
         
              }
              map.fitBounds(bounds);
              searchBox.set('map', map);
              map.setZoom(Math.min(map.getZoom(),12));
         
            });
          }
          google.maps.event.addDomListener(window, 'load', init);


          function setAddressSeparatedInputs(address_components_gmaps) {
            //console.log(address_components_gmaps)
            var addressCom = {
                country: "",
                locality: "", //grad
                route: "", //ulica
                postal_code: "",
                street_number: "",
                administrative_area_level_2: "", //okrug
            }


            for (var i = 0; i < address_components_gmaps.length; i++) {
                for (var j = 0; j < address_components_gmaps[i].types.length; j++) {
                    switch(address_components_gmaps[i].types[j]) {
                        case "country":  {
                            if(address_components_gmaps[i].long_name == 'Sjeverna Makedonija') {
                                addressCom.country = 'Makedonija';
                            }
                            else {
                                addressCom.country = address_components_gmaps[i].long_name;
                            }
                            break;
                        }
                        case "locality":  {
                            addressCom.locality = address_components_gmaps[i].long_name;
                            break;
                        }
                        case "route":  {
                            addressCom.route = address_components_gmaps[i].long_name;
                            break;
                        }
                        case "postal_code":  {
                            addressCom.postal_code = address_components_gmaps[i].long_name;
                            break;
                        }
                        case "street_number":  {
                            addressCom.street_number = address_components_gmaps[i].long_name;
                            break;
                        }
                        case "administrative_area_level_2":  {
                            addressCom.administrative_area_level_2 = address_components_gmaps[i].long_name;
                            break;
                        }
                        default: {
                            break;
                        }
                    }
                }
                
              }
              console.log(addressCom.country)
              //insert drzava
              
              $(`select[name="drzava"] option[value="${addressCom.country}"]`).attr('selected', 'selected');
              $(`input[name="grad"]`).val(addressCom.locality);
              $(`input[name="ulica"]`).val(addressCom.route);
              $(`input[name="broj"]`).val(addressCom.street_number);
              $(`input[name="okrug"]`).val(addressCom.administrative_area_level_2);
              $(`input[name="po_broj"]`).val(addressCom.postal_code);

              


          }

    });
    


})();