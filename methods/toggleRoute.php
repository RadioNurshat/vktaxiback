<?php


class toggleRoute extends Method implements IMethod
{
    public const CallableName = 'toggleRoute';
    public const RequireVerification = true;
    public static $ParamsList = array(
        'vk_user_id'=>'integer',
        'route_id' => 'integer'
    );
    public function Execute(): IReturnable
    {
        $driver = $this->data['vk_user_id'];
        $route_id = $this->data['route_id'];
        if (get_user($driver)){
            if (get_driver($driver)){
                $route =  get_route($route_id);
                if ($route){
                    if ($route['driver'] == $driver){
                        $new = toggle_route($route_id);
                        switch ($new){
                            case 1: return new TheSuccess(array('new_statement'=>1)); break;
                            case 0: return new TheSuccess(array('new_statement'=>0)); break;
                        }

                    }else{
                        return new TheError(211);
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
}