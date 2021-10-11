<?php
/*    include_once("index.html"); */

session_start();

error_reporting(E_ALL & ~E_NOTICE);
include_once("rmxLineFunction.php");

$CompanyUrl = COMPANY_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;

$Function = '';
if (isset($_POST['Function']))
    $Function = $_POST['Function'];
if (isset($_GET['Function']))
    $Function = $_GET['Function'];

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
</head>

<body>
    <form class="animate" method="GET" enctype="multipart/form-data" action="index.php">
        <input type="hidden" id="txtCompanyCode" value="<?php echo $CompanyCode; ?>">
        <input type="hidden" id="txtFunction" value="<?php echo $Function; ?>">
        <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">
    </form>

    <script>
        window.onload = function() {

            const LiffId = document.getElementById('txtLiffId').value;

            function selectMenu() {
                const sFunction = document.getElementById('txtFunction').value;
                const URL = "https://rmxlineliff.herokuapp.com/";
                if (sFunction == '') {
                    alert('Menu What');
                    url = URL;
                } else {
                    var sCompCode = document.getElementById('txtCompanyCode').value;
                    var sCmd = "call sp_main_check_register ('" + userId + "','" + sCompCode + "')";
                    var para = "?LinkCode=CHECK&LineId=" + userId + "&CmdCommand=" + sCmd;
                    switch (sFunction) {
                        case "REGISTER":
                            url = URL + "frmRegister.php" + para;
                            break;
                        case "QUERY":
                            url = URL + "frmQuery.php" + para;
                            break;
                        case "VIEW":
                            url = URL + "frmView.php" + para;
                            break;
                        case "TICKET":
                            url = URL + "frmTicket.php" + para;
                            break;
                        default:
                            break;
                    }
                }
                return url;
            }

            function initializeApp() {
                if (liff.isLoggedIn()) {
                    liff.getProfile().then(profile => {
                            const userId = profile.userId;
                            const url = selectMenu();
                            liff.login({
                                redirectUri: url
                            });
                        })
                        .catch((err) => {
                            console.log('error: ', err);
                        });
                } else {
                    liff.login();
                }
            }

            function initializeLiff(myLiffId) {
                liff.init({
                        liffId: myLiffId
                    })
                    .then(() => {
                        initializeApp();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }

            initializeLiff(defaultLiffId);
        };
    </script>

</body>

</html>