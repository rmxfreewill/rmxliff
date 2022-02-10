<?php
/*    include_once("index.html"); */

session_start();

error_reporting(E_ALL & ~E_NOTICE);
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
$ShipToCode = '';
$ShipToName = '';
$sFlagMsg = '';
$sFlag = '0';
$sTitle = 'Profile';
$sShowMsg = '';

if ($LinkCode == 'CHECK') {

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

            $ShipToCode = $ASRet[7];
            $ShipToName = $ASRet[8];

            $sShowMsg = '0';
            if ($sFlag != '0') {
                $sTitle = 'PROFILE';
            }
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

    <link rel="stylesheet" href="style.css">

</head>

<body>



    <form class="animate" method="GET" enctype="multipart/form-data">

        <?php if ($sFlag == '0' || $sFlag == '') {
        } else { ?>
            <div class="login_container">

                <label for="uname"><b>Line Id</b></label>
                <input type="text" id="txtLineId" readonly>

                <label for="uname"><b>Line Display Name</b></label>
                <input type="text" id="txtLineDisplay" readonly>

                <label for="uname"><b>Username</b></label>
                <input type="text" value="<?php echo $UserName; ?>" id="txtUserName" readonly>

                <label for="psw"><b>Telephone / Mobile</b></label>
                <input type="text" id="txtTel" value="<?php echo $Tel; ?>" readonly>


                <label for="psw"><b>EMail</b></label>
                <input type="text" id="txtEMail" value="<?php echo $EMail; ?>" readonly>


                <label for="psw"><b>SoldTo Code</b></label>
                <input type="text" id="txtSoldToCode" value="<?php echo $SoldToCode; ?>" readonly>

                <label for="psw"><b>SoldTo Name</b></label>
                <input type="text" id="txtSoldToName" value="<?php echo $SoldToName; ?>" readonly>


                <label for="psw"><b>ShipTo Code</b></label>
                <input type="text" id="txtShipToCode" value="<?php echo $ShipToCode; ?>" readonly>

                <label for="psw"><b>ShipTo Name</b></label>
                <input type="text" id="txtShipToName" value="<?php echo $ShipToName; ?>" readonly>





            </div>


        <?php }  ?>


        <input type="hidden" id="txtFlag" value="<?php echo $sFlag; ?>">
        <input type="hidden" id="txtCompanyCode" value="<?php echo $CompanyCode; ?>">
        <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">
        <input type="hidden" id="txtMsg" value="<?php echo $sFlagMsg; ?>">
        <input type="hidden" id="txtShowMsg" value="<?php echo $sShowMsg; ?>">

        <input type="hidden" id="txtType" value="<?php echo $LinkCode; ?>">


    </form>


    <script>
        window.onload = function() {
            const useNodeJS = false; // if you are not using a node server, set this value to false
            const defaultLiffId = "1656503744-kojgw9pb"; // change the default LIFF value if you are not using a node server

            let myLiffId = "";

            if (useNodeJS) {
                fetch('/send-id')
                    .then(function(reqResponse) {
                        return reqResponse.json();
                    })
                    .then(function(jsonResponse) {
                        myLiffId = jsonResponse.id;
                        initializeLiffOrDie(myLiffId);
                    })
                    .catch(function(error) {});
            } else {
                myLiffId = defaultLiffId;
                initializeLiffOrDie(myLiffId);
            }
        };

        function initializeLiffOrDie(myLiffId) {
            if (myLiffId) {
                initializeLiff(myLiffId);
            }
        }

        function initializeLiff(myLiffId) {
            liff.init({
                    liffId: myLiffId
                })
                .then(() => {
                    initializeApp();
                })
                .catch((err) => {});
        }


        function initializeApp() {
            //displayLiffData();

            if (liff.isLoggedIn()) {

                liff.getProfile().then(profile => {
                        const userName = profile.displayName;
                        const userId = profile.userId;

                        if (document.getElementById('txtLineDisplay'))
                            document.getElementById('txtLineDisplay').value = userName;

                        if (document.getElementById('txtType').value === "REGISTER") {
                            if (document.getElementById('lblUserName'))
                                document.getElementById('lblUserName').value = userName;
                        }

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
                                     text: '®Complete Register'
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
    </script>

</body>

</html>