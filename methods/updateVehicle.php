<?php


class updateVehicle extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $vehicle_id = $this->data['vehicle_id'];
        $name = $this->data['name'];
        $color = $this->data['color'];
        $owner_id = $this->data['vk_user_id'];
        $trunk = $this->data['trunk'];
        $seats = $this->data['seats'];

        $vehicle = get_vehicle($vehicle_id);
        if ($vehicle && $vehicle['owner_id'] == $owner_id){
            if (update_vehicle($vehicle_id,$name,$color,$trunk,$seats)){
                return new TheSuccess('Vehicle data updated');
            }else{
                return new TheError(208);
            }
        }else{
            return new TheError(209);
        }
    }
    public const CallableName = 'updateVehicle';
    public const RequireVerification = true;
    public static $ParamsList = array(
        'vehicle_id' => 'integer',
        'name' => 'string',
        'color' => 'string',
        'vk_user_id' => 'integer',
        'trunk' => 'integer',
        'seats'=>'integer'
    );
}