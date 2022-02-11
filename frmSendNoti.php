<?php
  
  session_start();

  error_reporting(E_ALL & ~E_NOTICE);
  include_once("rmxLineFunction.php");
  
  $CompanyUrl = COMPANY_URL;
  $RegisterUrl = REGISTER_URL;
  $CompanyCode = COMPANY_CODE;
  $LiffId = LIFF_ID;
  $LineSendUrl =LINESEND_URL;


    $RetCommand = '';
                 
    $CmdCommand= "call sp_main_select_lineId ('".$CompanyCode."')";
    $RetCommand =send_command($CompanyUrl,'','',$CmdCommand);       
    //echo '<script language="javascript">';
    //echo 'alert("'.$RetCommand.'")';
    //echo '</script>';

    $RetOption ="";
    
    
    if ($RetCommand) {
        //sLineId,sMobileNo,sUserName
        $asRow = [];
        $asRow = explode("^r", $RetCommand);
        
        $nRLen = count($asRow);          
        for ($n=0;$n<$nRLen;$n++) {
            $asCol = explode("^c", $asRow[$n]);            
            $RetOption = $RetOption
                ."<option id=".$asRow[$n]." >"
                    .$asCol[1].' - '.$asCol[2].' - '.$asCol[0]."</option>";
             
        }                    
    } 

    //echo '<script language="javascript">';
    //echo 'alert("'.$RetOption.'")';
    //echo '</script>';
    

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-language" content="en-th">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">


<title><?php echo $sTitle; ?></title>


 <link rel="stylesheet" href="style.css">

 <style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 30px; /* Location of the box */
        padding-bottom: 30px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 90%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 10px;
        border: 1px solid #888;
        width: 90%;

        height: 100%; 
        overflow: auto; 
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }


    .modal2 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 999; /* Sit on top */
        padding-top: 10px; /* Location of the box */
        padding-bottom: 10px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal2-content {
        background-color: #fefefe;
        margin: auto;
        padding: 10px;
        border: 1px solid #888;
        width: 90%;

        height: 100%; 
        overflow: auto; 
    }

    .close2 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close2:hover,
    .close2:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }


    #loader {
        clear:both;
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 999;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        border-right: 16px solid green;
        border-bottom: 16px solid red;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }


    table#tblList {
        border-collapse: collapse;
        width: 100%;
        background:#ccc;
        height: 90%;
        overflow: auto; 
    }


    table#tblList th,table#tblList td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    table#tblList td {
        Font-size: 11px;    
    }

    table#tblList  th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
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


    #tblTicket {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #tblTicket td, #tblTickets th {
        
        border: 1px solid black;
        padding: 8px;
    }


    #tblTicket th {
        /*padding-top: 12px;*
        /*padding-bottom: 12px;*/        
        text-align: right;
        /*background-color: #04AA6D;*/
        color: blue;
    }


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



</style>
</head>
<body>

<form class="animate" method="GET" enctype="multipart/form-data" >
       
    <div class="login_container">
                                   
            <label for="txtLineId"><b>Select Mobile</b></label>
            <br>
            <input list="dtMobileNo" id="lblMobileNo" 
            style=' width: 100%;padding: 12px 20px;margin: 8px 0;
                display: inline-block;border: 1px solid #ccc;
                box-sizing: border-box;color:#000;'
                onchange="onDataListChange('lblMobileNo');">
            <datalist id="dtMobileNo">
                <?php echo $RetOption; ?>
            </datalist>

            <br>
            <label for="psw"><b>Line Id</b></label>
            <input type="text" id="txtLineId"  readonly>

            <br>
            <label for="psw"><b>Mobile No</b></label>
            <input type="text" id="txtMobileNo"  readonly>

            <br>
            <label for="psw"><b>User Name</b></label>
            <input type="text" id="txtUser"  readonly>

            <br>
            <label for="txtTicketNo"><b>Message</b></label>
            <input type="text" id="txtMessage" value ="">
            
            <button type="button"  id="btnSearch" 
                onclick="SendClick()">Send To Line</button>                                      
    </div>
        
</form>

<input type="hidden" id="txtLineSendUrl" value ="<?php echo $LineSendUrl; ?>" >

<script>

 
    function onDataListChange(sId) {
        var txt = document.getElementById(sId);
        var sValue =txt.value;
        var sId =getDataList("dtMobileNo",sValue);
        if (sId) {
            var txtMobileNo = document.getElementById("txtMobileNo");
            var txtLineId = document.getElementById("txtLineId");
            var txtUser = document.getElementById("txtUser");
            var arTmp = sId.split("^c");
            
            txtLineId.value = arTmp[0];
            txtMobileNo.value = arTmp[1];
            txtUser.value = arTmp[2];
            
        }
        //alert(sId);
    }
    
    function getDataList(sId,sValue) {
        var sNo = "";
        var opt = document.getElementById(sId)
        if (opt)
        {
            var nLen = opt.options.length;
            for (var n=0;n<nLen;n++ )
            {
                if (opt.options[n].value === sValue)
                {
                    sNo = opt.options[n].id;
                    break;
                } 
            } 
        } //if (opt)
        return sNo;
    }


    function SendClick(){
                
        var txtMobileNo = document.getElementById("txtMobileNo");
        var txtLineId = document.getElementById("txtLineId");
        var txtUser = document.getElementById("txtUser");
        var txtMessage = document.getElementById("txtMessage");
        
        if (txtMobileNo.value ==""){
            alert("Please select line id before click send");
            return;
        }

        if (txtLineId.value ==""){
            alert("Please select line id before click send");
            return;
        }

        if (txtMessage.value ==""){
            alert("Please select line id before click send");
            return;
        }
        
        var sPara = "type=push&msg=" +encodeURIComponent(txtMessage.value) 
            +"&userId="+txtLineId.value;
        sendUrl(sPara);



        //https://rmxline.herokuapp.com/rmxsend.php?msg=123456789 test &userId=Ucd102187a2dfb7494ea9d723a5ae4041&type=push

    
        
    }

    function sendUrl(sPara){

        var request = new XMLHttpRequest();
        request.timeout = 30000; // 3 seconds
        request.ontimeout = () => console.log('timeout', request.responseURL);

        request.onreadystatechange = function(response) {            
            if (request.readyState === XMLHttpRequest.DONE) {
                //var status = request.status;
                //if (status === 0 || (status >= 200 && status < 400)) {
                    alert(request.status + " " + request.responseText);
                //}
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

