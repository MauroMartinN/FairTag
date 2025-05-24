<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<style>
    .leaflet-control-attribution {
        font-size: 14px;
    }

    .popup {
        min-width: 200px;
        font-size: 16px;
    }

    .map-container {
        position: relative;
        height: 80vh;
        max-width: 90%;
        margin: 0 auto;
        border-radius: 10px;
    }

    #map {
        width: 100%;
        height: 100%;
        border-radius: 10px;
    }
</style>


<h1><?= $paisNombre ?></h1>

<div class="container my-4">
    <?php if (isset($costes)): ?>
        <h2 class="mb-4"><?= htmlspecialchars($costes->city) ?>, <?= htmlspecialchars($paisNombre) ?></h2>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group">


                    <li class="list-group-item active">Comida</li>
                    <?php if ($costes->meal_inexpensive_restaurant !== null): ?>
                        <li class="list-group-item"><strong>Comida económica:</strong>
                            €<?= number_format($costes->meal_inexpensive_restaurant, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->meal_for_2_midrange !== null): ?>
                        <li class="list-group-item"><strong>Comida para 2 (media):</strong>
                            €<?= number_format($costes->meal_for_2_midrange, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->mcmeal_at_mcdonalds !== null): ?>
                        <li class="list-group-item"><strong>Menú McDonald's:</strong>
                            €<?= number_format($costes->mcmeal_at_mcdonalds, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->beer_domestic_restaurant !== null): ?>
                        <li class="list-group-item"><strong>Cerveza nacional (restaurante):</strong>
                            €<?= number_format($costes->beer_domestic_restaurant, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->beer_imported_restaurant !== null): ?>
                        <li class="list-group-item"><strong>Cerveza importada (restaurante):</strong>
                            €<?= number_format($costes->beer_imported_restaurant, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->cappuccino_restaurant !== null): ?>
                        <li class="list-group-item"><strong>Cappuccino (restaurante):</strong>
                            €<?= number_format($costes->cappuccino_restaurant, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->coke_pepsi !== null): ?>
                        <li class="list-group-item"><strong>Coca-Cola / Pepsi (restaurante):</strong>
                            €<?= number_format($costes->coke_pepsi, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->water_restaurant !== null): ?>
                        <li class="list-group-item"><strong>Agua (restaurante):</strong>
                            €<?= number_format($costes->water_restaurant, 2) ?></li>
                    <?php endif; ?>

                    <li class="list-group-item active">Supermercado</li>
                    <?php if ($costes->milk_1l !== null): ?>
                        <li class="list-group-item"><strong>Leche 1L:</strong> €<?= number_format($costes->milk_1l, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->bread_500g !== null): ?>
                        <li class="list-group-item"><strong>Pan 500g:</strong> €<?= number_format($costes->bread_500g, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->rice_1kg !== null): ?>
                        <li class="list-group-item"><strong>Arroz 1kg:</strong> €<?= number_format($costes->rice_1kg, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->eggs_12 !== null): ?>
                        <li class="list-group-item"><strong>Huevos (12 unidades):</strong>
                            €<?= number_format($costes->eggs_12, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->cheese_1kg !== null): ?>
                        <li class="list-group-item"><strong>Queso 1kg:</strong> €<?= number_format($costes->cheese_1kg, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->chicken_1kg !== null): ?>
                        <li class="list-group-item"><strong>Pollo 1kg:</strong> €<?= number_format($costes->chicken_1kg, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->beef_1kg !== null): ?>
                        <li class="list-group-item"><strong>Carne de vaca 1kg:</strong>
                            €<?= number_format($costes->beef_1kg, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->apples_1kg !== null): ?>
                        <li class="list-group-item"><strong>Manzanas 1kg:</strong> €<?= number_format($costes->apples_1kg, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->bananas_1kg !== null): ?>
                        <li class="list-group-item"><strong>Plátanos 1kg:</strong>
                            €<?= number_format($costes->bananas_1kg, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->oranges_1kg !== null): ?>
                        <li class="list-group-item"><strong>Naranjas 1kg:</strong>
                            €<?= number_format($costes->oranges_1kg, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->tomato_1kg !== null): ?>
                        <li class="list-group-item"><strong>Tomate 1kg:</strong> €<?= number_format($costes->tomato_1kg, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->potato_1kg !== null): ?>
                        <li class="list-group-item"><strong>Patata 1kg:</strong> €<?= number_format($costes->potato_1kg, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->onion_1kg !== null): ?>
                        <li class="list-group-item"><strong>Cebolla 1kg:</strong> €<?= number_format($costes->onion_1kg, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->lettuce_head !== null): ?>
                        <li class="list-group-item"><strong>Lechuga (unidad):</strong>
                            €<?= number_format($costes->lettuce_head, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->water_1_5l_market !== null): ?>
                        <li class="list-group-item"><strong>Agua 1.5L (supermercado):</strong>
                            €<?= number_format($costes->water_1_5l_market, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->wine_midrange_market !== null): ?>
                        <li class="list-group-item"><strong>Vino medio (supermercado):</strong>
                            €<?= number_format($costes->wine_midrange_market, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->beer_domestic_market !== null): ?>
                        <li class="list-group-item"><strong>Cerveza nacional (supermercado):</strong>
                            €<?= number_format($costes->beer_domestic_market, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->beer_imported_market !== null): ?>
                        <li class="list-group-item"><strong>Cerveza importada (supermercado):</strong>
                            €<?= number_format($costes->beer_imported_market, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->cigarettes_20 !== null): ?>
                        <li class="list-group-item"><strong>Cigarrillos (20 unidades):</strong>
                            €<?= number_format($costes->cigarettes_20, 2) ?></li>
                    <?php endif; ?>

                    <li class="list-group-item active">Transporte</li>
                    <?php if ($costes->transport_oneway !== null): ?>
                        <li class="list-group-item"><strong>Billete transporte sencillo:</strong>
                            €<?= number_format($costes->transport_oneway, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->transport_monthly !== null): ?>
                        <li class="list-group-item"><strong>Abono transporte mensual:</strong>
                            €<?= number_format($costes->transport_monthly, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->taxi_start !== null): ?>
                        <li class="list-group-item"><strong>Precio inicio taxi:</strong>
                            €<?= number_format($costes->taxi_start, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->taxi_1km !== null): ?>
                        <li class="list-group-item"><strong>Taxi por km:</strong> €<?= number_format($costes->taxi_1km, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->taxi_1h_wait !== null): ?>
                        <li class="list-group-item"><strong>Taxi por 1h:</strong>
                            €<?= number_format($costes->taxi_1h_wait, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->gasoline_1l !== null): ?>
                        <li class="list-group-item"><strong>Gasolina 1L:</strong> €<?= number_format($costes->gasoline_1l, 2) ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($costes->car_vw_golf !== null): ?>
                        <li class="list-group-item"><strong>Coche VW Golf:</strong>
                            €<?= number_format($costes->car_vw_golf, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->car_toyota_corolla !== null): ?>
                        <li class="list-group-item"><strong>Coche Toyota Corolla:</strong>
                            €<?= number_format($costes->car_toyota_corolla, 2) ?></li>
                    <?php endif; ?>

                    <li class="list-group-item active">Utilidades</li>
                    <?php if ($costes->utilities_85m2 !== null): ?>
                        <li class="list-group-item"><strong>Electricidad 85kWh:</strong>
                            €<?= number_format($costes->utilities_85m2, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->mobile_tariff_1min !== null): ?>
                        <li class="list-group-item"><strong>Tarifa mobil por minuto:</strong>
                            €<?= number_format($costes->mobile_tariff_1min, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->fitness_monthly !== null): ?>
                        <li class="list-group-item"><strong>Gimnasio mensual:</strong>
                            €<?= number_format($costes->fitness_monthly, 2) ?></li>
                    <?php endif; ?>

                    <li class="list-group-item active">Vivienda</li>
                    <?php if ($costes->apartment_1br_center !== null): ?>
                        <li class="list-group-item"><strong>Alquiler 1 hab. centro:</strong>
                            €<?= number_format($costes->apartment_1br_center, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->apartment_1br_outside !== null): ?>
                        <li class="list-group-item"><strong>Alquiler 1 hab. fuera centro:</strong>
                            €<?= number_format($costes->apartment_1br_outside, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->apartment_3br_center !== null): ?>
                        <li class="list-group-item"><strong>Alquiler 3 hab. centro:</strong>
                            €<?= number_format($costes->apartment_3br_center, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->apartment_3br_outside !== null): ?>
                        <li class="list-group-item"><strong>Alquiler 3 hab. fuera centro:</strong>
                            €<?= number_format($costes->apartment_3br_outside, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->price_m2_center !== null): ?>
                        <li class="list-group-item"><strong>Precio/m² centro ciudad:</strong>
                            €<?= number_format($costes->price_m2_center, 2) ?></li>
                    <?php endif; ?>
                    <?php if ($costes->price_m2_outside !== null): ?>
                        <li class="list-group-item"><strong>Precio/m² fuera centro:</strong>
                            €<?= number_format($costes->price_m2_outside, 2) ?></li>
                    <?php endif; ?>

                    <li class="list-group-item active">Salarios</li>
                    <?php if ($costes->avg_salary_monthly !== null): ?>
                        <li class="list-group-item"><strong>Salario neto (soltero):</strong>
                            €<?= number_format($costes->avg_salary_monthly, 2) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php elseif (isset($ciudades)): ?>
        <h2 class="mb-4">Ciudades en <?= htmlspecialchars($pais->getName()) ?></h2>
        <div class="row">
            <?php foreach ($ciudades as $ciudad): ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <a href="index.php?c=pais&a=ver&pais=<?= urlencode($pais->getName()) ?>&city=<?= urlencode($ciudad) ?>"
                        class="text-decoration-none">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h5 class="panel-title" style="margin:0;"><?= htmlspecialchars($ciudad) ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</div>



