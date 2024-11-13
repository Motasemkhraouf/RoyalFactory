
<?php
session_start();
require "../configuration.php";

$return_data=array();


$user_id=$_SESSION['user_id'];

if(empty($user_id) || $_SESSION['user_type']!=2)
{
	$return_data["head"]="error";
  $return_data["body"]="You Have No Permission '$user_id'";
  echo json_encode($return_data);
  exit;
}



$fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
$phone = mysqli_real_escape_string($connect, $_POST['phone']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$username = mysqli_real_escape_string($connect, $_POST['username']);




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

if(!empty($_POST['password']))
{
  $password = MD5(sha1(@$_POST['password']));
  
	$return_data["head"]="error";
	$return_data["body"]="must update password";
	echo json_encode($return_data);
  exit;
  
  $UPDATE_PASSWORD=" ,password= '$password' ";
  
}




$sql="UPDATE users SET fullname= '$fullname' ,phone= '$phone' ,address= '$address' ,loginname= '$username' $UPDATE_PASSWORD WHERE 1 AND id=$user_id";  

$update = mysqli_query($connect, $sql);

if ($update) 
{
  $return_data["head"]="ok";
  $return_data["body"]="Your Information Saved Correctly";
  echo json_encode($return_data);
  exit;
}
else
{
	$return_data["head"]="error";
	$return_data["body"]="error in save Your Personal Info";
	echo json_encode($return_data);
  exit;
}











