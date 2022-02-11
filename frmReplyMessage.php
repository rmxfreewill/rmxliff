<?php
  
  header('Access-Control-Allow-Origin: *');
  session_start();

  error_reporting(E_ALL & ~E_NOTICE);
  include_once("rmxLineFunction.php");
  
  $CompanyUrl = COMPANY_URL;
  $RegisterUrl = REGISTER_URL;
  $CompanyCode = COMPANY_CODE;
  $LiffId = LIFF_ID;
  $LineSendUrl =LINESEND_URL;

    $StartDate = date("d/m/Y");
    $EndDate = date("d/m/Y");
  
  
    $RetCommand = '';
                 
    $CmdCommand= "call sp_comp_select_log ('L_LineRequest','','".$StartDate."','".$EndDate."')";
    $RetCommand =send_command($CompanyUrl,'LINE',$CompanyCode,$CmdCommand);       

    $RetTable ="";
  
    
    if ($RetCommand) {

        $RetTable="<table >"
            ."<tr><th>Line Id</th><th>Message</th><th>Request Date</th></tr>";
        //sLineId,sMobileNo,sUserName
        $asRow = [];
        $asRow = explode("^r", $RetCommand);
        
        $nRLen = count($asRow);          
        for ($n=0;$n<$nRLen;$n++) {
            $asCol = explode("^c", $asRow[$n]);            
                                                      
            $RetTable=$RetTable
                ."<tr onclick=\"onRowClick('".$asCol[0]."');\">
                    <td>".$asCol[0]."</td><td>".$asCol[1]."</td><td>".$asCol[2]."</td>
                </tr>";
        }       
        
        $RetTable=$RetTable."</table>";
    } 

    //echo '<script language="javascript">';
    //echo 'alert("'.$RetOption.'")';
    //echo '</script>';
    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-language" content="en-th">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">




<style>
  

  * {box-sizing: border-box}

    /* Set height of body and the document to 100% */
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial;
    }

   

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    /*--------------------------------------------*/

    input[type=text], input[type=password]
        ,input[type=date],input[type=email],input[type=tel] {
        width: 100%;
        padding: 6px 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        color:#000;
    }

    label {
        color:#000;

    }
    /*--------------------------------------------*/

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        color:#000;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
        color:#000;
    }

    /******************************************************** */


    input[type="date"]::-webkit-datetime-edit-text
    {
        color: transparent;    
    }




    /*------- DatePicker ------------------------*/
    input[type="date"] {
        background-color: #ffffff;
        border-radius: 4px;
        border: 1px solid #8c8c8c;
        /* font-weight: 900; */
    }





    /*------- DatePicker - Focus ------------------------*/
    input[type="date"]:focus 
    {
        outline: none;
        box-shadow: 0 0 0 3px rgba(21, 156, 228, 0.4);
    }


    input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
        color: #fff;
        position: relative;    
    }



    /*------- Year ------------------------*/
    input[type="date"]::-webkit-datetime-edit-year-field {
        position: absolute !important;
        border-left: 1px solid #8c8c8c;
        padding: 2px;
        color: #000;
        left: 56px;
    }


    /*------- Month ------------------------*/
    input[type="date"]::-webkit-datetime-edit-month-field {
        position: absolute !important;
        border-left: 1px solid #8c8c8c;
        padding: 2px;
        color: #000;
        left: 26px;
    }



    /*------- Day ------------------------*/
    input[type="date"]::-webkit-datetime-edit-day-field {
        position: absolute !important;
        color: #000;
        padding: 2px;
        left: 4px;
    }



    table#tblList {
        border-collapse: collapse;
        width: 100%;
        background:#ccc;
        height: 400px;
    }


    table#tblList td {
        Font-size: 13px;    
    }


    table#tblList tr:nth-child(even) {
        background-color: #eee;
    }
    table#tblList tr:nth-child(odd) {
        background-color: #fff;
    }
    table#tblList th {
        background-color: black;
        color: white;
    }



</style>
</head>
<body>

<div style="width: 98%;padding: 0px 20px 0px 20px;">

    <h2 >Send Line Notification (Link to Line Message API)</h2>
    <p>Send to line Notification</p>


    <div id="tabList" style="height: 50%; text-align: right;
                padding: 0px 2px 0px 2px; display: block;" >
        <h3 style="color:#000;">Line Id List</h3>
      
            <?php echo $RetTable; ?>                       
      
    </div>
    <button type="button" id="btnLoop"
        onclick="onStopRefreshClick()"
        style='background-color:#3361FF;font-size: 17px;'>Stop Refresh</button> 

    <p id="demo"></p>

</div>

<input type="hidden" id="txtLineSendUrl" value ="<?php echo $LineSendUrl; ?>" >
<input type="hidden" id="txtCompanyUrl" value ="<?php echo $CompanyUrl; ?>" >
<input type="hidden" id="txtCompanyCode" value ="<?php echo $CompanyCode; ?>" >



<script>

    var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
    var btnLoop = document.getElementById("btnLoop");
    btnLoop.value = "Stop Refresh";
    var timeLoop=StartTimer();

    // Update the count down every 1 second
    function StartTimer() {
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            //document.getElementById("demo").innerHTML = days + "d " + hours + "h "
            //+ minutes + "m " + seconds + "s ";
            location.reload(true);
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 5000);
        return x;
    }
    

    function onStopRefreshClick(){

        var btnLoop2 = document.getElementById("btnLoop");
        //alert("["+btnLoop.innerHTML+","+btnLoop.value+"]");
        
        if (btnLoop2.innerHTML == "Stop Refresh") {
            clearInterval(timeLoop);
            btnLoop2.value = "Start Refresh";
            btnLoop2.innerHTML = "Start Refresh";
        } else {
            timeLoop=StartTimer();
            btnLoop2.value = "Stop Refresh";
            btnLoop2.innerHTML = "Stop Refresh";
        }

    }

    function onRowClick(lineId){
        //alert(lineId);
        clearInterval(timeLoop);
        var msg = prompt("Please enter message for reply", "");
        if (msg != null) {
            if (msg.length >0){
                var sPara = "type=push&msg=" +encodeURIComponent(msg) +"&userId="+lineId;
                sendUrl(sPara);
                timeLoop=StartTimer();
            } else {
                timeLoop=StartTimer();
            }
        } else {
            timeLoop=StartTimer();
        }
    }
   




    function sendUrl(sPara){

        var request = new XMLHttpRequest();
        request.timeout = 30000; // 3 seconds
        request.ontimeout = () => console.log('timeout', request.responseURL);

        request.onreadystatechange = function(response) {            
            if (request.readyState === XMLHttpRequest.DONE) {
                alert("Send OK (" + request.status + ")");
                //alert(request.status + " " + request.responseText);
            }
        };

      
      ////https://rmxline.herokuapp.com/rmxsend.php?msg=123456789 test &userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push
        //var enSql = encodeURIComponent(window.btoa(encodeURIComponent(sql)));
        var txtLineSendUrl = document.getElementById("txtLineSendUrl");
        var sURL = txtLineSendUrl.value +'?'+sPara;

        request.open('GET', sURL);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();

    }



</script>
   
</body>
</html> 
