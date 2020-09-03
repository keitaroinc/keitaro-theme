(function ($) {
  $(document).ready(function () {

    // This is where the pin locations are stored for fitBounds
    var bounds = [];
    // Define different locations with properties
    var locations = [
      {
        id: 'skopje',
        title: 'Skopje',
        country: 'North Macedonia',
        direction: 'right',
        pin: [41.9946, 21.4051],
        phone: '+389 78 293 269'
      },
      // {
      //   id: 'bitola',
      //   title: 'Bitola',
      //   country: 'North Macedonia',
      //   pin: [41.0353, 21.3289],
      //   phone: 'to be added'
      // },
      {
        id: 'berlin',
        title: 'Berlin',
        country: 'Germany',
        direction: 'right',
        pin: [52.5173, 13.3889],
        phone: '+49 1578 7336652'
      },
      {
        id: 'malmo',
        title: 'Malmö',
        country: 'Sweden',
        direction: 'left',
        pin: [55.6056, 13.0002],
        phone: '+46 76 335 40 76'
      },
      {
        id: 'london',
        title: 'London',
        country: 'United Kingdom',
        direction: 'bottom',
        pin: [51.5076, -0.1276],
        phone: '+44 7784 465130'
      },
      {
        id: 'tampa',
        title: 'Tampa',
        country: 'United States',
        direction: 'right',
        pin: [27.9965, -82.4202],
        phone: '+1 419 205 7602'
      },
    ];

    // Initialize map
    var map = L.map('amplus_locations', {
      scrollWheelZoom: false,
    });

    // Set tile layers and
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: 'mapbox.light'
    }).addTo(map);

    if (locations != undefined) {

      locations.forEach(function (el) {
        var icon = new L.Icon({
          iconUrl: 'wp-content/themes/keitaro-theme/assets/img/leaflet/marker-icon-amplus.svg',
          shadowUrl: '',
          iconSize: [25, 41],
          iconAnchor: [12.5, 41],
        });
        icon.options.shadowSize = [0, 0];
        var marker = L.marker(el.pin, { icon: icon }).addTo(map);
        marker.bindPopup("<h4 class='title'>" + el.phone + "</h4><p>" + el.country + "</p><a href='tel:" + el.phone + "' class='btn btn-sm btn-outline-secondary'>Call Now</a>");
        marker.bindTooltip(el.title, { direction: el.direction, sticky: true });
        bounds.push(el.pin);
      })

      // Zoom out to include all visible markers on the map
      map.fitBounds(bounds, { maxZoom: 3 });
    }

  })

})(jQuery);