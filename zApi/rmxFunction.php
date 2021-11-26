


<?php
ini_set('max_input_time','500');
ini_set('max_execution_time','500'); 
set_time_limit(300); 
//http://rmxcell.pe.hu/rmxFunction.php?spdata=call%20sp_bkk_print_order(%27Or-201911-000002%27,%2710001%27);
//http://rmxcell.pe.hu/rmxFunction.php?spdata=call sp_main_select_company('');

include_once ("rmxQueryFunctions.php");;

	$passTable = '';
	if (isset($_POST['table']))
		$passTable = $_POST['table'];

	$passValue = '';
	if (isset($_POST['values']))
		$passValue = $_POST['values'];

	$passField = '';
	if (isset($_POST['fields']))
		$passField = $_POST['fields'];

	$passBy = '';
	if (isset($_POST['byperson']))
		$passBy = $_POST['byperson'];

	$loginName = '';
	if (isset($_POST["loginname"]))
		$loginName = $_POST["loginname"];

	$session= '';
	if (isset($_POST["sessionkey"]))
		$session= $_POST["sessionkey"];

	$UDID= '';


	$SQLCommand= '';
	if (isset($_POST['sqlCommand'])) {
		$SQLCommand = urldecode($_POST['sqlCommand']);
		$SQLCommand = str_replace("\\t",'',$SQLCommand);
	}

	$FunctionName= '';
	if (isset($_POST['functionname']))
		$FunctionName = $_POST['functionname'];
	

	$SPName= '';
	if (isset($_POST['spname']))
		$SPName = $_POST['spname'];


	$SPSql= '';
	if (isset($_GET['spsql']))
		$SPSql = $_GET['spsql'];
	if (isset($_POST['sppost']))
		$SPSql = $_POST['sppost'];

	$SPLevel= '0';
	if (isset($_GET['splevel']))
		$SPLevel = $_GET['splevel'];
	if (isset($_POST['splevel']))
		$SPLevel = $_POST['splevel'];
	
	$SPData= '';
	if (isset($_GET['spdata']))
		$SPData = $_GET['spdata'];
	if (isset($_POST['spdata']))
		$SPData = $_POST['spdata'];



	$HOST = RMXHOST;
	$PORT =RMXPORT;
	$USER = RMXUSER;
	$PASS =RMXPASS;
	$DB = RMXDB;

	if (isset($_POST["DBName"]))
		$DB= $_POST["DBName"];
	if (isset($_GET['DBName']))
		$DB = $_GET['DBName'];


	if (isset($_POST["DBUser"]))
		$USER= $_POST["DBUser"];
	if (isset($_GET['DBUser']))
		$USER = $_GET['DBUser'];		

	if (isset($_POST["DBPWD"]))
		$PASS= $_POST["DBPWD"];
	if (isset($_GET["DBPWD"]))
		$PASS= $_GET["DBPWD"];		

/* ----------------------------------------------------------*/



if (strlen( $SPSql) >0){
	selectQuery($SPSql,$HOST,$PORT,$USER,$PASS,$DB,$UDID,$session,$SPLevel);
} else {

	if (strlen($SPData) >0){
		selectDataOnly($SPData,$HOST,$PORT,$USER,$PASS,$DB,$UDID,$session,$SPLevel);
	} else {
		switch($FunctionName){ 
			case "ExecuteCommand":
				ExecuteCommand($SQLCommand,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			
			case 'selectToQuery':
				selectToQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'selectOneQuery':
				selectOneQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'selectManyQuery':
				selectManyQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			default:
				echo 'NOT Parameter';
			break;
		}
	}
}
/* ----------------------------------------------------------*/

function ExecuteCommand($sql,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
	if (strlen($sql) >0){
		$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
		$sql = str_replace("!","'",$sql);
		$sql =str_replace("|","\'",$sql);
		//querylog($sql);
		$rs = db_query($conn,$sql);
		if (!$rs) {
			//echo '<script type="text/javascript">';
			//echo 'alert("'.db_error($conn).'")';
			//echo '</script>';
			errorlog(db_error($conn));
			echo db_error($conn);
		} else {
			echo dbValue($rs);
		}
		if ($conn) {
			db_close($conn);
		}
		$conn = null;

	}
	exit(1);
}
/* ----------------------------------------------------------*/




function selectManyQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

	if (strlen($passValue) >0){
	
		$Value =str_replace("|","'",$passValue);
		$SQL = "CALL ".$passTable." (".$Value.");";
		//echo $SQL;

		$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
		
		$res = '';
		$res = db_multi_query($conn,$SQL);
		echo $res;
		if ($conn) {
			mysqli_close($conn);
		}
		$conn = null;
	}

	
}


/* ----------------------------------------------------------*/
function selectToQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

	if (strlen($passValue) >0){
		$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
		$Value =str_replace("|","'",$passValue);
		$SQL = "CALL ".$passTable." (".$Value.");";
		

		$result = db_query($conn,$SQL);
		if ($result) {

			$fieldCount = mysqli_num_fields($result);
			$res = '';
			//$rowCount = db_num_fields($result);
			while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
				if ($res != "")
					$res = $res."$";

				for ($n=0;$n<$fieldCount;$n++) {
					if ($n >0){
						$res=$res."^";
					}
					$res=$res.trim($row[$n]);				
				}
			} 
			db_free($result);
			echo $res;
			$result = null;
		}	
		if ($conn) {
			db_close($conn);
		}
		$conn = null;

		exit(1);
	}

	
	
}

