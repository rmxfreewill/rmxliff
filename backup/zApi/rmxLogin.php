<?php
$LoginMsg ="";

$username=$_POST['txtLogin'];
$password=$_POST['txtPWD'];
$pointid=$_POST['txtPointId'];
	
if($username && $password && $pointid) {
/*
	echo '<script type="text/javascript">';
	echo 'alert("'.$username.'-'.$password.'-'.$pointid.','.HOST.','.USER.','.PASS.','.DB.','.PORT.'")';
	echo '</script>';
*/
	Login();
} 


function checkLogin(){
	$data_login=$_COOKIE['data_login'];
	if($data_login) {    
		if ($data_login = ""){
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}

function Login(){
	$username=$_POST['txtLogin'];
	$password=$_POST['txtPWD'];
	$pointid=$_POST['txtPointId'];
	//$pointid=POINTID;
	
	  $conn=db_mainconnect(HOST,USER,PASS,DB,PORT);
	  if ($conn) {
		  $ipAddress = get_client_ip();
		  //$password = md5($password);          
		  //$password = md5($password);          
		  $sql = "CALL sp_main_check_login ('$username','$password','$pointid','$ipAddress')";
	
		  $result = db_query($conn,$sql);  // Execute Query
		
		  session_start();
		   if(!db_num_rows($result)){
				
				//echo "<center><font color=\"#FF0000\"><b>Invalid your UserName and Password to login on to the system</b></font></center>";
				$_SESSION["logged"]=0;
				$_SESSION["userid"]="";
				$_SESSION["sessionkey"]="";
				$_SESSION["language"]="TH";
				$_SESSION["userlevel"]="0";
				$_SESSION["bAdmin"]="0";
				$_SESSION["bInUser"]="0";
				$_SESSION["bExUser"]="0";
				$_SESSION["bSystem"]="0";
				$_SESSION["ShopName"]="";
				$_SESSION["PointID"]="";
				$_SESSION["DBName"]="";
				$_SESSION["DBUser"]="";
				$_SESSION["DBPWD"]="";

				
				setcookie("data_login","",time()-500000);
				session_unset();
				session_destroy();
				$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./index.php\">";


				echo '<script type="text/javascript">';
				echo 'alert("Invalid your UserName and Password to login on to the system")';
				echo '</script>';
				//ob_start();
			}else{
				$row = db_fetch_array($result);

				if (!$row) {
						echo '<script type="text/javascript">';
						echo 'alert("Could not connect database")';
						echo '</script>';
						//echo "<center><font color=\"#FF0000\"><b>Could not connect database </b></font></center>";     
						$_SESSION["logged"]=0;
						$_SESSION["userid"]="";
						$_SESSION["sessionkey"]="";
						$_SESSION["language"]="TH";
						$_SESSION["userlevel"]="0";
						$_SESSION["bAdmin"]="0";
						$_SESSION["bInUser"]="0";
						$_SESSION["bExUser"]="0";
						$_SESSION["bSystem"]="0";
						$_SESSION["sPinCode"]="";
						$_SESSION["sResetCode"]="";
						setcookie("data_login","",time()-500000);
						$_SESSION["ShopName"]="";
						$_SESSION["PointID"]="";
						$_SESSION["DBName"]="";
						$_SESSION["DBUser"]="";
						$_SESSION["DBPWD"]="";
		
						session_unset();
						session_destroy();
						$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./index.php\">";
				} else {
					$_SESSION["employee"]=$row['sUsername'];
					$_SESSION["loginname"]=$row['sLoginName'];
					$_SESSION["userid"]=$row['sEmpNo'];
					$_SESSION["sessionkey"]=$row['key'];
					$_SESSION["bAdmin"]="0";
					$_SESSION["bInUser"]="0";
					$_SESSION["bExUser"]="0";
					$_SESSION["bSystem"]="0";
					$_SESSION["userlevel"]=$row['sUserLevel'];
					$_SESSION["sPinCode"]="";
					$_SESSION["sResetCode"]="";
					$_SESSION["ShopName"]=$row['sShopName'];
					$_SESSION["PointID"]=$pointid;
					$_SESSION["DBName"]=$row['sDBName'];
					$_SESSION["DBUser"]=$row['sDBUser'];
					$_SESSION["DBPWD"]=$row['sDBPWD'];

					setcookie("data_login","$username $password",time()+60*10);  // Set the cookie named 
					$_SESSION["logged"]=1;
					$_SESSION["language"]="TH";

					//sPINCode,sResetCode
					$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./frmmain.php\">"; 
				}

			} 

			db_free_result($result);
			$result = null;
			db_close($conn);
			$conn = null;
	

	}else{
	

		echo '<script type="text/javascript">';
		echo 'alert("Cannot connect database '.HOST.','.USER.','.PASS.','.DB.','.PORT.'")';
		echo '</script>';

		$_SESSION["logged"]=0;
		$_SESSION["userid"]="";
		$_SESSION["userlevel"]="0";
		$_SESSION["bAdmin"]="0";
		$_SESSION["bInUser"]="0";
		$_SESSION["bExUser"]="0";
		$_SESSION["bSystem"]="0";
		$_SESSION["sPinCode"]="";
		$_SESSION["sResetCode"]="";
		$_SESSION["ShopName"]="";
		$_SESSION["DBName"]="";
		$_SESSION["DBUser"]="";
		$_SESSION["DBPWD"]="";

		
		setcookie("data_login","",time()-500000);
		//ob_start();
		session_unset();
		session_destroy();
		$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./index.php\">"; 
	}

	// $msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./frmmain.php\">"; //put index.php
	// $msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./index.php\">"; //put index.php
	if($msg) echo $msg;  //if $msg is set echo it, resulting in a redirect to the next page.
	
}

?>