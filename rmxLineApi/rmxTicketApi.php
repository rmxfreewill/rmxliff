<?php


include_once("rmxProfileApi.php");


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$GLOBALS['obj'] = new stdClass();

function rmxApiGetTicketDetails($lineId)
{
    $soldToCode = rmxApiGetSoldToCode($lineId);
    $sql = "SELECT * FROM rmx01.T_LineTicket INNER JOIN rmxmain.M_User ON rmx01.T_LineTicket.sSoldToCode = rmxmain.M_User.sSoldToCode WHERE rmx01.T_LineTicket.sSoldToCode = '$soldToCode' AND rmx01.T_LineTicket.nLineNoti = 0  GROUP BY rmx01.T_LineTicket.sTicketNo ORDER BY rmx01.T_LineTicket.sTicketNo DESC";
    $result = mySQLconnect($sql);
    if ($result) {
        $numRow = mysqli_num_rows($result);
        if ($numRow) {
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                echo "ID: ".$row[0];
                echo "NAME: ".$row[1];  
            }
        }
    }
    mysqli_free_result($result);
}
