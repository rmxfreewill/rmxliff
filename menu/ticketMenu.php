<?php

error_reporting(-1);
ini_set('display_errors', 'On');

include("zMenuFunction.php");
include("zApiFunction.php");

$GLOBALS['COMPANY_URL'] =  COMPANY_URL;
$GLOBALS['REGISTER_URL'] =   REGISTER_URL;
$GLOBALS['COMPANY_CODE'] =   COMPANY_CODE;
$GLOBALS['LIFF_ID'] =   LIFF_ID;
$GLOBALS['sURL'] =   sURL;

$TableTitle = 'View Ticket';
if (isset($_POST['TableTitle']))
    $TableTitle = $_POST['TableTitle'];
if (isset($_GET['TableTitle']))
    $TableTitle = $_GET['TableTitle'];

$RetCommand = '';
$Ret = '';

$UserName = '';
$EMail = '';
$Tel = '';
$SoldToCode = '';
$SoldToName = '';
$sFlagMsg = '';
$sFlag = '5';
$sShowMsg = '';

$getDataFromUrl = getDataFromUrl($GLOBALS['COMPANY_CODE'], $GLOBALS['COMPANY_URL'], $GLOBALS['REGISTER_URL']);
$status = $getDataFromUrl->status;
if ($status == 'init') {
    $notFound =  "<center><h2><br>Not Found User</h2></center>";
    $getDataFromDatabase = getDataFromDatabase($GLOBALS['COMPANY_URL'], $getDataFromUrl);
    $sFlag = $getDataFromDatabase->sFlag;
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>RMX LINE OFFICIAL</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="en-th">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php

    if ($sFlag != '0') {
        $getTicketFromDatabaseRetCommand = getTicketFromDatabase($getDataFromUrl, $getDataFromDatabase);
        // showTicketList($getTicketFromDatabase);

        if ($getTicketFromDatabaseRetCommand) {
            $asTable = explode("^t", $getTicketFromDatabaseRetCommand);
            if (count($asTable) > 0) {
                $arTmp = explode("^f", $asTable[0]);
                if (count($arTmp) > 1) {
                    $asCol = explode("^c", $arTmp[0]);
                    echo json_encode($asCol);
                    $asRow = explode("^r", $arTmp[1]);
                    if (count($asRow) > 0) {

                        $nLoop = 0;

                        $nRLen = count($asRow);
                        $nCLen = count($asCol);
                        $sTab = "";
                        $sPage = "";


                        if ($nRLen > 10) $nRLen = 10;

                        for ($n = 0; $n < $nRLen; $n++) {

                            $sRow = $asRow[$n];
                            $asData = explode("^c", $sRow);
                            $nDLen = count($asData);
                            if ($nDLen > 0) {
                                $sTicketNo = $asData[0];
                                $sTab = $sTab . "<a class='tablink' href='#' "
                                    . "onclick=\"openPage('div" . $sTicketNo . "_" . $n
                                    . "', this, 'red')\">" . $sTicketNo . "</a>";

                                $sPage = $sPage . "<div id='div" . $sTicketNo . "_" . $n . "' class='tabcontent'>";

                                $sPage = $sPage . "<table class='tblticket'>";
                                for ($r = 0; $r < $nDLen; $r++) {
                                    $sC = $asCol[$r];
                                    $sD = $asData[$r];

                                    $sPage = $sPage . "<tr><th>" . $sC
                                        . "</th><td class='textLeft'>" . $sD . "</td></tr>";
                                }
                                $sPage = $sPage . "</table></div>";
                            }
                        }




                        $sTab = "
                        <div style='display: flex;flex-direction: row; 
                            width: 100%; height:45px; '>
                       
                            <input type='date'  dateformat='d M y' 
                                placeholder='Start Date'                                
                                value='" . $StartDate . "'
                                style='width: 40%;'
                                id='txtFirst' >
                            <input type='date' id='txtLast'  
                                placeholder='End Date'
                                value='" . $EndDate . "'
                                style='width: 40%;'>
                            <button type='button' 
                                style='width: 20%; text-align:center; '
                                 id='btnSearch' onclick='SearchClick()'>OK</button>  
                        </div>                        
                        <div class='scrollmenu'>" . $sTab . "</div>";
                        echo $sTab;
                        echo $sPage;
                    }
                } else {
                    echo count($arTmp);
                }
            }
        }
    } else {
        echo $notFound;
    }
    ?>
    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
        }

        function fillTicketData(tableName, asCol, asData) {
            var table = document.getElementById(tableName);
            if (table) {
                var sHtml = "";
                var nRLen = asData.length;
                for (var r = 0; r < nRLen; r++) {
                    var sC = asCol[r];
                    var sD = asData[r];
                    sHtml = sHtml + "<tr><th>" + sC + "</th><td class='textLeft'>" + sD + "</td></tr>";
                }
                table.innerHTML = sHtml;
            }
        }

        $(function() {
            $(".loader").hide();
        });
    </script>
</body>

</html>