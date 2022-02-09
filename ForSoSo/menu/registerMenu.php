<?php

error_reporting(-1);
ini_set('display_errors', 'On');

include("zMenuFunction.php");
include("zApiFunction.php");

$GLOBALS['COMPANY_URL'] =  COMPANY_URL;
$GLOBALS['REGISTER_URL'] =   REGISTER_URL;
$GLOBALS['COMPANY_CODE'] =   COMPANY_CODE;
$GLOBALS['LIFF_ID'] =   LIFF_ID;
$GLOBALS['sURL'] =   sURL;

$sFlag = '0';
$regisType = false;

function regisForm($type)
{
    $arr[0] = '';
    $arr[1] = '';
    if ($type == true) {
        $regisForm = '
        <div class="mb-3">
        <label for="psw"><b>Email: </b></label>' . $arr[0] . '
        <p><label for="psw"><b>Mobile: </b></label>' . $arr[1] . '
        <p><button type="button"  name="btnLogin" id="btnLogin" onclick="closeClick()">
            CLOSE
        </button>
        </div>
        ';
    } else {
        $regisForm = '
        <div class="mb-3">
        <label for="psw" class="form-label form-label-lg"><b>Email</b></label>
        <input type="email" class="form-control form-control-lg"
            id="txtEMail" 
            name="txtEMail"
            placeholder="Enter EMail"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
            maxlength="40"
        required>
        </div>
        <div class="mb-3">
        <label for="psw" class="form-label form-label-lg"><b>Mobile</b></label>
        <input type="tel" class="form-control form-control-lg"
            placeholder="Enter Mobile" 
            name="txtTel" id="txtTel" 
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" 
            maxlength="10"
        required>
        </div>
        <div class="mb-3">
        <button class="btn btn-success btn-lg rmxRegister pt-3 pb-3" type="button"  
            name="btnLogin" 
            id="btnLogin" 
            onclick="registerCheck()"
        >
        REGISTER
        </button>
        </div>
        ';
    }
    return $regisForm;
}



function register($RegisterUrl, $objParam)
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

            $ShipToCode = $ASRet[12];
            $ShipToName = $ASRet[13];


            $sShowMsg = '1';
            if ($sFlag == '4') {
                $sFlag = '5';
                $sFlagMsg = "Register Complete";
                // echo '<script language="javascript">';
                // echo 'alert("' . $sFlagMsg . '")';
                // echo '</script>';
            }
        }
        $objData->sFlag = $sFlag;
    } else {
        $objData->sFlag = '0';
    }

    $objData->RetCommand = $RetCommand;
    $objData->sFlag = $sFlag;

    return $objData;
}

$getDataFromUrl = getDataFromUrl($GLOBALS['COMPANY_CODE'], $GLOBALS['COMPANY_URL'], $GLOBALS['REGISTER_URL']);
$status = $getDataFromUrl->status;
if ($status == 'check') {
    // registerDataToDatabase($getDataFromUrl);
    // $getData = getDataFromDatabase($GLOBALS['REGISTER_URL'], $getDataFromUrl);
    $getData = register($GLOBALS['REGISTER_URL'], $getDataFromUrl);
    $sFlag = $getData->sFlag;
} else if ($status == 'init') {
    $getData = getDataFromDatabase($GLOBALS['COMPANY_URL'], $getDataFromUrl);
    $sFlag = $getData->sFlag;
}

if ($sFlag == '4') {
    $LINEID = $getDataFromUrl->LineId;
    rmxChangeMemberRichMenu('Member', $LINEID);
}


?>
<!DOCTYPE HTML>
<html>

<body>
    <div class="col-12 mb-3 mt-3">
        <h3>Register</h3>
    </div>
    <div class="col-12 mb-3">
        <?php
        echo regisForm($regisType);
        ?>
    </div>
    <script>
        var urlS = new URL(document.URL);
        // alert('urlS: ' + urlS);

        function registerCheck() {
            var sUserName = 'rmxadmin';
            var sLineDisplay = 'rmxadmin';
            //
            var sCompanyCode = "<?php echo $GLOBALS['COMPANY_CODE']; ?>";
            var sEMail = document.getElementById('txtEMail').value;
            //
            var sTel = document.getElementById('txtTel').value;
            if (sTel == '') {
                alert("Input Telephone / Mobile");
            } else if (sEMail == '') {
                alert("Input Email");
            } else {
                if (sTel.length < 8) {
                    alert("Telephone / Mobile must be at least 8 digits long");
                } else {
                    var toMenu = 'register';
                    var toStatus = 'check';
                    var sUrl = "<? echo sURL; ?>";
                    var userIdProfile = "<? echo  $getDataFromUrl->LineId; ?>";
                    var sCmd = sLineDisplay + "^c" + sUserName + "^c" + sTel + "^c" + sEMail;
                    var urlSelectMenu = rmxSelectMenu(sUrl, toMenu, userIdProfile, sCmd, toStatus);
                    var param = urlSelectMenu.paramS;
                    var menuUrl = "menu/registerMenu.php" + param;
                    // alert(menuUrl);
                    $("#rmxLiFFLayout").load(menuUrl);
                }
            }
        }

        var sFlag = "<?php echo $sFlag; ?>";
        if (sFlag == 4) {
            rmxCloseWindow();
        }
    </script>
</body>

</html>