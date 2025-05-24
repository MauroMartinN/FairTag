<?php

    /**
     * Obtiene el nombre del país a partir de coordenadas geográficas (latitud y longitud).
     * 
     * Esta función hace una petición HTTP a la API de Nominatim (OpenStreetMap) para
     * obtener datos geográficos a partir de coordenadas.
     */
    function fetchCountryFromCoordinates(String $lat, String $lon) {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lon}&zoom=5&addressdetails=1";
    
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: MyApp/1.0\r\nAccept-Language: en"
            ]
        ];

        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
    
        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['address']['country'])) {
                return $data['address']['country'];
            }
        }
    
        return false;
    }

    /**
     * Obtiene las coordenadas (latitud y longitud) a partir del nombre de una ciudad.
     * 
     * Esta función hace una petición HTTP a la API de Nominatim (OpenStreetMap) para
     * obtener datos geográficos a partir del nombre de una ciudad.
     */
    function fetchCoordinatesFromCity(String $city) {
        $cityEncoded = urlencode($city);
        $url = "https://nominatim.openstreetmap.org/search?format=json&q={$cityEncoded}&limit=1";

        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: MyApp/1.0\r\nAccept-Language: en"
            ]
        ];

        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);

        if ($response) {
            $data = json_decode($response, true);
            if (isset($data[0]['lat']) && isset($data[0]['lon'])) {
                return [
                    'lat' => $data[0]['lat'],
                    'lon' => $data[0]['lon']
                ];
            }
        }

        return false;
    }