/* ----------------------------------------------------------*/

function selectOneQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

	if (strlen($passValue) >0){
		$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);


		$Value =str_replace("|","'",$passValue);
		$SQL = "CALL ".$passTable." (".$Value.");";

		$result = db_query($conn,$SQL);
		if ($result) {
			$res = '';
			//$rowCount = db_num_fields($result);
			while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
				if ($res != "")
					$res = $res."$";

				$res=$res.trim($row[0]);	
				
			} 
			db_free($result);
			echo $res;
			$result = null;
		}	
		
		if ($conn) {
			db_close($conn);
		}
		$conn = null;

		exit(1);
	}

	
	
}


/* ----------------------------------------------------------*/




 /* ----------------------------------------------------------*/
function selectQuery($SPSql,$HOST,$PORT,$USER,$PASS,$DB,$UDID,$session,$SPLevel) {

	//querylog("selectQuery==".$SQL.'|'.$HOST.'|'.$USER.'|'.$PASS.'|'.$DB.'|'.$PORT);
	$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
	if ($conn) {
		//$SQL ='call ' . str_replace("^","'",$SPSql);

		$SQL = str_replace("!","'",$SPSql);
		$SQL = str_replace("|","\'",$SQL);
		
		
		 querylog("selectQuery==".$SQL.'|'.$HOST.'|'.$USER.'|'.$PASS.'|'.$DB.'|'.$PORT);

		$resAll = '';
		if (mysqli_multi_query($conn,$SQL))
		{			
			do{
				$result=mysqli_store_result($conn);
				if ($result) {
					if (strlen($resAll) >0) $resAll=$resAll."^t";
					
					$res = '';
					$fieldCount = db_num_fields($result);
					for ($n=0;$n<$fieldCount;$n++) {
						$finfo = $result->fetch_field_direct($n);
						if ($n >0) $res=$res."^c";
						$res=$res.trim($finfo->name);	
					}

					$resAll=$resAll.$res."^f";	
					$res = '';

					while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
						if (strlen($res) >0) $res = $res."^r";
						for ($n=0;$n<$fieldCount;$n++) {
							if ($n >0) $res=$res."^c";
							$res=$res.trim($row[$n]);				
						}
					} 
					mysqli_free_result($result);
					$resAll=$resAll.$res;	
				} else {
					if (strlen(mysqli_error($conn)) >0) 
						errorlog("db_mquery=(".$SQL.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
					break;
				}
				if (!mysqli_next_result($conn)){
					break;
				}
			} 
			while (true);
		}
		if (strlen($resAll) >1){
			$resAll = $UDID.'^u'.$session.'^s'.$resAll;
		}
		if ($conn) {
			db_close($conn);
		}


		//$realImage = base64_decode($image);
		
		$conn = null;
		if ($SPLevel == '0'){
			echo $resAll;
		} else if ($SPLevel == '2'){
			echo json_encode($resAll);
		} else {
			$compressed = gzcompress($resAll, $SPLevel);
			echo $compressed;
		}
		exit(1);

		
	} else {
		querylog("selectQuery Error Connect=".$SQL.'|'.$HOST.'|'.$USER.'|'.$PASS.'|'.$DB.'|'.$PORT);
	}
	
}

/* ----------------------------------------------------------*/
function selectDataOnly($SPSql,$HOST,$PORT,$USER,$PASS,$DB,$UDID,$session,$SPLevel) {
	$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
	if ($conn)
	{
		//$SQL ='call ' . str_replace("^","'",$SPSql);

		$SQL = str_replace("!","'",$SPSql);
		$SQL = str_replace("|","\'",$SQL);
		
		querylog($SQL);

		$resAll = '';
		if (mysqli_multi_query($conn,$SQL))
		{			
			do{
				$result=mysqli_store_result($conn);
				if ($result) {
					if (strlen($resAll) >0) $resAll=$resAll."^t";
					
					$res = '';
					$fieldCount = db_num_fields($result);
					$resAll=$resAll.$res."^f";	
					$res = '';

					while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
						if (strlen($res) >0) $res = $res."^r";
						for ($n=0;$n<$fieldCount;$n++) {
							if ($n >0) $res=$res."^c";
							$res=$res.trim($row[$n]);				
						}
					} 
					mysqli_free_result($result);
					$resAll=$resAll.$res;	
				} else {
					if (strlen(mysqli_error($conn)) >0) 
						errorlog("db_mquery=(".$SQL.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
					break;
				}
				if (!mysqli_next_result($conn)){
					break;
				}
			} 
			while (true);
		}
		if (strlen($resAll) >1){
			$resAll = $UDID.'^u'.$session.'^s'.$resAll;
		}
		if ($conn) {
			db_close($conn);
		}
		$conn = null;

		if ($SPLevel == '0'){
			echo $resAll;
		} else if ($SPLevel == '2'){
			echo json_encode($resAll);
		} else {
			//ini_set("zlib.output_compression", "On");
			//ob_start("ob_gzhandler");
			$compressed = gzcompress($resAll, $SPLevel);
			//ob_end_flush();
			echo $compressed;
		}
		//echo $resAll;
		exit(1);
	}
}

/*----------------------------------------------------------------------*/

?>



