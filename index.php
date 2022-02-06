<?php

session_start();

error_reporting(-1);
ini_set('display_errors', 'On');


include_once("rmxLineFunction.php");
include("rmxLiffFunction.php");

// header('Access-Control-Allow-Origin: *');

$GLOBALS['COMPANY_URL'] =  COMPANY_URL;
$GLOBALS['REGISTER_URL'] =   REGISTER_URL;
$GLOBALS['COMPANY_CODE'] =   COMPANY_CODE;
$GLOBALS['LIFF_ID'] =   LIFF_ID;
$GLOBALS['sURL'] =   sURL;



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
    <title>RMX LINE OFFICIAL</title>

    <link rel="stylesheet" href="css/style.css">

    <script charset="utf-8" src="js/jquery.js"></script>
    <script charset="utf-8" src="js/lineSdk_2_18_1.js"></script>
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>

</head>

<body>

    <div id="rmxLiFFLayout">

    </div>

    <!-- <form method="GET" enctype="multipart/form-data" action="index.php"> -->
    <!-- <input type="hidden" id="txtCompanyCode" value="<?php //echo $CompanyCode; 
                                                            ?>"> -->
    <!-- <input type="hidden" id="txtFunction" value="<?php //echo $Function; 
                                                        ?>"> -->
    <!-- <input type="hidden" id="txtMenu" value="<?php //echo $menu; 
                                                    ?>"> -->
    <!-- <input type="hidden" id="txtLiffId" value="<?php //echo $LiffId; 
                                                    ?>"> -->
    <!-- <input type="hidden" id="txtsURL" value="<?php //echo $sURL; 
                                                    ?>"> -->
    <!-- </form> -->

    <script>
        async function rmxInitializeLineLiff(myLiffId = String) {
            await liff.init({
                    liffId: myLiffId
                })
                .then(() => {
                    if (liff.isLoggedIn()) {

                        liff.getProfile()
                            .then(profile => {
                                const userIdProfile = profile.userId;
                                const sCompCode = "<? echo COMPANY_CODE; ?>";

                                var getParam = rmxGetParams();
                                var toMenu = getParam["menu"];
                                var urlSelectMenu = rmxSelectMenu(toMenu, userIdProfile, sCompCode);
                                alert(urlSelectMenu);
                            })
                            .catch((err) => {
                                console.log('error', err);
                            });




                        //                                 var getParam = rmxGetParams();
                        //                                 var toStatus = getParam["status"];
                        // alert(toStatus);
                        //                                 if (toStatus == null) {
                        //                                     window.location.assign(url);
                        //                                 } else if (toStatus == "init") {
                        //                                     var toMenu = getParam["menu"];
                        //                                     if (toMenu == "register") {
                        //                                         menuUrl = "menu/registerMenu.php";
                        //                                         $("#rmxLiFFLayout").load(menuUrl);
                        //                                     }
                        //                                 }
                        //                                 console.log(getParam);
                        //                             })
                        //                             .catch((err) => {
                        //                                 console.log('error ', err);
                        //                             });
                    }
                })
                .catch((err) => {
                    console.log('err initializeLiff: ', err);
                });
        }

        $(function() {
            var myLiffId = "<? echo LIFF_ID; ?>";
            rmxInitializeLineLiff(myLiffId);
        });
    </script>
</body>

</html>