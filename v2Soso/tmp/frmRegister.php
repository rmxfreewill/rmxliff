<?php
/*    include_once("index.html"); */



session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

// error_reporting(E_ALL & ~E_NOTICE);

include_once("rmxLineFunction.php");
include_once("rmxLiffFunction.php");

$CompanyUrl = COMPANY_URL;
$RegisterUrl = REGISTER_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;

/*
  if (isset($_POST['CompanyCode']))
      $CompanyCode = $_POST['CompanyCode'];
  if (isset($_GET['CompanyCode']))
      $CompanyCode = $_GET['CompanyCode'];
  */

$LinkCode = '';
if (isset($_POST['LinkCode']))
    $LinkCode = $_POST['LinkCode'];
if (isset($_GET['LinkCode']))
    $LinkCode = $_GET['LinkCode'];

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

$RetCommand = '';
$Ret = '';

$UserName = '';
$EMail = '';
$Tel = '';
$SoldToCode = '';
$SoldToName = '';
$sFlagMsg = '';
$sFlag = '0';
$sTitle = 'Register';
$sShowMsg = '';


if ($LinkCode == 'REGISTER') {

    // sCmd = sLineDisplay+"^c"+sUserName+"^c"+sTel+"^c"+sEMail;
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
    }
} else if ($LinkCode == 'CHECK') {

    $RetCommand = send_command($CompanyUrl, '', '', $CmdCommand);
    if ($RetCommand) {
        //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
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
            if ($sFlag != '0') $sTitle = 'View Register Info';
        }
    }
    /*
    } else  {        

        $RetCommand =send_command($CompanyUrl,'','',$CmdCommand);        
        if ($RetCommand) {
            //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
            $ASRet = [];
            $ASRet = explode("^c", $RetCommand);        
            if (count($ASRet) >=2) {
                $sFlagMsg=$ASRet[0];
                $sFlag=$ASRet[1];     
               
            }
        }

        $Ret =put_request($CompanyUrl,$LineId,$CompanyCode,$LinkCode,$CmdCommand);
        */
}


rmxChangeMemberRichMenu('REGISTER', $LineId);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="en-th">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache">


    <title><?php echo $sTitle; ?></title>

    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php 