<form action="index.php" method="get">
    <div style="display: flex; justify-content: center;">
        <a href="index.php?c=Post&a=crear&pais=<?= urlencode($paisNombre) ?>" class="btn-principal">
            Crear nuevo post
        </a>
    </div>
    <br><br>
    <h4>Filtrar por tipo de post</h4>
    <input type="hidden" name="c" value="pais">
    <input type="hidden" name="a" value="ver">
    <input type="hidden" name="pais" value="<?= htmlspecialchars($paisNombre) ?>">
    <input type="hidden" name="lat" value="<?= htmlspecialchars($lat) ?>">
    <input type="hidden" name="lon" value="<?= htmlspecialchars($lon) ?>">

    <div style="display: flex; justify-content: center;">
        <select name="type" onchange="this.form.submit()" class="select-filtro" style="max-width: 350px; text-align: center;">
            <option value="" disabled selected>Selecciona un tipo</option>
            <option value="">Todos los tipos</option>
            <option value="monumento">Monumento histórico</option>
            <option value="museo">Museo</option>
            <option value="playa">Playa</option>
            <option value="montaña">Montaña / Sendero</option>
            <option value="parque">Parque o espacio natural</option>
            <option value="zona_comercial">Zona comercial / Mercado</option>
            <option value="restaurante">Restaurante</option>
            <option value="mirador">Mirador</option>
            <option value="barrio_popular">Barrio pintoresco</option>
            <option value="otro">Otro</option>
        </select>
    </div>
</form>



<div class="map-container">
    <div id="map"></div>
</div>



<br><br>

<script>
    let lat = <?= $lat; ?>;
    let lon = <?= $lon; ?>;

    let map = L.map('map', {
        minZoom: 5,
        maxZoom: 17,
        maxBounds: [[-85, -180], [85, 180]]
    }).setView([lat, lon], <?= $zoom; ?>);

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