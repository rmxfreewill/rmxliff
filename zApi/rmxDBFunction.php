<?php 
	//Max length for a GET is 2,048 characters =]

	include_once ("rmxQueryFunctions.php");
	
	

	ini_set('memory_limit', '-1');

	$HOST = RMXHOST;
	$PORT =RMXPORT;
	$USER = RMXUSER;
	$PASS =RMXPASS;
	$DB = RMXDB;



	$CHECKMYSQL =CHECKMYSQL;//"RMX";
	session_start();

	

	if (isset($_POST['DBName'])) $DB = $_POST['DBName'];
	if (isset($_POST['DBUser'])) $USER = $_POST['DBUser'];
	if (isset($_POST['DBPWD'])) $PASS = $_POST['DBPWD'];

	
	$isZip = "0";
	if (isset($_GET['iszip']))
		$isZip = $_GET['iszip'];
	if (isset($_POST['iszip']))
		$isZip = $_POST['iszip'];


	$passTable = "";
	if (isset($_GET['table']))
		$passTable = $_GET['table'];
	if (isset($_POST['table']))
		$passTable = $_POST['table'];

	$passValue = "";
	if (isset($_GET['values']))
		$passValue = $_GET['values'];
	if (isset($_POST['values']))
		$passValue = $_POST['values'];

	$passField = "";
	if (isset($_GET['fields']))
		$passField = $_GET['fields'];
	if (isset($_POST['fields']))
		$passField = $_POST['fields'];

	$postValue = "";
	if (isset($_POST['postvalues']))
		$postValue = $_POST['postvalues'];

	$passBy = "";
	if (isset($_GET['byperson']))
		$passBy = $_GET['byperson'];

	$loginName = "";
	if (isset($_SESSION["loginname"]))
		$loginName = $_SESSION["loginname"];

	$session= "";
	if (isset($_SESSION["sessionkey"]))
		$session= $_SESSION["sessionkey"];

	$linkValue = "";
	if (isset($_GET['linkValue']))
		$linkValue = $_GET['linkValue'];

	$linkName = "";
	if (isset($_GET['linkName']))
		$linkName = $_GET['linkName'];
	
	$linkTable = "";
	if (isset($_GET['linkName']))
		$linkTable = $_GET['linkTable'];
	
	$SQLCommand= "";
	if (isset($_GET['sqlCommand']))
		$SQLCommand = $_GET['sqlCommand'];


	
	$DBList = "";
	if (isset($_POST['dblist']))
		$DBList = $_POST['dblist'];

	$functionname = "";
	if (isset($_GET['functionname']))
		$functionname = $_GET['functionname'];
	if (isset($_POST['functionname']))
		$functionname = $_POST['functionname'];
	
	if (is_connected()) {
		switch($functionname){ 
		
			case 'ExecuteCommand':
				ExecuteCommand($SQLCommand,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'MultiExecuteCommand':
				MultiExecuteCommand($passValue,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'MultiExecuteMainCommand':
				MultiExecuteMainCommand($passValue,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'MultiEncExecuteMainCommand':
				MultiEncExecuteMainCommand($passValue,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'saveComboData': 
	
				saveComboData($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;  
			case 'saveComboNew': 
				saveComboNew($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			
			 case 'saveComboLinkData': 
				saveComboLinkData($passTable, $passValue, $loginName,$linkName,$linkValue,$linkTable
					,$HOST,$PORT,$USER,$PASS,$DB);
				break; 
	
			case 'saveDeleteData': 
				saveDeleteData($passTable ,$passValue, $passField,$passBy,  $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;  
			case 'saveManyData': 
				saveManyData($passField ,$passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;  
			case 'findData': 
				getFindData($passTable ,$passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB,$session);
				break;
				
			case 'findManyData': 
				getFindManyData($passTable ,$passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB,$session);
				break;
			case 'getFillManyData': 
				getFillManyData($passTable ,$passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
	
			case 'saveDeleteDigital': 
				saveDeleteDigital($passValue, $passField,$passBy,  $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;  
	
			case 'saveDataToTable':
				saveDataToTable($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'encode':
				encode($passValue);
				break;
			case 'decode':
				decode($passValue);
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
			case 'selectCommand':
				selectCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			
			case 'queryCommand':
				queryCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'queryMainCommand':
				queryMainCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			//case 'queryMainGZCommand':
		///		queryMainGZCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
			//	break;
			case 'queryManyCommand':
				queryManyCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
	
			case 'queryManyMainCommand':
				queryManyMainCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'queryEncManyMainCommand':
				queryEncManyMainCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;

			case 'queryEncManyDBCommand':
				queryEncManyDBCommand($passValue, $loginName,$HOST,$PORT,$DBList);
				break;
			case "PostExecuteCommand":
				queryManyCommand($postValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
				break;
			case 'checkData':
	
				if ($passValue ==$CHECKMYSQL){
					echo "select distinct Table_Name , table_rows from information_schema.tables where table_type ='BASE TABLE' order by Table_Name";
				} else {
					echo "";	
				}
				
				break;
			case 'readSQL':
				readSQLFile($postValue,$passField);				
				break;
			case 'writeSQL':
				writeSQLFile($postValue,$passField,$passTable, $passValue);				
				break;
			case 'readMainSQL':
				readMainSQLFile();				
				break;
			case 'writeMainSQL':
				writeMainSQLFile($passField);				
				break;
		}   
		
	} else {
		echo '<script type="text/javascript">';
		echo 'alert("Connection not available. กรุณาตรวจสอบ Internet")';
		echo '</script>';
	}

		//errorlog("(".$_GET["functionname"]."),(".$SQLCommand."),(".$passTable."),(".$passValue.")");

	/*
	header('Content-Encoding: gzip'); 
	$output = gzencode(json_encode($data));     
	echo $output;
	*/

/* ----------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------- */

	function readMainSQLFile(){
		$sqlpath = "query";
		if (!file_exists($sqlpath)) mkdir($sqlpath, 0777, true);
		
		$sqlfile = $sqlpath.'/mainlog.log';			
		if ($file = fopen($sqlfile, "r")) {
			$line ="";
			while(!feof($file)) {
				$line = $line . fgets($file);
			}
			fclose($file);
			echo $line;
		}
	}


	function writeMainSQLFile($sFile){
		$sqlpath = "query";
		if (!file_exists($sqlpath)) mkdir($sqlpath, 0777, true);
		$mainfile = $sqlpath.'/mainlog.log';							
		file_put_contents($mainfile, $sFile."$\n", FILE_APPEND);	
		
		echo "ok";
	}


	function readSQLFile($sGroup,$sFile){
		
		$sqlpath = "query";
		if (!file_exists($sqlpath)) mkdir($sqlpath, 0777, true);

		if (strlen($sGroup) >0){
			$mainfile = $sqlpath.'/mainlog.log';							
			file_put_contents($mainfile, $sGroup."$\n", FILE_APPEND);	
		}

		$sqlfile = $sqlpath.'/'.$sFile.'.log';			
		
		if ($file = fopen($sqlfile, "r")) {
			$line ="";
			while(!feof($file)) {
				$line = $line . fgets($file);
			}
			fclose($file);
			echo $line;
		}
	}

	function writeSQLFile($sGroup,$sFile,$header,$detail){

		$sqlpath = "query";
		if (!file_exists($sqlpath)) mkdir($sqlpath, 0777, true);

		if (strlen($sGroup) >0){
			$mainfile = $sqlpath.'/mainlog.log';							
			file_put_contents($mainfile, $sGroup."$\n", FILE_APPEND);	
		}

		$sqlfile = $sqlpath.'/'.$sFile.'.log';		
		$header = $header . "^H" . $detail . "^D";		

		file_put_contents($sqlfile, $header."\n", FILE_APPEND);	
		
		echo "ok";
	}

	function deleteSQLFile($sFile){
		$sqlpath = "query";
		if (!file_exists($sqlpath)) mkdir($sqlpath, 0777, true);
		$sqlfile = $sqlpath.'/'.$sFile.'.log';		
		unlink($sqlfile);
		
	}

	function encode($str){
		echo base64_encode($str);
	}

	function decode($str){
		echo base64_decode($str);
	}


	


	function saveDataToTable($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);

			$asValue = explode("|", $passValue);
			
			$sql = "call ".$passTable." (";
			$nLoop =0;
			 foreach ($asValue as $v) { 
				if ($nLoop ==1) {
					$sql = $sql . ",";
				}
				$sql = $sql . "'" . $v . "'";
				$nLoop =1;
			 }
			$sql = $sql . ");";


			$result = db_query($conn,$sql);
			if ($result === false) {
				echo db_error($conn);
			} else {
				echo "";
			}
			
			db_result($result);
			$result = null;

			db_close($conn);
			$conn = null;
			
		}
		
	}




	function saveComboData($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$loginName= $_SESSION["loginname"];

			$sql="call sp_save_new_combo('".$passTable."','".$passValue."','".$loginName."')";
			//echo $sql;
			//querylog($sql);

			$rs = db_query($conn,$sql);
			if (!$rs) {
				echo '<script type="text/javascript">';
				echo 'alert("'.db_error($conn).'")';
				echo '</script>';
				//errorlog(db_error($conn));
			}
			echo db_toString($rs);


			db_close($conn);
			$conn = null;


			
		}
		
	}

	function MultiExecuteCommand($sql,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		if (strlen($sql) >0){
			$sql =str_replace("|","\'",$sql);

			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);

			$rs = db_multi_execute($conn,$sql);
			if (!$rs) {
				echo db_error($conn);
				
			} else {
				if (strlen(db_error($conn)) >0){
					echo db_error($conn);
				} else {
					echoData($rs);
					//echo $rs;
				}
			}
			
			db_close($conn);
			$conn = null;

		}
		
	}



	function MultiExecuteMainCommand($sql,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		if (strlen($sql) >0){
			$sql =str_replace("|","\'",$sql);

			$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);

			$rs = db_multi_execute($conn,$sql);
			if (!$rs) {
				
				echo db_error($conn);
				
			} else {
				if (strlen(db_error($conn)) >0){
					echo db_error($conn);
				} else {

					db_close($conn);
					$conn = null;
					echo $rs;
				}
			}
			if ($conn != null) {
				db_close($conn);
				$conn = null;
			}
			

		}
		
	}

	function MultiEncExecuteMainCommand($sql,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		if (strlen($sql) >0){
			//$sql =base64_decode(urldecode($sql));//str_replace("|","\'",$sql);

			$sql = urldecode(base64_decode(urldecode($sql)));
			//echo $sql;
			$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);

			$rs = db_multi_execute($conn,$sql);
			if (!$rs) {
				echo db_error($conn);
				
			} else {
				if (strlen(db_error($conn)) >0){
					echo db_error($conn);
				} else {

					db_close($conn);
					$conn = null;
					echo $rs;
				}
			}
			if ($conn != null) {
				db_close($conn);
				$conn = null;
			}
		}
		
	}


	function ExecuteCommand($sql,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		if (strlen($sql) >0){
			$sql =str_replace("|","\'",$sql);

			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);

			$rs = db_query($conn,$sql);
			if (!$rs) {
				echo '<script type="text/javascript">';
				echo 'alert("'.db_error($conn).'")';
				echo '</script>';
				//errorlog(db_error($conn));
			}
			echo dbValue($rs);
			db_close($conn);
			$conn = null;

		}
		
	}

	function saveDialogData($passTable, $passField, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) { 
	   	   
		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$loginName= $_SESSION["loginname"];
			$sql="call sp_save_new_dialog('".$passField."','".$passValue."','".$passTable."','".$loginName."','".POINTID."')";
			//querylog($sql);
			
			$resAll = excuteMDB($conn,$sql);
			
			//errorlog($resAll);
			db_close($conn);
			$conn = null;

			echo $resAll;
			
		}
		
	}

	
	function saveManyData($passField, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) { 
	   	   
		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$loginName= $_SESSION["loginname"];
			$sField =str_replace("|","\'",$passField);
			$sValue =str_replace("|","\'",$passValue);

			$sql="call sp_save_many_table('".$sField."','".$sValue."','".$loginName."','".POINTID."')";
			echo $sql;
			//querylog($sql);

			$rs = db_query($conn,$sql);
			if (!$rs) {
				echo '<script type="text/javascript">';
				echo 'alert("'.db_error($conn).'")';
				echo '</script>';
				//errorlog(db_error($conn));
			}
			db_close($conn);
			$conn = null;
			
		}
		
	}




	function saveDeleteData($passTable, $passWhere, $passReason, $passDeleteby, $loginName,$HOST,$PORT,$USER,$PASS,$DB) { 
	   	   
		if (strlen($passWhere) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$loginName= $_SESSION["loginname"];


			$sql="call sp_delete_data('".$passTable."','".$passWhere."','".$passReason."','".$passDeleteby."','".$loginName."','".POINTID."')";
			echo $sql;
			//querylog($sql);

			$rs = db_query($conn,$sql);
			if (!$rs) {
				echo '<script type="text/javascript">';
				echo 'alert("'.db_error($conn).'")';
				echo '</script>';
				//errorlog(db_error($conn));
			}
			db_close($conn);
			$conn = null;
			
		}
		
	}



	function saveComboNew($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		//if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$loginName= $_SESSION["loginname"];

			$sql="call sp_save_new_combo_data('".$passTable."','".$passValue."','".$loginName."')";
			echo $sql;
			
			$rs = db_query($conn,$sql);
			if ($rs === false) {
				echo db_error($conn);
			}
			db_close($conn);
			$conn = null;
			
	//	}
		
	}


	function saveComboLinkData($passTable, $passValue, $loginName,$linkName, $linkValue, $linkTable
			,$HOST,$PORT,$USER,$PASS,$DB) { 
	   
	   
		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$loginName= $_SESSION["loginname"];

			if (strlen($linkValue) >0){
				$sql="call sp_save_new_combo_link_table('".$passTable."','".$passValue
						."','".$loginName."','".$linkName."','".$linkValue."','".$linkTable."')";
			} else {
				$sql="call sp_save_new_combo_data('".$passTable."','".$passValue."','".$loginName."')";
			}
			echo $sql;
			
			$rs = db_query($conn,$sql);
			if ($rs === false) {
				echo db_error($conn);
			}
			db_close($conn);
			$conn = null;
			
		}
		
	}


	function selectManyQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
		
			
			$Value =str_replace("|","'",$passValue);
			$SQL = "CALL ".$passTable." (".$Value.");";
			//echo $SQL;

			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			
			$res = '';
			$res = db_multi_query($conn,$SQL);

			echoData($res);
			//echo $res;
			if ($conn) {
				mysqli_close($conn);
			}
			$conn = null;
		}
		
		
	}

	function selectToQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$Value =str_replace("|","'",$passValue);
			$SQL = "CALL ".$passTable." (".$Value.");";
			

			$result = db_query($conn,$SQL);
			if ($result) {

				$fieldCount = mysqli_num_fields($result);
				$res = "";
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
				//echo $res;

				if ($conn) {
					db_close($conn);
				}
				$conn = null;

				echoData($res);
				$result = null;
			}	
			if ($conn != null) {
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			}
			

			exit(1);
		}

		
		
	}

	function selectOneQuery($passTable, $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);


			$Value =str_replace("|","'",$passValue);
			$SQL = "CALL ".$passTable." (".$Value.");";

			$result = db_query($conn,$SQL);
			if ($result) {
				$res = "";
				//$rowCount = db_num_fields($result);
				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
					if ($res != "")
						$res = $res."$";

					$res=$res.trim($row[0]);	
					
				} 
				db_free($result);

				if ($conn) {
					db_close($conn);
				}
				$conn = null;
				//echo $res;
				echoData($res);
				$result = null;
			}	
			if ($conn != null) {
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			}
			exit(1);
		}

		
		
	}




	function selectCommand( $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);


			$Value =str_replace("|","\'",$passValue);
			$SQL = "CALL sp_select_command ('11111','".$Value."');";

			$result = db_query($conn,$SQL);
			if ($result) {
				$res = "";
				//$rowCount = db_num_fields($result);
				while($row = mysqli_fetch_array($result,MYSQLI_NUM)) { 
					if ($res != "")
						$res = $res."$";

					$res=$res.trim($row[0]);	
					
				} 
				db_free($result);
				//echo $res;
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
				echoData($res);
				$result = null;
			}	
			
			if ($conn != null) {
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			}

			exit(1);
		}

		
		
	}


	function getFindData($passTable,$passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB,$session) {
		if (strlen($passValue) >0){
			
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$Value =str_replace("|","\'",$passValue);

			$SQL = "call sp_select_find_data ('".$session."','".$passTable."','".$Value."','".$loginName."');";
			
			$result = db_query($conn,$SQL);
			if ($result) {

				$fieldCount = mysqli_num_fields($result);

				$res = "";
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
				//errorlog($res);
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			
				//echo $res;
				echoData($res);
				$result = null;
			}	
			if ($conn != null) {
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			}

			exit(1);

		
		}
	 }

	function getFindManyData($passTable,$passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB,$session) {

		//if (strlen($passValue) >0){
			
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$Value =str_replace("|","\'",$passValue);
			// $table ="\'".str_replace("^","\',\'",$passTable)."\'";

			$SQL = "call sp_select_find_many_data ('".$session."','".$passTable ."','".$Value."','".$loginName."');";
			
	
			$result = db_query($conn,$SQL);
			if ($result) {

				$fieldCount = mysqli_num_fields($result);

				$res = "";
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
				// errorlog($res);
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
				echoData($res);
				//echo $res;
				$result = null;
			}	
			if ($conn != null) {
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			}

			exit(1);

		
		//}
	 }


	function getFillManyData($passTable,$passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {
	
			
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);
			$Value =str_replace("|","\'",$passValue);

			$SQL = "call sp_select_table_data ('".$passTable."','".$Value."','".$loginName."','TH');";
			
			//querylog($SQL);

			$resAll = "";
			if (mysqli_multi_query($conn,$SQL))
			{			
				$resAll = "";
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
							errorlog("db_mquery=(".$SQL.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
						break;
					}
					if (!mysqli_next_result($conn)){
						break;
					}
				} 
				while (true);
			} else {
				$resAll = mysqli_error($conn);
			}
			
			if ($conn) {
				db_close($conn);
			}
			$conn = null;
			//echo $resAll;
			echoData($resAll);
			exit(1);

		
		
	 }


	function queryCommand( $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);


			$Value =str_replace("|","\'",$passValue);
			$result = db_query($conn,$Value);
			if ($result) {

				$fieldCount = mysqli_num_fields($result);

				$res = "";
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
				// errorlog($res);
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			
				//echo $res;
				echoData($res);
				$result = null;
			}	
			if ($conn != null) {
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			}

			exit(1);
		}

		
		
	}


	function queryMainCommand( $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);


			$Value =str_replace("|","\'",$passValue);
			$result = db_query($conn,$Value);
			if ($result) {

				$fieldCount = mysqli_num_fields($result);

				$res = "";
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
				// errorlog($res);
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
				echoData($res);
				//echo $res;
				$result = null;
			}	
			if ($conn != null) {
				if ($conn) {
					db_close($conn);
				}
				$conn = null;
			}

			exit(1);
		}

		
		
	}
	/* ----------------------------------------------------------------------------------------- */
