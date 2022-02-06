<?php

error_reporting(-1);
ini_set('display_errors', 'On');

include($_SERVER['DOCUMENT_ROOT'] . "/define_Global.php");
include($_SERVER['DOCUMENT_ROOT'] . "/rmxLineFunction.php");

function getDataFromUrl($CompanyUrl)
{
    $objData = new stdClass;

    $menu = '';
    if (isset($_POST['menu']))
        $menu = $_POST['menu'];
    if (isset($_GET['menu']))
        $menu = $_GET['menu'];

    $LineId = '';
    if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
        $LineId = $_GET['LineId'];

    if ($menu == "register") {
        $CmdCommand = "call sp_main_check_register ('" + $LineId + "','" + $CompanyUrl + "')";
    } else {
        $CmdCommand = '';
    }


    $objData->menu = $menu;
    $objData->LineId = $LineId;
    $objData->CompanyUrl = $CompanyUrl;
    $objData->CmdCommand = $CmdCommand;

    return $objData;
}

function getDataFromDatabase($objParam) //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
{
    $objData = new stdClass;
    $CmdCommand = $objParam->CmdCommand;
    $CompanyUrl =  $objParam->CompanyUrl;
    $RetCommand = send_command(
        $CompanyUrl,
        '',
        '',
        $CmdCommand
    );

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
        $objData->RetCommand = $RetCommand;
        $objData->sFlag = $sFlag;
    } else {
        $objData->sFlag = '0';
    }
    return $objData;
}

function registerDataToDatabase($objParam)
{
    $objData = new stdClass;
    $LineId = $objParam->LineId;
    $CmdCommand = $objParam->CmdCommand;
    $RegisterUrl = $GLOBALS['REGISTER_URL'];
    $CompanyCode = $GLOBALS['COMPANY_CODE'];

    $ASRet = [];
    $ASRet = explode("^c", $CmdCommand);
    $LineDisplay = $ASRet[0];
    $UserName = $ASRet[1];
    $Tel = $ASRet[2];
    $EMail = $ASRet[3];

    $RetCommand = register_command(
        $RegisterUrl,
        $LineId,
        $CompanyCode,
        $LineDisplay,
        $UserName,
        $Tel,
        $EMail
    );

    if ($RetCommand) {
        $ASRet = [];
        $ASRet = explode("^c", $RetCommand);
        if (count($ASRet) >= 5) {

            $sFlagMsg = $ASRet[0];
            $sFlag = $ASRet[1];
            $UserName = $ASRet[2];
            $Tel = $ASRet[3];
            $EMail = $ASRet[4];
            $SoldToCode = $ASRet[5];
            $SoldToName = $ASRet[6];

            $sShowMsg = '1';
            if ($sFlag == '4') {
                $sFlag = '5';
                $sFlagMsg = "Register Complete";
            }
        }
        $objData->RetCommand = $RetCommand;
        $objData->sFlag = $sFlag;
    } else {
        $objData->sFlag = '0';
    }
    return $objData;
}
