
<?php

    header('Content-Type: text/html; charset=utf-8');
    ini_set('memory_limit', '-1');
    session_start();

    error_reporting(E_ALL & ~E_NOTICE);
    ob_start();

    include_once ('rmxQueryFunctions.php');

    $URLMYSQL = RMXURLMYSQL;
    $DB=RMXDB;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>RMX MySQL Tools</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-language" content="en-th">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">
<link rel="Stylesheet" type="text/css" href="rmxcss.css" media="screen">



<!-- ********************************************************************* -->

</head>
<body>

<form id="rmxDBTool" action="rmxDBTool.php" class="appnitro" method="get" enctype="multipart/form-data">

    
<div class="row" id="divMain">
        
    <div class="column_3" style="background-color:#E0E0E0;" >
        
        <div style="background-color:#E0E0E0;
            display: table;width: 100%;height: 20px; padding: 2px;">
            <div style="float: left;width: 45%;">          
                <div style="display: table-cell; width: 100%; ">            
                    <input id="txtShop" placeholder="Select Shop"
                        style="padding: 2px;width: 65%" list="dtShop"  multiple=""  
                        onChange="onDataListChange()"
                        data-list='{"valueCompletion": true, "highlight": true}' >  
                        <datalist id="dtShop" autocomplete=true >  
                        </datalist>                    
                    <input type="button" value="Clear" 
                        onclick="document.getElementById('txtShop').value = ''" />
                </div>
            </div>
            
            <div style="float: left;width: 55%;">
            <label for="txtFilter" style="Font-size: 10px; width:40px;" >Filter:</label>
            <input type="text" id="txtFilter1" style="Font-size: 10px; width:20px;" 
                value="%">
            <input type="text" id="txtFilter" style="Font-size: 12px; width:90px;" >
            <input type="text" id="txtFilter2" style="Font-size: 10px; width:20px;" 
                value="%">
            <button type="button" id="tablebtn" style="Font-size: 10px; width:30px;">OK</button>
        </div>
          
        </div>

        <div style="background-color:#E0E0E0;
            overflow:scroll;position:relative;width: 100%;height: 85%;">
            <table id="tblList"  name="tblList"  >
            <thead style="Font-size: 10px;">
                <tr>
                <th ><span style="Font-size: 10px;" >Table Name</span></th>
                <th ><span style="Font-size: 10px;" >Rec Count</span></th>
                </tr>
            </thead>
            </table>
        </div>
    </div>
    
    <div class="column_1"  id="divMainResult" style="background-color:#E0E0E0;">
            
        <div class="scrollmenu" 
            style="background-color:#f1f1f1;height:20px; width:100% ">
                            
            <button type="button" id="spbtn">SP List</button>
            <button type="button" id="fnbtn" >FN List</button>
            <button type="button" id="findbtn">Find SP</button>
            <button type="button" id="viewbtn" >View SP</button>
            <button type="button" id="fieldbtn">Field</button>
            <button type="button" id="findFNbtn">Find FN</button>
            <button type="button" id="viewFNbtn" >View FN</button>

            
        </div>

        <div class="tab2" id="divMainSQLTab" >

            <button class="tabBtn" type="button" id="btnQuery1" 
                onclick="openTabFuncResult(event, 'tabFunc','tabBtn','divQuery1','btnQuery1','btnD1')">SQL 1</button>
            <button class="tabBtn" type="button" id="btnQuery2" 
                onclick="openTabFuncResult(event, 'tabFunc','tabBtn','divQuery2','btnQuery2','btnD2')">SQL 2</button>
            <button class="tabBtn" type="button" id="btnQuery3" 
                onclick="openTabFuncResult(event, 'tabFunc','tabBtn','divQuery3','btnQuery3','btnD3')">SQL 3</button>
            <button class="tabBtn" type="button" id="btnQuery4" 
                onclick="openTabFuncResult(event, 'tabFunc','tabBtn','divQuery4','btnQuery4','btnD4')">SQL 4</button>

            <button class="tabBtn" type="button" id="btnQuery5" 
                onclick="openTabFuncResult(event, 'tabFunc','tabBtn','divQuery5','btnQuery5','btnD5')">SQL 5</button>
            <button class="tabBtn" type="button" id="btnQuery6" 
                onclick="openTabFuncResult(event, 'tabFunc','tabBtn','divQuery6','btnQuery6','btnD6')">SQL 6</button>


        </div>

        
        <div id="divQuery1" class="tabFunc" style="height:90px; width:100% 
            ;z-index: 100;">
            <textarea id="txtSQL1" name="txtSQL1" 
            placeholder="Write something.." 
            style="height:120px; width:100% "></textarea>
            <div class="scrollmenu" 
                style="background-color:#f1f1f1;height:25px; width:100% ">                    
                <button type="button" id="submitbtn" 
                    onclick="sendSubmitCommand('1')" >Submit 1</button>
                <button type="button" id="executebtn"
                    onclick="sendExecuteCommand('1')">Execute 1</button>
                <button type="button" id="clearbtn"
                onclick="sendClearTextCommand('1')">clear 1</button>
                
            </div>
        </div>
    
        <div id="divQuery2" class="tabFunc" style="height:90px; width:100% 
            ;z-index: 100;">
            <textarea id="txtSQL2" name="txtSQL2" 
            placeholder="SQL 2" 
            style="height:120px; width:100% "></textarea>
            <div class="scrollmenu" 
                style="background-color:#f1f1f1;height:25px; width:100% ">
                <button type="button" id="submitbtn2" 
                    onclick="sendSubmitCommand('2')">Submit 2</button>
                <button type="button" id="executebtn2"
                    onclick="sendExecuteCommand('2')">Execute 2</button>
                <button type="button" id="clearbtn2"
                onclick="sendClearTextCommand('2')">clear 2</button>
                
                                                 
            </div>
        </div>
    
        <div id="divQuery3" class="tabFunc" style="height:90px; width:100% 
            ;z-index: 100;">
            <textarea id="txtSQL3" name="txtSQL3" 
            placeholder="SQL 3" 
            style="height:120px; width:100% "></textarea>
            <div class="scrollmenu" 
                style="background-color:#f1f1f1;height:25px; width:100% ">
                <button type="button" id="submitbtn3" 
                    onclick="sendSubmitCommand('3')">Submit 3</button>
                <button type="button" id="executebtn3"
                    onclick="sendExecuteCommand('3')">Execute 3</button>
                <button type="button" id="clearbtn3"
                onclick="sendClearTextCommand('3')">clear 3</button>
                                                     
                
            </div>
        </div>
    

        <div id="divQuery4" class="tabFunc" style="height:90px; width:100% 
            ;z-index: 100;">
            <textarea id="txtSQL4" name="txtSQL4" 
            placeholder="SQL 4" 
            style="height:120px; width:100% "></textarea>
            <div class="scrollmenu" 
                style="background-color:#f1f1f1;height:25px; width:100% ">
                <button type="button" id="submitbtn4" 
                    onclick="sendSubmitCommand('4')">Submit 4</button>
                <button type="button" id="executebtn4"
                    onclick="sendExecuteCommand('4')">Execute 4</button>
                <button type="button" id="clearbtn4"
                onclick="sendClearTextCommand('4')">clear 4</button>
               
                     
            </div>
        </div>
    

        <div id="divQuery5" class="tabFunc" style="height:90px; width:100% 
            ;z-index: 100;">
            <textarea id="txtSQL5" name="txtSQL5" 
            placeholder="SQL 5" 
            style="height:120px; width:100% "></textarea>
            <div class="scrollmenu" 
                style="background-color:#f1f1f1;height:25px; width:100% ">
                <button type="button" id="submitbtn5" 
                    onclick="sendSubmitCommand('5')">Submit 5</button>
                <button type="button" id="executebtn5"
                    onclick="sendExecuteCommand('5')">Execute 5</button>
                <button type="button" id="clearbtn5"
                onclick="sendClearTextCommand('5')">clear 5</button>
               
                                                                 
            </div>
        </div>

        <div id="divQuery6" class="tabFunc" style="height:90px; width:100% 
            ;z-index: 100;">
            <textarea id="txtSQL6" name="txtSQL6" 
            placeholder="SQL 6" 
            style="height:120px; width:100% "></textarea>
            <div class="scrollmenu" 
                style="background-color:#f1f1f1;height:25px; width:100% ">
                <button type="button" id="submitbtn6" 
                    onclick="sendSubmitCommand('6')">Submit 6</button>
                <button type="button" id="executebtn6"
                    onclick="sendExecuteCommand('6')">Execute 6</button>
                <button type="button" id="clearbtn6"
                    onclick="sendClearTextCommand('6')">clear 6</button>
              
                
            </div>
        </div>

    </div>

</div>


    <div class="tab2" id ="divMainTab">

        <button type="button" class="tabBtnDisplay" id="btnE1" 
            onclick="openTabFunc(event, 'tabDisplay','tabBtnDisplay'
                ,'divInfo','btnE1')">Info</button>
        
        <button class="tabBtnDisplay active" type="button" id="btnD1" 
                onclick="openTabFunc(event, 'tabDisplay','tabBtnDisplay'
                ,'divResult1','btnD1')">Result 1</button>
                
        <button class="tabBtnDisplay" type="button" id="btnD2" 
                onclick="openTabFunc(event, 'tabDisplay','tabBtnDisplay'
                ,'divResult2','btnD2')">Result 2</button>

                
        <button class="tabBtnDisplay" type="button" id="btnD3" 
                onclick="openTabFunc(event, 'tabDisplay','tabBtnDisplay'
                ,'divResult3','btnD3')">Result 3</button>


                
        <button class="tabBtnDisplay" type="button" id="btnD4" 
                onclick="openTabFunc(event, 'tabDisplay','tabBtnDisplay'
                ,'divResult4','btnD4')">Result 4</button>

                
        <button class="tabBtnDisplay" type="button" id="btnD5" 
                onclick="openTabFunc(event, 'tabDisplay','tabBtnDisplay'
                ,'divResult5','btnD5')">Result 5</button>

        <button class="tabBtnDisplay" type="button" id="btnD6" 
                onclick="openTabFunc(event, 'tabDisplay','tabBtnDisplay'
                ,'divResult6','btnD6')">Result 6</button>



        
    </div>

    <div class="tabDisplay" id="divResult1" style="overflow:auto;resize: both;display: none;
        padding: 2px 2px 2px 2px;border: 1px solid #ccc;border-top: none; " >
    </div>

    <div class="tabDisplay" id="divResult2" style="overflow:auto;resize: both;display: none;
        padding: 2px 2px 2px 2px;border: 1px solid #ccc;border-top: none; " >
    </div>		

    <div class="tabDisplay" id="divResult3" style="overflow:auto;resize: both;display: none;
        padding: 2px 2px 2px 2px;border: 1px solid #ccc;border-top: none; " >
    </div>		

    <div class="tabDisplay" id="divResult4" style="overflow:auto;resize: both;display: none;
        padding: 2px 2px 2px 2px;border: 1px solid #ccc;border-top: none; " >
    </div>		


    <div class="tabDisplay" id="divResult5" style="overflow:auto;resize: both;display: none;
        padding: 2px 2px 2px 2px;border: 1px solid #ccc;border-top: none; " >
    </div>		



    <div class="tabDisplay" id="divResult6" style="overflow:auto;resize: both;display: none;
        padding: 2px 2px 2px 2px;border: 1px solid #ccc;border-top: none; " >
    </div>		

    <div class="tabDisplay" id="divInfo" style="overflow:auto;display: none; 
        padding: 2px 2px 2px 2px;border: 1px solid #ccc;border-top: none;" >
        <div class="tab" id="divTabInfo">
            <button type="button" class="tablinks active" id ="btnTabSP"
                onclick="openTabDiv(event,'divTabSP','taballdb','btnTabSP','tablinks')">SP List</button>
            <button type="button" class="tablinks" id ="btnTabFN"
                onclick="openTabDiv(event,'divTabFN','taballdb','btnTabFN','tablinks')">FN List</button>
            <button type="button" class="tablinks" id ="btnTabData"
                onclick="openTabDiv(event,'divTabData','taballdb','btnTabData','tablinks')">Info List</button>

            <button type="button" class="tablinks" id ="btnTabFind"
                onclick="openTabDiv(event,'divTabFind','taballdb','btnTabFind','tablinks')">Find List</button>

        </div>
        <div class="taballdb" id="divTabSP" style="overflow:auto;display: none;" >
            <table id="tblSP"  name="tblSP"  >
            <thead style="Font-size: 12px;">
                <tr>
                <th ><span style="Font-size: 12px;" >SP List</span></th>
                </tr>
            </thead>
            </table>
        </div>
        <div class="taballdb" id="divTabFN" style="overflow:auto;display: none;" >
            <table id="tblFN"  name="tblFN"  >
            <thead style="Font-size: 12px;">
                <tr>
                <th ><span style="Font-size: 12px;" >FN List</span></th>
                </tr>
            </thead>
            </table>
        </div>
      
        <div class="taballdb" id="divTabData" style="overflow:auto;display: none;" >
        </div>


        <div class="taballdb" id="divTabFind" style="overflow:auto;display: none;" >
            <table id="tblFind"  name="tblFind"  >
            <thead style="Font-size: 12px;">
                <tr>
                <th ><span style="Font-size: 12px;" >Find List</span></th>
                </tr>
            </thead>
            </table>
        </div>

    </div>





<div id="loader" style="display:none;"></div>
<div id="divSqlTemp" style="display:none;">
    <input type='text' id='txtHSQL1' style="display:none;">
    <input type='text' id='txtHSQL2' style="display:none;">
    <input type='text' id='txtHSQL3' style="display:none;">
    <input type='text' id='txtHSQL4' style="display:none;">
    <input type='text' id='txtHSQL5' style="display:none;">
    <input type='text' id='txtHSQL6' style="display:none;">
