<?php


class getUserSetting extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $input = $this->data;
        $user_id = $input['vk_user_id'];
        $setting_name = $input['setting_name'];
        if (!get_user($user_id)){
            return new TheError(200);
        }
        $pref = get_user_pref($user_id,$setting_name);
        if ($pref){
            return new TheSuccess($pref);
        }else{
            return new TheError(203);
        }
    }
    public static $ParamsList = array(
        "vk_user_id" => 'integer',
        'setting_name' => 'string'
    );
    public const CallableName = 'getUserSetting';
    public const RequireVerification = true;
}