<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />


<h1 class="base">Mapa de países</h1>
<h2 class="base">Selecciona el país sobre el que quieres buscar información.</h2>

<div id="map"></div>
<br>

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

    map.on('click', function (e) {
        let lat = e.latlng.lat;
        let lon = e.latlng.lng;

        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&accept-language=es`)
            .then(response => response.json())
            .then(data => {
                let country = data.address.country;
                abrirModalComment(country);
                document.getElementById('botonPais').onclick = () => {
                    cerrarModalComment();
                    location.href = `index.php?c=pais&a=ver&pais=${country}&lat=${lat}&lon=${lon}`;
                };
            })
            .catch(err => {
                alert("No se pudo obtener el país.");
            });
    });


</script>

<div id="countryModal" class="modal-denuncia" style="display:none;">
    <div class="modal-content">
        <h4 class="base">Confirmación</h4>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <p id="countrySelectedText"></p>
            <div>
                <button type="button" id="botonPais">Sí</button>
                <button type="button" onclick="cerrarModalComment()">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModalComment(country) {
        document.getElementById('countrySelectedText').textContent = `Has seleccionado ${country}?`;
        document.getElementById('countryModal').style.display = 'block';
        return false;
    }
    function cerrarModalComment() {
        document.getElementById('countryModal').style.display = 'none';
    }
</script>