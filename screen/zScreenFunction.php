<?php

include($_SERVER['DOCUMENT_ROOT'] . "/rmxLineFunction.php");

function getDataFromRoute()
{
    $objData = new stdClass;

    $LinkCode = '';
    if (isset($_POST['LinkCode']))
        $LinkCode = $_POST['LinkCode'];
    if (isset($_GET['LinkCode']))
        $LinkCode = $_GET['LinkCode'];

    $route = '';
    if (isset($_POST['route']))
        $route = $_POST['route'];
    if (isset($_GET['route']))
        $route = $_GET['route'];

    $LineId = '';
    if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
        $LineId = $_GET['LineId'];

    $CmdCommand = '';
    if (isset($_POST['CmdCommand']))
        $CmdCommand = $_POST['CmdCommand'];
    if (isset($_GET['CmdCommand']))
        $CmdCommand = $_GET['CmdCommand'];

    $objData->LinkCode = $LinkCode;
    $objData->route = $route;
    $objData->LineId = $LineId;
    $objData->CmdCommand = $CmdCommand;

    return $objData;
}

function getDataFromDatabase($CompanyUrl, $CmdCommand)
{
    //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
    $SoldToCode = '';
    $RetCommand = send_command($CompanyUrl, '', '', $CmdCommand);
    echo $RetCommand;
    if ($RetCommand) {
        $ASRet = [];
        $ASRet = explode("^c", $RetCommand);
        if (count($ASRet) >= 2) {
            $sFlagMsg = $ASRet[0];
            $sFlag = $ASRet[1];

            $UserName = $ASRet[2];
            $EMail = $ASRet[3];
            $Tel = $ASRet[4];
            $SoldToCode = $ASRet[5];
            $SoldToName = $ASRet[6];

            $sShowMsg = '0';
            if ($sFlag != '0') {
                $sTitle = 'View Register Info';
                // $sFlagChangeMenu = true;
            }
        }
    }

    return $SoldToCode;
}
