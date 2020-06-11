<?php


class deleteVehicle extends Method implements IMethod
{
    public function Execute(): IReturnable
    {
        $vehicle_id = $this->data['vehicle_id'];
        $owner_id = $this->data['vk_user_id'];

        $vehicle = get_vehicle($vehicle_id);
        if ($vehicle){
            if ($vehicle['owner_id'] == $owner_id){
                if (delete_vehicle($vehicle_id)){
                    return new TheSuccess('Vehicle deleted');
                }else{
                    return new TheError(208);
                }
            }else{
                return new TheError(209);
            }
        }else{
            return new TheError(208);
        }
    }
    public const CallableName = 'deleteVehicle';
    public const RequireVerification = true;
    public static $ParamsList = array(
        'vehicle_id' => 'integer',
        'vk_user_id' => 'integer',
    );
}