<?php
function get_user(int $user_id){
    global $db;
    $result = $db->query('SELECT * FROM `user` WHERE `user_id` = ?i',$user_id);
    $data = $result->fetch_assoc();
    if (!$data){
        return false;
    }else{
        return $data;
    }
}

