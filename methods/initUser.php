<?php


class initUser extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        global $db;
        $input = $this->data;
        $user_id = $input['vk_user_id'];
        $name = $input['name'];
        $surname = $input['surname'];
        $result = $db->query('SELECT * FROM `user` WHERE `user_id` = ?i',$user_id);
        $data = $result->fetch_assoc();
         $user = get_user($user_id);

        if (!$user) {
            $date = new DateTime('now');
            $date->setTimezone(new DateTimeZone('UTC'));
            $creation_time = $date->format('Y-m-d H:i:s.u T');
            $insert = $db->query("INSERT INTO `user` (`user_id`,`name`,`surname`,`creation_time`,`status`) VALUES (?i,'?s','?s','?s')", $user_id, $name, $surname, $creation_time);
            return new TheSuccess(array(
                "user_status" => "partial"
            ));

        }
        $user = get_user($user_id);
        return new TheSuccess(array(
            "user_status" => $user["status"]
        ));
    }


    public const CallableName = 'initUser';
    public const RequireVerification = true;
    public static $ParamsList = array(
        "vk_user_id" => 'integer',
        "name" => 'HumanName',
        'surname'=> 'HumanName'
    );

}