</div>


</form>


<div id="divSPView" class="modal" style="display: none;">
<form class="modal-content animate" method="post"
    enctype="multipart/form-data" autocomplete="off" id ="frmSPView" >
<div class="imgcontainer">
<span onclick="document.getElementById('divSPView').style.display='none'" 
    class="close" title="Close Modal">&times;</span>
</div>

    <div >        
        <textarea id="txtSPView" name="txtSPView" placeholder="View something.." 
                style="height:100%; width:100%;"
                rows="35"  maxlength="50000"></textarea>

    </div>

</form>
</div>


<div id="divTableView" class="modal" style="display: none;height:98%;">
<form class="modal-content animate" method="post"
    enctype="multipart/form-data" autocomplete="off" id ="frmTableView" >
<div class="imgcontainer">
    <span onclick="document.getElementById('divTableView').style.display='none'" 
    class="close" title="Close Modal">&times;</span>

</div>
            
    <div class="container" style="height:95%;">
        <table id="tblTBField"  name="tblTBField" style="height:90%;" >
        <thead style="Font-size: 12px;">
            <tr>
            <th ><span style="Font-size: 12px;" >Field Name</span></th>
            </tr>
        </thead>
        </table>
    </div>

</form>
</div>


<div id="divEditView" class="modal" style="display: none;">
<form class="modal-edit animate" method="post"
    enctype="multipart/form-data" autocomplete="off" id ="frmEditView" >
<div class="imgcontainer">
    <span onclick="document.getElementById('divEditView').style.display='none'" 
        class="close" title="Close Modal">&times;</span>
</div>
    <div class="container">
                     
         <textarea id='txtEditView'  style='width:98%'
                style="height:30px; width:100%; "></textarea>
        <table id="tblEditTB"  name="tblEditTB"  >
        <thead style="Font-size: 10px;">
            <tr>
            <th ><span style="Font-size: 10px;" >Field Name</span></th>
            </tr>
        </thead>
        </table>
    

    </div>

</form>
</div>




<div id="divEditData" class="modal" style="display: none;">
<form class="modal-editdata animate" method="post"
    enctype="multipart/form-data" autocomplete="off" id ="frmEditData" >
<div class="imgcontainer">
    <span onclick="document.getElementById('divEditData').style.display='none'" 
        class="close" title="Close Modal">&times;</span>
</div>
    <!-- <label id="lblEditData" >test</label> -->

    <div align='left'  >
    <button type='button' id='btnEditInsert'  
    onclick="insertEditData('" +sTable+"','tblEditData','divEditData')">Insert  </button>		
    <input type='text' id='txtEditInsert'  style='width:92%;Height:30px;'>
    </div>
    
    <div align='left' >
    <button type='button' id='btnEditUpdate' 
    onclick="insertEditData('" +sTable+"','tblEditData','divEditData')">Update</button>		
    <input type='text' id='txtEditUpdate'  style='width:92%;Height:30px;'>
    </div>
    <div class="container">
        <table id="tblEditData"  name="tblEditData"  >
        <thead style="Font-size: 10px;">
        
            <tr>
            <th ><span style="Font-size: 10px;" >Field Name</span></th>
            <th ><span style="Font-size: 10px;" >Data</span></th>
            </tr>
        </thead>
        </table>
    

    </div>

</form>
</div>


<div id="divInsertView" class="modal" style="display: none;">
<form class="modal-edit animate" method="post"
    enctype="multipart/form-data" autocomplete="off" id ="frmInsertView" >
<div class="imgcontainer">
    <span onclick="document.getElementById('divInsertView').style.display='none'" 
        class="close" title="Close Modal">&times;</span>
</div>
    <div align='left'>
    <input type="button" value="copy"
    onclick="selectElementContents( document.getElementById('tblInsertTB') );">
    <label id="lblInsertView" >test</label>
    </div>
    <div class="container">
        
        <table id="tblInsertTB"  name="tblInsertTB"  >
        <thead style="Font-size: 10px;">
            <tr>
            <th ><span style="Font-size: 10px;" >Field Name</span></th>
            </tr>
        </thead>
        </table>
    

    </div>

</form>
</div>

<input id="txtEditSQL" type="hidden" >
<input id="txtLoadPos" type="hidden" >


<script>


var _URLMYSQL ="<?php echo $URLMYSQL; ?>";
var _DB ="<?php echo $DB; ?>";

/* ---------------------------------------------------------- */



resizeElementHeight("divResult1","divMainTab");
resizeElementHeight("divResult2","divMainTab");
resizeElementHeight("divResult3","divMainTab");
resizeElementHeight("divResult4","divMainTab");
resizeElementHeight("divResult5","divMainTab");
resizeElementHeight("divResult6","divMainTab");


resizeElementHeight("divInfo","divMainTab");


openTabFunc('', 'tabFunc','tabBtn','divQuery1','btnQuery1');


var person = prompt("Please enter your name", "Harry Potter");

if (person != null) {
    checkData(person);
}

var tTime;

function openTabFuncResult(evt, tabContent,tabLink,divName,btnId,btnResultId) 
{
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName(tabContent);
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName(tabLink);
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(divName).style.display = "block";
    if (evt != '') {
    if (evt.currentTarget) {
        if (evt.currentTarget.className) {
            evt.currentTarget.className += " active";
        }
    }
    } else {
        if (document.getElementById(btnId).className)
            document.getElementById(btnId).className += " active";
    }

    if (btnResultId != '') {
        document.getElementById(btnResultId).click();
    }

}



function openTabFunc(evt, tabContent,tabLink,divName,btnId) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName(tabContent);
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName(tabLink);
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(divName).style.display = "block";
    if (evt != '') {
    if (evt.currentTarget) {
        if (evt.currentTarget.className) {
            evt.currentTarget.className += " active";
        }
    }
    } else {
        if (document.getElementById(btnId)) {
            if (document.getElementById(btnId).className)
                document.getElementById(btnId).className += " active";
        }

    }

}



function fillDataList(dataListId)
{

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(response) {
        if (RequestStatus(request)){

            

            var dataList = document.getElementById(dataListId);
            if (dataList) {		
                var sRet = request.responseText.trim();
            
                if (sRet.length >0){

                                    
                    //var sInner='';
                    var arRow = sRet.trim().split("$");
                    var nLen = arRow.length;             
                    //var dataList = document.getElementById(dataListId);       
                    for (var r=0;r<nLen;r++ )
                    {
                        if (r==0){
                            var option2 = document.createElement('option');
                            option2.id = "300001^RMX Main^u304817194_rmxmain^u304817194_rmx00^OKwefer2552";
                            option2.value = "RMX Main";
                            dataList.appendChild(option2);
                        } 
                        var option = document.createElement('option');
                        var asVal = arRow[r].trim().split("^");
                    
                        option.id = asVal;
                        option.value = asVal[1];
                        dataList.appendChild(option);

                    }
                    document.getElementById("txtShop").value = "RMX Main";
                    //dataList.innerHTML = sInner;
                }
                
            } else {
                console.log("not found  =[" + dataListId+"]");
            }
            hideLoader();
            
        }
    };

    showLoader();
    var sql="CALL sp_main_select_database('');";

    var sURL = 'http://' + window.location.hostname 
    + '/rmxDBFunction.php?functionname=queryMainCommand&values='+sql+'&table=tes';

    URLLog(sURL+"?"+sql);

    request.open('POST', sURL, true);
    //request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send();
    //request.send(sSend);


}

function fillAllDatabaseList()
{

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(response) {
        if (RequestStatus(request)){

            var dataListId = "dtShop";

            var dataList = document.getElementById(dataListId);
            if (dataList) {		
                var sRet = request.responseText.trim();
            
                if (sRet.length >0){
                    var arRow = sRet.trim().split("$");
                    var nLen = arRow.length;             
                    
                    for (var r=0;r<nLen;r++ )
                    {
                        /*
                        if (r==0){
                            var option2 = document.createElement('option');
                            option2.id = "1^RMX Main^u304817194_rmxmain^u304817194_rmx00^OKwefer2552";
                            option2.value = "RMX Main";
                            
                            //dataList1.appendChild(option2);
                            //dataList2.appendChild(option2);

                            dataList.appendChild(option2);
                        } 
                        */
                        var option = document.createElement('option');
                        var asVal = arRow[r].trim().split("^");                    
                        option.id = asVal;
                        option.value = asVal[1];                                                
                        dataList.appendChild(option);



                    }
                    document.getElementById("txtShop").value = "RMX Main";
                    //dataList.innerHTML = sInner;
                }
                
            } else {
                console.log("not found  =[" + dataListId+"]");
            }
            hideLoader();
            
        }
    };

    showLoader();
    var sql="CALL sp_main_select_database('');";
    var sURL = 'http://' + window.location.hostname 
    + '/rmxDBFunction.php?functionname=queryMainCommand&values='+sql+'&table=tes';

    URLLog(sURL+"?"+sql);

    request.open('POST', sURL, true);
    //request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send();
    //request.send(sSend);


}



function onDataListChange()
{
    //var val = document.getElementById("txtShop").value;
    var sSql = "select Table_Name, table_rows from information_schema.tables ";
    sSql += "where table_type ='BASE TABLE'  order by Table_Name";
    sendGetTableData(sSql,"tblList");

}


function openTabDiv(evt, cityName,className,btnId,tablinks) 
{
    var i, tab, _tablinks;
    tab = document.getElementsByClassName(className);
    if (tab) {
        for (i = 0; i < tab.length; i++) {
            tab[i].style.display = "none";
        }
    }

    _tablinks = document.getElementsByClassName(tablinks);
    for (i = 0; i < _tablinks.length; i++) {
        _tablinks[i].className = _tablinks[i].className.replace(" active", "");
    }
    //if (document.getElementById(cityName)) {
    // if (document.getElementById(cityName).style != null)
            document.getElementById(cityName).style.display = "block";
    //}
    if (evt != '') 
        evt.currentTarget.className += " active";
    else {
    //  if (document.getElementById(btnId)) {
            //if (document.getElementById(btnId).className != null)
                document.getElementById(btnId).className += " active";
        //}
    }

//document.getElementById(cityName).className += " active";
}


function showLoader() 
{
    document.getElementById("loader").style.display = "block";
    document.getElementById("loader").style.display = "inline";

    tTime = setTimeout(hideLoader, 30000);
}


function hideLoader() 
{
    if (document.getElementById("loader").style.display != "none") {
        document.getElementById("loader").style.display = "none";
        if (tTime) {
            clearTimeout(tTime);
        }
    } 
    //document.getElementById("myDiv").style.display = "block";
}

function resizeElementHeight(elementId,mainId) 
{

    var element=document.getElementById(elementId);
    var elementMain=document.getElementById(mainId);

    var height = 0;
    var body = window.document.body;
    if (window.innerHeight) {
        height = window.innerHeight;
    } else if (body.parentElement.clientHeight) {
        height = body.parentElement.clientHeight;
    } else if (body && body.clientHeight) {
        height = body.clientHeight;
    }	

    //console.log("height="+height+",element.offsetTop=" + elementMain.offsetTop);
    element.style.height = (((height - elementMain.offsetTop)-40) + "px");
}


function sendGetTableData(sql,tableName)
{

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(response) {
        console.log("request.status=[" + request.status 
            +"]request.readyState=["+request.readyState+"]");
        
        if (RequestStatus(request)){
            var sRet = ResponseData(request.responseText);
                    
            var table = document.getElementById(tableName);
            if (table) {
                
                clearTableData(table);
                //console.log(" clear table ");
                if (sRet.length >0){
                    
                    console.log(" sendGetTableData responseText=[" + sRet+"]");

                    var arTable = sRet.split("^t");
                    if (arTable.length >0){

                        var arTmp = arTable[0].split("^f");
                        if (arTmp.length >1) {
                            var asCol = arTmp[0].split("^c");
                            var asRow = arTmp[1].split("^r");	

                            if (asRow.length >0) {
                                
                                var colCount = asCol.length;						
                                if (colCount>1){
                                    
                                    var header = table.createTHead();
                                    var row = header.insertRow(0);

                                    var cellb = row.insertCell(-1);
                                    cellb.innerHTML = "Tbl";

                                    var celle = row.insertCell(-1);
                                    celle.innerHTML = "Edit";

                                    for(var c = 0; c < colCount; c++) {
                                        var cell = row.insertCell(-1);
                                        cell.innerHTML = asCol[c].trim();
                                    }

                                    var nRLen = asRow.length;
                                    for (var r=0;r<nRLen;r++ )
                                    {
                                        if (asRow[r].length>0) { 
                                            var row2 = table.insertRow(-1);
                                            var asData = asRow[r].split("^c");

                                            var cellb3 = row2.insertCell(-1);
                                            cellb3.innerHTML = "<button type='button' onclick=\"displayTableField('"+asData[0].trim()+"')\">Tbl</button>";
                                        
                                            var cellb4 = row2.insertCell(-1);
                                            cellb4.innerHTML = "<button type='button' onclick=\"displayEditTable('"+asData[0].trim()+"')\">Edit</button>";

                                            for(var c = 0; c < colCount; c++) {
                                                var cell = row2.insertCell(-1);
                                                cell.innerHTML = asData[c].trim();
                                                cell.onclick = function(sTable,c){
                                                    return function() {
                                                        //var cell = myrow.getElementsByTagName("td")[2];                                                    
                                                        //var sVal = cell.innerHTML;                                                    
                                                        if (c==0) {
                                                            selectTableField(sTable);
                                                        }                                                        
                                                        else {
                                                            var asDiv = document.getElementsByClassName("tabFunc");
                                                            var nC = asDiv.length;                                                
                                                            for (var n=1;n<=nC;n++){
                                                                var sID = "divQuery" + n;        
                                                                if (document.getElementById(sID).style.display == "block"){
                                                                    sID = "txtSQL" + n; 
                                                                    document.getElementById(sID).value ="select * from " + sTable;;
                                                                    break;
                                                                }
                                                            }
                                                            
                                                        }
                                                    };
                                                }(asData[0].trim(),c);
                                            
                                            }
                                        }
                                       
                                    }
                                } //if (colCount>1){
                        
                            }	
                        }	
                        hideLoader();
                    } else {
                        hideLoader();
                        alert(sRet);
                        //console.log(sRet);
                    }	

                }
            }
            hideLoader();
        }
        
                
    };

    //rmxapi/SPView.aspx?sid=rmxcell&pid=10001&uid=rmx&key1=test&query=");
    showLoader();
    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];

    console.log("\n" + sURL + "\n sSend=[" + sSend+"]");

    URLLog(sURL+"?"+sSend);

    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send(sSend);


}


