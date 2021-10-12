



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

  	
    $CompanyCode = '';
    if (isset($_POST['CompanyCode'])) $CompanyCode = $_POST['CompanyCode'];
    if (isset($_GET['CompanyCode'])) $CompanyCode = $_GET['CompanyCode'];

  
    $Command = '';
    if (isset($_POST['Command'])) $Command = $_POST['Command'];
    if (isset($_GET['Command'])) $Command = $_GET['Command'];
    

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
    $FlagMsg = '';
    $Flag = '';
    $UserName = '';
    $EMail = '';
    $MobileNo = '';

    $SQL = "call sp_main_check_register_get_db ('".$LineId ."','".$CompanyCode."')";
    /* ----------------------------------------------------------*/
    
    $conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
    if (mysqli_multi_query($conn,$SQL))
    {			
        do{
            $result=mysqli_store_result($conn);
            if ($result) {
                $rowCount = db_num_fields($result);
                if ($rowCount > 1) {
                    while($row = mysqli_fetch_array($result,MYSQLI_NUM)) {    

                        $FlagMsg = trim($row[0]);
                        $Flag = trim($row[1]);
                        $UserName = trim($row[2]);
                        $EMail = trim($row[3]);
                        $MobileNo = trim($row[4]);
                        $sSoldToCode = trim($row[5]);
                        $sSoldToName = trim($row[6]);  
                        $LDB = trim($row[7]);     
                        $LHOST = trim($row[8]);                        
                        $LUSER = trim($row[9]);
                        $LPASS = trim($row[10]);
                        $LPORT = trim($row[11]);
                        
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
   
    if ($Flag=="3"||$Flag=="4"||$Flag=="5") {
        if ($LDB != '' && $Command != '') {      
            selectManyQuery($Command,$LHOST,$LPORT,$LUSER,$LPASS,$LDB);
        } else {
            echo 'Cannot connect database';
        }  
    } else {
        echo '-1'.'^c'.$FlagMsg;
    }
	



?>
