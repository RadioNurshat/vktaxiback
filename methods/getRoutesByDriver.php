<?php


class getRoutesByDriver extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        global $db;
        $driver_id = $this->data['driver_id'];
        if(get_user($driver_id)){
            if(get_driver($driver_id)){
                $routes = get_routes_by_driver($driver_id);
                if ($routes){
                    return new TheSuccess($routes);
                }else{
                    return new TheError(210);
                }
            }else{
                return new TheError(205);
            }
        }else{
            return new TheError(200);
        }

    }
    public static $ParamsList = array(
        "driver_id" => "integer"
    );
    public const CallableName = 'getRoutesByDriver';
    public const RequireVerification = true;
}