function displayEditTable(sTable)
{
    var sSql = "SELECT * FROM "+sTable+" limit 300;";    
   // document.getElementById('txtEditSQL').value =sSql;

    sSql +=" \nSELECT COLUMN_NAME ";
    sSql +=" FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '"+sTable+"' ";
    sSql +=" and COLUMN_KEY ='PRI'";
    sSql +=" order by ORDINAL_POSITION; ";


    sendQueryDialogEditData(sSql,'tblEditTB','divEditView',sTable);
}

function encPassSQL(sVal)
{

    var sql = sVal.replace(/(\r\n|\n|\r)/gm, "");
    var asS = sql.split("'");
    var sS = asS.join("=&=");

    return sS; 
}

function saveEditData(sPassSql,sType,sCol,sData,sTable,tableName,divName,priList)
{

    var table = document.getElementById(tableName);
    if (table) {
        var rowCount =  table.rows.length;
        var sF="";
        var sD="";
        var sU="";
        var sW="";

        var asData = sData.split("^c");
        
        for (var r=1;r<rowCount;r++) {
            var sPriKey = "";
            var sK = table.rows[r].cells[0].innerHTML;            
            var sFName = sK.replace('*','');

            if (priList.length >0) {
                if (sK.substring(0,1) == "*"){
                    sPriKey = sFName;
                }
            }
            
            var sId= "txt_"+sFName;

            var txt = document.getElementById(sId);
            if (txt) {
              
                
                var sFData = txt.value.split("'").join("\'");
                var sOData = asData[r-1];

                
                if (sU.length >0) sU += ",";
                if (sF.length >0) sF += ",";
                sF += sFName;

                if (sD.length >0) sD += ",";
                if (sFName.substring(0,1) == "n"){
                    sD += sFData;
                    sU += sFName + "=" +sFData;

                    //sW += sFName + "=" +sOData;
                    if (priList.length >0) {
                        if (sPriKey.length >0) {
                            if (sW.length >0) sW += " and ";
                            sW += sFName + "=" +sOData;
                        }
                    } else {
                        if (sW.length >0) sW += " and ";
                        sW += sFName + "=" +sOData;
                    }
                }	else {								
                    var sDD = SendSQL(sFData);					
                    sD += "'" + sDD + "'";
                    sU += sFName + "='" +sDD+"'";		

                    if (priList.length >0) {
                        if (sPriKey.length >0) {
                            if (sW.length >0) sW += " and ";
                            var sOD = SendSQL(sOData);
                            sW += sFName + "='" +sOD+"'";
                        }
                    } else {
                        if (sW.length >0) sW += " and ";
                        sW += sFName + "=" +sOData;
                    }
                }



            //} else {

            }
        }
        var sUpd = "update " + sTable +" set " +sU +" where " + sW + ";";
        
        console.log("Update \n[[\n\n"+sUpd+"\n\n]]\n\n");

        sendExecuteData(sUpd);
    
        document.getElementById(divName).style.display='none';


        var sSql =document.getElementById('txtEditSQL').value;
        //console.log("sSql [["+sSql+"]]");
        sendQueryDialogEditData(sSql,'tblEditTB','divEditView',sTable);

        
    }
}

function saveNewData(sFieldName,sTable,tableName,divName)
{

    var table = document.getElementById(tableName);
    if (table) {
        var rowCount =  table.rows.length;
        var sF="";
        var sD="";
        var sValue="";
        
        for (var r=1;r<rowCount;r++) {
            var sK = table.rows[r].cells[0].innerHTML;            
            var sFName = sK.replace('*','');
            var sId= "txt_"+sFName;
            var txt = document.getElementById(sId);
            if (txt) {
                
                var sFData = txt.value.split("'").join("\'");
                if (sValue.length >0) sValue += ",";
                
                if (sFName.substring(0,1) == "n"){
                    sValue += sFData;
                }	else {								
                    var sDD = SendSQL(sFData);					
                    sValue += "'" + sDD + "'";
                }
            }
        }


        var sIns = "insert into " + sTable + " ("+ sFieldName+ ") values (" + sValue+")";
        

        sendExecuteData(sIns);
    
        document.getElementById(divName).style.display='none';


        var sSql =document.getElementById('txtEditSQL').value;
        //console.log("sSql [["+sSql+"]]");
        sendQueryDialogEditData(sSql,'tblEditTB','divEditView',sTable);

        
    }
}


function sendExecuteData(sql){

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);


    request.onreadystatechange = function(response) {
        
        if (request.readyState === XMLHttpRequest.DONE) {
            var status = request.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                
                var nLen = request.responseText.length;
                var sRet =ResponseText(request);//request.responseText;
                        
                //console.log("request.responseText \n [["+sRet + "]]");
                if (sRet.length>0){
                    if (sRet == "0:"){
                        alert("Execute Complete");
                    } else {
                        alert(sRet);
                    }
                    
                }
                hideLoader();
            } else {

                var txtSQL1 = document.getElementById('txtSQL1');
                txtSQL1.value = request.statusText;
                hideLoader();
                //input.placeholder = "Couldn't load datalist options :(";
            }
        }
    };

    showLoader();


    var val = document.getElementById("txtShop").value;
    var sNo =  getDataList("dtShop",val);
    var asVal = sNo.trim().split("^");
    if (asVal.length ==1) asVal = sNo.trim().split(",");

    var sPointId = asVal[0];
    var sDBName = asVal[2];
    var sDBUser = asVal[3];
    var sDBPWD = asVal[4];


    //var enSql = encodeURIComponent(window.btoa(sql));
    var enSql = encodeURIComponent(window.btoa(encodeURIComponent(sql)));

    console.log("encodeURIComponent \n [["+enSql + "]]");
    var sURL = 'http://' + window.location.hostname + _URLMYSQL + '/rmxDBFunction.php';
    var sSend ="functionname=MultiEncExecuteMainCommand&table=www&values="+enSql
        +"&DBName="+sDBName+"&DBUser="+sDBUser+"&DBPWD="+sDBPWD;
    console.log(sSend);

    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //request.send("functionname=MultiExecuteMainCommand&table=www&values="+encodeURI(sql)
    //		+"&DBName="+sDBName+"&DBUser="+sDBUser+"&DBPWD="+sDBPWD);
    request.send(sSend);

    
}


function SendSQL(sql)
{

    var asS2 = sql.split("=&=");
    var sS2 ="";
    if (asS2.length==1){
        asS2 = sql.split("'");
        sS2 = asS2.join("\''");
    } else {
        sS2 = asS2.join("\''");
    }

    return sS2;
}


function displayEditData(sPassSql,sCol,sData,sTable,tableName,divName)
{

    //alert(divName);

    console.log("displayEditData \n [["+sPassSql + "]]");

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);

    request.onreadystatechange = function(response) {

        if (RequestStatus(request)){

            var sRet = ResponseText(request);

            var sType="update";
            var asKey = [];
            var priList ="";
            //var sRet = ResponseText(request);	

                    
            if (sRet.length >0){				
                //console.log("TTEST request.responseText \n primary key[[["+sRet + "]]]");
                if (sRet=="COLUMN_NAME^f"){
                    sType="insert";
                } else {
                    var asT = sRet.split("^f");	
                    if (asT.length >0){
                        var asData = asT[1].split("^r");	
                        var nM = asData.length;
                        for (var r=0;r<nM ;r++ ){
                            asKey.push(asData[r].replace("^r",""));
                        }						
                        console.log(asT[1]);
                    }
                }
                priList =asKey.toString();
                console.log("priList [" + priList +"]");
            }

                                    
            var asColName = sCol.split("^c");
            var asData = sData.split("^c");

            var table = document.getElementById(tableName);
            if (table) {
                var rowCount =  table.rows.length;
                while(--rowCount) {
                    if (rowCount >0)table.deleteRow(rowCount);
                }
                        
                if (asColName.length >1) {
                    
                    var tcap = table.createCaption();

                    var sH = "<button type='button' id='btnSaveEdit' ";
                    sH+= "onclick=\"saveEditData('" +sPassSql +"','"+sType +"','" + sCol +"','"+sData+"'";
                    sH+= ",'" +sTable+"','tblEditData','divEditData','"+priList+"')\">Save Edit</button>";
                                                            
                    tcap.innerHTML = sH;

                    var sInsert1 = "";			
                    var sInsert2 = "";					
                    var sUpdate = "";
                    var sWhere = "";

                    var nRLen = asData.length;
                    for (var r=0;r<nRLen ;r++ )
                    {
                        //if (asData[r].length>0) { 
                            var row2 = table.insertRow(-1);
                            var sC = asColName[r];
                            var asV = asData[r].split("=&=");
                            var sV = asV.join("\'");									
                            var bF = asKey.includes(sC);
                            if (bF) {
                                
                                if (sWhere.length >0) sWhere+=" and ";
                                if (sC[0]=='s'){								
                                    sWhere+=sC +"='"+ sV + "'";
                                }							
                                else {							
                                    sWhere+=sC +"="+ sV;
                                }		
                                sC ="*"+sC;					
                            } else {
                                if (sUpdate.length >0) sUpdate+= ",";
                                if (sC[0]=='s'){							
                                    sUpdate+=sC +"='"+ sV + "'";
                                }							
                                else {
                                    sUpdate+=sC +"="+ sV;
                                }
                            }
                            

                            var cell0_1 = row2.insertCell(-1);
                            cell0_1.innerHTML = sC;

                            sC =sC.replace("*","");

                            var cell0_2 = row2.insertCell(-1);
                                    

                            var sH ="";				
                        
                            if (sC.substring(0,1) == "n"){
                                sH = "<input id='txt_"+sC+"' type=\"number\" ";
                                sH += " value=\"" + sV +"\" ";
                                sH += " name='txt_"+sC+"' class='txtEdit' style='width:25% '>";
                            } else  if (sC.substring(0,1) == "b"){
                                sH = "<input id='txt_"+sC+"' type=\"number\" ";
                                sH += " value=\"" + sV +"\" min=\"0\" max=\"1\" ";
                                sH += " name='txt_"+sC+"' class='txtEdit' style='width:10% '>";

                            } else {
                                sH = "<textarea id='txt_"+sC+"' rows='1' cols='80'";
                                sH += " name='txt_"+sC+"' class='txtEdit' style='width:95% '>";
                                sH += sV+"</textarea>";
                            }


                            cell0_2.innerHTML = sH

                            if (sInsert1.length >0) sInsert1+=",";
                            sInsert1+=sC;

                            if (sInsert2.length >0) sInsert2+=",";
                            
                            if (sC[0]=='s'){
                                sInsert2+="'" + sV + "'";						
                            }							
                            else {
                                sInsert2+=sV;							
                            }
                            
                        //}
                        
                    } //for (var r=0;r<nLen ;r++ )
                } 

            } 

            sInsert1 = "insert into " + sTable + " ("+ sInsert1 + ") values (" + sInsert2+")";
            document.getElementById("txtEditInsert").value = sInsert1;

            sUpdate = "update " + sTable + " set " + sUpdate + " where " + sWhere;
            document.getElementById("txtEditUpdate").value = sUpdate;


            hideLoader();

            document.getElementById(divName).style.display='block';


        }

    };

    showLoader();


    var sSql ="SELECT COLUMN_NAME ";
    sSql +=" FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '"+sTable+"' ";
    sSql +="  and COLUMN_KEY != '' ";
    sSql +=" order by ORDINAL_POSITION ";



    var asRet = createSendMsg(sSql);
    var sURL = asRet[0];
    var sSend = asRet[1];

    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}

