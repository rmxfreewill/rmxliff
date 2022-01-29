<?php

include("define_rmxApi.php");

header('Access-Control-Allow-Origin: *');

$GLOBALS['obj'] = new stdClass();

function rmxGetProfile($LineId)
{
    //
    $conn = mysqli_connect(HEROKU_HOST, HEROKU_USER, HEROKU_PASS, HEROKU_DB, PORT);
    //
    // $conn = mysqli_connect(HOST, USER, PASS, DB, PORT);
    if ($conn) {
        $sql = "SELECT * FROM m_user WHERE sLineId = '$LineId'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (count($row) > 0) {


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

function rmxProfileHi()
{
    echo 'rmxProfile';
}
