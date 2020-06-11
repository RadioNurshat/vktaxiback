<?php


class getCities extends Method implements IMethod
{
    public const CallableName = 'getCities';
    public const RequireVerification = false;
    public function Execute(): IReturnable
    {
        $cities = get_cities();
        if($cities){
            return new TheSuccess($cities);
        }else{
            return new TheError(204);
        }
    }
}