if ($LinkCode == 'REGISTER'){
?>

    <form class="animate" method="GET" enctype="multipart/form-data">
        <div class="login_container">
            <?php if ($sFlag == '0' || $sFlag == '') { ?>
                <!-- <label for="uname"><b>Line Id</b></label>
                <input type="text" id="txtLineId" readonly> -->
                <label for="psw"><b>EMail</b></label>
                <input type="email" id="txtEMail" name="txtEMail" placeholder="Enter EMail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="40" required>
                <label for="psw"><b>Mobile</b></label>
                <input type="tel" placeholder="Enter Mobile" name="txtTel" id="txtTel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" maxlength="10" required>
                <button type="button" name="btnLogin" id="btnLogin" onclick="registerClick()">
                    REGISTER
                </button>
            <?php } else { ?>
                <button type="button" name="btnLogin" id="btnLogin" onclick="closeClick()">
                    CLOSE
                </button>
                <!-- <label for="uname"><b>Line Id</b></label> -->
                <!-- <input type="text" id="txtLineId" readonly>

                <label for="uname"><b>Line Display Name</b></label>
                <input type="text" id="txtLineDisplay" readonly>

                <label for="uname"><b>Username</b></label>
                <input type="text" value="<?php //echo $UserName; 
                                            ?>" id="txtUserName" readonly>

                <label for="psw"><b>EMail</b></label>
                <input type="text" id="txtEMail" value="<?php //echo $EMail; 
                                                        ?>" readonly>

                <label for="psw"><b>Telephone / Mobile</b></label>
                <input type="text" id="txtTel" value="<?php // echo $Tel; 
                                                        ?>" readonly>

                <label for="psw"><b>SoldTo Code</b></label>
                <input type="text" id="txtSoldToCode" value="<?php //echo $SoldToCode; 
                                                                ?>" readonly>

                <label for="psw"><b>SoldTo Name</b></label>
                <input type="text" id="txtSoldToName" value="<?php //echo $SoldToName; 
                                                                ?>" readonly> -->

                <!-- <button type="button" id="btnLogin" onclick="OkClick('red')">OK</button> -->
            <?php }  ?>
        </div>
        <input type="hidden" id="txtLineId" value="<?php echo $LineId; ?>">
        <input type="hidden" id="txtDisplay" value="<?php echo $LineDisplay; ?>">

        <input type="hidden" id="txtFlag" value="<?php echo $sFlag; ?>">
        <input type="hidden" id="txtCompanyCode" value="<?php echo $CompanyCode; ?>">
        <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">
        <input type="hidden" id="txtMsg" value="<?php echo $sFlagMsg; ?>">
        <input type="hidden" id="txtShowMsg" value="<?php echo $sShowMsg; ?>">

        <input type="hidden" id="txtsURL" value="<?php echo $sURL; ?>">

    </form>


    <script>
        function registerClick() {

            // var sLineId = document.getElementById('lblUserId').textContent;

            var sLineId = document.getElementById('txtLineId').value;
            var sLineDisplay = document.getElementById('txtDisplay').value;

            var sCompanyCode = document.getElementById('txtCompanyCode').value;
            var sUserName = 'rmxadmin';
            var sEMail = document.getElementById('txtEMail').value;
            var sTel = document.getElementById('txtTel').value;

            /*
            var sCmd = "call sp_main_line_reqister ('" + sLineId 
                + "','"+ sCompanyCode+"','"+sUserName
                + "','"+ sLineDisplay+"','"+sTel
                + "','"+ sEMail +"')";  
            */

            if (sTel == '') {
                alert("Input Telephone / Mobile");
            } else if (sEMail == '') {
                alert("Input Email");
            } else {
                if (sTel.length < 8) {
                    alert("Telephone / Mobile must be at least 8 digits long");
                } else {
                    var sCmd = sLineDisplay + "^c" + sUserName + "^c" + sTel + "^c" + sEMail;
                    var para = "?LinkCode=REGISTER&LineId=" + sLineId + "&CmdCommand=" + sCmd;
                    var surl = document.getElementById('txtsURL').value;
                    url = surl + "frmRegister.php" + para;
                    window.location.assign(url);
                }
            }


        }

        function closeClick() {
            var myLiffId = document.getElementById('txtLiffId').value;
            if (liff.getOS() != "web") {
                liff.closeWindow();
            } else {
                // var elementRegisterForm = document.getElementById('registerForm');
                // var elementSuccessMsg = document.getElementById('successMsg');
                // elementRegisterForm.style.display = "none";
                // elementSuccessMsg.removeAttribute("hidden");
            }
        }
        window.onload = function() {



            function initializeApp() {
                //displayLiffData();

                if (liff.isLoggedIn()) {

                    liff.getProfile().then(profile => {
                            const userName = profile.displayName;
                            const userId = profile.userId;

                            if (document.getElementById('txtLineDisplay'))
                                document.getElementById('txtLineDisplay').value = userName;

                            if (document.getElementById('txtLineId'))
                                document.getElementById('txtLineId').value = userId;

                            if (document.getElementById('lblUserId')) {
                                document.getElementById('lblUserId').textContent = userId;
                                document.getElementById('lblUserName').textContent = userName;
                                document.getElementById('txtDisplay').value = userName;
                            }


                            if (document.getElementById('txtShowMsg')) {
                                var sShow = document.getElementById('txtShowMsg').value;
                                if (sShow == "1") {
                                    var sMsg = document.getElementById('txtMsg').value;
                                    if (sMsg.length > 0) alert(sMsg);
                                }

                                /*
                                 if (sFlag=="ENDREGISTER"){
                                     liff.sendMessages([
                                         {
                                         type: 'text',
                                         text: '??Complete Register'
                                         } ])
                                     .then(() => {liff.closeWindow(); }) 
                                     .catch((err) => {
                                         console.log('error', err);
                                         alert(err);
                                     });
                                 }
                                 */
                            }


                        })
                        .catch((err) => {
                            console.log('error', err);
                        });

                }
                //liff.getProfile().userId;

            }


            function displayLiffData() {

                if (document.getElementById('browserLanguage')) {
                    document.getElementById('browserLanguage').textContent = liff.getLanguage();
                    document.getElementById('sdkVersion').textContent = liff.getVersion();
                    document.getElementById('lineVersion').textContent = liff.getLineVersion();
                    document.getElementById('deviceOS').textContent = liff.getOS();
                }
            }


            function toggleAccessToken() {
                toggleElement('accessTokenData');
            }


            function toggleProfileData() {
                toggleElement('profileInfo');
            }


            function toggleElement(elementId) {
                const elem = document.getElementById(elementId);
                if (elem.offsetWidth > 0 && elem.offsetHeight > 0) {
                    elem.style.display = 'none';
                } else {
                    elem.style.display = 'block';
                }
            }




            function OkClick(msg) {
                liff.closeWindow();
            }





        }
    </script>
<?php }?>
</body>

</html>