/*
	function queryMainGZCommand( $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);


			$Value =str_replace("|","\'",$passValue);
			$result = db_query($conn,$Value);
			if ($result) {

				$fieldCount = mysqli_num_fields($result);

				$res = "";
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

				
				header('EncodingType: gzip'); 
				$contents = base64_encode(gzcompress(rawurlencode($res),9));
				echo $contents;
				
				//echo $res;
				$result = null;
			}	
			if ($conn) {
				db_close($conn);
			}
			$conn = null;

			//exit(1);
		}

		
		
	}
	*/
	/* ----------------------------------------------------------------------------------------- */


	function queryManyCommand( $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_connect($HOST,$USER,$PASS,$DB,$PORT);


			$SQL =str_replace("|","\'",$passValue);
			//$result = db_query($conn,$SQL);
			$resAll = "";
			if (mysqli_multi_query($conn,$SQL))
			{
				$resAll = "";
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
							errorlog("db_mquery=(".$SQL.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
						break;
					}
					if (!mysqli_next_result($conn)){
						break;
					}
				} 
				while (true);
			
			} else {
				$resAll = mysqli_error($conn);
			}
			if ($conn) {
				db_close($conn);
			}
			$conn = null;
			echoData($resAll);
			//echo $resAll;
			exit(1);

			//exit(1);
		}

		
		
	}

