<?php


class createVehicle extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $name = $this->data['name'];
        $color = $this->data['color'];
        $owner_id = $this->data['vk_user_id'];
        $trunk = $this->data['trunk'];
        $seats = $this->data['seats'];
        if (!get_driver($owner_id)){
            return new TheError(205);
        }
        create_vehicle($name,$color,$owner_id,$trunk,$seats);
        return new TheSuccess(null,'vehicle created successfully');
    }
    public const CallableName = 'createVehicle';
    public const RequireVerification = true;
    public static $ParamsList = array(
        'name' => 'string',
        'color' => 'string',
        'vk_user_id' => 'integer',
        'trunk' => 'integer',
        'seats'=>'integer'
    );
}