

<?php
ini_set('max_input_time','500');
ini_set('max_execution_time','500'); 
set_time_limit(300); 

/*
http://rmxcell.pe.hu/rmxLineToDB.php?LineId=t0000-930000330&CompanyCode=00001
    &Command=call sp_comp_select_ticket('t0000-930000330','','')

http://rmxcell.pe.hu/rmxLineToDB.php?LineId=t0000-930000330&CompanyCode=00001
    &Command=call sp_comp_select_ticket('t0000-930000330','8/9/2018','8/11/2018')

http://rmxcell.pe.hu/rmxLineToDB.php?LineId=t0000-930000330&CompanyCode=00001
&Command=call sp_comp_insert_user_resquest ('test00948477444','00001','test send text','test send message');


http://rmxcell.pe.hu/rmxLineToDB.php?Command=call sp_main_select_company('')

http://rmxcell.pe.hu/rmxLineToDB.php?Command=CALL sp_main_check_user ('t0000-930001398','00001');
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
    

    $HOST = RMXHOST;
    $PORT =RMXPORT;
    $USER = RMXUSER;
    $PASS =RMXPASS;
    $DB = RMXDB;

    if ($LineId != '' &&  $CompanyCode != ''){
        CommandByLineId($HOST,$USER,$PASS,$DB,$PORT,$LineId,$CompanyCode,$Command);
    } else {
        if ( $Command != '') {         
            selectManyQuery($Command,$HOST,$PORT,$USER,$PASS,$DB);
        } else {
            echo 'No Parameter pass';
        }
    }




    function CommandByLineId($HOST,$USER,$PASS,$DB,$PORT,$LineId,$CompanyCode,$Command){

        $LHOST = '';
        $LPORT ='';
        $LUSER = '';
        $LPASS ='';
        $LDB = '';
        $LineFlag ='';
        $SoldToName = '';
        $SoldToCode = '';
        $res = "";

        //call sp_main_check_register_get_db('00001','00001');
        $conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
        $SQL = "CALL sp_main_check_register_get_db ('".$LineId."','".$CompanyCode."');";
        if (mysqli_multi_query($conn,$SQL))
        {			
            $tblNo=0;
           // $resAll = "";
            do{
                $result=mysqli_store_result($conn);
                if ($result) {
                    if (strlen($resAll) >0) $resAll = $resAll."^t";
                    $rowCount = db_num_fields($result);

                    if ($tblNo==0) $res = "";
                    while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
                                            
                        //echo $tblNo;
                        if ($tblNo==0){

                            //echo "OK (" .$rowCount.")";
                            if (strlen($res) >0) $res = $res."^r";
                            for ($n=0;$n<$rowCount;$n++) {
                                if ($n >0) $res=$res."^c";
                                $res=$res.trim($row[$n]);				
                            }
                            $LineFlag= trim($row[1]);
                            $SoldToCode= trim($row[5]);
                            $SoldToName= trim($row[6]);

                            //echo $res; 
                            //echo  $LineFlag.','.$SoldToCode,','.$SoldToName;
                            // select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo,$sSoldToCode,$sSoldToName;
                            
                            //echo $res;
                        } else if ($tblNo==1){
                            $LHOST = trim($row[1]);
                            $LPORT = trim($row[4]);
                            $LUSER = trim($row[2]);
                            $LPASS = trim($row[3]);
                            $LDB = trim($row[0]);               
                        }
                    }                                       
                    mysqli_free_result($result);                                    

                   // $resAll=$resAll.$res;
                } else{
                    if (strlen(mysqli_error($conn)) >0)
                        echo mysqli_errno($conn).':'.mysqli_error($conn);                        
                    break;
                }
                if (!mysqli_next_result($conn)) break;
                $tblNo++;
            } 
            while (true);
        }
        if ($conn) db_close($conn);        
        $conn = null;

        //echo $res;

        if ($LineFlag =="3" || $LineFlag =="4" || $LineFlag =="5") {
            if ($Command != '') {    
                if ($LDB != '') {
                    selectManyQuery($Command,$LHOST,$LPORT,$LUSER,$LPASS,$LDB);
                } else {
                    echo 'Cannot connect database';
                }
            } else {
                echo $res;
            }
        } else {
            echo $res;
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
           
	}


    function temp(){

        if ($LineId != '' &&  $CompanyCode != '' && $Command != '') {
            
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
            // echo "[". $Command ."]";

                selectManyQuery($Command,$LHOST,$LPORT,$LUSER,$LPASS,$LDB);
            } else {
                echo 'Cannot connect database';
            }
            
        } else {
            if ( $Command != '') {

                $HOST = RMXHOST;
                $PORT =RMXPORT;
                $USER = RMXUSER;
                $PASS =RMXPASS;
                $DB = RMXDB;

                //echo "[". $Command ."]\n\n";
            // echo '['.$Command.','.$HOST.','.$PORT.','.$USER.','.$PASS.','.$DB.']';
                selectManyQuery($Command,$HOST,$PORT,$USER,$PASS,$DB);

            } else {
                echo 'No Parameter pass';
            }
        }
    }


?>
