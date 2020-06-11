<?php


class getDriver extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $driver = get_driver($this->data['vk_user_id']);
        if ($driver){
            if ($driver['confirmed'] == 1){
                return new TheSuccess($driver);
            }else{
                return new TheError(207);
            }
        }else{
            return new TheError(205);
        }
    }
    public const CallableName = 'getDriver';
    public const RequireVerification = true;
    public static $ParamsList = array(
        'vk_user_id' => 'integer'
    );
}