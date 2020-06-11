<?php
function get_cities(){
    global $db;
    $q = $db->query("SELECT * FROM `city`");
    $cities = $q->fetch_assoc_array();
    if ($cities){
        return $cities;
    }else{
        return false;
    }
}
function get_city(int $city_id){
    $cities = get_cities();
    foreach ($cities as $city){
        if ($city["city_id"] == $city_id){
            return $city;
        }
    }
    return false;
}
