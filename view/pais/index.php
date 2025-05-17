<style>
    .leaflet-control-attribution {
        font-size: 14px;       /* Aumenta el tamaño de letra */
        padding: 8px 12px;      /* Más espacio alrededor */
        background: rgba(255, 255, 255, 0.8); /* Fondo más visible */
        color: #000;            /* Texto oscuro para más contraste */
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />


<h1>Mapa de países</h1>
<p>Selecciona el país sobre el que quieres buscar información.</p>

<div id="map" style="height: 80vh;"></div>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map = L.map('map', {
        minZoom: 3,
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
    // let circle = L.circle([51.508, -0.11], {
    //     radius: 500,
    //     color: "red",
    //     fillColor: "#f03",
    //     fillOpacity: 0.5
    // }).addTo(map);

map.on('click', function (e) {
    let lat = e.latlng.lat;
    let lon = e.latlng.lng;

    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
    .then(response => response.json())
    .then(data => {
        let country = data.address.country;
        if(confirm("Has seleccionado " + country + "?"))
            window.location.href = `/index.php?c=pais&a=ver&lat=${lat}&lon=${lon}`;
        else return false;
    })
    .catch(err => {
        alert("No se pudo obtener el país.");
    });
});
  
</script>
