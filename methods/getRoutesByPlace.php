<?php


class getRoutesByPlace extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $dep = $this->data['dep'];
        $dest = $this->data['dest'];
        if(get_city($dep)){
            if (get_city($dest)){
                if ($this->data['order']=='desc'){
                    $routes = get_routes_by_depdest_desc($dep,$dest);
                }else{
                    $routes = get_routes_by_depdest_asc($dep,$dest);
                }
                if ($routes){
                    return new TheSuccess($routes);
                }else{
                    return new TheError(210);
                }


            }else{
                return new TheError(212,'City with code '.$dest.' does not exist');
            }
        }else{
            return new TheError(212,'City with code '.$dep.' does not exist');
        }
    }
    public const CallableName = 'getRoutesByPlace';
    public const RequireVerification = true;
    public static $ParamsList = array(
        'dep' => 'integer',
        'dest' => 'integer'
    );
}