<?php

include(dirname(__FILE__) . "../../define_Global.php");

function rmxGetProfileLiff($LineId)
{
    $url = RMX_API_URL;
    $param = "?menu=profile&lineid=$LineId";

    $headers = [
        "Authorization: Bearer " . BEARER_TOKEN
    ];

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            array()
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);

        echo $data;
    } catch (Exception $ex) {

        print($ex);
    }
}

rmxGetProfileLiff($LineId);