/* ----------------------------------------------------------------------------------------- */


	function queryManyMainCommand( $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);


			$SQL =str_replace("|","\'",$passValue);
			//$result = db_query($conn,$SQL);
			$resAll = "";
			if (mysqli_multi_query($conn,$SQL))
			{
				$resAll = "";
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
						if (strlen(mysqli_error($conn)) >0) {
							errorlog("db_mquery=(".$SQL.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
							echoData(mysqli_errno($conn));
						}
						break;
					}
					if (!mysqli_next_result($conn)){
						break;
					}
				} 
				while (true);
				
			} else {
				$resAll = mysqli_error($conn);
			}
			if ($conn) {
				db_close($conn);
			}
			$conn = null;
			//echo $resAll;
			echoData($resAll);
			exit(1);

			//exit(1);
		}

		
		
	}

	/* ----------------------------------------------------------------------------------------- */


	function queryEncCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		if (strlen($passValue) >0){
			$conn=db_mainconnect($HOST,$USER,$PASS,$DB,$PORT);
			$SQL = urldecode(base64_decode(urldecode($passValue)));
			$resAll = "";
				if (mysqli_multi_query($conn,$SQL))
				{
					$resAll = "";
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
								errorlog("db_mquery=(".$SQL.")\n\t".mysqli_errno($conn).':'.mysqli_error($conn));
							break;
						}
						if (!mysqli_next_result($conn)){
							break;
						}
					} 
					while (true);
					
				} else {
					$resAll = mysqli_error($conn);

				}
				if ($conn) {
					db_close($conn);
				}
			$conn = null;
			return $resAll;
		} else {
			return "";
		}
	}

