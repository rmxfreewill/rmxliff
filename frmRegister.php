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
$sURL = sURL;
// $RichMenuId = RICHMENU_ID;

header('Access-Control-Allow-Origin: *');

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
$sFlagChangeMenu = false;
$sFlag = '0';
$sTitle = 'Please Register';
$sShowMsg = '';

// registerScreen Defualt
function registerScreen($type, $arr)
{

    $scrType = '
        <label for="uname"><b>Username</b></label>
        <input type="text" name="txtUserName" id="txtUserName"   >

        <label for="psw"><b>EMail</b></label>
        <input type="email" placeholder="Enter EMail" name="txtEMail" 
            id="txtEMail" required >
        
        <label for="psw"><b>Telephone / Mobile</b></label>
        <input type="tel" placeholder="Enter Telephone/Mobile" 
            name="txtTel" id="txtTel" 
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
        
        <button type="button"  name="btnLogin" id="btnLogin" 
            onclick="RegisterClick()">Register</button>
    
        </div>

        <div id="liffAppContent" class="hidden">
              
        <!-- ACCESS TOKEN DATA -->
        <div id="accessTokenData" class="hidden textLeft">
            <h2>Access Token</h2>
            <a href="#" onclick="toggleAccessToken()">Close Access Token</a>
            <table>
                <tr>
                    <th>accessToken</th>
                    <td id="accessTokenField"></td>
                </tr>
            </table>
        </div>
       
     
        <!-- LIFF DATA -->
        <div id="liffData">
            <h2 id="liffDataHeader" class="textLeft">Line Data</h2>
            <table>
                <tr>
                    <th>User Id</th>
                    <td id="lblUserId" class="textLeft"></td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td id="lblUserName" class="textLeft"></td>
                </tr>
                <tr>
                    <th>OS</th>
                    <td id="deviceOS" class="textLeft"></td>
                </tr>
                <tr>
                    <th>Language</th>
                    <td id="browserLanguage" class="textLeft"></td>
                </tr>
                <tr>
                    <th>LIFF SDK Version</th>
                    <td id="sdkVersion" class="textLeft"></td>
                </tr>
                <tr>
                    <th>LINE Version</th>
                    <td id="lineVersion" class="textLeft"></td>
                </tr>
              
            </table>
        </div>  
    ';

    if ($type == false) {
        $mobileForm = '
        <input type="hidden" id="txtUserName">
        <input type="hidden" id="txtLineDisplay">
        <input type="hidden" id="txtLineId">
        <label for="psw"><b>EMail</b></label>
        <input type="email"
            id="txtEMail" 
            name="txtEMail"
            placeholder="Enter EMail"
            maxlength="40"
        required>
        <label for="psw"><b>Telephone / Mobile</b></label>
        <input type="tel" 
            placeholder="Enter Telephone/Mobile" 
            name="txtTel" id="txtTel" 
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" 
            maxlength="10"
        required>
        <input type="hidden" id="txtIsCheckRegister" value="false">
        <button type="button"  name="btnLogin" id="btnLogin" onclick="registerCheck()">
            Register
        </button>
        ';

        $regisForm = $mobileForm;
    } else {
        $regisForm = '<input type="hidden" id="txtIsCheckRegister" value="true">';
    }
    $scr = '<div class="login_container">' . $regisForm . '</div>';
    return $scr;
}




if ($LinkCode == 'LOGOUT') {
} else {
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
                    $sFlagChangeMenu = true;
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
                if ($sFlag != '0') {
                    $sTitle = 'View Register Info';
                    $sFlagChangeMenu = true;
                }
            }
        }
    }

    if ($sTitle == 'View Register Info' || $sTitle == 'Register Complete') {
        rmxChangeMemberRichMenu('REGISTER', $LineId);
    }
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.18.1/sdk.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <title>RMX LINE OFFICIAL</title>

</head>

