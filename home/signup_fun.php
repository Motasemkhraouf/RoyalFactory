
<?php

require "../configuration.php";

$return_data=array();

#==============================================(visitor info)
$http_user_agent=$_SERVER['HTTP_USER_AGENT'];
//---------
# PHP7+
$client_iP = $_SERVER['HTTP_CLIENT_IP'] 
    ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # when behind cloudflare
    ?? $_SERVER['HTTP_X_FORWARDED'] 
    ?? $_SERVER['HTTP_X_FORWARDED_FOR'] 
    ?? $_SERVER['HTTP_FORWARDED'] 
    ?? $_SERVER['HTTP_FORWARDED_FOR'] 
    ?? $_SERVER['REMOTE_ADDR'] 
    ?? '0.0.0.0';
//---------  
$hash=MD5(sha1(@$http_user_agent.$client_iP));
#==============================================(/visitor info)

#==============================================prevent multiple request
$sql="SELECT insert_datetime,id FROM `user_agent_ip` WHERE 1 AND hash='$hash' AND insert_datetime > NOW() - INTERVAL 5 MINUTE AND request_type=1 ORDER by id DESC LIMIT 0,1";
$query=mysqli_query($connect, $sql);
if($row=mysqli_fetch_array($query))
{
	$return_data["head"]="error";
	$return_data["body"]="you can not create new account in less than 5 min";
	echo json_encode($return_data);
  exit;
}
else
{
  //continue
}

#==============================================


$fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
$phone = mysqli_real_escape_string($connect, $_POST['phone']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = MD5(sha1(@$_POST['password']));



if(empty($fullname))
{
	$return_data["head"]="error";
	$return_data["body"]="must insert fullname";
	echo json_encode($return_data);
  exit;
}

if(empty($phone))
{
	$return_data["head"]="error";
	$return_data["body"]="must insert phone";
	echo json_encode($return_data);
  exit;
}

if(empty($address))
{
	$return_data["head"]="error";
	$return_data["body"]="must insert address";
	echo json_encode($return_data);
  exit;
}

if(empty($username))
{
	$return_data["head"]="error";
	$return_data["body"]="must insert username";
	echo json_encode($return_data);
  exit;
}

if(empty($password))
{
	$return_data["head"]="error";
	$return_data["body"]="must insert password";
	echo json_encode($return_data);
  exit;
}




$sql="INSERT INTO users(fullname,phone,address,loginname,password,user_type) VALUES('$fullname' , '$phone', '$address', '$username', '$password',2)";

$insert = mysqli_query($connect, $sql);

if ($insert) 
{

  $sql="INSERT INTO user_agent_ip ( `user_agent`, `ip`, `hash`,request_type) VALUES ('$http_user_agent','$client_iP','$hash',1)";
	$query=mysqli_query($connect, $sql);	
	
	
  $return_data["head"]="ok";
  $return_data["body"]="You Are Signup Correctly";
  echo json_encode($return_data);
  exit;
}
else
{
	$return_data["head"]="error";
	$return_data["body"]="error in signup";
	echo json_encode($return_data);
  exit;
}











