

<?php
ini_set('max_input_time','500');
ini_set('max_execution_time','500'); 
set_time_limit(300); 

/*
http://rmxcell.pe.hu/rmxLineCmd.php?LineId=t0000-930000330&CompanyCode=00001
    &Command=call sp_comp_select_ticket('t0000-930000330','','')

http://rmxcell.pe.hu/rmxLineCmd.php?LineId=t0000-930000330&CompanyCode=00001
    &Command=call sp_comp_select_ticket('t0000-930000330','8/9/2018','8/11/2018')
http://rmxcell.pe.hu/rmxLineCmd.php?LineId=t0000-930000330&CompanyCode=00001
&Command=call sp_comp_insert_user_resquest ('test00948477444','00001','test send text','test send message');


http://rmxcell.pe.hu/rmxLineCmd.php?Command=call sp_main_select_company('')

http://rmxcell.pe.hu/rmxLineCmd.php?Command=CALL sp_main_check_user ('t0000-930001398','00001');
*/

include_once ("rmxQueryFunctions.php");


	$LineId = '';
	if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
		$LineId = $_GET['LineId'];        
	
    $CompanyCode = '';
    if (isset($_POST['CompanyCode']))
        $CompanyCode = $_POST['CompanyCode'];
    if (isset($_GET['CompanyCode']))
        $CompanyCode = $_GET['CompanyCode'];
    
    $Command = '';
    if (isset($_POST['Command']))
        $Command = $_POST['Command'];
    if (isset($_GET['Command']))
        $Command = $_GET['Command'];
    

    $QueryCommand = '';
    if (isset($_POST['QueryCommand']))
        $QueryCommand = $_POST['QueryCommand'];
    if (isset($_GET['QueryCommand']))
        $QueryCommand = $_GET['QueryCommand'];

    $HOST = RMXHOST;
    $PORT =RMXPORT;
    $USER = RMXUSER;
    $PASS =RMXPASS;
    $DB = RMXDB;
    

    if ($LineId != '' &&  $CompanyCode != '' && $Command != '') {
        selectCompanyQuery($CompanyCode,$HOST,$PORT,$USER,$PASS,$DB,$Command);

    } else  if ($LineId != '' &&  $CompanyCode != '' && $QueryCommand != '') {
        selectQueryCommand($CompanyCode,$HOST,$PORT,$USER,$PASS,$DB,$QueryCommand);

    } else {
        
        if ( $Command != '') {
           // querylog("rmxLineCmd \n" . $Command." \n [".$HOST.",".$PORT.",".$USER.",".$PASS.",".$DB."]");
            selectManyQuery($Command,$HOST,$PORT,$USER,$PASS,$DB);
        } else {
            echo 'No Parameter pass';
        }
    }


    
    function selectAllQuery($CompanyCode,$HOST,$PORT,$USER,$PASS,$DB,$Command,$MainCommand){
        $LHOST = '';
        $LPORT ='';
        $LUSER = '';
        $LPASS ='';
        $LDB = '';
        $SoldToName = '';
        $SoldToCode = '';

        /* ----------------------------------------------------------*/
        selectManyQuery($MainCommand,$HOST,$PORT,$USER,$PASS,$DB);

        /* ----------------------------------------------------------*/
        $conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
        $SQL = "CALL sp_main_select_db ('".$CompanyCode."');";
        if (mysqli_multi_query($conn,$SQL))
        {			
            do{
                $result=mysqli_store_result($conn);
                if ($result) {
                    $rowCount = db_num_fields($result);
                    if ($rowCount > 3) {
                        while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
                            $LHOST = trim($row[1]);
                            $LPORT = trim($row[4]);
                            $LUSER = trim($row[2]);
                            $LPASS = trim($row[3]);
                            $LDB = trim($row[0]);                             
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
       // echo $LHOST.",".$LUSER.",".$LPASS.",".$LDB.",".$LPORT;
        if ($LDB != '') {
            selectManyQuery($Command,$LHOST,$LPORT,$LUSER,$LPASS,$LDB);
        } else {
            echo 'Cannot connect database';
        }
    }

    function selectCompanyQuery($CompanyCode,$HOST,$PORT,$USER,$PASS,$DB,$Command){
        $LHOST = '';
        $LPORT ='';
        $LUSER = '';
        $LPASS ='';
        $LDB = '';
        $SoldToName = '';
        $SoldToCode = '';

        /* ----------------------------------------------------------*/
        $conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);

        $SQL = "CALL sp_main_select_db ('".$CompanyCode."');";
        if (mysqli_multi_query($conn,$SQL))
        {			
            do{
                $result=mysqli_store_result($conn);
                if ($result) {
                    $rowCount = db_num_fields($result);
                    if ($rowCount > 3) {
                        while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
                            $LHOST = trim($row[1]);
                            $LPORT = trim($row[4]);
                            $LUSER = trim($row[2]);
                            $LPASS = trim($row[3]);
                            $LDB = trim($row[0]);                             
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
       // echo $LHOST.",".$LUSER.",".$LPASS.",".$LDB.",".$LPORT;
        if ($LDB != '') {
           // querylog("rmxLineCmd \n" . $Command." \n [".$LHOST.",".$LPORT.",".$LUSER.",".$LPASS.",".$LDB."]");
            selectManyQuery($Command,$LHOST,$LPORT,$LUSER,$LPASS,$LDB);
        } else {
            echo 'Cannot connect database';
        }
    }



    function selectQueryCommand($CompanyCode,$HOST,$PORT,$USER,$PASS,$DB,$Command){
        $LHOST = '';
        $LPORT ='';
        $LUSER = '';
        $LPASS ='';
        $LDB = '';
        $SoldToName = '';
        $SoldToCode = '';

        /* ----------------------------------------------------------*/
        $conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);

        $SQL = "CALL sp_main_select_db ('".$CompanyCode."');";
        if (mysqli_multi_query($conn,$SQL))
        {			
            do{
                $result=mysqli_store_result($conn);
                if ($result) {
                    $rowCount = db_num_fields($result);
                    if ($rowCount > 3) {
                        while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
                            $LHOST = trim($row[1]);
                            $LPORT = trim($row[4]);
                            $LUSER = trim($row[2]);
                            $LPASS = trim($row[3]);
                            $LDB = trim($row[0]);                             
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
       // echo $LHOST.",".$LUSER.",".$LPASS.",".$LDB.",".$LPORT;
        if ($LDB != '') {
           // querylog("selectMoreQuery \n" . $Command." \n [".$LHOST.",".$LPORT.",".$LUSER.",".$LPASS.",".$LDB."]");
            selectMoreQuery($Command,$LHOST,$LPORT,$LUSER,$LPASS,$LDB);
        } else {
            echo 'Cannot connect database';
        }
    }



?>
