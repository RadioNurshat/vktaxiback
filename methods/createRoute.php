<?php


class createRoute extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $driver = $this->data['vk_user_id'];
        $dep_city = $this->data['dep_city'];
        $dest_city = $this->data['dest_city'];
        $dep_time = $this->data['dep_time'];
        $passengers = $this->data['passengers'];
        $vehicle = $this->data['vehicle'];
        $desc = $this->data['desc'];
        if (get_user($driver)){
            if (get_driver($driver)){
                create_route($dep_city,$dest_city,$dep_time,$passengers,$driver,$vehicle,$desc);
                return new TheSuccess('Route created');
            }else{
                return new TheError(205);
            }
        }else{
            return new TheError(200);
        }
    }
    public const CallableName = 'createRoute';
    public const RequireVerification = true;
    public static $ParamsList = array(
        'vk_user_id' => 'integer',
        'dep_city' => 'integer',
        'dest_city' => 'integer',
        'dep_time' => 'DateTime',
        'passengers' => 'Json',
        'vehicle' => 'integer',
        'desc' => 'string'
);
}