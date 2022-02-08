<?php

error_reporting(-1);
ini_set('display_errors', 'On');

// include($_SERVER['DOCUMENT_ROOT'] . "/define_Global.php");
include($_SERVER['DOCUMENT_ROOT'] . "/rmxLineFunction.php");

function postWebContent($url, $curl_data)
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects
        CURLOPT_ENCODING       => "",           // handle all encodings
        CURLOPT_USERAGENT      => "kai",     // who am i
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
        CURLOPT_TIMEOUT        => 120,          // timeout on response
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        CURLOPT_POST            => 1,            // i am sending post data
        CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1                //
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch);
    $header  = curl_getinfo($ch);
    curl_close($ch);

    return trim($content);
}

// function sendCommand($CompanyUrl, $userId, $CompanyId, $Command)
// {

//     $curl_data = "LineId=" . $userId . "&CompanyCode=" . $CompanyId . "&Command=" . $Command;
//     $response = post_web_content($CompanyUrl, $curl_data);
//     return $response;
// }

function sendQuery($type, $CompanyUrl, $userId, $CompanyId, $Command)
{
    if ($type = 'Command') {
        $curlCmd = "&Command=" . $Command;
    } else if ($type = 'QueryCommand') {
        $curlCmd = "&QueryCommand=" . $Command;
    }

    $curl_data = "LineId=" . $userId . "&CompanyCode=" . $CompanyId . $curlCmd;
    $response = postWebContent($CompanyUrl, $curl_data);
    return $response;
}

function getDataFromUrl($CompanyCode, $CompanyUrl, $RegisterUrl)
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


    if ($status == 'check') {
    } else {
        $CmdCommand = "call sp_main_check_register ('" . $LineId . "','" . $CompanyCode . "')";
    }



    $objData->menu = $menu;
    $objData->status = $status;
    $objData->LineId = $LineId;
    $objData->CompanyUrl = $CompanyUrl;
    $objData->CompanyCode = $CompanyCode;
    $objData->RegisterUrl = $RegisterUrl;
    $objData->CmdCommand = $CmdCommand;



    return $objData;
}

function getDataFromDatabase($CompanyUrl, $objParam) //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
{
    // echo json_encode('CmdCommand: ' . $objParam);
    $objData = new stdClass;
    $CmdCommand = $objParam->CmdCommand;
    $RetCommand = sendQuery(
        'Command',
        $CompanyUrl,
        '',
        '',
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
        $objData->error = $th;
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

function getTicketFromDatabase($objParam)
{

    /*
    https://rmx.freewillsolutions.com/rmxline/rmxLineCmd.php?
    QueryCommand=call sp_comp_select_ticket('U379c8a7fce077a831d3fbfad3c1e4bda', '01/01/2017', '31/12/2022', '320001839')
    &LineId=U379c8a7fce077a831d3fbfad3c1e4bda
    &CompanyCode=00001
    */

    $objData = new stdClass;
    $RetCommand  = '';
    $LineId = $objParam->LineId;
    $CompanyUrl =  $objParam->CompanyUrl;
    $CompanyCode =  $objParam->CompanyCode;
    $CmdCommand = $objParam->CmdCommand;
    $RetCommand = sendQuery('Command', $CompanyUrl, '', '', $CmdCommand);
    if ($RetCommand) {
        $ASRet = [];
        $ASRet = explode("^c", $RetCommand);
        if (count($ASRet) >= 2) {
            $sFlagMsg = $ASRet[0];
            $sFlag = $ASRet[1];
            if ($sFlag != '0') {
                //
                $LineId = 'Ucd102187a2dfb7494ea9d723a5ae4041';
                $sShipToCode = '320000106';

                // $LineId = 'U194d6a8a8d6557a6b1ee0e2f16737d77';
                // $sShipToCode = '320000900';

                $dStartDate = '01/01/2017';
                $dEndDate = '31/12/2022';

                //
                $CmdCommand = "call sp_comp_select_ticket('$LineId','$dStartDate','$dEndDate','$sShipToCode')";
                //    
                $RetCommand = sendQuery('QueryCommand', $CompanyUrl, $LineId, $CompanyCode, $CmdCommand);
            }
        }
    }
    return  $RetCommand;
}

function showTicketList($RetCommand)
{

    if ($RetCommand) {
        $asTable = explode("^t", $RetCommand);
        if (count($asTable) > 0) {
            $arTmp = explode("^f", $asTable[0]);
echo json_encode('arTmp: ' . $arTmp);
            if (count($arTmp) > 1) {
                $asCol = explode("^c", $arTmp[0]);
                $asRow = explode("^r", $arTmp[1]);
                if (count($asRow) > 0) {
                    $nLoop = 0;
                    $nRLen = count($asRow);
                    $nCLen = count($asCol);
                    $sTab = "";
                    $sPage = "";
                    if ($nRLen > 10) $nRLen = 10;
                    
                    for ($n = 0; $n < $nRLen; $n++) {
                        $sRow = $asRow[$n];
                        $asData = explode("^c", $sRow);
                        $nDLen = count($asData);
                        if ($nDLen > 0) {
                            $sTicketNo = $asData[0];
                            $sTab = $sTab . "<a class='tablink' href='#' "
                                . "onclick=\"openPage('div" . $sTicketNo . "_" .
                                "', this, 'red')\">" . $sTicketNo . "</a>";

                            $sPage = $sPage . "<div id='div" . $sTicketNo . "_" .
                                "' class='tabcontent'>";
                            $sPage = $sPage . "<table class='tblticket'>";

                            for ($r = 0; $r < $nDLen; $r++) {
                                $sC = $asCol[$r];
                                $sD = $asData[$r];

                                $sPage = $sPage . "<tr><th>" . $sC
                                    . "</th><td class='textLeft'>" . $sD . "</td></tr>";
                            }
                            $sPage = $sPage . "</table></div>";
                        }
                    }

                    $sTab = "<div class='scrollmenu'>" . $sTab . "</div>";
                    echo $sTab;
                    echo $sPage;
                }
            }
        }
    }
}

function getSearchFromDatabase($objParam)
{
    $objData = new stdClass;
    $RetCommand  = '';
    $LineId = $objParam->LineId;
    $CompanyUrl =  $objParam->CompanyUrl;
    $CompanyCode =  $objParam->CompanyCode;
    $CmdCommand = $objParam->CmdCommand;
    $RetCommand = sendQuery('Command', $CompanyUrl, '', '', $CmdCommand);
    if ($RetCommand) { //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
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
            if ($sFlag != '0') $sTitle = 'Search';
        }
    }
}
