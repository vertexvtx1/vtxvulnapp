<?php

namespace Laramin\Utility;

use App\Lib\CurlRequest;

class Onumoti{

    public static function getData(){
        $param['purchasecode'] = env("PURCHASECODE");
        $param['website'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'] . ' - ' . env("APP_URL");
        $reqRoute = VugiChugi::lcLabRoute();
        $reqRoute = $reqRoute. systemDetails()['name'];
        $response = CurlRequest::curlPostContent($reqRoute, $param);
        $response = json_decode($response);
        
        $push = [];
        if (@$response->version && (@systemDetails()['version'] < @$response->version)) {
            $push['version'] = @$response->version ?? '';
            $push['details'] = @$response->details ?? '';
        }
        if (@$response->message) {
            $push['message'] = @$response->message ?? [];
        }
        $general = gs();
        $general->system_info = $push;
        $general->save();
    }

    public static function mySite($site,$className){
        $myClass = VugiChugi::clsNm();
        if($myClass != $className){
            return $site->middleware(VugiChugi::mdNm());
        }
    }
}
