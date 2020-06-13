<?php


class deleteRoute extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $driver = $this->data['vk_user_id'];
        $route_id = $this->data['route_id'];
        if (get_user($driver)){
            if (get_driver($driver)){
                $route =  get_route($route_id);
                if ($route){
                    if ($route['driver'] == $driver){
                        delete_route($route_id);
                        return new TheSuccess(null,'route deleted');
                    }else{
                        return new TheError(210);
                    }
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
        'vk_user_id' => 'integer',
        'route_id' => 'integer'
    );
    public const CallableName = 'deleteRoute';
    public const RequireVerification = true;
}