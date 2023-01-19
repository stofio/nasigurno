(function() {

var filesPath = THEME_DIR;
var currentMarkerData;
var mbAccessToken = 'pk.eyJ1IjoidXNlcm1pcnphIiwiYSI6ImNsZDMwYTk0ZzBhc2MzcW9kaDc1c2Y2eGIifQ.FKXx1zgzRj0PvGjXcJIj9Q';

var geocodingClient = mapboxSdk({ accessToken: mbAccessToken });
mapboxgl.accessToken = mbAccessToken;


const map = new mapboxgl.Map({
    container: 'nasigurno-map',
    style: 'mapbox://styles/usermirza/cld31g82g000w01lcoi46sua9',
    center: [18.413420, 43.85643],
    zoom: 12
});


map.on('load', () => {
  
  map.addSource('dbData', {
    type: 'geojson',
    data: filesPath + '/store-locator/parts/getAllLocationsGeoJson.php',
    cluster: true,
    clusterMaxZoom: 14, 
    clusterRadius: 50
  });



  // inspect a cluster on click
  map.on('click', 'clusters', (e) => {
    const features = map.queryRenderedFeatures(e.point, {
    layers: ['clusters']
    });
    const clusterId = features[0].properties.cluster_id;
    map.getSource('dbData').getClusterExpansionZoom(
      clusterId,
      (err, zoom) => {
        if (err) return;
       
        map.easeTo({
          center: features[0].geometry.coordinates,
          zoom: zoom
        });
      }
    );
  });

  $(document).on('click', '.location-id', (e) => {
    displayListingOnSidebar($(e.target).attr('data-id'));
  });

  map.on('click', 'unclustered-point', (e) => {
    showListingOnSidebar(e);
    showPopup(e.point.x, e.point.y);
    flyToPoint(e);
    currentMarkerData = { lngLat: e.lngLat };
                    
  });


  map.on('mouseover', 'unclustered-point', (e) => {
    showPopup(e.point.x, e.point.y);
  });

  map.on('mouseout', 'unclustered-point', (e) => {
    //closePopups();
  });

  //set cursor pointer on points
  map.on('mouseenter', 'unclustered-point', () => {
    map.getCanvas().style.cursor = 'pointer'
  })
  map.on('mouseleave', 'unclustered-point', () => {
    map.getCanvas().style.cursor = ''
  })
  map.on('mouseenter', 'clusters', () => {
    map.getCanvas().style.cursor = 'pointer'
  })
  map.on('mouseleave', 'clusters', () => {
    map.getCanvas().style.cursor = ''
  })
   
  map.addLayer({
    id: 'clusters',
    type: 'circle',
    source: 'dbData',
    filter: ['has', 'point_count'],
    paint: {
      'circle-color': [
        'step',
        ['get', 'point_count'],
        'rgba(155,20,43, 0.7)', //small
        100,
        'rgba(155,20,43, 0.7)', //mid
        750,
        'rgba(155,20,43, 0.7)' //big
      ],
      'circle-radius': [
        'step',
        ['get', 'point_count'],
        10,
        100,
        20,
        750,
        30
      ]
      }
  });


  map.addLayer({
    id: 'cluster-count',
    type: 'symbol',
    source: 'dbData',
    filter: ['has', 'point_count'],
    layout: {
      'text-field': '{point_count_abbreviated}',
      'text-size': 12
    }, 
    paint: {
      "text-color": "#ffffff"
    }
  });
   
   /**
    * red marker
    */
   map.loadImage(filesPath + '/store-locator/icons/pin-and-shadow.png',
    (error, image) => {
      if (error) throw error;

      // Add the image to the map style.
      map.addImage('nasigurnoMarker', image);
 
      //add layer
      map.addLayer({
        id: 'unclustered-point',
        type: 'symbol',
        filter: ['!', ['has', 'point_count']],
        source: 'dbData',
        layout: {
          'icon-image': 'nasigurnoMarker', // reference the image
          'icon-size': .8
        }
      })
    }
  ); //loadImage()



  // Add geolocate control to the map.
  map.addControl(
    new mapboxgl.GeolocateControl({
    positionOptions: {
    enableHighAccuracy: true
    },
    // When active the map will receive updates to the device's location as it changes.
    trackUserLocation: true,
    // Draw an arrow next to the location dot to indicate which direction the device is heading.
    showUserHeading: true
    })
  );
  
    function closePopups() {
      const popUps = document.getElementsByClassName('mapboxgl-popup');
      /** Check if there is already a popup on the map and if so, remove it */
      if (popUps[0]) popUps[0].remove();
    }

  function createPopUp(currentFeature) {
    const popUps = document.getElementsByClassName('mapboxgl-popup');
    /** Check if there is already a popup on the map and if so, remove it */
    if (popUps[0]) popUps[0].remove();

    /*
     * set link id on click
    */
    const popup = new mapboxgl.Popup({  closeOnMove:false, offset: 17 })
      .setLngLat(currentFeature.geometry.coordinates)
      .setHTML(`<h3>${currentFeature.properties.address}, ${currentFeature.properties.postcode}</h3>
                <h4>${currentFeature.properties.link_name}</h4>`
              )
      .addTo(map);
  }

  function showPopup(x, y) {
    const features = map.queryRenderedFeatures([x, y], {
      layers: ['unclustered-point']
    });
     /* If it does not exist, return */
    if (!features.length) return;
    const clickedPoint = features[0];

    createPopUp(clickedPoint);
  }



  function flyToPoint(e) {
    map.flyTo({
      center: [e.lngLat.lng, e.lngLat.lat],
      speed: 2
    });
  }


  function showListingOnSidebar(event) {
    const features = map.queryRenderedFeatures(event.point, {
      layers: ['unclustered-point']
    });

    if (!features.length) return;
    const clickedPoint = features[0];

   displayListingOnSidebar(clickedPoint.properties.link_id);

  }

  function displayListingOnSidebar(id) {
    console.log(id)
    $loading = $('.loading');
    $listing = $('.listing');
    $listingContainer = $('.listings');

    $listing.remove();
    $loading.css('display', 'flex');
    $.ajax({
      method: "POST",
      url: filesPath + '/store-locator/parts/getProfileWithId.php?id=' + id,
      success: function(data) {
        $loading.css('display', 'none');
        console.log(data);
        /**
         * output data on left
         */
        //fill the dom


        //show
        $listingContainer.append(data);
      }
    });


    
  }


  autocompleteAddressBox(document.getElementById("stLocSearch"));


  function autocompleteSuggestionMapBoxAPI(inputParams, callback) {
    geocodingClient.geocoding.forwardGeocode({
        query: inputParams,
        countries: ['Rs'],
        autocomplete: true,
        limit: 5,
      })
      .send()
      .then(response => {
        const match = response.body;
        callback(match);
      });
  }

  function autocompleteAddressBox(inp, callback) {

    var currentLocationFocus;
    inp.addEventListener('click', function(e) {
      var a, b, i, val = this.value;
      //closeLocations();
      currentLocationFocus = -1;

      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "location-list");
      a.setAttribute("class", "location-items");
      this.parentNode.appendChild(a);

    })

    var currentSuggesFocus;
    inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      closeLocations();
      if (!val) {
        $(inp).attr('data-lat', '');
        $(inp).attr('data-lng', '');
        return false;
      }
      currentSuggesFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list-st");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);

      // suggestion list MapBox api called with callback
      autocompleteSuggestionMapBoxAPI($(inp).val(), function(results) {
        results.features.forEach(function(key) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + key.place_name.substr(0, val.length) + "</strong>";
          b.innerHTML += key.place_name.substr(val.length);
          b.innerHTML += "<input type='hidden' data-lat='" + key.geometry.coordinates[1] + "' data-lng='" + key.geometry.coordinates[0] + "'  value='" + key.place_name + "'>";
          b.addEventListener("click", function(e) {
            let lat = $(this).find('input').attr('data-lat');
            let long = $(this).find('input').attr('data-lng');
            let title = $(this).find('input').attr('value');
            let postalcode = '';
            let city = '';
            let country = '';

            if(key.context) {
              key.context.forEach(function(item) {
                var reqstr = item.id.substring(0, item.id.indexOf('.'));
                reqstr == 'postcode' ? postalcode = item.text : true;
                reqstr == 'place' ? city = item.text : true;
                reqstr == 'country' ? country = item.text : true;
              });
            }
          

            inp.value = $(this).find('input').val();
            inp.title = $(this).find('input').val();
            $(inp).attr('data-lat', lat);
            $(inp).attr('data-lng', long);
            $(inp).attr('city', city);
            $(inp).attr('country', country);
            $(inp).attr('postalcode', postalcode);

            setPointToMap([long, lat], true);
            closeAllLists();
            //}
          });
          a.appendChild(b);
        });
      })
    });

    /*when click over the input*/
    document.addEventListener("click", function(e) {
      closeAllLists(e.target);
    });

    document.addEventListener("click", function(e) {
      if (e.target.id !== 'startPoint' && e.target.id !== 'destPoint') {
        closeLocations(e.target);
      }
    });


    //flash this coordinate
    var inputIcon = $($(inp).closest('div').prev('button'));
    $(inputIcon).on('click', function() {
      if ($(inp).attr('data-lat') !== '' && $(inp).attr('data-lng') !== '') {
        //flash this coordinate
        let lat = $(inp).attr('data-lat');
        let lng = $(inp).attr('data-lng');
        let cordId = (lng + lat).split('.').join('');
        $('#' + 'm' + cordId).addClass('animate__flash');
        setTimeout(function() {
          $('#' + 'm' + cordId).removeClass('animate__flash');
        }, 1000);
      }
    })


    inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list-st");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed*/
        currentSuggesFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed*/
        currentSuggesFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed*/
        e.preventDefault();
        if (currentSuggesFocus > -1) {
          if (x) x[currentSuggesFocus].click();
        }
      }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentSuggesFocus >= x.length) currentSuggesFocus = 0;
      if (currentSuggesFocus < 0) currentSuggesFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentSuggesFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }

    function closeLocations(elmnt) {
      var x = document.getElementsByClassName("location-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }


    function setPointToMap(coordinates) {
      var el = document.createElement('div');
      el.className = 'marker';
      cordId = coordinates.toString().split('.').join('').split(',').join('');
      el.setAttribute('id', 'm' + cordId);

      new mapboxgl.Marker(el)
        .setLngLat(coordinates)
        .addTo(map);

        map.flyTo({
          center: coordinates,
          essential: true
        });
    }

    
  } //autocompleteAddressBox()


}); //map load


})(); //(function() {