/* ----------------------------------------------------------------------------------------- */


	function queryEncManyMainCommand( $passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB) {

		$resAll = queryEncCommand($passValue, $loginName,$HOST,$PORT,$USER,$PASS,$DB);
		//echo $resAll;
		echoData($resAll);
		exit(1);
		
	}



/* ----------------------------------------------------------------------------------------- */

	function queryEncManyDBCommand( $passValue, $loginName,$HOST,$PORT,$DBList) {

		
		if (strlen($passValue) >0){

			$resAll = "";
			$sList = urldecode(base64_decode(urldecode($DBList)));
			//$sList = $DBList;
			//querylog($sList);
			$asDB = explode("|", $sList);
			
			foreach ($asDB as $v) { 
			
				$asV = explode(",", $v);

			
				$sDB=$asV[2];
				$sUSER=$asV[3];
				$sPASS=$asV[4];

				$res = queryEncCommand($passValue, $loginName,$HOST,$PORT,$sUSER,$sPASS,$sDB);
				
				if (strlen($resAll) >0){
					$resAll = $resAll.'^d'.$res;
				} else {
					$resAll = $res;
				}

				//$resAll = $v.'=='.$sDB.'^d'.$sUSER.'^d'.$sPASS;


			}
			
			//echo $resAll;
			echoData($resAll);
			exit(1);

			//exit(1);
		}
		
		//echo "test queryEncManyDBCommand";
		//exit(1);
		
	}

/* ----------------------------------------------------------------------------------------- */

	function echoData($res){
		/*
		$isZip = "0";
		if (isset($_GET['iszip']))
			$isZip = $_GET['iszip'];
		if (isset($_POST['iszip']))
			$isZip = $_POST['iszip'];
		*/
		if ($GLOBALS["isZip"]) {
			$isZip =$GLOBALS["isZip"];		
		}

		if (strcmp($isZip, '1') == 0) {
			if (strlen($res) >50000){
				header('EncodingType: gzip'); 
				$contents = base64_encode(gzcompress(rawurlencode($res),9));
				
				echo $contents;

			} else {
				
				header('EncodingType: txt '.$isZip); 
				echo $res;
			}
		} else {
				
			header('EncodingType: txt '.$isZip); 
			echo $res;
		}
		
	}

?>	



