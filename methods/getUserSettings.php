<?php


class getUserSettings extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $input = $this->data;
        $user_id = $input['vk_user_id'];

        if (!get_user($user_id)){
            return new TheError(200);
        }
        $prefs = get_user_prefs($user_id);
        if ($prefs){
            return new TheSuccess($prefs);
        }else{
            return new TheError(203);
        }
    }
    public static $ParamsList = array(
        "vk_user_id" => 'integer'
    );
    public const CallableName = 'getUserSettings';
    public const RequireVerification = true;
}