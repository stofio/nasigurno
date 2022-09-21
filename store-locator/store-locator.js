(function() {

var filesPath = THEME_DIR;


mapboxgl.accessToken = 'pk.eyJ1Ijoic3RvZmlvIiwiYSI6ImNrZ3duNHhmdDA0MnoycXBmYWVlYjJtMHgifQ.eS9K2EYvkEEDASW4SBEjdQ';

const map = new mapboxgl.Map({
    container: 'nasigurno-map',
    style: 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd',
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
    flyToPoint(e.lngLat);
    showPopup(e);
  });

  

  map.on('mouseover', 'unclustered-point', (e) => {
    showPopup(e)
  });

  map.on('mouseout', 'unclustered-point', (e) => {
    closePopups();
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
        20,
        100,
        30,
        750,
        40
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
      'text-size': 14
    }, 
    paint: {
      "text-color": "#ffffff"
    }
  });
   

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
          'icon-size': 1
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
    const popup = new mapboxgl.Popup({ closeOnClick: true, closeOnMove:true, offset: 17 })
      .setLngLat(currentFeature.geometry.coordinates)
      .setHTML(`<h3>${currentFeature.properties.address}, ${currentFeature.properties.postcode}</h3>
                <h4>${currentFeature.properties.link_name}</h4>`
              )
      .addTo(map);
  }

  function showPopup(event) {
    const features = map.queryRenderedFeatures(event.point, {
      layers: ['unclustered-point']
    });
     /* If it does not exist, return */
    if (!features.length) return;
    const clickedPoint = features[0];

    createPopUp(clickedPoint);

  }


  function flyToPoint(lngLat) {
    console.log(lngLat)
    map.flyTo({
      center: [lngLat.lng, lngLat.lat],
      zoom: 17,
      speed: 1
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
    
    $('#listings').append(`<h3>Link_id = ${id}</h3>`);
    $.ajax({
      method: "POST",
      url: filesPath + '/store-locator/parts/getProfileWithId.php?id=' + id,
      success: function(data) {
        profile = JSON.parse(data);
        console.log(profile);
      }
    });


    
  }


}); //map load


})(); //(function() {