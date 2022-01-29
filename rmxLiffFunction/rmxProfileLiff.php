<?php

include(dirname(__FILE__) . "../../define_Global.php");

function rmxGetProfileLiff($LineId)
{
    $url = RMX_API_URL;
    $param = "?menu=profile&lineid=$LineId";

    $token = BEARER_TOKEN;
    $authorization = "Authorization: Bearer $token";

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.$param);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));
        $content = curl_exec($ch);

        echo $content;

        curl_close($ch);
    } catch (Exception $ex) {

        print($ex);
    }
}
