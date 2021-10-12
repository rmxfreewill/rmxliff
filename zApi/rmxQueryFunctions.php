<?php
header('Content-Type: text/html; charset=utf-8');

ini_set('memory_limit', '-1');

//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();
include_once("define_Gobal.php");



function force_gzip()
{
	// Ensures only forced if the Accept-Encoding header contains "gzip"
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
	{
		header('Content-Encoding: gzip');
		ob_start('ob_gzhandler');
	}
}

function db_mainconnect($HOST,$USER,$PASS,$DB,$PORT)
{
	
	/*
	echo '<script type="text/javascript">';
	echo 'alert("connection database:('.$HOST.','.$USER.','.$PASS.','.$DB.','.$PORT.'")';
	echo '</script>';
	*/
	$conn = mysqli_connect($HOST , $USER, $PASS,$DB ,$PORT);
	if (!$conn){
		 errorlog("main connection object not created: ".mysqli_error($conn).":".mysqli_connect_error()." (".$HOST.",".$USER.",".$PASS.",".$DB.",".$PORT);
		 exit();
	}
	if (mysqli_connect_errno()) {
		errorlog("main Connect failed: %s\n" . mysqli_connect_error());
		exit();
	}

	mysqli_set_charset($conn,'utf8');
	
	mysqli_query($conn,"SET character_set_results=utf8");
	mysqli_query($conn,"SET character_set_client=utf8");
	mysqli_query($conn,"SET character_set_connection=utf8");

	mysqli_query($conn,"SET character_set_database=utf8");
	mysqli_query($conn,"SET character_set_server=utf8");
	mysqli_query($conn,"SET collation_server=utf8_unicode_ci");
	//mysqli_select_db($DB);
	
	return $conn;
}

function db_connect($HOST,$USER,$PASS,$DB,$PORT)
{


	//querylog("DBName(".$_SESSION["DBName"].')DBUser('.$_SESSION["DBUser"].')DBPWD('.$_SESSION["DBPWD"].')');

	$DB2 =  $_SESSION["DBName"];
	$USER2= $_SESSION["DBUser"];
	$PASS2= $_SESSION["DBPWD"];

	//querylog("DBName2(".$DB2.')DBUser2('.$USER2.')DBPWD2('.$PASS2.')');

	/*
	echo '<script type="text/javascript">';
	echo 'alert("connection database:('.$HOST.','.$USER.','.$PASS.','.$DB.','.$PORT.'")';
	echo '</script>';
	*/
	
	
	if (!$conn){
		$conn = mysqli_connect($HOST , $USER2, $PASS2,$DB2 ,$PORT);

		 //errorlog("connection object not created: ".mysqli_error($conn).":".mysqli_connect_error()." (".$HOST.",".$USER.",".$PASS.",".$DB.",".$PORT);
		 //exit();
	}

	if (!$conn){
		 errorlog("connection object not created: ".mysqli_error($conn).":".mysqli_connect_error()." (".$HOST.",".$USER.",".$PASS.",".$DB.",".$PORT);
		 exit();
	}

	if (mysqli_connect_errno()) {
		errorlog("Connect failed: %s\n" . mysqli_connect_error());
		exit();
	}

	mysqli_set_charset($conn,'utf8');
	
	mysqli_query($conn,"SET character_set_results=utf8");
	mysqli_query($conn,"SET character_set_client=utf8");
	mysqli_query($conn,"SET character_set_connection=utf8");

	mysqli_query($conn,"SET character_set_database=utf8");
	mysqli_query($conn,"SET character_set_server=utf8");
	mysqli_query($conn,"SET collation_server=utf8_unicode_ci");
	//mysqli_select_db($DB);
	
	//querylog("Connect OK");
	return $conn;
}

function db_close($conn)
{
	if ($conn != null) {
		mysqli_close($conn) or die("Couldn t execute query.".mysqli_error($conn));
		$conn = null;
	}
}

//get data from table
function mkr_query($strsql,$conn)
{

	return  db_query($conn,$strsql);
	
}

//get data from table
function db_query($conn,$strsql)
{


	$result = mysqli_query($conn, $strsql);	
	//if (!$result){
		if (strlen(mysqli_error($conn)) >0)
			errorlog("db_query=(".$strsql.")\n\t".mysqli_errno($conn).':\n\t'.mysqli_error($conn));
	//}

	return $result;
}

