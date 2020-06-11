<?php


class createDriver extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $driver_id = $this->data['driver_id'];
        $phone = $this->data['phone'];


        if (!get_driver($driver_id)){
            if (get_user($driver_id)){
                create_driver($driver_id,$phone);
            }else{
                return new TheError(200);
            }
        }else{
            return new TheError(206);
        }
    }
    public static $ParamsList = array(
        'driver_id' => 'integer',
        'phone'=>'string'
    );
    public const CallableName = 'createDriver';
    public const RequireVerification = true;
}