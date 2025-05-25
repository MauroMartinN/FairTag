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

    public function toArray() {
        return [
            'id' => $this->id,
            'city' => $this->city,
            'country' => $this->country,
            'meal_inexpensive_restaurant' => $this->meal_inexpensive_restaurant,
            'meal_for_2_midrange' => $this->meal_for_2_midrange,
            'mcmeal_at_mcdonalds' => $this->mcmeal_at_mcdonalds,
            'beer_domestic_restaurant' => $this->beer_domestic_restaurant,
            'beer_imported_restaurant' => $this->beer_imported_restaurant,
            'cappuccino_restaurant' => $this->cappuccino_restaurant,
            'coke_pepsi' => $this->coke_pepsi,
            'water_restaurant' => $this->water_restaurant,
            'milk_1l' => $this->milk_1l,
            'bread_500g' => $this->bread_500g,
            'rice_1kg' => $this->rice_1kg,
            'eggs_12' => $this->eggs_12,
            'cheese_1kg' => $this->cheese_1kg,
            'chicken_1kg' => $this->chicken_1kg,
            'beef_1kg' => $this->beef_1kg,
            'apples_1kg' => $this->apples_1kg,
            'bananas_1kg' => $this->bananas_1kg,
            'oranges_1kg' => $this->oranges_1kg,
            'tomato_1kg' => $this->tomato_1kg,
            'potato_1kg' => $this->potato_1kg,
            'onion_1kg' => $this->onion_1kg,
            'lettuce_head' => $this->lettuce_head,
            'water_1_5l_market' => $this->water_1_5l_market,
            'wine_midrange_market' => $this->wine_midrange_market,
            'beer_domestic_market' => $this->beer_domestic_market,
            'beer_imported_market' => $this->beer_imported_market,
            'cigarettes_20' => $this->cigarettes_20,
            'transport_oneway' => $this->transport_oneway,
            'transport_monthly' => $this->transport_monthly,
            'taxi_start' => $this->taxi_start,
            'taxi_1km' => $this->taxi_1km,
            'taxi_1h_wait' => $this->taxi_1h_wait,
            'gasoline_1l' => $this->gasoline_1l,
            'car_vw_golf' => $this->car_vw_golf,
            'car_toyota_corolla' => $this->car_toyota_corolla,
            'utilities_85m2' => $this->utilities_85m2,
            'mobile_tariff_1min' => $this->mobile_tariff_1min,
            'internet_60mbps' => $this->internet_60mbps,
            'fitness_monthly' => $this->fitness_monthly,
            'tennis_hour_weekend' => $this->tennis_hour_weekend,
            'cinema_ticket' => $this->cinema_ticket,
            'jeans_levis' => $this->jeans_levis,
            'summer_dress_chain' => $this->summer_dress_chain,
            'nike_shoes' => $this->nike_shoes,
            'leather_shoes' => $this->leather_shoes,
            'apartment_1br_center' => $this->apartment_1br_center,
            'apartment_1br_outside' => $this->apartment_1br_outside,
            'apartment_3br_center' => $this->apartment_3br_center,
            'apartment_3br_outside' => $this->apartment_3br_outside,
            'price_m2_center' => $this->price_m2_center,
            'price_m2_outside' => $this->price_m2_outside,
            'avg_salary_monthly' => $this->avg_salary_monthly
            
        ];
    }

}
