<?php

class Costes {
    private int $id;
    private string $city;
    private int $country;

    private float $meal_inexpensive_restaurant;
    private float $meal_for_2_midrange;
    private float $mcmeal_at_mcdonalds;
    private float $beer_domestic_restaurant;
    private float $beer_imported_restaurant;
    private float $cappuccino_restaurant;
    private float $coke_pepsi;
    private float $water_restaurant;

    private float $milk_1l;
    private float $bread_500g;
    private float $rice_1kg;
    private float $eggs_12;
    private float $cheese_1kg;
    private float $chicken_1kg;
    private float $beef_1kg;
    private float $apples_1kg;
    private float $bananas_1kg;
    private float $oranges_1kg;
    private float $tomato_1kg;
    private float $potato_1kg;
    private float $onion_1kg;
    private float $lettuce_head;
    private float $water_1_5l_market;
    private float $wine_midrange_market;
    private float $beer_domestic_market;
    private float $beer_imported_market;
    private float $cigarettes_20;

    private float $transport_oneway;
    private float $transport_monthly;
    private float $taxi_start;
    private float $taxi_1km;
    private float $taxi_1h_wait;

    private float $gasoline_1l;
    private float $car_vw_golf;
    private float $car_toyota_corolla;

    private float $utilities_85m2;
    private float $mobile_tariff_1min;
    private float $internet_60mbps;

    private float $fitness_monthly;
    private float $tennis_hour_weekend;
    private float $cinema_ticket;

    private float $jeans_levis;
    private float $summer_dress_chain;
    private float $nike_shoes;
    private float $leather_shoes;

    private float $apartment_1br_center;
    private float $apartment_1br_outside;
    private float $apartment_3br_center;
    private float $apartment_3br_outside;
    private float $price_m2_center;
    private float $price_m2_outside;

    private float $avg_salary_monthly;


    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        trigger_error("Propiedad '$name' no existe en " . __CLASS__, E_USER_NOTICE);
        return null;
    }

    public function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            trigger_error("Propiedad '$name' no existe en " . __CLASS__, E_USER_NOTICE);
        }
    }

}
