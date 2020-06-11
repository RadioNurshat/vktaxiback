<?php
function get_driver(int $user_id){
    global $db;
    $q = $db->query("SELECT * FROM `driver` WHERE `driver_id` = ?i",$user_id);
    $driver = $q->fetch_assoc();
    if ($driver){
        return $driver;
    }else{
        return false;
    }
}
function create_driver(int $user_id,string $phone){
    global $db;
    $q = $db->query("INSERT INTO `driver` SET `driver_id` = ?i,`phone`='?s'",$user_id,$phone);
}
