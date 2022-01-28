<?php

include_once("../rmxApi/define_Api_Global.php");

//Line Api
function rmxChangeMemberRichMenuDefualt($LINEID)
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

function getProfile()
{
    $conn = mysqli_connect(HEROKU_HOST, HEROKU_USER, HEROKU_PASS, HEROKU_DB, PORT);

    $sql = "SELECT * FROM m_user";
    $result = $conn->query($sql);

    if ($conn) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        printf( $row["sName"]);
    } else {
        echo "What";
    }
}

function rmxhi()
{
    echo "RMX Hi";
}
