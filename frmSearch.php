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

$TableTitle = 'Query Result';
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
$sFlag = '0';
$sTitle = 'Search';
$sShowMsg = '';

if ($LinkCode == 'SEARCH') {

    $RetCommand = send_query($CompanyUrl, $LineId, $CompanyCode, $CmdCommand);
    if ($RetCommand) {
    }
    $sFlag = '5';
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
            if ($sFlag != '0') $sTitle = 'Search';
        }
    }
}

function ticketSearchScreen($LineId)
{
    //     <label><b>LINE ID: </b>'.$LineId.'</label>
    // <p>
    echo
    '<div class="login_container">
        <div class="login_container">
            <label for="txtFirst"><b>Start Date</b></label>
            <input type="date" dateformat="d M y" id="txtFirst">
            <label for="txtLast"><b>End Date</b></label>
            <input type="date" id="txtLast" dateformat="d M y">
            <label for="txtTicketNo"><b>Ticket No</b></label>
            <input type="text" id="txtTicketNo" value="">
            <input type="hidden" id="txtRet" value="<?php echo $RetCommand; ?>">
            <button type="button" id="btnSearch" onclick="SearchClick()">SEARCH</button>
        </div>

    </div>';
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
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search_style.css">
</head>

<body>
    <form class="animate" method="GET" enctype="multipart/form-data">

        <?php
        if ($sFlag == '0' || $sFlag == '') {
            echo registerScreen(false, []);
        } else {
            ticketSearchScreen($LineId);
        }
        ?>

        <input type="hidden" id="txtFlag" value="<?php echo $sFlag; ?>">
        <input type="hidden" id="txtCompanyCode" value="<?php echo $CompanyCode; ?>">
        <input type="hidden" id="txtLiffId" value="<?php echo $LiffId; ?>">
        <input type="hidden" id="txtMsg" value="<?php echo $sFlagMsg; ?>">
        <input type="hidden" id="txtShowMsg" value="<?php echo $sShowMsg; ?>">
        <input type="hidden" id="txtRetCommand" value="<?php echo $RetCommand; ?>">
        <input type="hidden" id="txtLineId" value="<?php echo $LiffId; ?>">
        <input type="hidden" id="txtTableTitle" value="<?php echo $TableTitle; ?>">
        <input type="hidden" id="txtsURL" value="<?php echo $sURL; ?>">

    </form>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div style="overflow-x:auto;">
                <h2><?php echo $TableTitle; ?></h2>

                <table id="tblList">
                    <thead style="Font-size: 10px;">
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>Alfreds Futterkiste</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                    </tr>

                </table>
                <h2></h2>

            </div>
        </div>
    </div>

    <div id="ticketModal" class="modal2">
        <div class="modal2-content">
            <span class="close2">&times;</span>
            <div style="overflow-x:auto;">
                <h2>Ticket</h2>
                <table id="tblTicket">

                </table>
                <h2></h2>
            </div>
        </div>
    </div>

    <div id="loader" style="display:none;"></div>

    <script>
        /*
    var today = new Date();
    var curDate = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
    document.getElementById('txtFirst').value =curDate;
    document.getElementById('txtLast').value =curDate;
*/


        window.onload = function() {

            var myLiffId = document.getElementById('txtLiffId').value;
            // initializeLiff(myLiffId);
            var sFlag = document.getElementById('txtFlag').value;
            if (sFlag == "5") {
                var sRetCommand = document.getElementById('txtRetCommand').value;
                if (sRetCommand.length > 0) {
                    fillTableData('tblList', sRetCommand);
                    modal.style.display = "block";
                }
            }
        };



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

            if (liff.isLoggedIn()) {

                // liff.getProfile().then(profile => {
                //         const userId = profile.userId;
                //         if (document.getElementById('txtLineId'))
                //             document.getElementById('txtLineId').value = userId;

                //         if (document.getElementById('txtShowMsg')) {
                //             var sShow = document.getElementById('txtShowMsg').value;
                //             if (sShow == "1") {
                //                 var sMsg = document.getElementById('txtMsg').value;
                //                 if (sMsg.length > 0) alert(sMsg);
                //             }
                //         }
                //         // alert(userId);
                //     })
                //     .catch((err) => {
                //         alert(err);
                //         console.log('error', err);
                //     });

                var sFlag = document.getElementById('txtFlag').value;
                if (sFlag == "5") {
                    var sRetCommand = document.getElementById('txtRetCommand').value;
                    if (sRetCommand.length > 0) {
                        fillTableData('tblList', sRetCommand);
                        modal.style.display = "block";
                    }
                }
            }


        }

        function SearchClick() {

            var sLineId = document.getElementById('txtLineId').value;

            var sFirst = document.getElementById('txtFirst').value;
            if (sFirst == "") {
                alert("Please select first date before click search");
                return;
            }
            var sLast = document.getElementById('txtLast').value;
            if (sLast == "") {
                alert("Please select end date before click search");
                return;
            }

            var dF = new Date(sFirst);
            sFirst = dF.getDate() + '/' + (dF.getMonth() + 1) + '/' + dF.getFullYear();
            var dL = new Date(sLast);
            sLast = dL.getDate() + '/' + (dL.getMonth() + 1) + '/' + dL.getFullYear();

            var sCmd = "call sp_comp_select_ticket('" + sLineId + "','" + sFirst + "','" + sLast + "')";
            var sTableTitle = "Date " + sFirst + " to " + sLast;

            var para = "?LinkCode=SEARCH&LineId=" + sLineId + "&CmdCommand=" + sCmd +
                "&TableTitle=" + sTableTitle;

            var URL = document.getElementById('txtsURL').value;
            url = URL + "frmSearch.php" + para;
            window.location.assign(url);


        }

        /****************************************************************************** */
        var tTime;

        function showLoader() {
            document.getElementById("loader").style.display = "block";
            document.getElementById("loader").style.display = "inline";

            tTime = setTimeout(hideLoader, 30000);
        }


        function hideLoader() {
            if (document.getElementById("loader").style.display != "none") {
                document.getElementById("loader").style.display = "none";
                if (tTime) {
                    clearTimeout(tTime);
                }
            }
            //document.getElementById("myDiv").style.display = "block";
        }


        function clearTableData(table) {
            var rowCount = table.rows.length;
            while (--rowCount) {
                if (rowCount > 0) table.deleteRow(rowCount);
            }
            table.deleteTHead();

        }

        function fillTableData(tableName, sRet) {
            var anPos = [1, 1, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0];

            var table = document.getElementById(tableName);
            if (table) {

                //clearTableData(table);
                table.innerHTML = "";
                if (sRet.length > 0) {

                    var arTable = sRet.split("^t");
                    if (arTable.length > 0) {

                        var arTmp = arTable[0].split("^f");
                        if (arTmp.length > 1) {
                            var sColumnName = arTmp[0];
                            var asCol = arTmp[0].split("^c");
                            var asRow = arTmp[1].split("^r");

                            if (asRow.length > 0) {

                                var colCount = asCol.length;
                                if (colCount > 1) {

                                    var header = table.createTHead();
                                    var row = header.insertRow(0);
                                    row.style.backgroundColor = "#04AA6D";
                                    row.style.color = "white";


                                    for (var c = 0; c < colCount; c++) {
                                        var cell = row.insertCell(-1);
                                        cell.innerHTML = asCol[c].trim();
                                        cell.style.display = anPos[c] == 1 ? '' : 'none';
                                    }

                                    var nRLen = asRow.length;
                                    for (var r = 0; r < nRLen; r++) {
                                        if (asRow[r].length > 0) {
                                            var row2 = table.insertRow(-1);
                                            var asData = asRow[r].split("^c");

                                            for (var c = 0; c < colCount; c++) {
                                                var cell = row2.insertCell(-1);
                                                cell.style.display = anPos[c] == 1 ? '' : 'none';
                                                cell.innerHTML = asData[c].trim();
                                            }
                                            row2.onclick = function(asCol, asData) {
                                                return function() {
                                                    fillTicketData('tblTicket', asCol, asData);
                                                };
                                            }(asCol, asData);
                                        }
                                    }
                                } //if (colCount>1){

                            }
                        }

                    }

                }
            }



        }


        function fillTicketData(tableName, asCol, asData) {

            var table = document.getElementById(tableName);
            if (table) {
                var sHtml = "";
                var nRLen = asData.length;
                for (var r = 0; r < nRLen; r++) {
                    var sC = asCol[r];
                    var sD = asData[r];
                    sHtml = sHtml +
                        "<tr><th>" + sC + "  " +
                        "</th>" +
                        "<td class='textLeft'>" + sD + "</td></tr>";
                }
                table.innerHTML = sHtml;


            }
            modal2.style.display = "block";

        }
        // Get the modal

        /************************************************************** */
        var modal = document.getElementById("myModal");
        var modal2 = document.getElementById("ticketModal");

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }

        var span2 = document.getElementsByClassName("close2")[0];
        span2.onclick = function() {
            modal2.style.display = "none";
        }


        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
    </script>

</body>

</html>