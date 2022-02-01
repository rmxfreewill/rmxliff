<?php

include_once("define_rmxLineApi.php");

include_once("rmxProfileApi.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$GLOBALS['obj'] = new stdClass();

function mySQLconnect()
{
    $conn = mysqli_connect("127.0.0.1", "root", "freewill@kernel1168/86-88", "rmxmain", 3306);
    return $conn;
}

function rmxApiGetSoldToCode($lineId)
{
    $conn = mySQLconnect();
    if ($conn) {
        $sql = "SELECT sSoldToCode FROM rmx01.M_User WHERE  rmx01.M_User.sLineId='$lineId'";
    }
}

function rmxApiGetTicketDetails($soldToCode)
{
    //SELECT * FROM rmx01.T_LineTicket INNER JOIN rmxmain.M_User ON rmx01.T_LineTicket.sSoldToCode = rmxmain.M_User.sSoldToCode WHERE rmx01.T_LineTicket.sSoldToCode = 'CT-ST-0099-50' group by rmx01.T_LineTicket.sTicketNo;
    //
    $conn = mySQLconnect();
    if ($conn) {

        $sql = "SELECT * FROM rmx01.T_LineTicket INNER JOIN rmxmain.M_User ON rmx01.T_LineTicket.sSoldToCode = rmxmain.M_User.sSoldToCode WHERE rmx01.T_LineTicket.sSoldToCode = '$soldToCode' group by rmx01.T_LineTicket.sTicketNo";
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
