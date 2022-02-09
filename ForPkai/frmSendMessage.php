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


    $RetCommand = '';
                 
    $CmdCommand= "call sp_main_select_lineId ('".$CompanyCode."')";
    $RetCommand =send_command($CompanyUrl,'','',$CmdCommand);       

    $RetOption ="";
    $RetCheckBox ="";
    $RetTable ="";
    
    if ($RetCommand) {

        $RetTable="<table >"
            ."<tr><th>Line Id</th><th>Mobile No</th><th>user Name</th></tr>";
        //sLineId,sMobileNo,sUserName
        $asRow = [];
        $asRow = explode("^r", $RetCommand);
        
        $nRLen = count($asRow);          
        for ($n=0;$n<$nRLen;$n++) {
            $asCol = explode("^c", $asRow[$n]);            
            $RetOption = $RetOption
                ."<option id=".$asRow[$n]." >"
                    .$asCol[1].' - '.$asCol[2].' - '.$asCol[0]."</option>";

            $RetCheckBox = $RetCheckBox
                ."<input type='checkbox' class='chk' id='".$asCol[0]."' value='".$asCol[0]."'>"
                ."<label >".$asCol[1].' - '.$asCol[2].' - '.$asCol[0]."</label><br>";
                                             
            $RetTable=$RetTable
                ."<tr><td>".$asCol[0]."</td><td>".$asCol[1]."</td><td>".$asCol[2]."</td></tr>";                                
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

    /* Style tab links */
    .tablink {
        background-color: #555;
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 7px 8px;
        font-size: 17px;
        width: 25%; 
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: white;
        display: none;  
        padding: 0px 10px 0px 10px;
        height: 100%;
        width: 100%;
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

    <div style="width: 100%;padding: 0px 10px 0px 10px;">
        <button class="tablink" onclick="openPage('tabPush', this)" id="defaultOpen">Send by Push</button>
        <button class="tablink" onclick="openPage('tabMulticast', this)" >Send by Multicast</button>
        <button class="tablink" onclick="openPage('tabList', this)">Line Id List</button>
        <button class="tablink" onclick="openPage('tabSendLog', this)">Send Log</button>
    </div>

    <div id="tabPush" class="tabcontent">
     <h3 style="color:#000;">Send by Push</h3>
                                   
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
            
            <button type="button"  id="btnPushSend" 
                onclick="pushSendClick()">Send To Line (Push)</button>                                      
        
    </div>

    <div id="tabMulticast" class="tabcontent">
        <h3 style="color:#000;">Send by Multicast</h3>
        
            <label for="txtLineId"><b>Select Mobile</b></label>
            <br>

            <fieldset>
                <?php echo  $RetCheckBox; ?>                  
              
             </fieldset>       
            <br>
            <label for="txtMultiMessage"><b>Message</b></label>
            <input type="text" id="txtMultiMessage" value ="">
            
            <button type="button"  id="btnMulitSend" 
                onclick="multiSendClick()">Send To Line (Multicast)</button>                                      
       
    </div>

    <div id="tabList" class="tabcontent">
        <h3 style="color:#000;">Line Id List</h3>
      
            <?php echo $RetTable; ?>                       
      
    </div>

    <div id="tabSendLog" class="tabcontent">
        <h3 style="color:#000;">Send Log</h3>
      
        <fieldset>
        <div style="display: flex;flex-direction: row; width: 100%; ">
      
            <label style="float: left; width: 15%; text-align:center;
                padding: 6px 6px 0px 6px; display: block;">Start Date</label>
                <input type="date" size='14' title='d-MMM-yyyy' "
                style="float: right; width: 25%; text-align: 	
                        right;padding: 2px 2px 2px 2px; display: block;"
                placeholder="Start Date"
                name="dStart" id="dpcStart" 
                value="<?php echo date("Y-m-d"); ?>"
                autocomplete=off ">
                
            <label style="float: left; width: 15%; text-align:center; 
                padding: 6px 6px 0px 6px;display: block;">End Date</label>
                <input type="date" size='14' title='d-MMM-yyyy' "
                style="float: right; width: 25%; text-align: 	
                    right;padding: 2px 2px 2px 2px; display: block;"
                placeholder="End Date"
                name="dEnd" id="dpcEnd" 
                value="<?php echo date("Y-m-d"); ?>"
                autocomplete=off ">

            <div  style="float: right; width: 20%; text-align: right;
                padding: 0px 2px 0px 2px; display: block;">
                <button type="button" 
                onclick="onSelectDataClick()"
                style='background-color:#3361FF;font-size: 17px;' > Select Data </button> 
            </div>	 		

          
        </div>
    </fieldset>
    <div style="background-color:#E0E0E0;
                overflow:scroll;position:relative;width: 100%;height: 100%;">
                <table id="tblList"  name="tblList"  >
                <thead style="Font-size: 14px;">
                    <tr>
                    <th ><span style="Font-size: 14px;" >Line Id</span></th>
                    <th ><span style="Font-size: 14px;" >Message</span></th>
                    <th ><span style="Font-size: 14px;" >Date Time</span></th>
                    </tr>
                </thead>
                </table>
            </div>
      
    </div>

</div>

<input type="hidden" id="txtLineSendUrl" value ="<?php echo $LineSendUrl; ?>" >
<input type="hidden" id="txtCompanyUrl" value ="<?php echo $CompanyUrl; ?>" >
<input type="hidden" id="txtCompanyCode" value ="<?php echo $CompanyCode; ?>" >



<script>
   
    function openPage(pageName,elmnt) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        
        document.getElementById(pageName).style.display = "block";
        
    }

    //openPage('tabPush', '');

// Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();


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


    function pushSendClick(){
                
        var txtMobileNo = document.getElementById("txtMobileNo");
        var txtLineId = document.getElementById("txtLineId");
        var txtUser = document.getElementById("txtUser");
        var txtMessage = document.getElementById("txtMessage");
        
        if (txtMobileNo.value ==""){
            alert("Please select mobile no before click send");
            return;
        }

        if (txtLineId.value ==""){
            alert("Please select line id before click send");
            return;
        }

        if (txtMessage.value ==""){
            alert("Please enter message before click send");
            return;
        }
        
        var sPara = "type=push&msg=" +encodeURIComponent(txtMessage.value) 
            +"&userId="+txtLineId.value;
        sendUrl(sPara);
    
        
    }
    

    function multiSendClick(){
                
    
        var idList = document.getElementsByClassName('chk');

        var asLineId ="";
        var i;
        for (i = 0; i < idList.length; i++) {
            var chk = idList[i];
            if (chk.checked == true){
                if (asLineId !="") asLineId= asLineId+"^";
                asLineId = asLineId + chk.id;
            }
        }
        if (asLineId ==""){
            alert("Please select line id before click send");
            return;
        }

        if (txtMultiMessage.value ==""){
            alert("Please enter message before click send");
            return;
        }
       
        
        var sPara = "type=multi&msg=" +encodeURIComponent(txtMultiMessage.value) 
            +"&userId="+asLineId;
        sendUrl(sPara);
    
            
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

    function onSelectDataClick(){
        var dpc = input = document.getElementById("dpcStart");
        var date = new Date(dpc.value);
        var sStartDate=date.getDate()+ "/"+(date.getMonth()+1)+ "/"+date.getFullYear();

        
        dpc = input =  document.getElementById("dpcEnd");
        date = new Date(dpc.value);
        var sEndDate=date.getDate()+ '/'+(date.getMonth()+1)+ '/'+date.getFullYear();
        
        var sSql = "call sp_comp_select_log('L_LineSend','','"+sStartDate+"','"+sEndDate+"');";
        
        //onGet(sSql);
        sendSQLToLineDB(sSql);

    }

    function sendSQLToLineDB(sPara){

        var request = new XMLHttpRequest();
        request.timeout = 30000; // 3 seconds
        request.ontimeout = () => console.log('timeout', request.responseURL);

        request.onreadystatechange = function(response) {            
            if (request.readyState === XMLHttpRequest.DONE) {
                var status = request.status;
                if (status === 0 || (status >= 200 && status < 400)) {
                    alert(request.responseText);
                }
            }
        };

        alert(sPara);
        //var enSql = encodeURIComponent(window.btoa(encodeURIComponent(sPara)));
        var enSql =encodeURIComponent(sPara);
        var sURL = document.getElementById("txtCompanyUrl").value;
        var sCompanyCode = document.getElementById("txtCompanyCode").value;

        var sSend =  "LineId=LineID&CompanyCode="+sCompanyCode+"&Command="+enSql;    
        sURL = sURL+ "?" + sSend; 
        alert(sURL);
        console.log(sURL);
        

        request.open('GET', sURL,true);
        request.withCredentials = true;
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");        
        request.setRequestHeader('Access-Control-Allow-Credentials', 'true');        
        request.send();

        //header("Access-Control-Allow-Origin: http://localhost:4200");
        //header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        //header("Access-Control-Allow-Headers: Content-Type, Authorization");

       // request.open('POST', sURL, true);
        //request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.send();


    }

    function onGet(sPara) {

        //const url = "http://localhost:8000/api/" + version + "/messages";
        var enSql =encodeURIComponent(sPara);
        var sURL = document.getElementById("txtCompanyUrl").value;
        var sCompanyCode = document.getElementById("txtCompanyCode").value;

        var sSend =  "LineId=LineID&CompanyCode="+sCompanyCode+"&Command="+enSql;    
        sURL = sURL+ "?" + sSend; 

        /*
        var headers = {"Access-Control-Allow-Origin: *"
        ,"Access-Control-Allow-Methods: GET, POST, OPTIONS"
        ,"Access-Control-Allow-Headers: Content-Type, Authorization"};
        */
        var headers = {};
        
        fetch(sURL, {
            method : "GET",
            mode: 'cors',
            headers: headers
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error(response.error)
            }
            return response.json();
        })
        .then(data => {
            alert(data.messages);
            //document.getElementById('messages').value = data.messages;
        })
        .catch(function(error) {
            alert(error);
            //document.getElementById('messages').value = error;
        });
    }


</script>
   
</body>
</html> 
