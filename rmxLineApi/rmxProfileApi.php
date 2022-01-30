<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$GLOBALS['obj'] = new stdClass();

function rmxApiGetProfile($LineId)
{
    //
    // $conn = mysqli_connect(HEROKU_HOST, HEROKU_USER, HEROKU_PASS, HEROKU_DB, PORT);
    $conn = mysqli_connect("127.0.0.1","root", "freewill@kernel1168/86-88", "rmxmain", 3306);
    //

    if ($conn) {
        // if ($mobileNo != '') {
        //     $sql_mobile = " OR sMobileNo = '$mobileNo'";
        // } else {
        //     $sql_mobile = '';
        // }

        $sql = "SELECT * FROM m_user WHERE sLineId = '$LineId'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row) {
            $GLOBALS['obj']->name = $row["sName"];
            $GLOBALS['obj']->surname = $row["sSurName"];
            $GLOBALS['obj']->mobile = $row["sMobileNo"];
            echo json_encode($GLOBALS['obj']);
        }
    }
}