function displayNewData(sPassSql,sCol,sTable,tableName,divName)
{

    console.log("displayNewData \n [["+sPassSql + "]]");

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);

    request.onreadystatechange = function(response) {

        if (RequestStatus(request)){

            var sRet = ResponseText(request);

        
            var asKey = [];
            var priList ="";
            //var sRet = ResponseText(request);	

                    
            if (sRet.length >0){				
                //console.log("TTEST request.responseText \n primary key[[["+sRet + "]]]");
                if (sRet=="COLUMN_NAME^f"){
                    sType="insert";
                } else {
                    var asT = sRet.split("^f");	
                    if (asT.length >0){
                        var asData = asT[1].split("^r");	
                        var nM = asData.length;
                        for (var r=0;r<nM ;r++ ){
                            asKey.push(asData[r].replace("^r",""));
                        }						
                        console.log(asT[1]);
                    }
                }
                priList =asKey.toString();
                console.log("priList [" + priList +"]");
            }


            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            var curDate =  yyyy+mm + dd;

            var asColName = sCol.split("^c");
        

            var table = document.getElementById(tableName);
            if (table) {
                var rowCount =  table.rows.length;
                while(--rowCount) {
                    if (rowCount >0)table.deleteRow(rowCount);
                }
                        
                if (asColName.length >1) {
                    
                

                    var sInsert1 = "";			
                    var sInsert2 = "";					
                    var sUpdate = "";
                    var sWhere = "";

                    var nRLen = asColName.length;
                    for (var r=0;r<nRLen ;r++ )
                    {
                        //if (asData[r].length>0) { 
                            var row2 = table.insertRow(-1);
                            var sC = asColName[r];
                            var bF = asKey.includes(sC);
                        

                            var cell0_1 = row2.insertCell(-1);
                            cell0_1.innerHTML = sC;

                            sC =sC.replace("*","");

                            var cell0_2 = row2.insertCell(-1);
                                    

                            var sH ="";	
                            
                            if (sC.substring(0,1) == "n"){	                            
                                sH = "<input id='txt_"+sC+"' type=\"number\" ";
                                sH += " value=\"0\"  ";
                                sH += " name='txt_"+sC+"' class='txtEdit' style='width:25% '>";
                            } else  if (sC.substring(0,1) == "b"){
                                sH = "<input id='txt_"+sC+"' type=\"number\" ";
                                sH += " value=\"0\" min=\"0\" max=\"1\" ";
                                sH += " name='txt_"+sC+"' class='txtEdit' style='width:10% '>";
                            } else  if (sC.substring(0,1) == "d"){
                                sH = "<input id='txt_"+sC+"' type=\"text\" ";
                                sH += " value=\""+curDate+"\" ";
                                sH += " name='txt_"+sC+"' class='txtEdit' style='width:15% '>";


                            } else {		                            
                                sH = "<textarea id='txt_"+sC+"' rows='1' cols='80'";
                                sH += " name='txt_"+sC+"' class='txtEdit' style='width:95% '>";
                                sH += "</textarea>";
                            }

                            cell0_2.innerHTML = sH

                            if (sInsert1.length >0) sInsert1+=",";
                            sInsert1+=sC;
                            
                        //}
                        
                    } //for (var r=0;r<nLen ;r++ )
                } 

            } 


            var tcap = table.createCaption();
            var sH = "<button type='button' id='btnSaveNew' ";                                    
            sH+= "onclick=\"saveNewData('"+sInsert1 +"','" +sTable+"','tblEditData','divEditData')\">Save New</button>";
                                                    
            tcap.innerHTML = sH;

            sInsert1 = "insert into " + sTable + " ("+ sInsert1 + ") values (" + sInsert2+")";
            document.getElementById("txtEditInsert").value = sInsert1;


            hideLoader();

            document.getElementById(divName).style.display='block';


        }

    };

    showLoader();


    var sSql ="SELECT COLUMN_NAME ";
    sSql +=" FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '"+sTable+"' ";
    sSql +="  and COLUMN_KEY != '' ";
    sSql +=" order by ORDINAL_POSITION ";



    var asRet = createSendMsg(sSql);
    var sURL = asRet[0];
    var sSend = asRet[1];

    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}

function displayDeleteData(sWhere,sTable)
{

    //alert(divName);
    var sW = sWhere.split('[&').join("'");

    var r = confirm("Comfirm Delete Command [" + sW + "]");
    if (r) {        
        var h = confirm("Comfirm Delete Command Again");
        if (h) {    
            var sSql = "delete from "+sTable+" where "+sW +";";        
            sendExecutePostData(sSql);  
            displayEditTable(sTable);
        }
    }

}

function sendQueryDialogEditData(sqlBase,tableName,divName,sTable)
{


    var sql = sqlBase;

  

    var passSql = encPassSQL(sql);


    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);

    request.onreadystatechange = function(response) {
        
        if (RequestStatus(request)){

            var sRet = ResponseText(request);
            //var sRet = request.responseText.trim();
            //console.log("sRet["+sRet+"]");
                
            var table = document.getElementById(tableName);
            if (table) {
                clearTableData(table);

                var rowCount =  table.rows.length;
            

                var sSelect ="";
                var tcap = table.createCaption();
                var sH = "<div align='left'>";

                sH += "<button type='button' id='btnInsert' ";
                sH += "onclick=\"insertEditData('" +sTable+"','tblEditData','divEditData')\">Insert</button>";


                sH += "<input id=\"txtWhereField\" placeholder=\"Select Field\" ";
                sH += "style=\"padding: 2px\" list=\"dtWhereField\"  multiple=\"\"  ";
                sH += "data-list='{\"valueCompletion\": true, \"highlight\": true}' > ";  
                sH += "<datalist id=\"dtWhereField\" autocomplete=true > "; 

                var arTable = sRet.split("^t");
                if (arTable.length >0){
                    var arTmp = arTable[0].split("^f");
                    if (arTmp.length >1) {
                        var asCol = arTmp[0].split("^c");
                        var asRow = arTmp[1].split("^r");

                        var asKCol=[];
                        var asKColNo=[];                        
                        if (arTable.length >1) {
                            var arTmp2 = arTable[1].split("^f");
                            if (arTmp2.length >1) {                                                               
                                asKCol = arTmp2[1].split("^r");
                            }
                        }
                        
                        if (asRow.length >0) {
                            var colCount = asCol.length;
                            var colKCount = asKCol.length;
                            if (colCount>1){
                                var header = table.createTHead();
                                var row = header.insertRow(0);
                                
                                var cell0 = row.insertCell(-1);
                                cell0.innerHTML = "EDIT";
                           

                            
                                for(var c = 0; c < colCount; c++) {
                                    var sF = asCol[c].trim();
                                
                                    var nK = asKCol.indexOf(sF);
                                    if (nK != -1) asKColNo.push(c);

                                    var cell = row.insertCell(-1);
                                    cell.innerHTML = sF;

                                    sH += "<option value=\""+sF+"\">";
                                    if (sSelect.length >0) sSelect += ",";
                                    sSelect += sF;
                                }
                                

                                var nRLen = asRow.length;
                                for (var r=0;r<nRLen ;r++ )
                                {
                                    if (asRow[r].length>0) {
                                        var asData = asRow[r].split("^c");
                                        if (asData.length>0) {

                                            
                                            var sWhere = "";
                                            if (colKCount ==1 && asKCol[0].length==0){
                                                for(var k = 0; k < colCount; k++) {
                                                    if (asCol.length>k) {
                                                        var sKF = asCol[k].trim();                                                         
                                                        if (asData.length>k) {
                                                            var sKV = asData[k].trim();
                                                            if (sWhere.length>0) sWhere += " and ";
                                                            sWhere += sKF + "= [&" + sKV+"[&";
                                                        }
                                                    }                                                    
                                                }
                                            } else {
                                                for(var k = 0; k < colKCount; k++) {
                                                    if (asKCol.length>k) {
                                                        var sKF = asKCol[k].trim(); 
                                                        var nkk = asKColNo[k];
                                                        if (asData.length>nkk) {
                                                            var sKV = asData[nkk].trim();
                                                            if (sWhere.length>0) sWhere += " and ";
                                                            sWhere += sKF + "= [&" + sKV+"[&";
                                                        }
                                                    }                                                    
                                                }
                                            }

                                            var row2 = table.insertRow(-1);
                                            var cell0 = row2.insertCell(-1);
                                            
                                            var sD = encPassSQL(asRow[r]);

                                            var sH2 = "<button type='button' ";
                                            sH2+= "onclick=\"displayEditData('"+passSql+"','" +arTmp[0] +"','" +sD+"','";
                                            sH2+= sTable +"','tblEditData','divEditData')\">Edit</button>";
                                            cell0.innerHTML = sH2;



                                            for(var c = 0; c < colCount; c++) {
                                                if (asData.length>c) {
                                                    var cell = row2.insertCell(-1);
                                                    if (asData[c]) {
                                                        cell.innerHTML = asData[c].trim();
                                                    }
                                                }
                                            }			
                                        } //if (asData.length>0) {
                                    }
                                } //for (var r=0;r<nLen ;r++ )

                                sSelect = "select " + sSelect.substring(0, sSelect.length)
                                    + " from " + sTable;
                                document.getElementById('txtEditView').value =sSelect;
                            }
                                            
                                        
                        } else {
                            if (table.rows.length>1) {
                                for (i = 0; i < table.rows[1].cells.length; i++) {
                                    sH += "<option value=\""+table.rows[1].cells[i].headers+"\">";									
                                }
                            }
                        }

                    }


                }

                sH += "</datalist> ";
                sH += "<input type=\"button\" value=\"Clear\" "; 
                sH += "onclick=\"document.getElementById('txtWhereField').value = ''\" /> ";
                //					
                sH += "<label for='txtWhere' style='font-size: 12px;'>Where  </label>";
                
                sH += "<input id=\"txtEqual\" value=\"like\" style='width:50px' ";
                sH += "style=\"padding: 2px\" list=\"dtEqual\"  multiple=\"\"  ";
                sH += "data-list='{\"valueCompletion\": true, \"highlight\": true}' > ";  
                sH += "<datalist id=\"dtEqual\" autocomplete=true > "; 
                sH += "<option value=\"=\">";
                sH += "<option value=\"!=\">";
                sH += "<option value=\"like\">";
                sH += "<option value=\"in\">";
                sH += "</datalist> ";

                sH += "<input type='text' id='txtFWhere1' style='Font-size: 10px; width:20px;' value='%'>";
                sH += "<input type='text' id='txtWhere' name='txtWhere' style='width:200px'>";
                sH += "<input type='text' id='txtFWhere2' style='Font-size: 10px; width:20px;' value='%'>";


                sH += "<label for='txtStartRow' style='font-size: 12px;'>  Start Row  </label>";
                sH += "<input type='text' id='txtStartRow' style='width:50px' value ='0'>";
                sH += "<label for='txtRowCount' style='font-size: 12px;'>  Row Count  </label>";
                sH += "<input type='text' id='txtRowCount' style='width:50px' value ='300'>";
                sH += "<button type='button' id='btnWhere' ";
                sH += "onclick=\"queryEditData('"+sSelect +"','" +sTable+"','tblEditData','divEditData')\">Query</button>";

                sH += "<button type='button' id='btnInsertNew' ";
                sH += "onclick=\"displayNewData('"+passSql+"','" 
                    +arTmp[0] +"','"+ sTable +"','tblEditData','divEditData')\">New</button>";
                        

        

            
                sH += "</div> ";
                
                tcap.innerHTML = sH;


            } //if (table) {
            hideLoader();
            document.getElementById(divName).style.display='block';
            
        }
    };


    showLoader();

    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];
    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);
        



}



function sendQueryDialogInsertData(sqlBase,tableName,divName,sTable)
{


    var sql = sqlBase;

    var lblEditView= document.getElementById('lblInsertView');
    lblEditView.innerHTML =sql;

    var passSql = encPassSQL(sql);


    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);

    request.onreadystatechange = function(response) {
        
        if (RequestStatus(request)){

            var sRet = ResponseData(request.responseText);

            //console.log("sRet["+sRet+"]");
                
            var table = document.getElementById(tableName);
            if (table) {
                var rowCount =  table.rows.length;
                while(--rowCount) {
                    if (rowCount >0)table.deleteRow(rowCount);
                }

                var sSelect ="";
                //var tcap = table.createCaption();
                var arTable = sRet.split("^t");
                var nTLen = arTable.length;					
                if (nTLen >0){                    
                    var arTmp = arTable[0].split("^f");
                    var asCol = arTmp[0].split("^c");
                    var asRow = arTmp[1].split("^r");

                    if (asRow.length >0) {
                        table.deleteTHead();

                        var colCount = asCol.length;
                        if (colCount>1){
                            var header = table.createTHead();
                            var row = header.insertRow(0);

                            var sInsF = "";
                            for(var c = 0; c < colCount; c++) {
                                var sF = asCol[c].trim();
                                if (sInsF.length>0 && c!= colCount -1) sInsF += ","
                                sInsF += sF;
                            }

                            sInsF = "insert into " + sTable + " (" + sInsF + ") values ";
                            var cell = row.insertCell(-1);
                            cell.innerHTML = sInsF;

                            
                            sInsF = ""
                            var nRLen = asRow.length;
                            console.log("asType["+asRow[1]+"]");
                            //var asType = asRow[1].split("^c");

                            for (var r=0;r<nRLen ;r++ )
                            {
                                if (asRow[r].length>0) {
                                    var asData = asRow[r].split("^c");
                                    if (asData.length>0) {
                                        sInsF = ""
                                        for(var c = 0; c < colCount; c++) {
                                            
                                            var sCN = asCol[c];
                                            var sD =asData[c].trim();
                                            if (c>0) sInsF += ","
                                            
                                            if (sCN[0]=='s')
                                                sInsF += "'" + asData[c].trim() +"'";
                                            else
                                                sInsF += asData[c].trim();
                                                                                                                                        
                                        }		
                                        var row2 = table.insertRow(-1);      	
                                        var cell = row2.insertCell(-1);
                                        if (r==0) 
                                            sInsF = "(" + sInsF + ")";
                                        else
                                            sInsF = ",(" + sInsF + ")";

                                        cell.innerHTML = sInsF;
                                    } //ielse  (asData.length>0) {
                                }
                            } //for (var r=0;r<nLen ;r++ )

                            
                        }
                
                    }
                }

            } //if (table) {
            hideLoader();
            document.getElementById(divName).style.display='block';
            
        }
    };


    showLoader();
    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];



    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}

function isFieldNum(sType){
    switch(sType) {
        case "float":
        case "number":
        case "Int32":
        case "smallint":
        case "numeric":
            return true;
            break;
    default:
        return false;
    }
    return false;
    }

