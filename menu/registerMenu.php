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

function regisForm($sFlag)
{
    $arr[0] = '';
    $arr[1] = '';
    if ($sFlag != '0') {
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
        <div class="mb-3" hidden>
        <label for="psw" class="form-label form-label-lg"><b>Email</b></label>
        <input type="email" class="form-control form-control-lg"
            id="txtEMail" 
            name="txtEMail"
            placeholder="Enter EMail"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
            maxlength="40"
            value=""
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

$getDataFromUrl = getDataFromUrl($GLOBALS['COMPANY_CODE'], $GLOBALS['COMPANY_URL'], $GLOBALS['REGISTER_URL']);
$status = $getDataFromUrl->status;
if ($status == 'check') {
    $getData = registerDataToDatabase($GLOBALS['REGISTER_URL'], $getDataFromUrl);
} else {
    $getData = getDataFromDatabase($GLOBALS['COMPANY_URL'], $getDataFromUrl);
}

$sFlag = $getData->sFlag;
if ($sFlag == '4') {
    $LINEID = $getDataFromUrl->LineId;
    rmxChangeMemberRichMenu('Member', $LINEID);
} else if ($sFlag == '0') {
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
        echo regisForm($sFlag);
        ?>
    </div>
    <script>
        function registerCheck() {
            $(".loader").show();
            //
            var sCompanyCode = "<?php echo $GLOBALS['COMPANY_CODE']; ?>";
            var sEMail = document.getElementById('txtEMail').value;
            //
            var sUserName = 'rmxadmin';
            var sLineDisplay = 'rmxadmin';
            sEMail = sEMail != "" ?? 'rmxadmin@rmxadmin.com';
            //
            var sTel = document.getElementById('txtTel').value;
            if (sTel == '') {
                alert("Input Mobile");
                return;
            } else {
                if (sTel.length < 8) {
                    alert("Mobile must be at least 8 digits long");
                    return;
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
                    $(".loader").hide();
                }
            }
        }
        $(function() {
            var sFlag = "<?php echo $sFlag; ?>";
            alert(sFlag);
            if (sFlag == '4') {
                rmxCloseWindow();
            }
        });
    </script>
</body>

</html>