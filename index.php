<?php

session_start();

error_reporting(E_ALL & ~E_NOTICE);
include_once("rmxLineFunction.php");

$CompanyUrl = COMPANY_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;
$sURL = sURL;

$Function = '';
if (isset($_POST['Function']))
    $Function = $_POST['Function'];
if (isset($_GET['Function']))
    $Function = $_GET['Function'];

$menu = '';
if (isset($_POST['menu']))
    $menu = $_POST['menu'];
if (isset($_GET['menu']))
    $menu = $_GET['menu'];


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
    <title>Line</title>

    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>
</head>

<body>

    <form method="GET" enctype="multipart/form-data" action="index.php">
        <input type="hidden" id="txtCompanyCode" value="<?php echo $CompanyCode; ?>">
        <input type="hidden" id="txtFunction" value="<?php echo $Function; ?>">
        <input type="hidden" id="txtMenu" value="<?php echo $menu; ?>">
        <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">
        <input type="hidden" id="txtsURL" value="<?php echo $sURL; ?>">
    </form>

    <script>
        window.onload = function() {

            // function selectMenu(toMenu, userId) {
            //     var URL = document.getElementById('txtsURL').value;
            //     var sCompCode = document.getElementById('txtCompanyCode').value;
            //     var sCmd = "call sp_main_check_register ('" + userId + "','" + sCompCode + "')";
            //     var para = "?LinkCode=CHECK&LineId=" + userId + "&CmdCommand=" + sCmd;
            //     switch (toMenu) {
            //         case "REGISTER":
            //             url = URL + "frmRegister.php" + para;
            //             break;
            //         case "QUERY":
            //             url = URL + "frmQuery.php" + para;
            //             break;
            //         case "VIEW":
            //             url = URL + "frmView.php" + para;
            //             break;
            //         case "TICKET":
            //             url = URL + "frmTicket.php" + para;
            //             break;
            //         case "LOGOUT":
            //             url = URL + "frmLogout.php" + para;
            //             break;
            //         default:
            //             url = 'closeWindow.php';
            //             break;
            //     }

            //     return url;
            // }

            function getProfileLiffUserId() {
                liff.getProfile()
                    .then(profile => {
                        var sFunction = document.getElementById('txtFunction').value;
                        var sMenu = document.getElementById('txtMenu').value;
                        if (sFunction != '') {
                            var userIdProfile = profile.userId;
                            var url = rmxSelectMenu(sFunction, userIdProfile);
                            window.location.assign(url);
                        } else {
                            if (sMenu != '') {
                                var userIdProfile = profile.userId;
                                var url = rmxSelectMenu(sMenu, userIdProfile);
                                window.location.assign(url);
                            }
                        }
                    })
                    .catch((err) => {
                        console.log('getProfile: ', err);
                    });
            }

            async function initializeLiff() {
                var myLiffId = document.getElementById('txtLiffId').value;
                await liff.init({
                        liffId: myLiffId
                    })
                    .then(() => {
                        liff.isLoggedIn() ? getProfileLiffUserId() : liff.login();
                    })
                    .catch((err) => {
                        console.log("initializeLiff: " + err);
                    });
            }

            var myLiffId = document.getElementById('txtLiffId').value;
            initializeLiff();

        }
    </script>

</body>

</html>