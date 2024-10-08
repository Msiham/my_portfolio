jQuery(function($){
  var map = new Maplace({
    controls_on_map: false,
    map_div: '#googlemaps-ID1',
    locations: [{
      lat: latitude,
      lon: longitude,
      zoom: 16
    }],
    styles: {
      'Greyscale': [{
        featureType: 'all',
        stylers: [
          { saturation: -100 },
          { gamma: 0.50 }
        ]
      }]
    },
    map_options: {scrollwheel: false},
  }).Load();
});
