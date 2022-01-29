<?php

include("../../define_Global.php");

function rmxGetProfileLiff($LineId)
{
    $url = RMX_API_URL;
    $data = "menu=profile&lineid=$LineId";
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $content = curl_exec($ch);

        echo $content;

        curl_close($ch);
    } catch (Exception $ex) {

        print($ex);
    }
}
