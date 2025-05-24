<?php

require_once 'entidades/costes.php';

class CostesDAO {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM cost_of_living WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return $this->mapearCostes($data);
        }

        return null;
    }

    public function obtenerPorCiudad(string $city) {
        $stmt = $this->pdo->prepare("SELECT * FROM cost_of_living WHERE city = ?");
        $stmt->execute([$city]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return $this->mapearCostes($data);
        }

        return null;
    }

    public function obtenerCiudadesPorCountryId(int $country_id) {
        $stmt = $this->pdo->prepare("SELECT city FROM cost_of_living WHERE country_id = ?");
        $stmt->execute([$country_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cities = [];
        foreach ($data as $row) {
            $cities[] = $row['city'];
        }
        return $cities;
    }

    private function mapearCostes(array $data) {
        $costes = new Costes();

        $costes->id = (int) $data['id'];
        $costes->city = $data['city'];
        $costes->country = $data['country_id'];

        $costes->meal_inexpensive_restaurant = (float) $data['meal_inexpensive_restaurant'];
        $costes->meal_for_2_midrange = (float) $data['meal_for_2_midrange'];
        $costes->mcmeal_at_mcdonalds = (float) $data['mcmeal_at_mcdonalds'];
        $costes->beer_domestic_restaurant = (float) $data['beer_domestic_restaurant'];
        $costes->beer_imported_restaurant = (float) $data['beer_imported_restaurant'];
        $costes->cappuccino_restaurant = (float) $data['cappuccino_restaurant'];
        $costes->coke_pepsi = (float) $data['coke_pepsi'];
        $costes->water_restaurant = (float) $data['water_restaurant'];

        $costes->milk_1l = (float) $data['milk_1l'];
        $costes->bread_500g = (float) $data['bread_500g'];
        $costes->rice_1kg = (float) $data['rice_1kg'];
        $costes->eggs_12 = (float) $data['eggs_12'];
        $costes->cheese_1kg = (float) $data['cheese_1kg'];
        $costes->chicken_1kg = (float) $data['chicken_1kg'];
        $costes->beef_1kg = (float) $data['beef_1kg'];
        $costes->apples_1kg = (float) $data['apples_1kg'];
        $costes->bananas_1kg = (float) $data['bananas_1kg'];
        $costes->oranges_1kg = (float) $data['oranges_1kg'];
        $costes->tomato_1kg = (float) $data['tomato_1kg'];
        $costes->potato_1kg = (float) $data['potato_1kg'];
        $costes->onion_1kg = (float) $data['onion_1kg'];
        $costes->lettuce_head = (float) $data['lettuce_head'];
        $costes->water_1_5l_market = (float) $data['water_1_5l_market'];
        $costes->wine_midrange_market = (float) $data['wine_midrange_market'];
        $costes->beer_domestic_market = (float) $data['beer_domestic_market'];
        $costes->beer_imported_market = (float) $data['beer_imported_market'];
        $costes->cigarettes_20 = (float) $data['cigarettes_20'];

        $costes->transport_oneway = (float) $data['transport_oneway'];
        $costes->transport_monthly = (float) $data['transport_monthly'];
        $costes->taxi_start = (float) $data['taxi_start'];
        $costes->taxi_1km = (float) $data['taxi_1km'];
        $costes->taxi_1h_wait = (float) $data['taxi_1h_wait'];

        $costes->gasoline_1l = (float) $data['gasoline_1l'];
        $costes->car_vw_golf = (float) $data['car_vw_golf'];
        $costes->car_toyota_corolla = (float) $data['car_toyota_corolla'];

        $costes->utilities_85m2 = (float) $data['utilities_85m2'];
        $costes->mobile_tariff_1min = (float) $data['mobile_tariff_1min'];
        $costes->internet_60mbps = (float) $data['internet_60mbps'];

        $costes->fitness_monthly = (float) $data['fitness_monthly'];
        $costes->tennis_hour_weekend = (float) $data['tennis_hour_weekend'];
        $costes->cinema_ticket = (float) $data['cinema_ticket'];

        $costes->jeans_levis = (float) $data['jeans_levis'];
        $costes->summer_dress_chain = (float) $data['summer_dress_chain'];
        $costes->nike_shoes = (float) $data['nike_shoes'];
        $costes->leather_shoes = (float) $data['leather_shoes'];

        $costes->apartment_1br_center = (float) $data['apartment_1br_center'];
        $costes->apartment_1br_outside = (float) $data['apartment_1br_outside'];
        $costes->apartment_3br_center = (float) $data['apartment_3br_center'];
        $costes->apartment_3br_outside = (float) $data['apartment_3br_outside'];
        $costes->price_m2_center = (float) $data['price_m2_center'];
        $costes->price_m2_outside = (float) $data['price_m2_outside'];

        $costes->avg_salary_monthly = (float) $data['avg_salary_monthly'];
        return $costes;
    }
}
