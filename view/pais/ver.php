<h1><?php echo $paisNombre?></h1>

<div id="map" style="height: 80vh;"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let lat = <?php echo $lat; ?>;
    let lon = <?php echo $lon; ?>;

    let map = L.map('map', {
        minZoom: 5,
        maxZoom: 17,
        maxBounds: [[-85, -180], [85, 180]]
    }).setView([lat, lon], 6);

    map.on('drag', function () {
        map.panInsideBounds(map.options.maxBounds, { animate: false });
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        noWrap: true,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>
