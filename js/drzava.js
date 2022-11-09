(function () {

  var filesPath = THEME_DIR;
  var currentDrzava = DRZAVA;

  mapboxgl.accessToken = 'pk.eyJ1Ijoic3RvZmlvIiwiYSI6ImNrZ3duNHhmdDA0MnoycXBmYWVlYjJtMHgifQ.eS9K2EYvkEEDASW4SBEjdQ';

  console.log(currentDrzava)

  //https://www.latlong.net/
  switch(currentDrzava) {
    case 'Srbija':
      var bounds = [
        [17.965353, 41.745445], // west, south
        [23.704046, 46.670879] // east, north
      ];
      var thecenter = [20.994273, 44.086444];
      var mapStyle = 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd';
    break;
    case 'Bosna i Hercegovina':
      var bounds = [
        [15.395171, 42.296993], // west, south
        [19.968535, 45.447969] // east, north
      ];
      var thecenter = [17.948761, 44.172047];
      var mapStyle = 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd';
    break;
    case 'Makedonija':
      var bounds = [
        [20.317890, 40.667489], // west, south
        [23.198230, 42.459307] // east, north
      ];
      var thecenter = [21.725247, 41.594263];
      var mapStyle = 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd';
    break;
    case 'Hrvatska':
      var bounds = [
        [12.971222, 42.365393], // west, south
        [19.677357, 46.716092] // east, north
      ];
      var thecenter = [16.328234, 45.684777];
      var mapStyle = 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd';
    break;
    case 'Slovenija':
      var bounds = [
        [13.285109, 45.295841], // west, south
        [16.707936, 46.930924] // east, north
      ];
      var thecenter = [14.554877, 46.048157];
      var mapStyle = 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd';
      break;
    case 'Crna Gora':
      var bounds = [
        [18.357350, 41.662333], // west, south
        [20.418662, 43.605940] // east, north
      ];
      var thecenter = [19.220352, 42.631622];
      var mapStyle = 'mapbox://styles/stofio/cl83ka2bd005414o6t7wcbxrd';
      break;
    default:
      // def
  }

  const map = new mapboxgl.Map({
    container: 'drzava-map',
    style: mapStyle,
    center: thecenter,
    zoom: 8,
    maxBounds: bounds 
  });

  map.on('load', () => {

    map.addSource('dbData', {
      type: 'geojson',
      data: filesPath + '/scripts/get_drzava_locations.php?drzava=' + currentDrzava,
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