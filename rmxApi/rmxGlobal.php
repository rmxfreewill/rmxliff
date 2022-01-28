<?php

header('Content-Type: text/html; charset=utf-8');

ini_set('memory_limit', '-1');

//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();
include_once("define_Api_Global.php");


function db_mainconnect($HOST,$USER,$PASS,$DB,$PORT)
{
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