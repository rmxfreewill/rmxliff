<?php
/*    include_once("index.html"); */

session_start();

error_reporting(E_ALL & ~E_NOTICE);
include_once("rmxLineFunction.php");

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
$sTitle = 'Register';
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

    if ($type == true) {

        $LineId = $arr[0];
        $LineDisplay = $arr[1];
        $UserName = $arr[2];
        $EMail = $arr[3];
        $Tel = $arr[4];
        $SoldToCode = $arr[5];
        $SoldToName = $arr[6];

        $scrType = '
        <label for="uname"><b>Line Id: </b></label><span id="txtLineId">' . $LineId . '</span>
        <p>
        <label for="uname"><b>LineDisplay: </b></label><span id="txtLineDisplay">' . $LineDisplay . '</span>
        <p>
        <label for="uname"><b>Username: </b></label><span id="txtUserName">' . $UserName . '</span>
        <p>
        <label for="uname"><b>EMail: </b></label><span id="txtEMail">' . $EMail . '</span>
        <p>
        <label for="uname"><b>Telephone: </b></label><span id="txtTel">' . $Tel . '</span>
        <p>
        <label for="uname"><b>SoldTo Code: </b></label><span id="txtSoldToCode">' . $SoldToCode . '</span>
        <p>
        <label for="uname"><b>SoldTo Name: </b></label><span id="txtSoldToName">' . $SoldToName . '</span>
        <p>
        <button type="button" id="btnLogin" onclick="OkClick(\'red\')">Close</button>
        ';


        $scrBackup = '
        <div class="login_container">

        <label for="uname"><b>Line Id</b></label>
        <input type="text" id="txtLineId" readonly>

        <!-- <label for="uname"><b>Line Display Name</b></label>
        <input type="text" id="txtLineDisplay" readonly hidden> -->

        <label for="uname"><b>Username</b></label>
        <input type="text" value="' . $UserName . '" id="txtUserName" readonly>

        <label for="psw"><b>EMail</b></label>
        <input type="text" id="txtEMail" value="' . $EMail . '" readonly>

        <label for="psw"><b>Telephone / Mobile</b></label>
        <input type="text" id="txtTel" value="' . $Tel . '" readonly>

        <label for="psw"><b>SoldTo Code</b></label>
        <input type="text" id="txtSoldToCode" value="' . $SoldToCode . '" readonly>

        <label for="psw"><b>SoldTo Name</b></label>
        <input type="text" id="txtSoldToName" value="' . $SoldToName . '" readonly>

        <button type="button" id="btnLogin" onclick="OkClick(\'red\')">Close</button>
        </div>
        ';
    }else{
        $scrType = '
        <label for="uname"><b>Line Id</b></label>
        <input type="text" id="txtLineId" readonly>

        <label for="uname"><b>Line Display Name</b></label>
        <input type="text" id="txtLineDisplay" readonly>

        <label for="uname"><b>Username</b></label>
        <input type="text" name="txtUserName" id="txtUserName">
    
        <label for="psw"><b>EMail</b></label>
        <input type="email" placeholder="Enter EMail" name="txtEMail" 
            id="txtEMail" 
        required>
        
        <label for="psw"><b>Telephone / Mobile</b></label>
        <input type="tel" placeholder="Enter Telephone/Mobile" 
            name="txtTel" id="txtTel" 
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" 
        required>
        
        <button type="button"  name="btnLogin" id="btnLogin" onclick="abc()">
            Register
        </button>
    
        ';
    }

    // onclick="RegisterClick(\'\')">Register</button>

    $scr = '
    <div class="login_container">
    ' . $scrType . '
    </div>
    ';

    return $scr;
}


//Line Api
function changeMemberRichMenu($LINEID)
{
    $RICHMENUID = RICHMENU_ID;
    $CURLOPT = CURLOPT_POST;
    $url = "https://api.line.me/v2/bot/user/$LINEID/richmenu/$RICHMENUID";
    $data = array();
    $method = "POST";
    $headers = [
        "Authorization: Bearer " . BEARER_TOKEN
    ];
    try {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        // curl_setopt($ch, $CURLOPT, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $data
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); # receive server response
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); # do not verify SSL
        $data = curl_exec($ch); # execute curl
        $httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); # http response status code
        curl_close($ch);

        $data = "{}";
    } catch (Exception $ex) {
        $data = $ex;
    }
}

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

