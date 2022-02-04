<?php

error_reporting(-1);
ini_set('display_errors', 'On');

include($_SERVER['DOCUMENT_ROOT'] . "/define_Global.php");
include("zScreenFunction.php");

$CompanyUrl = COMPANY_URL;
$RegisterUrl = REGISTER_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;

$objData = getDataFromRoute();

if ($objData->route == 'MENU') {
} else if ($objData->route == 'CHECKDATA') {
}

?>
<html>

<head>
    <title>RMX LINE OFFICIAL</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="en-th">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.18.1/sdk.js"></script> -->
    <link rel="stylesheet" href="../css/style.css">

    <script charset="utf-8" src="../js/jquery.js"></script>
    <script charset="utf-8" src="../js/lineSdk.js"></script>
    <script charset="utf-8" src="../js/rmx_liff_function.js"></script>
</head>

<body>

    <script>
        async function initializeLiff(myLiffId) {
            console.log('initializeLiff: ', myLiffId);
            liff.init({
                    liffId: myLiffId
                })
                .then(() => {
                    if (liff.isLoggedIn()) {
                        liff.getProfile().then(profile => {
                                const userName = profile.displayName;
                                const userId = profile.userId;
                            })
                            .catch((err) => {
                                console.log('error ', err);
                            });
                    }
                })
                .catch((err) => {
                    console.log('initializeLiff: ', err);
                });
        }

        $(function() {
            var myLiffId = "<?php echo LIFF_ID; ?>";
            initializeLiff(myLiffId);
        });
    </script>
</body>

</html>