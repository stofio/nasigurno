(function () {

    var filesPath = THEME_DIR;

    mapboxgl.accessToken = 'pk.eyJ1IjoidXNlcm1pcnphIiwiYSI6ImNsZDMwYTk0ZzBhc2MzcW9kaDc1c2Y2eGIifQ.FKXx1zgzRj0PvGjXcJIj9Q';

    $(window).on('load', () => {
        showMap();
    });


    function showMap() {
        
        $lat = $('#single-map').attr('data-lat') * 1;
        $lng = $('#single-map').attr('data-lng') * 1;
        $title = $('#single-map').attr('data-title');
        $address = $('#single-map').attr('data-address');


        const map = new mapboxgl.Map({
            container: 'single-map',
            style: 'mapbox://styles/usermirza/cld31g82g000w01lcoi46sua9',
            center: [$lng, $lat],
            zoom: 12
        });

        map.on('load', () => {

            map.loadImage(filesPath + '/store-locator/icons/pin-and-shadow.png',
                (error, image) => {
                    if (error) throw error;

                    // Add the image to the map style.
                    map.addImage('nasigurnoMarker', image);


                    map.addSource('point', {
                        'type': 'geojson',
                        'data': {
                            'type': 'FeatureCollection',
                            'features': [
                                {
                                    'type': 'Feature',
                                    'geometry': {
                                        'type': 'Point',
                                        'coordinates': [$lng, $lat]
                                    }
                                }
                            ]
                        }
                    });

                    //add layer
                    map.addLayer({
                        id: 'point',
                        type: 'symbol',
                        source: 'point',
                        layout: {
                        'icon-image': 'nasigurnoMarker', // reference the image
                        'icon-size': 1
                        }
                    })

                    const popup = new mapboxgl.Popup({ closeButton: false, closeOnClick: false, closeOnMove:false, offset: 17 })
                    .setLngLat([$lng, $lat])
                    .setHTML(`<h3>${$title}</h3>
                              <h4>${$address}</h4>`
                            )
                    .addTo(map);

                }





            ); //loadImage()
        });

    }


  


})(); 