function db_num_rows($rs)
{

	try {
		$nRow = mysqli_num_rows($rs); 
		if ($nRow) 
			return $nRow; 
		else
			return 0;
	} catch (Exception $e) {
		return 0;
	}
	
}

function db_fetch($rs)
{
	//db_fetch_assoc($result)
	return mysqli_fetch_assoc($rs);//,MYSQL_ASSOC);
}

function db_fetch_array($rs)
{
	//echo $rs;
	return mysqli_fetch_array($rs);
}
function db_free($rs)
{
	if ($rs != null) {
		mysqli_free_result($rs);
	}
}

function db_free_result($rs)
{
	if ($rs != null) {
		mysqli_free_result($rs);
	}
}


function db_field_name($rs, $i )
{
	return mysqli_field_name($rs);
}


function db_fetch_assoc($rs)
{
	//echo $rs;
	return mysqli_fetch_assoc($rs);
}

function db_data_seek($rs,$cnt)
{
	mysqli_data_seek($rs, $cnt);
}

function db_error($conn)
{
	return mysqli_errno($conn).': '.mysqli_error($conn);
	//return mysqli_error($conn);
}

function db_fetch_object($rs)
{
	//echo $rs;
	return mysqli_fetch_object($rs);
}

//get number of rows in results sets
function db_num_fields($rs)
{
	return @mysqli_num_fields($rs); 
}

//get number of rows in results sets
function num_rows($rs)
{
	return @mysqli_num_rows($rs); 
}

function fetch_array($rs)
{
	//echo $rs;
	return mysqli_fetch_array($rs);
}

//fetch object
function fetch_object($rs)
{
	//echo $rs;
	return mysqli_fetch_object($rs);
}

function free_result($rs)
{
	@mysqli_free_result($rs);
}

function data_seek($rs,$cnt)
{
	@mysqli_data_seek($rs, $cnt);
}

function error($conn)
{
	return mysqli_error($conn);
}

//---------------------------------------------------------


function db_find($conn,$sql){
	//$sql = "CALL sp_select_user ('$search')";

	$result=db_query($conn,$sql);
	if ($result) {
		$tbl=fetch_object($result);

		db_free($result);
		$result = null;
	}
	return $tbl;
}


function db_select($HOST,$USER,$PASS,$DB,$PORT,$sql){

	//$sql = "CALL sp_select_user ('$search')";
	$conn =db_connect($HOST,$USER,$PASS,$DB,$PORT);

	$result=db_query($conn,$sql);
	if ($result) {
		$tbl=fetch_object($result);

		db_free($result);
		$result = null;
	}
	if ($conn) {
		db_close ($conn);
		$conn = null;
	}
	return $tbl;
}


function db_multi_query($con,$sql)
{
	$res = "";
		
	//querylog($sql);
	if (mysqli_multi_query($con,$sql))
	{			
	 	do{
			$result=mysqli_store_result($con);
			if ($result) {

				$rowCount = db_num_fields($result);
				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
					for ($idx = 0; $idx < $rowCount; $idx++)
					{
						$res=$res.trim($row[$idx])."^C";
					}
					$res=$res."^R";
				} 
		
				$res = $res."^T";
				
				mysqli_free_result($result);
				
				
			} else{
				if (strlen(mysqli_error($con)) >0)

					errorlog("db_multi_query=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));
				break;
			}
			if (!mysqli_next_result($con)){
				break;
			}
		} 
		while (true);
		
	}
	return $res;	
	
	
}

/*
$cars = array
  (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
  );

*/


function db_ArrayQuery($sql){
	$arTable = array();
	$conn=db_connect(HOST,USER,PASS,DB,PORT);
	if ($conn) {
		
		$arTable = db_mmquery($conn,$sql);
	}
	db_close ($conn);
	$conn = null;
	return $arTable;

}

