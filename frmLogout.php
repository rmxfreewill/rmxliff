<?php
session_start();

error_reporting(E_ALL & ~E_NOTICE);
include_once("rmxLineFunction.php");
include_once("function/rmx_liff_function.php");

$LiffId = LIFF_ID;

$LineId = '';
if (isset($_POST['LineId']))
    $LineId = $_POST['LineId'];
if (isset($_GET['LineId']))
    $LineId = $_GET['LineId'];

//Line Api
// function changeMemberRichMenuDefualt($LINEID)
// {
//     $url = "https://api.line.me/v2/bot/user/$LINEID/richmenu";
//     $method = 'DELETE';
//     $data = array();
//     $headers = [
//         "Authorization: Bearer " . BEARER_TOKEN
//     ];

//     try {
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
//         // curl_setopt($ch, $CURLOPT, 1);
//         curl_setopt(
//             $ch,
//             CURLOPT_POSTFIELDS,
//             $data
//         );

//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); # receive server response
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); # do not verify SSL
//         $data = curl_exec($ch); # execute curl
//         $httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); # http response status code
//         curl_close($ch);

//         $data = "{}";
//     } catch (Exception $ex) {
//         $data = $ex;
//     }
// }

rmxChangeMemberRichMenuDefualt($LineId);

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
    <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">

    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>
</head>

<body>
    <center>
        <h1>Thank You</h1>
    </center>
    <script>
        // var myLiffId = document.getElementById('txtLiffId').value;
        // var type = "logout";
        // rmxInitializeLiff(myLiffId,type);
    </script>
</body>

</html>