<?php

error_reporting(-1);
ini_set('display_errors', 'On');

// include($_SERVER['DOCUMENT_ROOT'] . "/define_Global.php");
include($_SERVER['DOCUMENT_ROOT'] . "/rmxLineFunction.php");

function getDataFromUrl($CompanyCode, $RegisterUrl)
{
    $objData = new stdClass;

    $menu = '';
    if (isset($_POST['menu']))
        $menu = $_POST['menu'];
    if (isset($_GET['menu']))
        $menu = $_GET['menu'];

    $status = '';
    if (isset($_POST['status']))
        $status = $_POST['status'];
    if (isset($_GET['status']))
        $status = $_GET['status'];

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

    $LineDisplay = '';
    $UserName = '';
    $sSoldToCode = '';
    $sSoldToName = '';
    $Tel = '';
    $EMail = '';

    if ($menu == "register") {
        if ($status == 'check') {
        } else {
            $CmdCommand = "call sp_main_check_register ('" . $LineId . "','" . $CompanyCode . "')";
        }
    }


    $objData->menu = $menu;
    $objData->status = $status;
    $objData->LineId = $LineId;
    $objData->CompanyCode = $CompanyCode;
    $objData->RegisterUrl = $RegisterUrl;
    $objData->CmdCommand = $CmdCommand;



    return $objData;
}

function getDataFromDatabase($CompanyUrl, $objParam) //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
{
    $objData = new stdClass;
    $CmdCommand = $objParam->CmdCommand;
    $LineId = $objParam->LineId;
    $CompanyCode = $objParam->CompanyCode;
    $RetCommand = send_command(
        $CompanyUrl,
        $LineId,
        $CompanyCode,
        $CmdCommand
    );

    try {
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
    } catch (\Throwable $th) {
        $objData->sFlag = '0';
    }

    return $objData;
}

function registerDataToDatabase($objParam)
{
    $objData = new stdClass;

    $RegisterUrl = $objParam->RegisterUrl;
    $LineId = $objParam->LineId;
    $CompanyCode =  $objParam->CompanyCode;
    $CmdCommand = $objParam->CmdCommand;

    $ASRet = [];
    $ASRet = explode("^c", $CmdCommand);
    $LineDisplay = $ASRet[0];
    $UserName = $ASRet[1];
    $Tel = $ASRet[2];
    $EMail = $ASRet[3];

    // sp_comp_reqister_user ('Uc1dd5c7730988280c6c7731980655f7a','00001','rmxadmin','111','111','111','111','111','111');

    // `sp_comp_reqister_user`(
    //     IN $sLineId VARCHAR(50) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sCompanyCode VARCHAR(50) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sUserName VARCHAR(300) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sSoldToCode VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sSoldToName VARCHAR(300) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sShipToCode VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sShipToName VARCHAR(300) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sMobileNo VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    //     ,IN $sEMail VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci




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
