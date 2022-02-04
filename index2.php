<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>RMX LINE OFFICIAL</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="en-th">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script charset="utf-8" src="js/lineSdk_2_18_1.js"></script>
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>
</head>

<body>
    <div id="rmxMenu">
    </div>
    <button id="page1">Page1</button>
    <button id="page2">Page2</button>

    <script>
        $(document).ready(function() {
            $("#rmxMenu").load("screen/profileScreen.php");
            $("#page1").click(function() {
                $("#rmxMenu").load("screen/profileScreen.php");
            });
            $("#page2").click(function() {
                window.addEventListener("load", function(event) {
                    $('#rmxMenu').load('frmTicket.php');

                });
            });
        });
    </script>
</body>

</html>