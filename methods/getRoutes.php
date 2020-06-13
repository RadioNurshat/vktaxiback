<?php


class getRoutes extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        global $db;
        if (isset($this->data['order']) && $this->data['order'] == 'desc'){
            $routes = get_active_routes_desc();
        }else{
            $routes = get_active_routes_asc();
        }
        if ($routes){
            return new TheSuccess($routes);
        }else{
            return new TheError(210);
        }
    }
    public static $ParamsList = array();
    public const CallableName = 'getRoutes';
    public const RequireVerification = false;
}