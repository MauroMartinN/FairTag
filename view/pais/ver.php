<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<style>

</style>


<h1 class="base"><?= $paisNombre ?></h1>


<div class="container my-4" id="cost-container">
    <h2 id="ciudad-pais" class="mb-4 text-success base"></h2>
    <div class="row"></div>
</div>


<div class="container my-4" style="display: <?= isset($costes) ? 'none' : 'block' ?>;" id="city-container">
    <h2 class="mb-4 base">Ciudades en <?= htmlspecialchars($pais->getName()) ?></h2>
    <div class="row"></div>
</div>



<script>
    let paisNombre = <?= json_encode($paisNombre) ?>;


    if (<?= isset($costes) ? 'true' : 'false' ?>) {
        let costes = <?= isset($costes) ? json_encode($costes->toArray()) : "null" ?>;


        function crearSeccion(titulo, idUnico) {
            const col = document.createElement('div');
            col.className = 'col-md-4 mb-4';

            const ul = document.createElement('ul');
            ul.className = 'list-group';

            const header = document.createElement('li');
            header.className = 'list-group-item green-active clickable-header';
            header.textContent = titulo;

            const itemsContainer = document.createElement('div');
            itemsContainer.className = 'toggle-content';
            itemsContainer.id = `section-${idUnico}`;

            header.addEventListener('click', () => {
                let secciones = document.querySelectorAll('.toggle-content');
                let parentsContainer = document.querySelectorAll('.list-group');

                secciones.forEach(el => {
                    el.classList.remove('show');
                });
                parentsContainer.forEach(parent => {
                    parent.classList.remove('principal');
                });

                itemsContainer.classList.toggle('show');
                parentsContainer = itemsContainer.parentElement;
                parentsContainer.classList.toggle('principal');

                let parentRow = col.parentElement;
                parentRow.prepend(col);

            });

            ul.appendChild(header);
            ul.appendChild(itemsContainer);
            col.appendChild(ul);

            return { col, itemsContainer };
        }

        function agregarItem(etiqueta, valor) {
            let li = document.createElement('li');
            li.className = 'list-group-item';
            <?php if (isset($rate)): ?>
                li.innerHTML = `<strong>${etiqueta}:</strong> <br> - ${parseFloat(valor).toFixed(2)}€ <br> - Moneda local: ${(parseFloat(valor) * <?= $rate ?>).toFixed(2)} <?= $coin ?>`;
            <?php else: ?>
                li.innerHTML = `<strong>${etiqueta}:</strong> ${parseFloat(valor).toFixed(2)}€`;
            <?php endif; ?>
            return li;
        }
        let etiquetas = {
            meal_inexpensive_restaurant: "Comida económica (restaurante)",
            meal_for_2_midrange: "Comida para 2 personas (restaurante de precio medio)",
            mcmeal_at_mcdonalds: "Menú McDonald's",
            beer_domestic_restaurant: "Cerveza nacional (restaurante)",
            beer_imported_restaurant: "Cerveza importada (restaurante)",
            cappuccino_restaurant: "Cappuccino (restaurante)",
            coke_pepsi: "Coca-Cola / Pepsi (restaurante)",
            water_restaurant: "Agua (restaurante)",
            milk_1l: "Leche (1 litro)",
            bread_500g: "Pan (500g)",
            rice_1kg: "Arroz (1kg)",
            eggs_12: "Huevos (12 unidades)",
            cheese_1kg: "Queso local (1kg)",
            chicken_1kg: "Pechuga de pollo (1kg)",
            beef_1kg: "Carne de ternera (1kg)",
            apples_1kg: "Manzanas (1kg)",
            bananas_1kg: "Plátanos (1kg)",
            oranges_1kg: "Naranjas (1kg)",
            tomato_1kg: "Tomates (1kg)",
            potato_1kg: "Patatas (1kg)",
            onion_1kg: "Cebollas (1kg)",
            lettuce_head: "Lechuga (una pieza)",
            water_1_5l_market: "Agua (1.5L, supermercado)",
            wine_midrange_market: "Vino (gama media, supermercado)",
            beer_domestic_market: "Cerveza nacional (supermercado)",
            beer_imported_market: "Cerveza importada (supermercado)",
            cigarettes_20: "Cigarrillos (20 unidades)",

            transport_oneway: "Billete de ida (transporte público)",
            transport_monthly: "Abono mensual (transporte público)",
            taxi_start: "Tarifa inicial taxi",
            taxi_1km: "Tarifa taxi (1 km)",
            taxi_1h_wait: "Espera taxi (1 hora)",
            gasoline_1l: "Gasolina (1 litro)",
            car_vw_golf: "Coche nuevo (Volkswagen Golf)",
            car_toyota_corolla: "Coche nuevo (Toyota Corolla)",

            utilities_85m2: "Servicios básicos para un piso de 85m² (electricidad, agua, etc.)",
            mobile_tariff_1min: "Tarifa móvil (por minuto, prepago)",
            internet_60mbps: "Internet (60 Mbps o más, ilimitado)",

            fitness_monthly: "Gimnasio (mensual)",
            tennis_hour_weekend: "Pista de tenis (1h en fin de semana)",
            cinema_ticket: "Entrada de cine",

            jeans_levis: "Vaqueros (Levis o similar)",
            summer_dress_chain: "Vestido de verano (cadena tipo Zara)",
            nike_shoes: "Zapatillas deportivas (Nike u otra marca)",
            leather_shoes: "Zapatos de cuero",

            apartment_1br_center: "Piso 1 dormitorio (centro)",
            apartment_1br_outside: "Piso 1 dormitorio (afueras)",
            apartment_3br_center: "Piso 3 dormitorios (centro)",
            apartment_3br_outside: "Piso 3 dormitorios (afueras)",
            price_m2_center: "Precio por m² (centro)",
            price_m2_outside: "Precio por m² (afueras)",

            avg_salary_monthly: "Sueldo medio mensual neto"
        };



        let secciones = {
            "Comida (restaurantes)": [
                "meal_inexpensive_restaurant",
                "meal_for_2_midrange",
                "mcmeal_at_mcdonalds",
                "beer_domestic_restaurant",
                "beer_imported_restaurant",
                "cappuccino_restaurant",
                "coke_pepsi",
                "water_restaurant"
            ],
            "Comida (supermercado)": [
                "milk_1l",
                "bread_500g",
                "rice_1kg",
                "eggs_12",
                "cheese_1kg",
                "chicken_1kg",
                "beef_1kg",
                "apples_1kg",
                "bananas_1kg",
                "oranges_1kg",
                "tomato_1kg",
                "potato_1kg",
                "onion_1kg",
                "lettuce_head",
                "water_1_5l_market",
                "wine_midrange_market",
                "beer_domestic_market",
                "beer_imported_market",
                "cigarettes_20"
            ],
            "Transporte": [
                "transport_oneway",
                "transport_monthly",
                "taxi_start",
                "taxi_1km",
                "taxi_1h_wait",
                "gasoline_1l",
                "car_vw_golf",
                "car_toyota_corolla"
            ],
            "Servicios": [
                "utilities_85m2",
                "mobile_tariff_1min",
                "internet_60mbps"
            ],
            "Ocio y deporte": [
                "fitness_monthly",
                "tennis_hour_weekend",
                "cinema_ticket"
            ],
            "Ropa y calzado": [
                "jeans_levis",
                "summer_dress_chain",
                "nike_shoes",
                "leather_shoes"
            ],
            "Vivienda": [
                "apartment_1br_center",
                "apartment_1br_outside",
                "apartment_3br_center",
                "apartment_3br_outside",
                "price_m2_center",
                "price_m2_outside"
            ],
            "Otros": [
                "avg_salary_monthly"
            ]
        };

        document.getElementById("ciudad-pais").textContent = `${costes.city}, ${paisNombre}`;

        const row = document.querySelector('#cost-container .row');

        let seccionId = 0;

        for (const [titulo, claves] of Object.entries(secciones)) {
            const { col, itemsContainer } = crearSeccion(titulo, seccionId++);
            claves.forEach(clave => {
                if (costes[clave] != null) {
                    itemsContainer.appendChild(agregarItem(etiquetas[clave], costes[clave]));
                }
            });
            row.appendChild(col);
        }

    } else {
        let cityContainer = document.getElementById('city-container');
        cityContainer.display = 'block';
        let cityContainerRow = document.querySelector('#city-container .row');
        let ciudades = <?= isset($ciudades) ? json_encode($ciudades) : "null" ?>;
        ciudades.forEach(ciudad => {
            let cityDiv = document.createElement('div');
            cityDiv.className = 'col-md-4 mb-3';
            cityDiv.innerHTML = `
               <a href="index.php?c=pais&a=ver&pais=<?= urlencode($paisNombre) ?>&city=${encodeURIComponent(ciudad)}" class="text-decoration-none">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <h5 class="panel-title" style="margin:0;">${ciudad}</h5>
                        </div>
                    </div>
                </a>
            `;
            cityContainerRow.appendChild(cityDiv);
        });

    }