<body>
    <form class="animate" method="GET" id="registerForm" enctype="multipart/form-data" hidden>

        <?php
        echo "DevMode<hr>";
        echo $sFlag;
        if ($sFlag == '0' || $sFlag == '') {
            echo registerScreen(false, []);
        } else {
            $arrayList = [$LineId, $LineDisplay, $UserName, $EMail, $Tel, $SoldToCode, $SoldToName];
            // echo registerScreen(true, $arrayList);
        }
        ?>

        <input type="hidden" id="txtFlag" value="<?php echo $sFlag; ?>">
        <input type="hidden" id="txtCompanyCode" value="<?php echo $CompanyCode; ?>">
        <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">
        <input type="hidden" id="txtShowMsg" value="<?php echo $sShowMsg; ?>">
        <input type="hidden" id="txtTitle" value="<?php echo $sTitle; ?>">
        <input type="hidden" id="txtsURL" value="<?php echo $sURL; ?>">
        <input type="hidden" id="txtMsg" value="<?php echo $sFlagMsg; ?>">

    </form>

    <script>
        // function displayLiffData() {
        //     if (document.getElementById('browserLanguage')) {
        //         document.getElementById('browserLanguage').textContent = liff.getLanguage();
        //         document.getElementById('sdkVersion').textContent = liff.getVersion();
        //         document.getElementById('lineVersion').textContent = liff.getLineVersion();
        //         document.getElementById('deviceOS').textContent = liff.getOS();
        //     }
        // }

        // function toggleAccessToken() {
        //     toggleElement('accessTokenData');
        // }

        // function toggleProfileData() {
        //     toggleElement('profileInfo');
        // }

        // function toggleElement(elementId) {
        //     const elem = document.getElementById(elementId);
        //     if (elem.offsetWidth > 0 && elem.offsetHeight > 0) {
        //         elem.style.display = 'none';
        //     } else {
        //         elem.style.display = 'block';
        //     }
        // }


        function registerCheck() {
            // var sUserName = document.getElementById('txtUserName').value;
            // var sLineDisplay = document.getElementById('txtLineDisplay').value;
            var sUserName = '';
            var sLineDisplay = '';
            //
            var sCompanyCode = document.getElementById('txtCompanyCode').value;
            var sLineId = document.getElementById('txtLineId').value;
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
                    var sCmd = sLineDisplay + "^c" + sUserName + "^c" + sTel + "^c" + sEMail;
                    var para = "?LinkCode=REGISTER&LineId=" + sLineId + "&CmdCommand=" + sCmd;
                    var surl = document.getElementById('txtsURL').value;
                    url = surl + "frmRegister.php" + para;
                    alert(url);
                    window.location.assign(url);
                }
            }




        }

        // function RegisterClickBB(msg) {
        //     var sLineId = document.getElementById('lblUserId').textContent;
        //     var sLineDisplay = document.getElementById('txtDisplay').value;
        //     var sCompanyCode = document.getElementById('txtCompanyCode').value;
        //     var sUserName = document.getElementById('txtUserName').value;
        //     var sEMail = document.getElementById('txtEMail').value;
        //     var sTel = document.getElementById('txtTel').value;
        //     var sCmd = sLineDisplay + "^c" + sUserName + "^c" + sTel + "^c" + sEMail;
        //     var para = "?LinkCode=REGISTER&LineId=" + sLineId + "&CmdCommand=" + sCmd;
        //     var URL = document.getElementById('txtsURL').value;
        //     url = URL + "frmRegister.php" + para;
        //     window.location.assign(url);
        // }


        // function OkClick(msg) {
        //     alert('Close');
        //     var myLiffId = document.getElementById('txtLiffId').value;
        //     if (liff.getOS() != "web") {
        //         liff.closeWindow();
        //     } else {

        //         var elementRegisterForm = document.getElementById('registerForm');
        //         var elementSuccessMsg = document.getElementById('successMsg');

        //         elementRegisterForm.style.display = "none";
        //         elementSuccessMsg.removeAttribute("hidden");

        //     }
        // }

        function initializeApp() {
            if (liff.isLoggedIn()) {

                liff.getProfile().then(profile => {
                        const userName = profile.displayName;


                        if (document.getElementById('txtLineDisplay'))
                            document.getElementById('txtLineDisplay').value = userName;

                        const userId = profile.userId;
                        if (document.getElementById('txtLineId'))
                            document.getElementById('txtLineId').value = userId;

                        if (document.getElementById('lblUserId')) {
                            document.getElementById('lblUserId').textContent = userId;
                            document.getElementById('lblUserName').textContent = userName;
                            document.getElementById('txtDisplay').value = userName;
                        }

                        if (document.getElementById('txtShowMsg')) {
                            var elementRegisterForm = document.getElementById('registerForm');
                            elementRegisterForm.removeAttribute("hidden");
                            var sMsg = document.getElementById('txtMsg').value;
                            if (sMsg.length > 0) {
                                // alert(sMsg);
                            }
                        }
                    })
                    .catch((err) => {
                        console.log('error ', err);
                    });
            }
        }

        function initializeLiff(myLiffId) {
            // console.log('initializeLiff: ', myLiffId);
            liff.init({
                    liffId: myLiffId
                })
                .then(() => {
                    initializeApp();
                })
                .catch((err) => {
                    console.log('initializeLiff: ', err);
                });
        }



        window.onload = function() {
            var myLiffId = document.getElementById('txtLiffId').value;
            var isCheckRegister = document.getElementById('txtIsCheckRegister').value;
            liff.init({
                    liffId: myLiffId
                })
                .then(() => {
                    if (isCheckRegister == 'true') {
                        liff.closeWindow();
                    } else if (isCheckRegister == 'false') {
                        initializeApp();
                    }
                })
                .catch((err) => {
                    console.log('initializeLiff: ', err);
                });
        };
    </script>


</body>

</html>