function db_mquery($con,$sql)
{
	querylog($sql);
	$nTable =0;
	$arTable = array();
		
	if (mysqli_multi_query($con,$sql))
	{			

	 	do{
			$result=mysqli_store_result($con);
			if ($result) {

				$arRow = array();
				$nRow =0;
				$rowCount = db_num_fields($result);
				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 

					$arCol = array();
					for ($idx = 0; $idx < $rowCount; $idx++)
					{
						$finfo = $result->fetch_field_direct($idx);
						$arCol[$finfo->name] =$row[$idx];

						//array_push($arCol,$row[$idx]);
					}

					$arRow[$nRow]  =$arCol;
					$nRow++;
				} 
		
				mysqli_free_result($result);
				
				$arTable[$nTable] =$arRow;
				$nTable++;
				
			} else{
				if (strlen(mysqli_error($con)) >0)
					errorlog("db_mquery=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));
				break;
			}
			if (!mysqli_next_result($con)){
				break;
			}
		} 
		while (true);


	
	}
	

	return $arTable;	
	
	
}



function db_mmquery($con,$sql)
{
	//querylog($sql);
	$nTable =0;
	$arTable = array();
		
	if (mysqli_multi_query($con,$sql))
	{			

	 	do{
			$result=mysqli_store_result($con);
			if ($result) {

				$arColumn = array();
				$arRow = array();
				$nRow =0;


				$rowCount = db_num_fields($result);
				for ($idx = 0; $idx < $rowCount; $idx++)
				{
					$finfo = $result->fetch_field_direct($idx);
					$arColumn[$idx] =$finfo->name;
				}
				$arTable[$nTable] = $arColumn;
				$nTable++;

				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 

					$arCol = array();
					for ($idx = 0; $idx < $rowCount; $idx++)
					{
						//$finfo = $result->fetch_field_direct($idx);
						$arCol[$idx] =$row[$idx];						
					}

					$arRow[$nRow]  =$arCol;
					$nRow++;
				} 
		
				mysqli_free_result($result);

				$arTable[$nTable] =$arRow;
				$nTable++;

			
				
			} else{
				if (strlen(mysqli_error($con)) >0)
					errorlog("db_mquery=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));
				break;
			}
			if (!mysqli_next_result($con)){
				break;
			}
		} 
		while (true);


	
	}
	

	return $arTable;	
	
	
}


function db_one_query($con,$sql)
{
	//querylog($sql);
	$res = "";
	$result= mysqli_query($con,$sql);
	if ($result) 
	{
		$resType ="";
		$rowCount = db_num_fields($result);

		for ($idx = 0; $idx < $rowCount; $idx++)
		{
			$finfo = $result->fetch_field_direct($idx);

			$res =$res.$finfo->name."^C";
			$resType =$resType .$finfo->type."^C";
		}
		$res=$res."^R";
		$res=$res.$resType."^R";

		while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
			for ($idx = 0; $idx < $rowCount; $idx++)
			{
				$res=$res.trim($row[$idx])."^C";
			}
			$res=$res."^R";
		} 

		$res = $res."^T";
		mysqli_free_result($result);
		
	} else {
		if (strlen(mysqli_error($con)) >0)
			errorlog("db_one_query=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));

	}
	return $res;	
	
}

function db_one_value($con,$sql)
{
	//querylog($sql);
	$res = "";
	$result= mysqli_query($con,$sql);
	if ($result) 
	{	
		$rowCount = num_rows($result); 
		if ($rowCount >0) {
			$row = mysqli_fetch_array($result,MYSQLI_NUM);
			$res=$row[0];
		}
		mysqli_free_result($result);
		$result = null;
		
	} else {
		if (strlen(mysqli_error($con)) >0)
			errorlog("db_one_value=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));
	}
	return $res;	
	
}


function getSelectCombo($HOST,$USER,$PASS,$DB,$PORT,$SQL) {
	 

	$res = ":;NEW:New Data";
	$con=db_connect($HOST,$USER,$PASS,$DB,$PORT);

	if ($con) {
		//$SQL = "call sp_select_detail_th_list ('TRDeviceType');";
		$result = db_query($con,$SQL);
		if ($result) {
			while($row = db_fetch($result)) { 
				if ($res != "")
					$res = $res.";";
				//$res=$res . $row['sDesc'] . ":" . $row['sDesc'];
				$res=$res . $row['sNo'] . ":" . $row['sDesc'];

			} 

			db_free($result);
			$result = null;
		}
		db_close ($con);
		$con =null;
	}
	return "\"" . $res . "\"";
 }


function getSelectComboDesc($HOST,$USER,$PASS,$DB,$PORT,$SQL) {
	 
	$res = ":;NEW:New Data";
	$con=db_connect($HOST,$USER,$PASS,$DB,$PORT);

	if ($con) {
		//$SQL = "call sp_select_detail_th_list ('TRDeviceType');";
		$result = db_query($con,$SQL);
		if ($result) {
			while($row = db_fetch($result)) { 
				if ($res != "")
					$res = $res.";";
				$res=$res . $row['sDesc'] . ":" . $row['sDesc'];
				//$res=$res . $row['sNo'] . ":" . $row['sDesc'];

			} 

			db_free($result);
			$result = null;
		}
		db_close ($con);
		$con =null;
	}
	return "\"" . $res . "\"";
 }

function get_client_ip() 
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}




