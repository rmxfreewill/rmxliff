

<?php
ini_set('max_input_time','500');
ini_set('max_execution_time','500'); 
set_time_limit(300); 

/*
http://rmxcell.pe.hu/rmxRegister.php?LineId=t0000-930000330&CompanyCode=00001
    &CustName=test&CustSurName=Surtest
    &MobileNo=024871000&EMail=930000330@gmail.com

http://rmxcell.pe.hu/rmxRegister.php?LineId=t0000-930001398&CompanyCode=00001&CustName=test 930001398&CustSurName=Surtest 930001398&MobileNo=024871000&EMail=930001398@gmail.com

http://rmxcell.pe.hu/rmxRegister.php?LineId=t0000-930000483&CompanyCode=00001&CustName=test 930000483&CustSurName=Surtest 930000483&MobileNo=024871000&EMail=930000483@gmail.com

http://rmxcell.pe.hu/rmxRegister.php?LineId=t0000-930000286&CompanyCode=00001
    &CustName=test 930000286&CustSurName=Surtest 930000286
    &MobileNo=024871000&EMail=930000286@gmail.com
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
    
    $CustName = '';
    if (isset($_POST['CustName']))
        $CustName = $_POST['CustName'];
    if (isset($_GET['CustName']))
        $CustName = $_GET['CustName'];

    $CustSurName = '';
    if (isset($_POST['CustSurName']))
        $CustSurName = $_POST['CustSurName'];
    if (isset($_GET['CustSurName']))
        $CustSurName = $_GET['CustSurName'];
    
    

    $MobileNo = '';
    if (isset($_POST['MobileNo']))
        $MobileNo = $_POST['MobileNo'];
    if (isset($_GET['MobileNo']))
        $MobileNo = $_GET['MobileNo'];    


    $EMail = '';
    if (isset($_POST['EMail']))
        $EMail = $_POST['EMail'];        
    if (isset($_GET['EMail']))
        $EMail = $_GET['EMail'];   


    if ($LineId === '' ||  $CompanyCode === '' ||  $MobileNo === '' || $EMail === ''
        ||  $CustName === '' || $CustSurName === '') {
            echo 'NOT Parameter';
    } else {
        
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

        $SQL = "CALL sp_main_reqister_user ('".$LineId."','".$CompanyCode
        ."','".$CustName."','".$CustSurName."','".$MobileNo."','".$EMail."');";
      //  echo $SQL ."\n";
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
                            $SoldToCode = trim($row[5]);   
                            $SoldToName = trim($row[6]);   
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
                if (!mysqli_next_result($conn)){
                    break;
                }
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
            $lconn=db_mainconnect($LHOST,$LUSER,$LPASS,$LDB,$LPORT);
            /* ----------------------------------------------------------*/
            $SQL = "CALL sp_comp_reqister_user ('".$LineId."','".$CompanyCode
                ."','".$SoldToCode."','".$SoldToName."','".$MobileNo."','".$EMail."');";   

            //echo $SQL;
            $lresult = db_query($lconn,$SQL);
            if ($lresult) {
                $fieldCount = mysqli_num_fields($lresult);    
                
                while($row = mysqli_fetch_array($lresult,MYSQLI_NUM)) { 
                    echo trim($row[1]);                        
                } 
                db_free($lresult);
                $lresult = null;
            }	
            if ($lconn) {
                db_close($lconn);
            }
            $lconn = null;                
        } else {

        }
        

    
    }


?>
