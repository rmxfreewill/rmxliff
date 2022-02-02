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
    $data = [];
    $soldToCode = rmxApiGetSoldToCode($lineId);
    $sql = "SELECT sTicketNo,sProductCode,dTicketDate,sCompanyName,sSoldToName,sShipToPerson,sShipToMobile,sShipToName,dLoadDate,dLoadTime,dLeaveDate,
    dLeaveTime,dDeliveryDate,dDeliveryTime,sTruckNo,sDriverName,nOrderQty,sPlantCode,sProductName,sSlump,
    sStrength,sSpecialInstruction FROM rmx01.T_LineTicket INNER JOIN rmxmain.M_User ON rmx01.T_LineTicket.sSoldToCode = rmxmain.M_User.sSoldToCode WHERE rmx01.T_LineTicket.sSoldToCode = '$soldToCode' AND rmx01.T_LineTicket.nLineNoti = 0  GROUP BY rmx01.T_LineTicket.sTicketNo ORDER BY rmx01.T_LineTicket.sTicketNo DESC";
    $result = mySQLconnect($sql);
    if ($result) {
        $numRow = mysqli_num_rows($result);
        if ($numRow) {
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                $GLOBALS['obj']->sTicketNo = $row[0];
                $GLOBALS['obj']->sProductCode = $row[1];
                $GLOBALS['obj']->dTicketDate = $row[2];
                $GLOBALS['obj']->sCompanyName = $row[3];
                $GLOBALS['obj']->sSoldToName = $row[4];
                $GLOBALS['obj']->sShipToPerson = $row[5];
                $GLOBALS['obj']->sShipToMobile = $row[6];
                $GLOBALS['obj']->sShipToName = $row[7];
                $GLOBALS['obj']->dLoadDate = $row[8];
                $GLOBALS['obj']->dLoadTime = $row[9];
                $GLOBALS['obj']->dLeaveDate = $row[10];
                $GLOBALS['obj']->dLeaveTime = $row[11];
                $GLOBALS['obj']->dDeliveryDate = $row[12];
                $GLOBALS['obj']->dDeliveryTime = $row[13];
                $GLOBALS['obj']->sTruckNo = $row[14];
                $GLOBALS['obj']->sDriverName = $row[15];
                $GLOBALS['obj']->nOrderQty = $row[16];
                $GLOBALS['obj']->sPlantCode = $row[17];
                $GLOBALS['obj']->sProductName = $row[18];
                $GLOBALS['obj']->sSlump = $row[19];
                $GLOBALS['obj']->sStrength = $row[20];
                $GLOBALS['obj']->sSpecialInstruction = $row[21];
                array_push($data, $GLOBALS['obj']);
            }
        }
        mysqli_free_result($result);
        echo json_encode($data);
    }
}
