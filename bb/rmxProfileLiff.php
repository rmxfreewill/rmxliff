<?php

// include("define_Global.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


function rmxGetProfileLiff($menu, $LineId)
{
    // $rmx_api_url = RMX_HEROKU_API_URL;
    $rmx_api_url = RMX_SERVER_API_URL;
    $param_menu = "?menu=$menu&lineid=$LineId";

    // if ($mobileNo != '') {
    //     $param_mobileno = "&mobile=$mobileNo";
    // } else {
    //     $param_mobileno = '';
    // }

    $url = $rmx_api_url  . $param_menu;
    $headers = ["Authorization: Bearer " . BEARER_TOKEN];

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return  $data;
    } catch (Exception $ex) {
        print('Error rmxProfileLiff: ' . $ex);
    }
}
