<?php

include("define_rmxApi.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$GLOBALS['obj'] = new stdClass();

function rmxApiGetProfile($LineId)
{
    //
    $conn = mysqli_connect(HEROKU_HOST, HEROKU_USER, HEROKU_PASS, HEROKU_DB, PORT);
    //  $conn = mysqli_connect(HOST, USER, PASS, DB, PORT);
    //
   
    if ($conn) {
        $sql = "SELECT * FROM m_user WHERE sLineId = '$LineId'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row) {


            // echo "<b>USER PROFILE</b>";
            // echo "<p>";
            // echo "<b>Name:</b>";
            // echo "<br>";
            // echo $row["sName"] . ' ' . $row["sSurName"];
            // echo "<p>";
            // echo "<b>Mobile No.</b>";
            // echo "<br>";
            // echo $row["sMobileNo"];

            $GLOBALS['obj']->name = $row["sName"];
            $GLOBALS['obj']->surname = $row["sSurName"];
            $GLOBALS['obj']->mobile = $row["sMobileNo"];
            echo json_encode($GLOBALS['obj']);
        }
    }
}