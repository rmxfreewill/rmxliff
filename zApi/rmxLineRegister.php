



<?php
ini_set('max_input_time','500');
ini_set('max_execution_time','500'); 
set_time_limit(300); 

/*
http://rmxcell.pe.hu/rmxLineRegister.php?LineId=t0000-930000330
    &CompanyCode=00001
    &LineDisplay=display
    &UserName=UserName
    &Tel=9983473955
    &EMail=g@g.com
    
http://rmxcell.pe.hu/rmxLineRegister.php?LineId=teeeee930000330&CompanyCode=00001&LineDisplay=display&UserName=UserName&Tel=9983473955&EMail=g@g.com

*/

include_once ("rmxQueryFunctions.php");


	$LineId = '';
	if (isset($_POST['LineId'])) $LineId = $_POST['LineId'];
    if (isset($_GET['LineId'])) $LineId = $_GET['LineId'];       

    $LineDisplay = '';
	if (isset($_POST['LineDisplay'])) $LineDisplay = $_POST['LineDisplay'];
    if (isset($_GET['LineDisplay'])) $LineDisplay = $_GET['LineDisplay'];       
	
    $CompanyCode = '';
    if (isset($_POST['CompanyCode'])) $CompanyCode = $_POST['CompanyCode'];
    if (isset($_GET['CompanyCode'])) $CompanyCode = $_GET['CompanyCode'];

    $UserName = '';
    if (isset($_POST['UserName'])) $UserName = $_POST['UserName'];
    if (isset($_GET['UserName'])) $UserName = $_GET['UserName'];
            
    $Tel = '';
    if (isset($_POST['Tel'])) $Tel = $_POST['Tel'];
    if (isset($_GET['Tel'])) $Tel = $_GET['Tel'];
    
    $EMail = '';
    if (isset($_POST['EMail'])) $EMail = $_POST['EMail'];
    if (isset($_GET['EMail'])) $EMail = $_GET['EMail'];
    

    $HOST = RMXHOST;
    $PORT =RMXPORT;
    $USER = RMXUSER;
    $PASS =RMXPASS;
    $DB = RMXDB;


    $LHOST = '';
    $LPORT ='';
    $LUSER = '';
    $LPASS ='';
    $LDB = '';
    $SoldToName = '';
    $SoldToCode = '';
    $sFlagMsg = '';
    $nFlag = '';

    
    $SQL = "call sp_main_line_reqister_to_db ('".$LineId ."','".$CompanyCode
        ."','".$UserName."','".$LineDisplay."','".$Tel."','".$EMail."')";
    /* ----------------------------------------------------------*/
    //querylog($SQL." \n [".$HOST.",".$PORT.",".$USER.",".$PASS.",".$DB."]");
    $conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
    if (mysqli_multi_query($conn,$SQL))
    {			
        do{
            $result=mysqli_store_result($conn);
            if ($result) {
                $rowCount = db_num_fields($result);
                if ($rowCount > 1) {
                    while($row = mysqli_fetch_array($result,MYSQLI_NUM)) {   
                        //select $sFlagMsg,$nFlag,$sName,$sMobileNo,$sEMail
                        //,$sSoldToCode,$sSoldToName
                        //,sDatabase,sServer,sDBUser,sDBPWD,sDBPort
                        $sFlagMsg = trim($row[0]);
                        $nFlag = trim($row[1]);

                        $sSoldToCode = trim($row[5]);
                        $sSoldToName = trim($row[6]);  
                        $LDB = trim($row[7]);     
                        $LHOST = trim($row[8]);                        
                        $LUSER = trim($row[9]);
                        $LPASS = trim($row[10]);
                        $LPORT = trim($row[11]);

                       // querylog(" \n [".$sFlagMsg.",".$nFlag.",".$sSoldToCode.",".$sSoldToName."]");
                        
                    }                   
                } else {
                    echo 'Not Found User';
                }         
                mysqli_free_result($result);                                    
            } else{
                if (strlen(mysqli_error($conn)) >0)
                    echo mysqli_errno($conn).':'.mysqli_error($conn);                        
                break;
            }
            if (!mysqli_next_result($conn)) break;
        } 
        while (true);
    }
    //echo "222\n";                          
    if ($conn) {
        db_close($conn);
    }
    $conn = null;
   
    if ($nFlag=="4") {
    // querylog("[".$LDB."]");
        if ($LDB != '') {      
            $Command ="call sp_comp_reqister_user ('".$LineId."','".$CompanyCode."','"
                .$LineDisplay."','".$sSoldToCode."','".$sSoldToName."','"
                .$Tel."','".$EMail."')";
            //querylog($Command." \n [".$LHOST.",".$LPORT.",".$LUSER.",".$LPASS.",".$LDB."]");
            selectManyQuery($Command,$LHOST,$LPORT,$LUSER,$LPASS,$LDB);
            // select '4','Found Sold To',$sUserName,$sMobileNo,$sEMail,$sSoldToCode,$sSoldToName;
        } else {
            echo 'Cannot connect database';
        }
    } else {
        //querylog("Return \n [".$sFlagMsg.'^c'.$nFlag.'^c'.$sName.'^c'.$sMobileNo
        //    .'^c'.$sEMail.'^c'.$sSoldToCode.'^c'.$sSoldToName."]");

        echo $sFlagMsg.'^c'.$nFlag.'^c'.$sName.'^c'.$sMobileNo
            .'^c'.$sEMail.'^c'.$sSoldToCode.'^c'.$sSoldToName;


    }
  




?>
