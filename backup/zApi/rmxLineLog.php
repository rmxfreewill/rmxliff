



<?php
ini_set('max_input_time','500');
ini_set('max_execution_time','500'); 
set_time_limit(300); 

/*
http://rmxcell.pe.hu/rmxLineCmd.php?LineId=t0000-930000330&CompanyCode=00001
    &Command=call sp_comp_select_ticket('t0000-930000330','','')

http://rmxcell.pe.hu/rmxLineCmd.php?LineId=t0000-930000330&CompanyCode=00001
    &Command=call sp_comp_select_ticket('t0000-930000330','8/9/2018','8/11/2018')

http://rmxcell.pe.hu/rmxLineCmd.php?Command=call sp_main_select_company('')

http://rmxcell.pe.hu/rmxLineLog.php?Command=CALL sp_main_check_user ('t0000-930001398','00001');

http://rmxcell.pe.hu/rmxLineLog.php?CompanyCode=00001&LineToken=urrrrrrrrr&UserId=2222222
&Command=call sp_comp_insert_user_resquest ('test00948477444','00001','test send text','test send message');

*/

include_once ("rmxQueryFunctions.php");

    $CompanyCode = '';
    if (isset($_POST['CompanyCode']))
        $CompanyCode = $_POST['CompanyCode'];
    if (isset($_GET['CompanyCode']))
        $CompanyCode = $_GET['CompanyCode'];


    $LineToken = '';
	if (isset($_POST['LineToken']))
        $LineToken = $_POST['LineToken'];
    if (isset($_GET['LineToken']))
		$LineToken = $_GET['LineToken'];        

	$UserId = '';
	if (isset($_POST['UserId']))
        $UserId = $_POST['UserId'];
    if (isset($_GET['UserId']))
		$UserId = $_GET['UserId'];        
	
   
    $Message = '';
    if (isset($_POST['Message']))
        $Message = $_POST['Message'];
    if (isset($_GET['Message']))
        $Message = $_GET['Message'];
    

    if ($LineToken != '' &&  $UserId != '' && $Message != '' && $CompanyCode !='') {
        
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
                        echo 'Not Found Company';
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


	function selectManyQuery($SQL,$HOST,$PORT,$USER,$PASS,$DB) {

        //echo '['.$SQL.']';

        $lconn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
        /* ----------------------------------------------------------*/     
        //echo $SQL;
        $lresult = db_query($lconn,$SQL);
        if ($lresult) {
            $fieldCount = mysqli_num_fields($lresult);    
            $res = "";
            //echo '['.$SQL.']='.$fieldCount.']';
            
            while($row = mysqli_fetch_array($lresult,MYSQLI_NUM)) { 

                if (strlen($res) >0) $res = $res."^r";
                for ($n=0;$n<$fieldCount;$n++) {
                    if ($n >0) $res=$res."^c";
                    $res=$res.trim($row[$n]);				
                }
            } 
            db_free($lresult);
            $lresult = null;

            echo $res;
        }	
        if ($lconn) {
            db_close($lconn);
        }
        $lconn = null;  
            /*

			$res = '';
            $res = db_multi_query($conn,$SQL);
            echo '['.$res.']';
			echoData($res);
			if ($conn) {
				mysqli_close($conn);
			}
			$conn = null;
            */
	}




?>