function dbCreateEntry($con,$sql)
{
	$res = "";
	//querylog($sql);
	if (mysqli_multi_query($con,$sql))
	{			
	 	do{
			$result=mysqli_store_result($con);
			if ($result) {

				$rowCount = db_num_fields($result);
				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
					for ($idx = 0; $idx < $rowCount; $idx++)
					{
						$res=$res.trim($row[$idx])."^C";
					}
					$res=$res."^R";
				} 
		
				$res = $res."^T";
				
				mysqli_free_result($result);
				
				
			} else{
				if (strlen(mysqli_error($con)) >0)
					errorlog("dbCreateEntry=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));
				break;
			}
			if (!mysqli_next_result($con)){
				break;
			}
		} 
		while (true);
		
	}
	return $res;	
	
	
}




function selectMultiQuery($SQL) {

		$conn=db_connect(HOST,USER,PASS,DB,PORT);
		if ($conn) {
			$res = '';
			$res = db_multi_query($conn,$SQL);
			echo $res;
		
			mysqli_close($conn);
		} else {
			echo $SQL;
		}
		$conn = null;
	
}


function excuteMDB($conn,$sql)
{
	$resAll = "";
	if (mysqli_multi_query($conn,$sql))
	{			
		
		do{
			$result=mysqli_store_result($conn);
			if ($result) {
				if (strlen($resAll) >0) $resAll=$resAll."^t";
				
				$res = "";
				$fieldCount = db_num_fields($result);
				for ($n=0;$n<$fieldCount;$n++) {
					$finfo = $result->fetch_field_direct($n);
					if ($n >0) $res=$res."^c";
					$res=$res.trim($finfo->name);	
				}

				$resAll=$resAll.$res."^f";	
				$res = "";

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
				    errorlog("db_mquery=(".$sql.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
				break;
			}
			if (!mysqli_next_result($conn)){
				break;
			}
		} 
		while (true);
	}
	return $resAll;	
	
}


function db_toString($result)
{
	$res= "";
	if ($result) 
	{
		$rowCount = db_num_fields($result);
		while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
			for ($idx = 0; $idx < $rowCount; $idx++)
			{
				$res=$res.trim($row[$idx]).",";
			}
			$res=$res.",";
		} 
		mysqli_free_result($result);
		
	
	}
	return $res;	
	
}

function dbValue($result)
{
	$res= "";
	if ($result) 
	{
		$rowCount = db_num_fields($result);
		while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
			for ($idx = 0; $idx < $rowCount; $idx++)
			{
				if (strlen($res)>1) 
					$res=$res.",";
				$res=$res.trim($row[$idx]);
			}
			
		} 
		mysqli_free_result($result);
		
	
	}
	return trim($res);	
	
}


function selectOneArray($sSql) {

	$arValue=array();

	if (strlen($sSql) >0){
		$conn=db_connect(HOST,USER,PASS,DB,PORT);

		
		$result = db_query($conn,$sSql);
		if ($result) {

			//$fieldCount = mysqli_num_fields($result);

		
			while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
				array_push($arValue,$row[0]); 
			} 
			db_free($result);
			$result = null;
		}	
		if ($conn) {
			db_close($conn);
		}
		$conn = null;
	}

	return $arValue;
	
}

function selectToArray($sSql) {

	$arRow=array();

	if (strlen($sSql) >0){
		$conn=db_connect(HOST,USER,PASS,DB,PORT);

		
		$result = db_query($conn,$sSql);
		if ($result) {

			$fieldCount = mysqli_num_fields($result);
			
			while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
				/*
				$arColumn=array();
				for ($idx = 0; $idx < $fieldCount; $idx++) {
					array_push($arColumn,$row[$idx]); 
			    }

				array_push($arRow,$arColumn); 
				*/
				array_push($arRow,$row);
			} 

			db_free($result);
			$result = null;
		}	
		if ($conn) {
			db_close($conn);
		}
		$conn = null;
	}

	return $arRow;
	
}