</script>






<form action="index.php" method="get" class="form-container">
    <div style="display: flex; justify-content: center;">
        <a href="index.php?c=Post&a=crear&pais=<?= urlencode($paisNombre) ?>" class="btn-principal">
            Crear nuevo post
        </a>
    </div>
    <br><br>
    <h4 class="base">Filtrar por tipo de post</h4>
    <input type="hidden" name="c" value="pais">
    <input type="hidden" name="a" value="ver">
    <input type="hidden" name="pais" value="<?= htmlspecialchars($paisNombre) ?>">
    <input type="hidden" name="lat" value="<?= htmlspecialchars($lat) ?>">
    <input type="hidden" name="lon" value="<?= htmlspecialchars($lon) ?>">

    <div style="display: flex; justify-content: center;">
        <select name="type" onchange="this.form.submit()" class="select-filtro"
            style="max-width: 350px; text-align: center;">
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
            let ulElement = document.querySelector('ul.leaflet-draw-actions.leaflet-draw-actions-top.leaflet-draw-actions-bottom');
            let firstLi = ulElement ? ulElement.querySelector('li:first-child') : null;
            if (firstLi) {
                let link = firstLi.querySelector('a');
                if (link) {
                    link.click();
                    console.log('Modo borrar desactivado');
                }
            }
        }, 1);
    });
</script>