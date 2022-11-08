(function () {

  var filesPath = THEME_DIR;

  mapboxgl.accessToken = 'pk.eyJ1Ijoic3RvZmlvIiwiYSI6ImNrZ3duNHhmdDA0MnoycXBmYWVlYjJtMHgifQ.eS9K2EYvkEEDASW4SBEjdQ';

  const bounds = [
    [17.965353, 41.745445], // Southwest coordinates
    [23.704046, 46.670879] // Northeast coordinates
  ];

  const map = new mapboxgl.Map({
    container: 'drzava-map',
    style: 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd',
    center: [20.994273, 44.086444],
    zoom: 7,
    maxBounds: bounds 
  });

  map.on('load', () => {

    map.addSource('dbData', {
      type: 'geojson',
      data: filesPath + '/scripts/get_drzava_locations.php',
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



   
  


  }); //map load






})(); //(function() {