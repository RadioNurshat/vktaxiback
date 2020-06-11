<?php
    function get_vehicles(int $owner_id){
        global $db;
        $q = $db->query("SELECT * FROM `vehicle` WHERE `owner_id` = ?i",$owner_id);
        $vehicles = $q->fetch_assoc_array();
        if ($vehicles){
            return $vehicles;
        }else{
            return false;
        }
    }
    function get_vehicle($vehicle_id){
        global $db;
        $q = $db->query("SELECT * FROM `vehicle` WHERE `vehicle_id` = ?i",$vehicle_id);
        $vehicle = $q->fetch_assoc();
        if ($vehicle){
            return $vehicle;
        }else{
            return false;
        }
    }
    function create_vehicle(string $name, string $color, int $owner_id, int $trunk, int $seats){
        global $db;
        $q = $db->query("INSERT INTO `vehicle` SET `name` = '?s',`color` = '?s', `owner_id` = '?i', `trunk` = '?i', `seats` = '?i'",$name,$color,$owner_id,$trunk,$seats);
        return true;
    }
    function update_vehicle(int $vehicle_id, string $name, string $color, int $trunk, int $seats){
        global $db;
        $vehicle = get_vehicle($vehicle_id);
        if ($vehicle){
            $q = $db->query("UPDATE `vehicle` SET `name` = '?s',`color` = '?s',`trunk` = '?i', `seats` = '?i' WHERE `vehicle_id` = ?i",$name,$color,$trunk,$seats,$vehicle_id);
        }else{
        return false;
        }
    }
    function delete_vehicle(int $vehicle_id){
        global $db;
        $vehicle = get_vehicle($vehicle_id);
        if($vehicle){
            $q = $db->query("DELETE FROM `vehicle` WHERE `vehicle_id` = ?i",$vehicle_id);
            return true;
        }else{
            return false;
        }
    }