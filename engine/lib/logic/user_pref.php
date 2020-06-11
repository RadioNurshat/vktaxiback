<?php
function get_user_prefs(int $user_id){
    global $db;
    $q = $db->query("SELECT * FROM `user_settings` WHERE `user_id` = ?i",$user_id);
    $prefs = $q->fetch_assoc();
    if ($prefs){
        return $prefs;
    }else{
        return false;
    }
}
function get_user_pref(int $user_id,string $preference){
    $prefs = get_user_prefs($user_id);
    if (!$prefs){
        return false;
    }
    foreach ($prefs as $pref){
        if ($pref["setting_name"] == $preference){
            return array(
                "setting_name" => $pref["setting_name"],
                "setting_value" => $pref["setting_value"]
            );
        }
    }
    return false;
 }
 function set_user_pref(int $user_id,string $pref_name,string $pref_value){
    global $db;
    if (get_user_pref($user_id,$pref_name)){
        $q = $db->query("UPDATE `user_settings` SET `setting_name` = '?s', `setting_value = '?s'` WHERE `user_id` = ?i",$pref_name,$pref_value,$user_id);
    }else{
         $q = $db->query("INSERT INTO `user_settings` (`user_id`,`setting_name`,`setting_value`) VALUES (?i,'?s','?s')",$user_id,$pref_name,$pref_value);
     }
 }