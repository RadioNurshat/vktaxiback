<?php
function get_active_routes_desc(){
    global $db;
    $q = $db->query("SELECT *, `driver`.`driver_id`,`driver`.`ad_ratio` FROM `route` INNER JOIN `driver` ON `route`.`driver` = `driver`.`driver_id` WHERE `route`.`active` = 1 ORDER BY UNIX_TIMESTAMP(`route`.`departure_time`) DESC, `driver`.`ad_ratio` DESC");
    $routes = $q->fetch_assoc_array();
    if ($routes){
       return $routes;
    }else{
        return false;
    }
}
function get_active_routes_asc(){
    global $db;
    $q = $db->query("SELECT *, `driver`.`driver_id`,`driver`.`ad_ratio` FROM `route` INNER JOIN `driver` ON `route`.`driver` = `driver`.`driver_id` WHERE `route`.`active` = 1 ORDER BY UNIX_TIMESTAMP(`route`.`departure_time`) ASC, `driver`.`ad_ratio` DESC");
    $routes = $q->fetch_assoc_array();
    if ($routes){
        return $routes;
    }else{
        return false;
    }
}
function get_routes_by_driver(int $driver){
    global $db;
    $q = $db->query("SELECT * FROM `route` WHERE `driver` = ?i",$driver);
    $routes = $q->fetch_assoc_array();
    if ($routes){
        return $routes;
    }else{
        return false;
    }
}
function get_routes_by_depdest_desc(int $dep, int $dest){
    global $db;
    $q = $db->query("SELECT *, `driver`.`driver_id`,`driver`.`ad_ratio` FROM `route` INNER JOIN `driver` ON `route`.`driver` = `driver`.`driver_id` WHERE `route`.`active` = 1 AND `route`.`departure_city` = ?i AND `route`.`destination_city` = ?i  ORDER BY UNIX_TIMESTAMP(`route`.`departure_time`) DESC, `driver`.`ad_ratio` DESC",$dep,$dest);
    $routes = $q->fetch_assoc_array();
    if ($routes){
        return $routes;
    }else{
        return false;
    }
}
function get_routes_by_depdest_asc(int $dep, int $dest){
    global $db;
    $q = $db->query("SELECT *, `driver`.`driver_id`,`driver`.`ad_ratio` FROM `route` INNER JOIN `driver` ON `route`.`driver` = `driver`.`driver_id` WHERE `route`.`active` = 1 AND `route`.`departure_city` = ?i AND `route`.`destination_city` = ?i  ORDER BY UNIX_TIMESTAMP(`route`.`departure_time`) ASC, `driver`.`ad_ratio` DESC",$dep,$dest);
    $routes = $q->fetch_assoc_array();
    if ($routes){
        return $routes;
    }else{
        return false;
    }
}
function toggle_route(int $route_id){
    global $db;
    $route = get_route($route_id);
    if ($route){
        $active = $route['active'];
        if ($active == 1){
            $new = 0;
        }else{
            $new = 1;
        }
        $q = $db->query("UPDATE `route` SET `active` = ?i WHERE `route_id` = ?i",$new,$route_id);
        return $new;
    }else{
        return false;
    }
}


function create_route(int $dep_city, int $dest_city, string $dep_time, string $passengers, int $driver, int $vehicle, string $desc){
    global $db;
    $q = $db->query("INSERT INTO `route` (`departure_city`, `destination_city`, `departure_time`, `passengers`, `driver`, `vehicle`, `description`) VALUES ( ?i, ?i, '?s', '?s', ?i, ?i, '?s')",$dep_city,$dest_city,$dep_time,$passengers,$driver,$vehicle,$desc);
}
function get_route($route_id){
    global $db;
    $q = $db->query("SELECT * FROM `route` WHERE `route_id` = ?i ",$route_id);
    $route = $q->fetch_assoc();
    if ($route){
        return $route;
    }else{
        return false;
    }
}
function update_route(int $route_id, int $dep_city, int $dest_city, string $dep_time, string $passengers, int $driver, int $vehicle, string $desc){
    global $db;
    $q = $db->query("UPDATE `route` SET `departure_city` = ?i, `destination_city` = ?i, `departure_time` = '?s', `passengers` = '?s', `driver` = ?i, `vehicle` = ?i, `description` = '?s' WHERE `route_id` = ?i",$dep_city,$dest_city,$dep_time,$passengers,$driver,$vehicle,$desc,$route_id);
    if ($result == null){
        return false;
    }else{
        return $result;
    }
}
function delete_route(int $route_id){
    global $db;
    $q = $db->query("DELETE FROM `route` WHERE `route_id` = ?i",$route_id);
    if ($q == null){
        return false;
    }else{
        return true;
    }
}