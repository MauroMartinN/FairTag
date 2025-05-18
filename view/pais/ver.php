<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<style>
    .leaflet-control-attribution {
        font-size: 14px;       /* Aumenta el tamaño de letra */
        padding: 8px 12px;      /* Más espacio alrededor */
        background: rgba(255, 255, 255, 0.8); /* Fondo más visible */
        color: #000;            /* Texto oscuro para más contraste */
    }

    .popup {
    min-width: 200px; /* Puedes ajustar esto */
    font-size: 16px;
}
</style>

<h1><?= $paisNombre ?></h1>
<a href="index.php?c=Post&a=crear">Crear nuevo post</a>

<div id="map" style="height: 80vh;"></div>

<script>
let lat = <?= $lat; ?>;
let lon = <?= $lon; ?>;

let map = L.map('map', {
    minZoom: 5,
    maxZoom: 17,
    maxBounds: [[-85, -180], [85, 180]]
}).setView([lat, lon], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    noWrap: true,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

let allMarkers = [];
let marker;

<?php
$limitedPosts = array_slice($posts, 0, 100);
foreach ($limitedPosts as $post):
    $postLat = $post->getLatitude();
    $postLon = $post->getLongitude();
    $title = $post->getTitle();
    $type = $post->getType();
    $id = $post->getId();
    $link = "index.php?c=Post&a=ver&id=$id";
    $popupContent = "
        <div class='popup'>
            <strong>$title</strong><br>
            Tipo: $type<br>
            <a href='$link'>Ver</a>
        </div>";
?>
    marker = L.marker([<?= $postLat ?>, <?= $postLon ?>]).bindPopup(`<?= $popupContent ?>`);
    marker.addTo(map);
    allMarkers.push(marker);
<?php endforeach; ?>


let drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

let drawControl = new L.Control.Draw({
    draw: {
        polygon: false,
        rectangle: false,
        polyline: false,
        marker: false,
        circlemarker: false,
        circle: {
            shapeOptions: {
                color: 'red'
            }
        }
    },
    edit: {
        featureGroup: drawnItems,
        edit: false,
        remove: true
    }
});
map.addControl(drawControl);

map.on(L.Draw.Event.CREATED, function (event) {
    drawnItems.clearLayers();

    let layer = event.layer;
    drawnItems.addLayer(layer);

    if (layer instanceof L.Circle) {
        let center = layer.getLatLng();
        let radius = layer.getRadius();

        allMarkers.forEach(marker => {
            let distance = center.distanceTo(marker.getLatLng());
            if (distance <= radius) {
                marker.addTo(map);
            } else {
                map.removeLayer(marker);
            }
        });
    }
});

map.on(L.Draw.Event.DELETESTART, function (event) {
    drawnItems.clearLayers();

    allMarkers.forEach(marker => {
        marker.addTo(map);
    });

    setTimeout(() => {
        const ulElement = document.querySelector('ul.leaflet-draw-actions.leaflet-draw-actions-top.leaflet-draw-actions-bottom');
        const firstLi = ulElement ? ulElement.querySelector('li:first-child') : null;
        if (firstLi) {
            const link = firstLi.querySelector('a');
            if (link) {
                link.click();
                console.log('Modo borrar desactivado');
            }
        }
    }, 1);
});
</script>