if ($LineId != '' && $sFlagChangeMenu != false) {
    changeMemberRichMenu($LineId);
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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <form class="animate" method="GET" id="registerForm" enctype="multipart/form-data" hidden>

        <?php
       
        if ($sFlag == '0' || $sFlag == '') {
            echo registerScreen(false, []);
        } else {
            $arrayList = [$LineId, $LineDisplay, $UserName, $EMail, $Tel, $SoldToCode, $SoldToName];
            echo registerScreen(true, $arrayList);
        }
        ?>

        <input type="hidden" id="txtFlag" value="<?php echo $sFlag; ?>">
        <input type="hidden" id="txtCompanyCode" value="<?php echo $CompanyCode; ?>">
        <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">
        <input type="hidden" id="txtShowMsg" value="<?php echo $sShowMsg; ?>">
        <input type="hidden" id="txtsURL" value="<?php echo $sURL; ?>">

        <!-- <input type="hidden" id="txtMsg" value="<?php  //echo $sFlagMsg; ?>">  -->

    </form>

    <div id="successMsg" hidden>
        <center>
            <h1>Register Success</h1>
            <h2>Close Windows</h2>
        </center>
    </div>


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


        function abc(){
            var sLineId = document.getElementById('txtLineId').value;
            var sLineDisplay = document.getElementById('txtLineDisplay').value;
            var sCompanyCode = document.getElementById('txtCompanyCode').value;
            var sUserName = document.getElementById('txtUserName').value;
            var sEMail = document.getElementById('txtEMail').value;
            var sTel = document.getElementById('txtTel').value;
            var sCmd = sLineDisplay + "^c" + sUserName + "^c" + sTel + "^c" + sEMail;
            var para = "?LinkCode=REGISTER&LineId=" + sLineId + "&CmdCommand=" + sCmd;
            alert(sCmd);
        }
        function RegisterClick(msg) {
            var sLineId = document.getElementById('lblUserId').textContent;
            var sLineDisplay = document.getElementById('txtDisplay').value;
            var sCompanyCode = document.getElementById('txtCompanyCode').value;
            var sUserName = document.getElementById('txtUserName').value;
            var sEMail = document.getElementById('txtEMail').value;
            var sTel = document.getElementById('txtTel').value;
            var sCmd = sLineDisplay + "^c" + sUserName + "^c" + sTel + "^c" + sEMail;
            var para = "?LinkCode=REGISTER&LineId=" + sLineId + "&CmdCommand=" + sCmd;
            var URL = document.getElementById('txtsURL').value;
            url = URL + "frmRegister.php" + para;
            alert(url);
            window.location.assign(url);
        }

        function OkClick(msg) {
            var myLiffId = document.getElementById('txtLiffId').value;
            if (liff.getOS() != "web") {
                liff.closeWindow();
            } else {

                var elementRegisterForm = document.getElementById('registerForm');
                var elementSuccessMsg = document.getElementById('successMsg');

                elementRegisterForm.style.display = "none";
                elementSuccessMsg.removeAttribute("hidden");



            }
        }

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
                                alert(sMsg);
                            }
                        }
                    })
                    .catch((err) => {
                        console.log('error ', err);
                    });
            }
        }

        function initializeLiff(myLiffId) {
            console.log('initializeLiff: ', myLiffId);
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
            initializeLiff(myLiffId);
        };
    </script>

</body>

</html>


<!-- // async function changeMemberRichMenu(myLiffId) { 
        //     BearerToken = "Bearer EDiLRqCWwuFXTmT2KGXddtlV2GVSg9kaTWJuJvsonJ1bbAKPCKISIyhavW4D5tL5tY7L+sU8jUkh+V7bxIP6lLTo7aXpV+QTKthC3vXAho+2nq50e2ZrzJguKtoC6Nhp4CLJajUtheyDbCyHvcHQ/gdB04t89/1O/w1cDnyilFU=";
        //     urlApi = "https://api.line.me/v2/bot/user/";
        //     pathRichmenu = "/richmenu/";
        //     memberRichmenu = "richmenu-119fefe49b2dd01369a9416da62d7f80";
        //     url = urlApi + myLiffId + pathRichmenu + memberRichmenu;
        //     console.log(url);
        //     LINE_HEADER = {
        //         'Authorization': BearerToken
        //     };
        //     await axios({
        //             method: 'POST',
        //             url: url,
        //             data: {},
        //             headers: LINE_HEADER
        //         })
        //         .then(function(response) {
        //             console.log(response);
        //         })
        //         .catch(function(error) {
        //             console.log(error);
        //         });
        // }
    -->