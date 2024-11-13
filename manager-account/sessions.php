<?php
error_reporting(0);

session_start();
if(file_exists('../configuration.php'))include '../configuration.php';
else if(file_exists('../../configuration.php'))include '../../configuration.php';
else if(file_exists('../../../configuration.php'))include '../../../configuration.php';



if(!isset($_SESSION['user_id'])||$_SESSION['user_type']!=1)
{

	if(file_exists('../home/login.php'))echo"<script> window.top.location.href = '../home/login.php';</script>";
	
	else if(file_exists('../../home/login.php')) echo"<script> window.top.location.href = '../../home/login.php';</script>";
	else if(file_exists('../../../home/login.php')) echo"<script> window.top.location.href = '../../../home/login.php';</script>";
	
	exit;
}

?>

 
      
