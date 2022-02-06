<?php

//Line Api
function rmxChangeMemberRichMenuDefualt($type, $LINEID)
{
    $url = "https://api.line.me/v2/bot/user/$LINEID/richmenu";
    $method = 'DELETE';
    $data = array();
    $headers = [
        "Authorization: Bearer " . BEARER_TOKEN
    ];

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        // curl_setopt($ch, $CURLOPT, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $data
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); # receive server response
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); # do not verify SSL
        $data = curl_exec($ch); # execute curl
        $httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); # http response status code
        curl_close($ch);

        $data = "{}";
    } catch (Exception $ex) {
        $data = $ex;
    }
}

function rmxChangeMemberRichMenu($type, $LINEID)
{
    if ($type == 'LOGOUT') {
        $url = "https://api.line.me/v2/bot/user/$LINEID/richmenu";
        $method = 'DELETE';
    } else if ($type == 'REGISTER') {
        $CURLOPT = CURLOPT_POST;
        $RICHMENUID = RICHMENU_ID;
        $url = "https://api.line.me/v2/bot/user/$LINEID/richmenu/$RICHMENUID";
        $method = "POST";
    }
    $data = array();
    $headers = [
        "Authorization: Bearer " . BEARER_TOKEN
    ];
    try {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        // curl_setopt($ch, $CURLOPT, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $data
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); # receive server response
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); # do not verify SSL
        $data = curl_exec($ch); # execute curl
        $httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); # http response status code
        curl_close($ch);

        $data = "{}";
    } catch (Exception $ex) {
        $data = $ex;
    }
}

function rmxGetDataLiff($menu, $LineId)
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

function getDataFromRoute()
{
    $objData = new stdClass;

    // $LinkCode = '';
    // if (isset($_POST['LinkCode']))
    //     $LinkCode = $_POST['LinkCode'];
    // if (isset($_GET['LinkCode']))
    //     $LinkCode = $_GET['LinkCode'];

    // $route = '';
    // if (isset($_POST['route']))
    //     $route = $_POST['route'];
    // if (isset($_GET['route']))
    //     $route = $_GET['route'];

    $menu = '';
    if (isset($_POST['menu']))
        $menu = $_POST['menu'];
    if (isset($_GET['menu']))
        $menu = $_GET['menu'];

    $LineId = '';
    if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
        $LineId = $_GET['LineId'];

    $CmdCommand = '';
    if (isset($_POST['CmdCommand']))
        $CmdCommand = $_POST['CmdCommand'];
    if (isset($_GET['CmdCommand']))
        $CmdCommand = $_GET['CmdCommand'];

    // $objData->LinkCode = $LinkCode;
    // $objData->route = $route;
    $objData->menu = $menu;
    $objData->LineId = $LineId;
    $objData->CmdCommand = $CmdCommand;

    return $objData;
}
