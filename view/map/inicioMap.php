<div id="map" style="height: 600px;"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var map = L.map('map', {
        minZoom: 2,
        maxZoom: 10,
        maxBounds: [[-85, -180], [85, 180]]
    }).setView([20, 0], 2);

    map.on('drag', function () {
        map.panInsideBounds(map.options.maxBounds, { animate: false });
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        noWrap: true,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

  // Marcador
//   L.marker([40.4168, -3.7038]).addTo(map)
//     .bindPopup('Madrid')
//     .openPopup();

    // circulo
    var circle = L.circle([51.508, -0.11], {
        radius: 500,
        color: "red",
        fillColor: "#f03",
        fillOpacity: 0.5
    }).addTo(map);

map.on('click', function (e) {
      var lat = e.latlng.lat;
      var lon = e.latlng.lng;

      fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
        .then(response => response.json())
        .then(data => {
          var country = data.address.country || "País no encontrado";
          alert("Estás en: " + country);
        })
        .catch(err => {
          console.error("Error con Nominatim:", err);
          alert("No se pudo obtener el país.");
        });
    });
  
</script>
