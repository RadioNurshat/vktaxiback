<?php


class updateRoute extends Method implements IMethod
{
    public static $ParamsList = array(
        'route_id' => 'integer',
        'vk_user_id' => 'integer',
        'dep_city' => 'integer',
        'dest_city' => 'integer',
        'dep_time' => 'DateTime',
        'passengers' => 'Json',
        'vehicle' => 'integer',
        'desc' => 'string'
    );
    public const CallableName = 'updateRoute';
    public const RequireVerification = true;
    public function Execute(): IReturnable
    {
        //int $route_id, int $dep_city, int $dest_city, string $dep_time, string $passengers, int $driver, int $vehicle, string $desc
        $driver = $this->data['vk_user_id'];
        $dep_city = $this->data['dep_city'];
        $dest_city = $this->data['dest_city'];
        $dep_time = $this->data['dep_time'];
        $passengers = $this->data['passengers'];
        $vehicle = $this->data['vehicle'];
        $desc = $this->data['desc'];
        $route_id = $this->data['route_id'];

        if (get_user($driver)){
            if (get_driver($driver)){
                $route =  get_route($route_id);
                if ($route){
                    if ($route['driver'] == $driver){
                        if (update_route($route_id,$dep_city,$dest_city,$dep_time,$passengers,$driver,$vehicle,$desc)){
                            return new TheSuccess(null,'Route updated');
                        }else{
                            return new TheError(210);
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