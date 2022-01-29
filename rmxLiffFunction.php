<?php

include_once("define_Api_Global.php");

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

function abc()
{
    $url = 'http://localhost:81/Api/RestfulApi.php';
    $data = "fn=login&test=1";
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $content = curl_exec($ch);
        curl_close($ch);
    } catch (Exception $ex) {

        echo $ex;
    }
}

function getProfile($LineId)
{
    //
    // $conn = mysqli_connect(HEROKU_HOST, HEROKU_USER, HEROKU_PASS, HEROKU_DB, PORT);
    //
    $conn = mysqli_connect(HOST, USER, PASS, DB, PORT);
    if ($conn) {
        $sql = "SELECT * FROM m_user WHERE sLineId = '$LineId'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (count($row) > 0) {
            echo "<b>USER PROFILE</b>";
            echo "<p>";
            echo "<b>Name:</b>";
            echo "<br>";
            echo $row["sName"] . ' ' . $row["sSurName"];
            echo "<p>";
            echo "<b>Mobile No.</b>";
            echo "<br>";
            echo $row["sMobileNo"];
        }
    } else {
        echo "What";
    }
}

function rmxhi()
{
    echo "RMX Hi";
}
