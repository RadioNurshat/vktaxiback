<?php
include_once './engine/lib/logic/user.php';

class createUser extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        global $db;
        $input = $this->data;
        $user_id = $input['vk_user_id'];
        $name = $input['name'];
        $surname = $input['surname'];
        $city = $input['city'];
        $user = get_user($user_id);
        if ($user){
            return new TheError(200);
        }
        if ($user["status"]=='complete'){
           return new TheError(201);
        }
        if ($user["status"]=='partial'){
            $db->query("UPDATE `user` SET `user_id` = ?i, `name` = '?s',`surname` = '?s',`city`='?s',`status`='?s'",$user_id,$name,$surname,$city,'complete');
            return new TheSuccess(array(
                "user_status"=>"complete"
            ));
        }
        return new TheError(200);
    }
    public static $ParamsList = array(
        "vk_user_id" => 'integer',
        'name' => 'HumanName',
        'surname' => 'HumanName',
        'city' => 'integer'
    );
    public const CallableName = 'createUser';
    public const RequireVerification = true;
}