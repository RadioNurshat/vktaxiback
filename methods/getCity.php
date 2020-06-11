<?php


class getCity extends Method implements IMethod
{

    public function Execute(): IReturnable
    {
        $city_id = $this->data["city_id"];
        $city = get_city($city_id);
        if ($city){
            return new TheSuccess($city);
        }else{
            return new TheError(204);
        }

    }
    public const CallableName = 'getCity';
    public const RequireVerification = true;
    public static $ParamsList = array(
        "city_id" => "integer"
    );
}