function queryEditData(sSql,sTable,tableName,divName){
    var sSql = "SELECT * FROM "+sTable;

    var txtEqual = document.getElementById('txtEqual');
    var txtField = document.getElementById('txtWhereField');
    if (txtField){
        var sF = txtField.value;

        if (sF.length >0) {
            var txtFWhere1 = document.getElementById('txtFWhere1');
            var txtFWhere2 = document.getElementById('txtFWhere2');
            var txtWhere = document.getElementById('txtWhere');
            if (txtWhere) {
            
                var sFW1 = txtFWhere1.value;
                var sW = txtWhere.value;
                var sFW2 = txtFWhere2.value;
                var sE = txtEqual.value;
                
                sW = "\'" + sFW1 + sW.replace("'","\'") + sFW2 + "\'";

                if ((sF.length >0) && (sW.length >0)) 
                    sSql += " where " + sF + " " +sE + " " + sW;
                else if (sW.length >0)
                    sSql += " where " + sW;
            }

            /*
            Select 0 as TempSort, T.* From MyTable T 
            ORDER BY TempSort OFFSET 2 ROWS FETCH NEXT 3 ROWS
            */
            var txtStartRow = document.getElementById('txtStartRow');
            var txtRowCount = document.getElementById('txtRowCount');
            if ((txtRowCount) && (txtStartRow)) {
                var sO = txtStartRow.value;
                var sN = txtRowCount.value;
                if ((sO.length >0) && (sN.length >0)) {
                    sSql += " order by (select null) offset " + sO;
                    sSql += " ROWS FETCH NEXT "+sN+" ROWS ONLY";
                }
            }
            document.getElementById('txtEditSQL').value =sSql;

            sendQueryDialogEditData(sSql,'tblEditTB','divEditView',sTable);
        } else {
            alert("Please select field before click query");
        }
    }
}





function insertEditData(sTable,tableName,divName){
    var sSql = "SELECT * FROM "+sTable;

    var txtEqual = document.getElementById('txtEqual');
    var txtField = document.getElementById('txtWhereField');
    if (txtField){
        var sF = txtField.value;

        if (sF.length >0) {
            var txtFWhere1 = document.getElementById('txtFWhere1');
            var txtFWhere2 = document.getElementById('txtFWhere2');
            var txtWhere = document.getElementById('txtWhere');
            if (txtWhere) {
            
                var sFW1 = txtFWhere1.value;
                var sW = txtWhere.value;
                var sFW2 = txtFWhere2.value;
                var sE = txtEqual.value;
                
                sW = "\'" + sFW1 + sW.replace("'","\'") + sFW2 + "\'";

                if ((sF.length >0) && (sW.length >0)) 
                    sSql += " where " + sF + " " +sE + " " + sW;
                else if (sW.length >0)
                    sSql += " where " + sW;
            }

            
            var txtStartRow = document.getElementById('txtStartRow');
            var txtRowCount = document.getElementById('txtRowCount');
            if ((txtRowCount) && (txtStartRow)) {
                var sO = txtStartRow.value;
                var sN = txtRowCount.value;
                if ((sO.length >0) && (sN.length >0)) {
                    sSql += " order by (select null) offset " + sO;
                    sSql += " ROWS FETCH NEXT "+sN+" ROWS ONLY";
                }
            }
            //document.getElementById('txtEditSQL').value =sSql;

            
            sendQueryDialogInsertData(sSql,'tblInsertTB','divInsertView',sTable);
        } else {
            alert("Please select field before click query");
        }
    }
}


function deleteTableField(sField,sTable){
    var r = confirm("Comfirm Delete Command");
    if (r) {        
        var r2 = confirm("Comfirm Delete Command Again");
        if (r2) {      
            var sSql = "ALTER TABLE "+sTable+" DROP COLUMN "+sField+";";
            sendExecutePostData(sSql);  

            displayTableField(sTable);
        }
    }
}


function changeTableField(sOldField,sOldType,sTable){

    var sField = "";
    var sType = "";

    sPrompt = prompt("Please enter name", sOldField);
    if (sPrompt != null) {
        sField = sPrompt;
    }

    sPrompt = prompt("Please enter type and size", sOldType);
    if (sPrompt != null) {
        sType = sPrompt;
    }

    var sSql = "";
    var r = confirm("Comfirm Change Command");
    if (r) {       

        if (sField != sOldField){
            sSql = "ALTER TABLE "+sTable+" CHANGE COLUMN "+sOldField+" "+sField +" "+sType+";"
        } else {
            sSql = "ALTER TABLE "+sTable+" MODIFY "+sField+" "+sType+";"
        }             
        sendExecutePostData(sSql);  
        displayTableField(sTable);
    }

}

function displayTableField(sTable){
    //alert(sTable);
    var sSql ="SELECT COLUMN_NAME,COLUMN_TYPE,COLUMN_KEY ";
    sSql +=" FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '"+sTable+"' ";
    sSql +=" order by ORDINAL_POSITION; ";
    sSql +=" SHOW CREATE TABLE "+sTable+";";


    sendQueryDialogData(sSql,'tblTBField','divTableView',sTable);

}



function selectTableField(sTable){
//alert(sTable);

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);


    request.onreadystatechange = function(response) {
        
        if (RequestStatus(request)){

            var sRet = ResponseText(request);
            //var sRet = request.responseText;
            var arTmp = sRet.split("^f");


        
            hideLoader();

            

        }
    };


    var sSql ="SELECT COLUMN_NAME ";
    sSql +=" FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '"+sTable+"' ";
    sSql +=" order by ORDINAL_POSITION ";


    showLoader();
    var asRet = createSendMsg(sSql);
    var sURL = asRet[0];
    var sSend = asRet[1];


    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);




}

function sendQueryDialogData(sql,tableName,divName,sTable){

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);


    request.onreadystatechange = function(response) {
        
        if (RequestStatus(request)){

            var sRet = ResponseText(request);
            //var sRet = request.responseText;

            var table = document.getElementById(tableName);
            if (table) {
                clearTableData(table);

                var sSelect = "";				
                if (sRet.length >4){
                    var arTable = sRet.split("^t");
                    if (arTable.length >0){
                        
                        var arTmp = arTable[0].split("^f");
                        if (arTmp.length >1) {
                            var asCol = arTmp[0].split("^c");
                            var asRow = arTmp[1].split("^r");
                                                    
                            var header = table.createTHead();
                            var row = header.insertRow(0);
                        

                            var colCount = asCol.length;
                            for(var c = 0; c < colCount; c++) {
                                var cell = row.insertCell(-1);
                                cell.innerHTML = asCol[c].trim();
                            }
                            
                            var nRLen = asRow.length;
                            for (var r=0;r<nRLen ;r++ )
                            {
                                if (asRow[r].length>0) {
                                    var asData = asRow[r].split("^c");
                                    if (asData.length>0) {
                                        

                                        var row2 = table.insertRow(-1);

                                        for(var c = 0; c < colCount; c++) {
                                            if (asData.length>c) {
                                                var cell = row2.insertCell(-1);
                                                cell.innerHTML = asData[c].trim();
                                            }
                                        }			
                                    } //if (asData.length>0) {
                                }
                            } //for (var r=0;r<nLen ;r++ )
                        } //if (arTmp.length >0) {
                        
                    } //if (nLen >0){
                } //if (sRet.length >10){
                        
            } //if (table) {
            hideLoader();

            document.getElementById(divName).style.display='block';

        }
    };

    showLoader();
    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];


    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}


function URLLog(sMsg){
   
}

function sendManyQueryData(sql,tableName,divName,tabName,tabLinks){
    // console.clear();
    var request = new XMLHttpRequest();


    request.onreadystatechange = function(response) {
        if (RequestStatus(request)){
            var sRet =request.responseText.trim();

            console.log("sRet=[[" + sRet + "]]");

            fillManyTableData(divName,tabName,sRet,tabLinks,tableName);
            hideLoader();
        }
    };

    showLoader();

    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];

    console.clear();
    console.log(sURL+"?"+sSend);

    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}

function sendManyQueryDataAtCol(sql,tableName,divName,tabName,tabLinks,AtCol){
    // console.clear();
    var request = new XMLHttpRequest();

    request.onreadystatechange = function(response) {
        if (RequestStatus(request)){
            var sRet =request.responseText.trim();
            fillManyTableDataAtCol(divName,tabName,sRet,tabLinks,tableName,AtCol);
            hideLoader();
        }
    };

    showLoader();

    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];

    URLLog(sURL+"?"+sSend);

    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}


function sendViewSPData(sql,txtName,divName){

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);

    request.onreadystatechange = function(response) {
        
        if (request.readyState === 4) {
            if (request.status === 200) {

                var nLen = request.responseText.length;
                var sRet =ResponseText(request);//request.responseText;
            
                var txtSPView = document.getElementById(txtName);
                if (txtSPView) {
                    txtSPView.value ="";                    
                        var arTable = sRet.split("^t");
                        var nTLen = arTable.length;					

                        if (nTLen >0){
                            for (var k=0;k<nTLen;k++){
                                var arTmp = arTable[k].split("^f");
                                if (arTmp.length >1) {
                                    
                                    if (arTmp[1].length> 1) {
                                        var asRow = arTmp[1].split("^r");
                                        var nRLen = asRow.length;
                                        for (var r=0;r<nRLen ;r++ )
                                        {
                                            if (asRow[r].length>0) {
                                                var asData = asRow[r].split("^c");
                                                if (asData.length>0) {
                                                    txtSPView.value = txtSPView.value + asData[2].trim();
                                                } //if (asData.length>0) 
                                            }
                                        } //for (var r=0;r<nLen ;r++ )
                                    }
                                
                                
                                } //if (arTmp.length >0) 
                                else {
                                    alert(arTable[k]);
                                }
                            }
                        } //if (nLen >0)
                    
                    hideLoader();
                    document.getElementById(divName).style.display='block';
                }
                
            } else {
                hideLoader();
            }
        }
    };

    showLoader();

    var val = document.getElementById("txtShop").value;
    var sNo =  getDataList("dtShop",val);

    var asVal = sNo.trim().split("^");
    if (asVal.length ==1) asVal = sNo.trim().split(",");

    var sPointId = asVal[0];
    var sDBName = asVal[2];
    var sDBUser = asVal[3];
    var sDBPWD = asVal[4];

    var enSql = encodeURIComponent(window.btoa(encodeURIComponent(sql)));

    var sURL = 'http://' + window.location.hostname + _URLMYSQL + '/rmxDBFunction.php';
    var sSend = 'functionname=queryEncManyMainCommand&table=www&values='+enSql
        +"&DBName="+sDBName+"&DBUser="+sDBUser+"&DBPWD="+sDBPWD;

    console.log(sSend);

    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send(sSend);



}

function displayTableData(divTable,arTable,divName,tblName,classLink
,tabcontent,tableName){


    var nTLen = arTable.length;	
    if (nTLen >0){

        var sTabHTML = "";
        var sTableHTML = "";
        if (nTLen >1) {
            for (var t=0;t<nTLen;t++){
                var sIId =divName+t.toString();
                var sBtnId="tab"+t;
                sTabHTML += "<button type='button' class='"+classLink+"'";
                sTabHTML += " id='"+sBtnId+"'";
                sTabHTML += " onclick=\"openTabFunc(event,'"+tabcontent+"','"+classLink+"','"+sIId+"','"+sBtnId+"')\"> ";
                sTabHTML += " Table "+(t+1)+"</button>\n";		

                var sTblId = tblName+t.toString();
                sTableHTML += "<div id='"+sIId+"' class='"+tabcontent+"' style='overflow:auto;'>\n";
                sTableHTML += "<table id='"+sTblId+"' name='"+sTblId+"' style='overflow:auto;'>\n";
                sTableHTML += "<thead style='Font-size: 14px;'><tr></tr></thead></table></div>\n";
            }
            sTabHTML ="<div class='tab'>\n"+sTabHTML+"</div>\n";
        } else {
            var sTblId = tblName+"0";
            sTableHTML  = "<table id='"+sTblId+"' name='"+sTblId+"' style='overflow:auto;'>\n";
            sTableHTML += "<thead style='Font-size: 14px;'><tr></tr></thead></table>\n";
        }

        divTable.innerHTML = sTabHTML+sTableHTML;
        for (var k=0;k<=nTLen;k++){
            var sId = tblName+k.toString();
            var table = document.getElementById(sId);
            if (table) {
                var arTmp = arTable[k].split("^f");
                if (arTmp.length >1) {
                    var asCol = arTmp[0].split("^c");
                    var header = table.createTHead();
                    var row = header.insertRow(0);
                    var colCount = asCol.length;
                    for(var c = 0; c < colCount; c++) {
                        //var cell = row.insertCell(-1);
                        row.insertCell(-1).innerHTML = asCol[c].trim();
                    }				
                    if (arTmp[1].length> 1) {
                        var asRow = arTmp[1].split("^r");
                        var nRLen = asRow.length;
                        for (var r=0;r<nRLen ;r++ )
                        {
                            if (asRow[r].length>0) {
                                var asData = asRow[r].split("^c");
                                if (asData.length>0) {
                                    var row2 = table.insertRow(-1);
                                    for(var c = 0; c < colCount; c++) {
                                        if (asData.length>c) {
                                            var cell = row2.insertCell(-1);
                                            cell.innerHTML = asData[c].trim();

                                            if ((tableName == 'tblSPInfo') && (c==1))  {
                                                var createClickHandler = function(ccell) {
                                                    return function() {
                                                        var value = ccell.innerHTML;
                                                        sSql ="SHOW CREATE PROCEDURE "+value;
                                                        sendViewSPData(sSql,'txtSPView','divSPView');
                                                    };
                                                };
                                                cell.onclick = createClickHandler(cell);
                                            } else if ((tableName == 'tblFNInfo') && (c==1))  {
                                                var createClickHandler = function(ccell) {
                                                    return function() {
                                                        var value = ccell.innerHTML;
                                                        sSql ="SHOW CREATE FUNCTION "+value+" ";
                                                        sendViewSPData(sSql,'txtSPView','divSPView');
                                                    };
                                                };
                                                cell.onclick = createClickHandler(cell);
                                            } else if ((tableName == 'tblCompInfo') && (c==1))  {
                                                
                                                var createClickHandler = function(ccell,dbName) {
                                                    return function() {
                                                        var value = ccell.innerHTML;

                                                        var sDBCheck = "";
                                                        var opt = document.getElementById("dtShop")
                                                        if (opt)
                                                        {
                                                            var nC=1;
                                                            var nLen = opt.options.length;
                                                            for (var n=0;n<nLen;n++ ){
                                                                var sNo = opt.options[n].id;
                                                                var asVal = sNo.trim().split(",");
                                                                var id="chk_" + asVal[0];
                                                                var chk = document.getElementById(id);
                                                                if (chk) {
                                                                    if (chk.checked){
                                                                        var sCId = 'txtSPView' + nC.toString();
                                                                        //console.log("dbName=[" + asVal[2] +"]");
                                                                        sSql ="SHOW CREATE PROCEDURE "+value;
                                                                        sendViewSPDataByDB(sSql,sCId,'divCompare',asVal[2]);
                                                                        nC++;
                                                                        if (nC>3) break;

                                                                    }
                                                                }
                                                            }
                                                        }

                                                        
                                                        //sendViewSPData(sSql,'txtSPView1','divCompare');
                                                    };
                                                };
                                                cell.onclick = createClickHandler(cell,asData[0]);
                                            }
                                        }
                                    }			
                                } //if (asData.length>0) 
                            }
                        } //for (var r=0;r<nLen ;r++ )
                    }
                } else {
                    alert(arTable[k]);
                }//if (arTmp.length >0) 
            }
        }
    } 
}