function selectToMultiArray($sSql) {

	
	$arTable = array();
	
	$con=db_connect(HOST,USER,PASS,DB,PORT);
	
	if (mysqli_multi_query($con,$sSql))
	{			
	 	do{
			$result=mysqli_store_result($con);
			if ($result) {
				$arRow = array();

				$fieldCount = mysqli_num_fields($result);
				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
					/*
					$arColumn=array();
					for ($idx = 0; $idx < $fieldCount; $idx++) {
						array_push($arColumn,$row[$idx]); 
					}
					*/
					array_push($arRow,$row);//$arColumn); 
				} 
			
				mysqli_free_result($result);
				
				array_push($arTable,$arRow);

			} else{
				if (strlen(mysqli_error($con)) >0)
					errorlog("db_multi_query=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));
				break;
			}
			if (!mysqli_next_result($con)){
				break;
			}
		} 
		while (true);
		
	}
	if ($con) {
		db_close($con);
	}
	$con = null;

	return $arTable;	
	
}


		
function db_multi_execute($con,$sql)
{
	$res = "";
	querylog($sql);
	if (mysqli_multi_query($con,$sql))
	{			
	 	do{
			$result=mysqli_store_result($con);
			if ($result) {
				$res = $res . mysqli_fetch_all($result, MYSQLI_ASSOC);
				mysqli_free_result($result);
			} else{
				if (strlen(mysqli_error($con)) >0)
					errorlog("db_multi_query=(".$sql.")\n\t".mysqli_errno($con).':'.mysqli_error($con));
				break;
			}
		} 
		while (true);
	}

	return $res;	
	
}

// ------------------------------------------------------------

function querylog($log_msg)
{
    $log_filename = "querylog";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/querylog_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, $log_msg ."\n".date('Y-m-d H:i:s')."\n" , FILE_APPEND);
}

function errorlog($log_msg)
{
    $log_filename = "errorlog";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/errorlog_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, "\n".date('Y-m-d H:i:s')."\n" . $log_msg . "\n", FILE_APPEND);
}



function errorquerylog($query,$log_msg)
{
    $log_filename = "errorlog";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/errorlog_' . date('d-M-Y') . '.log';
	file_put_contents($log_file_data, "\n".date('Y-m-d H:i:s')."\n".$query."\n". $log_msg . "\n", FILE_APPEND);
}



function is_connected()
{
  $connected = fopen("http://www.google.com:80/","r");
  if($connected)
  {
     return true;
  } else {
   return false;
  }

}

	
function selectManyQuery($SQL,$HOST,$PORT,$USER,$PASS,$DB) {


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



function selectMoreQuery($SQL,$HOST,$PORT,$USER,$PASS,$DB) {


	$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
	/* ----------------------------------------------------------*/     
	//echo $SQL;
	$resAll = "";
	if (mysqli_multi_query($conn,$SQL))
	{			
		
		do{
			$result=mysqli_store_result($conn);
			if ($result) {
				if (strlen($resAll) >0) $resAll=$resAll."^t";
				
				$res = "";
				$fieldCount = db_num_fields($result);
				for ($n=0;$n<$fieldCount;$n++) {
					$finfo = $result->fetch_field_direct($n);
					if ($n >0) $res=$res."^c";
					$res=$res.trim($finfo->name);	
				}

				$resAll=$resAll.$res."^f";	
				$res = "";

				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
					if (strlen($res) >0) $res = $res."^r";
					for ($n=0;$n<$fieldCount;$n++) {
						if ($n >0) $res=$res."^c";
						$res=$res.trim($row[$n]);				
					}
				} 
				mysqli_free_result($result);
				$resAll=$resAll.$res;	

				//querylog("selectMoreQuery \n" ."[".$resAll."]");
			} else {
				if (strlen(mysqli_error($conn)) >0) 
				    errorlog("db_mquery=(".$sql.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
				break;
			}
			if (!mysqli_next_result($conn)){
				break;
			}
		} 
		while (true);
	}
	echo $resAll;
	
	if ($conn) {
		db_close($conn);
	}
	$conn = null;  
	
	//return $resAll;	

}




?>