function fillManyTableData(divName,className,sRet,tablinks,tableName){
    var divTable = document.getElementById(divName);//('divTable');
    if (divTable) {
        divTable.innerHTML = "";

        if (sRet.length >0){

            var arTable = sRet.split("^t");
            var nTLen = arTable.length;					
            if (nTLen >0){

                //divName,tabName
                var sTabRawHTML = "";
                var sTxtRawHTML = "";
                var sTabHTML = "";
                var sTableHTML = "";
                var sFId = "div"+divName+"0";
                var sBId = "btn"+divName+"0";

                var sBtnId = "btnRaw"+divName;    
                var sIId ="divRaw"+divName;
                sTabRawHTML = "<button type='button' class='tablinks'";
                sTabRawHTML +=  " id='"+sBtnId+"'";
                sTabRawHTML += " onclick=\"openTabDiv(event,\'"+sIId+"\','"+className+"','" +sBtnId +"','" + tablinks+"')\"> ";
                sTabRawHTML += " Raw </button>\n";		


                sTxtRawHTML= "<div id='"+sIId+"' class='"+className+"' style='overflow:auto;z-index: 1;'>";
                sTxtRawHTML += "<textarea id='txt"+divName+"' name='txt"+divName+t+"' style=>";
                sTxtRawHTML += "'overflow:auto;z-index: 1;max-width:100%;height:100%; width:100%' </textarea></div>\n";

                for (var t=0;t<nTLen;t++){
                    sBtnId = "btn"+divName+t;                        
                    sIId ="div"+divName+t;
                    
                    sTabHTML += "<button type='button' class='tablinks'";
                    sTabHTML += " id='"+sBtnId+"'";
                    sTabHTML += " onclick=\"openTabDiv(event,\'"+sIId+"\','"+className+"','" +sBtnId +"','" + tablinks+"')\"> ";
                    sTabHTML += " Table "+(t+1)+"</button>\n";		

                    sTableHTML += "<div id='"+sIId+"' class='"+className+"' style='overflow:auto;z-index: 1;'>";
                    sTableHTML += "<table id='tbl"+divName+t+"' name='tbl"+divName+t+"' style='overflow:auto;z-index: 1;'>";
                    sTableHTML += "<thead style='Font-size: 14px;'><tr></tr></thead></table></div>\n";

                }

                sTabHTML ="<div class='tab' style='z-index: 1;' >\n"+sTabRawHTML + sTabHTML+"</div>\n";

                divTable.innerHTML = sTabHTML+sTxtRawHTML+sTableHTML;
                
                var sId = "txt"+divName;
                document.getElementById(sId).value = sRet;

                for (var k=0;k<nTLen;k++){                        
                    sId = "tbl"+divName+k.toString();
                    var table = document.getElementById(sId);
                    if (table) {
                        
                        var arTmp = arTable[k].split("^f");
                        if (arTmp.length >1){
                        
                            var asCol = arTmp[0].split("^c");
                            var asRow = arTmp[1].split("^r");
                            
                            if (asRow.length>0) {                                
                                var header = table.createTHead();
                                var row = header.insertRow(0);
                                var colCount = asCol.length;
                                for(var c = 0; c < colCount; c++) {
                                    var cell = row.insertCell(-1);
                                    cell.innerHTML = asCol[c].trim();
                                }
                                var nRLen = asRow.length;
                                for (var r=0;r<nRLen;r++ )
                                {
                                    if (asRow[r].length>0) {  
                                        var row2 = table.insertRow(-1);
                                        var asData = asRow[r].split("^c");
                                        for(var c = 0; c < colCount; c++) {
                                            var cell = row2.insertCell(-1);
                                            cell.innerHTML = asData[c];//.trim();
                                            

                                                    if ((tableName == 'tblSPInfo') && (c==1))  {
                                                        var createClickHandler = function(ccell) {
                                                            return function() {
                                                                var value = ccell.innerHTML;
                                                                sSql ="SHOW CREATE PROCEDURE "+value;
                                                                sendViewSPData(sSql,'txtSPView','divSPView');
                                                            };
                                                        };
                                                        cell.onclick = createClickHandler(cell);
                                                    } else if ((tableName == 'tblFNInfo') && (c==1))  {
                                                        var createClickHandler = function(ccell) {
                                                            return function() {
                                                                var value = ccell.innerHTML;
                                                                sSql ="SHOW CREATE FUNCTION "+value+" ";
                                                                sendViewSPData(sSql,'txtSPView','divSPView');
                                                            };
                                                        };
                                                        cell.onclick = createClickHandler(cell);
                                                    } else if ((tableName == 'tblCompInfo') && (c==1))  {
                                                        
                                                        var createClickHandler = function(ccell,dbName) {
                                                            return function() {
                                                                var value = ccell.innerHTML;

                                                                var sDBCheck = "";
                                                                var opt = document.getElementById("dtShop")
                                                                if (opt)
                                                                {
                                                                    var nC=1;
                                                                    var nLen = opt.options.length;
                                                                    for (var n=0;n<nLen;n++ ){
                                                                        var sNo = opt.options[n].id;
                                                                        var asVal = sNo.trim().split(",");
                                                                        var id="chk_" + asVal[0];
                                                                        var chk = document.getElementById(id);
                                                                        if (chk) {
                                                                            if (chk.checked){
                                                                                var sCId = 'txtSPView' + nC.toString();
                                                                                //console.log("dbName=[" + asVal[2] +"]");
                                                                                sSql ="SHOW CREATE PROCEDURE "+value;
                                                                                sendViewSPDataByDB(sSql,sCId,'divCompare',asVal[2]);
                                                                                nC++;
                                                                                if (nC>3) break;

                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                
                                                                //sendViewSPData(sSql,'txtSPView1','divCompare');
                                                            };
                                                        };
                                                        cell.onclick = createClickHandler(cell,asData[0]);
                                                    }


                                        }
                                    }
                                } 
                            
                            }
                        } else {                      
                            alert(arTable[k]);
                        }
                    }
                }
                openTabDiv("",sFId,className,sBId,tablinks);


            } else {
                hideLoader();
                alert(sRet);
            }	
            hideLoader();
        } //if (sRet.length >10)
    } //i

}



function fillManyTableDataAtCol(divName,className,sRet,tablinks,tableName,AtCol){
    var divTable = document.getElementById(divName);//('divTable');
    if (divTable) {
        divTable.innerHTML = "";

        if (sRet.length >0){

            var arTable = sRet.split("^t");
            var nTLen = arTable.length;					
            if (nTLen >0){

                //divName,tabName
                var sTabRawHTML = "";
                var sTxtRawHTML = "";
                var sTabHTML = "";
                var sTableHTML = "";
                var sFId = "div"+divName+"0";
                var sBId = "btn"+divName+"0";

                var sBtnId = "btnRaw"+divName;    
                var sIId ="divRaw"+divName;
                sTabRawHTML = "<button type='button' class='tablinks'";
                sTabRawHTML +=  " id='"+sBtnId+"'";
                sTabRawHTML += " onclick=\"openTabDiv(event,\'"+sIId+"\','"+className+"','" +sBtnId +"','" + tablinks+"')\"> ";
                sTabRawHTML += " Raw </button>\n";		


                sTxtRawHTML= "<div id='"+sIId+"' class='"+className+"' style='overflow:auto;z-index: 1;'>";
                sTxtRawHTML += "<textarea id='txt"+divName+"' name='txt"+divName+t+"' style=>";
                sTxtRawHTML += "'overflow:auto;z-index: 1;max-width:100%;height:100%; width:100%' </textarea></div>\n";

                for (var t=0;t<nTLen;t++){
                    sBtnId = "btn"+divName+t;                        
                    sIId ="div"+divName+t;
                    
                    sTabHTML += "<button type='button' class='tablinks'";
                    sTabHTML += " id='"+sBtnId+"'";
                    sTabHTML += " onclick=\"openTabDiv(event,\'"+sIId+"\','"+className+"','" +sBtnId +"','" + tablinks+"')\"> ";
                    sTabHTML += " Table "+(t+1)+"</button>\n";		

                    sTableHTML += "<div id='"+sIId+"' class='"+className+"' style='overflow:auto;z-index: 1;'>";
                    sTableHTML += "<table id='tbl"+divName+t+"' name='tbl"+divName+t+"' style='overflow:auto;z-index: 1;'>";
                    sTableHTML += "<thead style='Font-size: 14px;'><tr></tr></thead></table></div>\n";

                }

                sTabHTML ="<div class='tab' style='z-index: 1;' >\n"+sTabRawHTML + sTabHTML+"</div>\n";

                divTable.innerHTML = sTabHTML+sTxtRawHTML+sTableHTML;
                
                var sId = "txt"+divName;
                var sRRaw ="";
                //document.getElementById(sId).value = sRet;

                for (var k=0;k<nTLen;k++){                        
                    sId = "tbl"+divName+k.toString();
                    var table = document.getElementById(sId);
                    if (table) {
                        
                        var arTmp = arTable[k].split("^f");
                        if (arTmp.length >1){

                            var asCol = arTmp[0].split("^c");
                            var asRow = arTmp[1].split("^r");
                            
                            if (asRow.length>0) {                                
                                var header = table.createTHead();
                                var row = header.insertRow(0);
                                var colCount = asCol.length;
                            // for(var c = 0; c < colCount; c++) {
                                    var cell = row.insertCell(-1);
                                    cell.innerHTML = asCol[AtCol].trim();
                                //}
                                var nRLen = asRow.length;
                                for (var r=0;r<nRLen;r++ )
                                {
                                    if (asRow[r].length>0) { 
                                        var row2 = table.insertRow(-1);
                                        var asData = asRow[r].split("^c");
                                    //for(var c = 0; c < colCount; c++) {
                                        var cell = row2.insertCell(-1);
                                        var sD = asData[AtCol];
                                        cell.innerHTML = sD;//.trim();
                                        sRRaw = sRRaw +  sD +";\n\n";
                                    //}
                                    }
                                } 
                            
                            }
                        } else {
                            alert( arTable[k]);

                        }
                    }
                }

                sId = "txt"+divName;
                document.getElementById(sId).value = sRRaw;
                openTabDiv("",sFId,className,sBId,tablinks);


            } else {
                hideLoader();
                alert(arU[1]);
            }	
            hideLoader();
        } //if (sRet.length >10)
    } //i

}

function sendQueryPostDataToText(sql,txtId){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(response) {
        //console.log("request.status=" + request.status);
        
        if (RequestStatus(request)){
            var sRet = ResponseData(request.responseText);
                
            if (sRet.length >0){
                                    
                var sData =  sRet.split("^r").join("\n");
                sData = sData.split("TextString").join("");
                sData = sData.split("^c").join("");
                
                var txtSQL = document.getElementById('txtSQL1');
                txtSQL.value = sData;
                                            
            }
            hideLoader();
        
        }
        

    };

    showLoader();

    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];
    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}


function sendQueryPostData(sql,tableName){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(response) {
        
        if (RequestStatus(request)){
            var sRet = ResponseData(request.responseText);

                //console.log("request.responseText \n [["+sRet + "]]");
                
            var table = document.getElementById(tableName);
            if (table) {
                clearTableData(table);
                
                    table.deleteCaption();
                    var tcap = table.createCaption();
                    tcap.innerHTML = "<p style='text-align:center'>"+sql+"</p>";

                if (sRet.length >0){
                    var arTable = sRet.split("^t");
                    if (arTable.length >0){                        
                        var arTmp = arTable[0].split("^f");
                        if (arTmp.length >1) {
                            var asCol = arTmp[0].split("^c");
                            var asRow = arTmp[1].split("^r");
                            
                            table.deleteTHead();
                            var header = table.createTHead();
                            var row = header.insertRow(0);
                            
                            var colCount = asCol.length;
                            for(var c = 0; c < colCount; c++) {
                                var cell = row.insertCell(-1);
                                cell.innerHTML = asCol[c].trim();
                            }
                                
                            var nRLen = asRow.length;
                            for (var r=0;r<nRLen ;r++ )
                            {
                                if (asRow[r].length>0) { 
                                    var row2 = table.insertRow(-1);
                                    var asData = asRow[r].split("^c");
                                    if (asData.length >0) {                                
                                        for(var c = 0; c < colCount; c++) {
                                            var cell = row2.insertCell(-1);
                                            cell.innerHTML = asData[c].trim();

                                            if ((tableName == 'tblSP') && (c==1))  {
                                                var createClickHandler = function(ccell) {
                                                    return function() {
                                                        var value = ccell.innerHTML;
                                                        sSql ="SHOW CREATE PROCEDURE "+value;
                                                        sendViewSPData(sSql,'txtSPView','divSPView',value);

                                                    };
                                                };
                                                cell.ondblclick = createClickHandler(cell);
                                            } else if ((tableName == 'tblFN') && (c==1))  {
                                                var createClickHandler = function(ccell) {
                                                    return function() {
                                                        var value = ccell.innerHTML;
                                                        sSql ="SHOW CREATE FUNCTION "+value;
                                                        sendViewSPData(sSql,'txtSPView','divSPView',value);

                                                    };
                                                };
                                                cell.ondblclick = createClickHandler(cell);
                                            }
                                        }                                    
                                        row2.onclick = function(myrow){
                                            return function() {
                                                
                                                // var cell = myrow.getElementsByTagName("td")[2];
                                                //var sVal = cell.innerHTML;
                                                //document.getElementById("txtSelect").value ="select * from " + sVal;		
                                            };
                                        }(row2);
                                    } //if (asData.length >0) {
                                }
                            } //for (var r=0;r<nLen ;r++ )
                        } //if (arTmp.length >0) {
                    } //if (nLen >0){
                } //if (sRet.length >0){
                
            }
                
            hideLoader();
        }
        
        
    };

    showLoader();
    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];


    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}


function sendQueryPostDataToOne(sql,tableName){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(response) {
        
        if (RequestStatus(request)){
            var sRet = ResponseData(request.responseText);

            var table = document.getElementById(tableName);
            if (table) {
                clearTableData(table);
                
            // table.deleteCaption();
                //var tcap = table.createCaption();
                //tcap.innerHTML = "<p style='text-align:center'>"+sql+"</p>";

                if (sRet.length >0){
                    var arTable = sRet.split("^t");
                    if (arTable.length >0){                

                        for(var t = 0; t < arTable.length; t++) {

                            var arTmp = arTable[t].split("^f");
                            if (arTmp.length >1) {
                                var asCol = arTmp[0].split("^c");
                                var asRow = arTmp[1].split("^r");
                                var colCount = asCol.length;

                                if (t==0) {
                                    //table.deleteTHead();
                                    var header = table.createTHead();
                                    var row = header.insertRow(0);                                                                        
                                    for(var c = 0; c < colCount; c++) {
                                        var cell = row.insertCell(-1);
                                        cell.innerHTML = asCol[c].trim();
                                    }
                                }
                                    
                                var nRLen = asRow.length;
                                for (var r=0;r<nRLen ;r++ )
                                {
                                    if (asRow[r].length>0) { 
                                        var row2 = table.insertRow(-1);
                                        var asData = asRow[r].split("^c");
                                        if (asData.length >0) {                                
                                            for(var c = 0; c < colCount; c++) {
                                                var sD =asData[c].trim();
                                                var cell = row2.insertCell(-1);
                                                cell.innerHTML = sD;

                                                if (c==2 && sD == 'PROCEDURE')  {
                                                    var createClickHandler = function(ccell) {
                                                        return function() {
                                                            var value = ccell.innerHTML;
                                                            sSql ="SHOW CREATE PROCEDURE "+value;
                                                            sendViewSPData(sSql,'txtSPView','divSPView',value);

                                                        };
                                                    };
                                                    cell.ondblclick = createClickHandler(cell);
                                                } else if (c==2 && sD == 'FUNCTION')  {
                                                    var createClickHandler = function(ccell) {
                                                        return function() {
                                                            var value = ccell.innerHTML;
                                                            sSql ="SHOW CREATE FUNCTION "+value;
                                                            sendViewSPData(sSql,'txtSPView','divSPView',value);

                                                        };
                                                    };
                                                    cell.ondblclick = createClickHandler(cell);
                                                }
                                            }                                    
                                            
                                        } //if (asData.length >0) {
                                    }
                                } //for (var r=0;r<nLen ;r++ )
                            } //if (arTmp.length >0) {                        
                        } //for(var t = 0; t < arTable.length; t++)
                    } //if (nLen >0){
                } //if (sRet.length >0){
                
            }
                
            hideLoader();
        }
        
        
    };

    showLoader();
    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];


    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}


function sendExecutePostData(sql){

    sendExecuteData(sql);

}




function sendExecutePostDataNoReturn(sql){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(response) {
        if (RequestStatus(request)) {
                        
            var sRet = request.responseText;
            console.log(" request.responseText \n [["+sRet + "]]");          
            hideLoader();
            
            
        }
    };

    showLoader();
    var asRet = createSendMsg(sql);
    var sURL = asRet[0];
    var sSend = asRet[1];

    console.log("sSend=[" + sSend+"]");

    URLLog(sURL+"?"+sSend);

    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send(sSend);


}

function checkData(sql){


    var request = new XMLHttpRequest();

    request.onreadystatechange = function(response) {
        //console.log("request.status=" + request.status);
        
        if (RequestStatus(request)) {
            var sRet  =request.responseText;
            sRet = sRet.trim();
            console.log("request.responseText \n [["+sRet + "]]");

            if (sRet.length >0){
                                
                //fillDataList('dtShop');
                fillAllDatabaseList();

                sendGetTableData(sRet,"tblList");
            // sendLoadMainTextCommand();
                            
                
                var btnSP= document.getElementById('spbtn');
                var btnFN= document.getElementById('fnbtn');
                var btnFind= document.getElementById('findbtn');
                var btnView= document.getElementById('viewbtn');
                var btnField= document.getElementById('fieldbtn');
                var btnTable= document.getElementById('tablebtn');
                

        
                window.onclick = function(event) {
                /*                     
                    if (event.target == btnRefresh) {
                        sSql = "select Table_Name, table_rows from information_schema.tables ";
                        sSql += "where table_type ='BASE TABLE'  order by Table_Name";
                        sendGetTableData(sSql,"tblList");
                        
                    } else */
                    if (event.target == btnTable) {
                        
                        var sSql = "select Table_Name, table_rows ";
                        sSql += " from information_schema.tables ";
                        sSql += "where table_type ='BASE TABLE'  ";

                        //sSql = "SELECT o.NAME,i.rowcnt FROM sysindexes AS i";
                        //sSql += " INNER JOIN sysobjects AS o ON i.id = o.id ";
                        //sSql += " WHERE i.indid < 2  AND OBJECTPROPERTY(o.id, 'IsMSShipped') = 0 ";

                        var txtFilter = document.getElementById('txtFilter');
                        var txtF1 = document.getElementById('txtFilter1');
                        var txtF2 = document.getElementById('txtFilter2');
                        if (txtFilter.value !="") {
                            var sFF = txtF1.value + txtFilter.value + txtF2.value;
                            sSql += " and Table_Name like '"+sFF.trim() +"'";
                        }
                        sSql += " order by Table_Name";

                        console.log("txtFilter \n [["+sSql + "]]");
                        sendGetTableData(sSql,'tblList');
                        
               
                                                                            
                    } else if (event.target == btnSP) {
                        
                        sSql = "SHOW PROCEDURE STATUS;";
                        //sSql += "SHOW FUNCTION STATUS;";
                        sendQueryPostData(sSql,'tblSP');

                        //openTabDiv('','divInfo','taball','btnE1','tablinks');
                        openTabFunc('', 'tabDisplay','tabBtnDisplay','divInfo','btnE1')
                        openTabDiv('','divTabSP','taballdb','btnTabSP','tablinks');
                        
                    } else if (event.target == btnFN) {
                        sSql = "SHOW FUNCTION STATUS;";
                        sendQueryPostData(sSql,'tblFN');
                        //openTabDiv('','divInfo','taball','btnE1','tablinks');
                        openTabFunc('', 'tabDisplay','tabBtnDisplay','divInfo','btnE1')
                        openTabDiv('','divTabFN','taballdb','btnTabFN','tablinks');

                    } else if (event.target == btnFind) {
                        var sFind = prompt("Please enter your find", "");
                        if (sFind != null) {
                            sSql ="SELECT ROUTINE_SCHEMA,ROUTINE_NAME,ROUTINE_DEFINITION ";
                            sSql +=" FROM INFORMATION_SCHEMA.ROUTINES ";
                            sSql +=" WHERE (ROUTINE_DEFINITION LIKE '%"+sFind+"%'";
                            sSql +=" or ROUTINE_NAME LIKE '%"+sFind+"%')";
                            sendManyQueryData(sSql,'tblInfo','divTabData','tabsuball','tablinks');
                            //openTabDiv('','divInfo','taball','btnE1','tablinks');
                            openTabFunc('', 'tabDisplay','tabBtnDisplay','divInfo','btnE1')
                            openTabDiv('','divTabData','taballdb','btnTabData','tablinks');

                        }
                    } else if (event.target == btnField) {
                        var sFind = prompt("Please enter Field Name", "");
                        if (sFind != null) {
                            sSql ="SELECT COLUMN_NAME, TABLE_NAME ";
                            sSql += " FROM INFORMATION_SCHEMA.COLUMNS ";
                            sSql += " WHERE COLUMN_NAME LIKE '%"+sFind+"%' ";
                            sendManyQueryData(sSql,'tblInfo','divTabData','tabsuball','tablinks');
                            //openTabDiv('','divInfo','taball','btnE1','tablinks');
                            openTabFunc('', 'tabDisplay','tabBtnDisplay','divInfo','btnE1')
                            openTabDiv('','divTabData','taballdb','btnTabData','tablinks');


                        }

                    } else if (event.target == btnView) {
                        var sFind = prompt("Please enter SP Name", "");
                        if (sFind != null) {
                            sSql ="SHOW CREATE PROCEDURE "+sFind;
                            sendViewSPData(sSql,'txtSPView','divSPView',sFind);
                            //SHOW CREATE FUNCTION sp_plus
                        }
                    }
                }

            
            } else {               
                document.body.innerHTML = "";
            }
            
                //input.placeholder = "Couldn't load datalist options :(";
        }
    };



    showLoader();
        
    var sURL = 'http://' + window.location.hostname + _URLMYSQL + '/rmxDBFunction.php';

    console.log(sURL + "===" + sql);


    request.open('POST', sURL, true);

    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send('functionname=checkData&table=www&values='+encodeURI(sql));
    //console.log(sURL + "===" + sql);


}



function sendLoadMainTextCommand(){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(response) {
        //console.log("request.status=" + request.status);
        
        if (RequestStatus(request)) {
            var sRet  =request.responseText;
            sRet = sRet.trim();
            console.log("request.responseText \n [["+sRet + "]]");

            if (sRet.length >0){

                var cmbList = document.getElementById('cmbLoad');
                var dataList = document.getElementById('dtGroup');

                var sGroup = "";
                var arRow = sRet.trim().split("$");
                var nLen = arRow.length;     
                for (var r=0;r<nLen;r++ )
                {
                    var sVal = arRow[r].trim();
                    if (r==0) sGroup=sVal;
                    var option = document.createElement('option');                    
                    option.id = sVal;
                    option.value = sVal;
                    dataList.appendChild(option);

                    var opt = document.createElement('option');
                    opt.text = sVal;
                    cmbList.add(opt);
                }
                document.getElementById("txtGroup").value = sGroup;  

            }
        }
    };

            
    var sURL = 'http://' + window.location.hostname + _URLMYSQL + '/rmxDBFunction.php';
    request.open('POST', sURL, true);

    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("functionname=readMainSQL&table=&values=");
    //console.log(sURL + "===" + sql);    
}



function sendShowTextCommand(nId,sMsg){
    alert("Ok");
    var sId = "txtSQL"+ nId;
    var txtSQL = document.getElementById(sId);
    txtSQL.value=sMsg;
}


function sendClearTextCommand(nId){
    var sId = "txtSQL"+ nId;
    var txtSQL = document.getElementById(sId);
    txtSQL.value="";
}

function sendExecuteCommand(nId){
    var sId = "txtSQL"+ nId;
    var txtSQL = document.getElementById(sId);
    if ( txtSQL.value.length >0){
        var r = confirm("Comfirm Execute Command");
        if (r) sendExecutePostData(txtSQL.value);  
    }
}

function sendSubmitCommand(nId){
    var sId = "txtSQL"+ nId;
    var txtSQL = document.getElementById(sId);
    if ( txtSQL.value.length >0){
        sId = "divResult"+ nId;
        var sBId = "btn"+ nId;
        sendManyQueryData(txtSQL.value,'tblResult',sId,'tabcontent','tablinks');                            
        openTabFunc('', 'tabDisplay','tabBtnDisplay',sId,sBId);    
    }
}


function checkDataList(sId,sValue) {

    var sNo =  "";
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
    if (sNo==""){
        var option = document.createElement('option');
        option.id = sValue;
        option.value = sValue;
        sNo = sValue;
    } else {
        sNo = "";
    }
    return sNo;
}


function getDataList(sId,sValue) {

    
    var sNo = "1^RMX Main^u304817194_rmxmain^u304817194_rmx00^OKwefer2552";
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


function createSendMsgByDBNo(sql,sNo){

    var sTN  = 'txtShop' + sNo;
    var sDN  = 'dtShop' + sNo;
    var val = document.getElementById(sTN).value;        
    var sNo =  getDataList(sDN,val);

    var asVal = sNo.trim().split("^");
    //console.log("{"+asVal.length + "====" +val+"=="+sNo+"}");
    if (asVal.length ==1) asVal = sNo.trim().split(",");

    var sPointId = asVal[0];
    var sDBName = asVal[2];
    var sDBUser = asVal[3];
    var sDBPWD = asVal[4];

    var sURL = 'http://' + window.location.hostname + _URLMYSQL + '/rmxDBFunction.php';
    var sSend ='functionname=queryManyMainCommand&table=www&values='+encodeURI(sql)
        +"&DBName="+sDBName+"&DBUser="+sDBUser+"&DBPWD="+sDBPWD;

    // sSend ="cmd=KKAI&sid=rmxcell&pid=10001&uid=rmx&key1=test&query="+encodeURIComponent(sql);      
    console.log("[["+sURL + "]] -- [["+sSend +"]]");
        
    var arRet = [];
    arRet.push(sURL,sSend);
    return arRet;
}


function createSendMsg(sql){

    var val = document.getElementById("txtShop").value;        
    var sNo =  getDataList("dtShop",val);



    var asVal = sNo.trim().split("^");
    //console.log("{"+asVal.length + "====" +val+"=="+sNo+"}");
    if (asVal.length ==1) asVal = sNo.trim().split(",");

    var sPointId = asVal[0];
    var sDBName = asVal[2];
    var sDBUser = asVal[3];
    var sDBPWD = asVal[4];

    var sURL = 'http://' + window.location.hostname + _URLMYSQL + '/rmxDBFunction.php';
    var sSend ='functionname=queryManyMainCommand&table=www&values='+encodeURI(sql)
        +"&DBName="+sDBName+"&DBUser="+sDBUser+"&DBPWD="+sDBPWD;

    // sSend ="cmd=KKAI&sid=rmxcell&pid=10001&uid=rmx&key1=test&query="+encodeURIComponent(sql);      
    console.log("[["+sURL + "]] -- [["+sSend +"]]");
        

    var arRet = [];
    arRet.push(sURL,sSend);
    return arRet;
    }

    function clearTableData(table){
    var rowCount =  table.rows.length;
    while(--rowCount) {
        if (rowCount >0)table.deleteRow(rowCount);
    }
    table.deleteTHead();

}

function ResponseData(sRet){
    return sRet.trim();

}

function RequestStatus(request){
    if (request.readyState === 4) {
        if  (request.status === 200) {
                
            return true;
        } else {
            hideLoader();
        }
        
    }
    return false;
}


function selectElementContents(el) {
    var body = document.body, range, sel;
    if (document.createRange && window.getSelection) {
        range = document.createRange();
        sel = window.getSelection();
        sel.removeAllRanges();
        try {
            range.selectNodeContents(el);
            sel.addRange(range);
        } catch (e) {
            range.selectNode(el);
            sel.addRange(range);
        }
        document.execCommand("copy");

    } else if (body.createTextRange) {
        range = body.createTextRange();
        range.moveToElementText(el);
        range.select();
        range.execCommand("Copy");
    }
}


function popup(mylink, windowname) { 
    if (! window.focus) return true; 
    var href; 
    if (typeof(mylink) == 'string') 
        href=mylink; 
    else 
        href=mylink.href; 

    var win = window.open("", "Title", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=200,top="+(screen.height-400)+",left="+(screen.width-840));
    win.document.body.innerHTML = href;

    // window.open(href, windowname, 'width=400,height=200,scrollbars=yes'); 
    return false; 
}



function ResponseText(request) {

    var sRet = request.responseText;
    if (sRet){
        try {
            sRet = sRet.trim();
        } catch (err) {
            return "";
            //message.innerHTML = "Input is " + err;
        }
        return sRet;
    } else {
        return "";
    }

}

function sendViewSPDataByDB(sql,txtName,divName,sDBName){
    //txtSPView,divSPView

    //console.clear();

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);


    request.onreadystatechange = function(response) {
        //console.log("request.status=" + request.status);
        
        if (request.readyState === 4) {
            if (request.status === 200) {
                var nLen = request.responseText.length;

                var sRet =ResponseText(request);//request.responseText;
            
                console.log("request.responseText \n [["+sRet + "]]");
                var txtSPView = document.getElementById(txtName);
                if (txtSPView) {
                    txtSPView.value ="";
                    if (sRet.length >1){
                        var arData = sRet.split("^d");
                        //alert(arData.length);
                        if (arData.length > 0) {
                            var nMax =arData.length;

                            for (var r=0;r<nMax ;r++ ) {
                                var arTable = arData[r].split("^t");
                                var nTLen = arTable.length;					

                                if (nTLen >0){
                                    for (var k=0;k<nTLen;k++){
                                        var arTmp = arTable[k].split("^f");
                                        if (arTmp.length >1) {
                                            
                                            if (arTmp[1].length> 1) {
                                                var asRow = arTmp[1].split("^r");
                                                var nRLen = asRow.length;
                                                for (var r=0;r<nRLen ;r++ )
                                                {
                                                    if (asRow[r].length>0) {
                                                        var asData = asRow[r].split("^c");
                                                        if (asData.length>0) {
                                                            txtSPView.value = txtSPView.value + asData[2].trim();
                                                            //console.log("*" + asData[2].trim());
                                                        } //if (asData.length>0) 
                                                    }
                                                } //for (var r=0;r<nLen ;r++ )
                                            }
                                        } else {
                                            alert(arTable[k]);
                                        } //if (arTmp.length >0) 
                                    }
                                } //if (nLen >0)
                            }
                        }
                    } //if 
                    hideLoader();
                    document.getElementById(divName).style.display='block';
                }
                
            } else {
                hideLoader();
                //input.placeholder = "Couldn't load datalist options :(";
            }
        }
    };

    showLoader();

    var sDBCheck = "";
    var opt = document.getElementById("dtShop")
    if (opt)
    {
        var nLen = opt.options.length;
        for (var n=0;n<nLen;n++ ){
            var sNo = opt.options[n].id;
            var asVal = sNo.trim().split(",");
            var id="chk_" + asVal[0];

            if (sDBName==asVal[2]){
                sDBCheck = sNo;
                break;
            }
        }
    }
    if (sDBCheck.length > 0) {
        showLoader();

        var enSql = encodeURIComponent(window.btoa(encodeURIComponent(sql)));
        var enDBList = encodeURIComponent(window.btoa(encodeURIComponent(sDBCheck)));

        var sURL = 'http://' + window.location.hostname + _URLMYSQL + '/rmxDBFunction.php';

        var sSend = "functionname=queryEncManyDBCommand&table=www&values="+enSql
            +"&dblist="+enDBList;

        console.log(sSend);

        request.open('POST', sURL, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        request.send(sSend);



    } else {
        alert("Please select db name before click.");
    }



}


/*------------------------------------------------------------------------*/



function sendGetTableDatabyDBNo(sql,tableName,sDBNo)
{

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(response) {
    
        
        if (RequestStatus(request)){
            var sRet = ResponseData(request.responseText);
                    
            var table = document.getElementById(tableName);
            if (table) {
                
                clearTableData(table);
                //console.log(" clear table ");
                if (sRet.length >0){
                    
                    //console.log(" sendGetTableData responseText=[" + sRet+"]");

                    var arTable = sRet.split("^t");
                    if (arTable.length >0){

                        var arTmp = arTable[0].split("^f");
                        if (arTmp.length >1) {
                            var asCol = arTmp[0].split("^c");
                            var asRow = arTmp[1].split("^r");	

                            if (asRow.length >0) {
                                
                                var colCount = asCol.length;						
                                if (colCount>1){
                                    
                                    var header = table.createTHead();
                                    var row = header.insertRow(0);

                                    var cellb = row.insertCell(-1);
                                    cellb.innerHTML = "Chk";

                                    for(var c = 0; c < colCount; c++) {
                                        var cell = row.insertCell(-1);
                                        cell.innerHTML = asCol[c].trim();
                                    }

                                    var nRLen = asRow.length;
                                    for (var r=0;r<nRLen;r++ )
                                    {
                                        if (asRow[r].length>0) { 
                                            var row2 = table.insertRow(-1);
                                            var asData = asRow[r].split("^c");

                                            var cellb3 = row2.insertCell(-1);
                                            cellb3.innerHTML = "<input type='checkbox' id='chkTB_" + sDBNo +"_"+ r +"'" +" >";
                                                                    
                                            for(var c = 0; c < colCount; c++) {
                                                var cell = row2.insertCell(-1);
                                                if (asData.length>c) {
                                                    if (asData[c]) {
                                                        cell.innerHTML = asData[c].trim();
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } //if (colCount>1){
                        
                            }	
                        }	
                        hideLoader();
                    } else {
                        hideLoader();
                        alert(sRet);
                        //console.log(sRet);
                    }	

                }
            }
            hideLoader();
        }
        
                
    };

    //rmxapi/SPView.aspx?sid=rmxcell&pid=10001&uid=rmx&key1=test&query=");
    showLoader();
    //sDBNo
    var asRet = createSendMsgByDBNo(sql,sDBNo);
    var sURL = asRet[0];
    var sSend = asRet[1];

    console.log("\n" + sURL + "\n sSend=[" + sSend+"]");

    URLLog(sURL+"?"+sSend);

    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send(sSend);


}


function sendQueryPostDataToOneByDBNo(sql,tableName,sDBNo){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(response) {
        
        if (RequestStatus(request)){
            var sRet = ResponseData(request.responseText);

            var table = document.getElementById(tableName);
            if (table) {
                clearTableData(table);
                
            
                if (sRet.length >0){
                    var arTable = sRet.split("^t");
                    if (arTable.length >0){                

                        for(var t = 0; t < arTable.length; t++) {

                            var arTmp = arTable[t].split("^f");
                            if (arTmp.length >1) {
                                var asCol = arTmp[0].split("^c");
                                var asRow = arTmp[1].split("^r");
                                var colCount = 3;//asCol.length;

                                if (t==0) {
                                    //table.deleteTHead();
                                    var header = table.createTHead();
                                    var row = header.insertRow(0);    
                                    var cellb = row.insertCell(-1);
                                    cellb.innerHTML = "Chk";

                                    for(var c = 1; c < colCount; c++) {
                                        var cell = row.insertCell(-1);
                                        cell.innerHTML = asCol[c].trim();
                                    }
                                }
                                    
                                var nRLen = asRow.length;
                                for (var r=0;r<nRLen ;r++ )
                                {
                                    if (asRow[r].length>0) { 
                                        var row2 = table.insertRow(-1);


                                        var cellb3 = row2.insertCell(-1);
                                        cellb3.innerHTML = "<input type='checkbox' id='chkSP_" + sDBNo +"_"+ r +"'" +" >";

                                        var asData = asRow[r].split("^c");
                                        if (asData.length >0) {                                
                                            for(var c = 1; c < colCount; c++) {
                                                var sD =asData[c].trim();
                                                var cell = row2.insertCell(-1);
                                                cell.innerHTML = sD;

                                                if (c==2 && sD == 'PROCEDURE')  {
                                                    var createClickHandler = function(ccell) {
                                                        return function() {
                                                            var value = ccell.innerHTML;
                                                            sSql ="SHOW CREATE PROCEDURE "+value;
                                                            sendViewSPData(sSql,'txtSPView','divSPView',value);

                                                        };
                                                    };
                                                    cell.ondblclick = createClickHandler(cell);
                                                } else if (c==2 && sD == 'FUNCTION')  {
                                                    var createClickHandler = function(ccell) {
                                                        return function() {
                                                            var value = ccell.innerHTML;
                                                            sSql ="SHOW CREATE FUNCTION "+value;
                                                            sendViewSPData(sSql,'txtSPView','divSPView',value);

                                                        };
                                                    };
                                                    cell.ondblclick = createClickHandler(cell);
                                                }
                                            }                                    
                                            
                                        } //if (asData.length >0) {
                                    }
                                } //for (var r=0;r<nLen ;r++ )
                            } //if (arTmp.length >0) {                        
                        } //for(var t = 0; t < arTable.length; t++)
                    } //if (nLen >0){
                } //if (sRet.length >0){
                
            }
                
            hideLoader();
        }
        
        
    };

    showLoader();
    var asRet = createSendMsgByDBNo(sql,sDBNo);
    var sURL = asRet[0];
    var sSend = asRet[1];


    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);

}



function sendViewSPDataByDBNo(sql,txtName,sDBNo,AtCol,sNo){

    var request = new XMLHttpRequest();
    request.timeout = 30000; // 3 seconds
    request.ontimeout = () => console.log('timeout', request.responseURL);

    request.onreadystatechange = function(response) {
        //console.log("request.status=" + request.status);
        
      if (request.readyState === 4) {
            if (request.status === 200) {
                var nLen = request.responseText.length;
                var sRet =ResponseText(request);//request.responseText;		
                //console.log("request.status=" + sRet);		

                var txtView = document.getElementById(txtName);
                if (txtView) {
                    txtView.value ="";
                    if (sRet.length >1){
                        var arTable = sRet.split("^t");
                        if (arTable.length >0){
                            txtView.value = arTable[0].split("^f")[1].split("^c")[AtCol];
                            LNPrefix(txtView,sNo)
                        }						
                    } //if 
                    hideLoader();					
                }
                
            } else {
                hideLoader();
            }
        }
    };

    showLoader();
    var asRet = createSendMsgByDBNo(sql,sDBNo);
    var sURL = asRet[0];
    var sSend = asRet[1];

    URLLog(sURL+"?"+sSend);
    request.open('POST', sURL, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(sSend);



}





</script>


</body>
</html>