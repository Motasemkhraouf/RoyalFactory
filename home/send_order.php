
<?php
session_start();
require "../configuration.php";
$return_data=array();

$current_date = date('Y-m-d');

$customer_id=$_SESSION['user_id'];

if(empty($customer_id) || $_SESSION['user_type']!=2)
{
	$return_data["head"]="error";
  $return_data["body"]="You Have No Permission";
  echo json_encode($return_data);
  exit;
}



$recipient_name = mysqli_real_escape_string($connect, $_POST['recipient_name']);
$recipient_phone = mysqli_real_escape_string($connect, $_POST['recipient_phone']);
$recipient_address = mysqli_real_escape_string($connect, $_POST['recipient_address']);


$current_date=date("Y-m-d H:i:s");

$sql="INSERT INTO `orders`(`transaction_datetime`, `user_id`, `recipient_name`, `recipient_phone`, `recipient_address`) VALUES ('$current_date','$customer_id','$recipient_name','$recipient_phone','$recipient_address')";

$insert = mysqli_query($connect, $sql);

if (!$insert) 
{
	$return_data["head"]="error";
  $return_data["body"]="Error to connect database when send order";
  echo json_encode($return_data);
  exit;
}

$last_order_id = mysqli_insert_id($connect);

$sql="SELECT * FROM `cart` WHERE 1 AND user_id=$_SESSION[user_id]";
$sel = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_array($sel)) 
{

  $sql="INSERT INTO `order_detail`( `order_id`, `gallery_item_id`, `price`, `amount_op1`) VALUES ('$last_order_id','$row[gallery_item_id]','$row[price]','$row[amount_op1]')";
  
  $insert = mysqli_query($connect, $sql);
  
}

$return_data["head"] = "ok";
$return_data["body"] = "Your Order Is Sent order_id($last_order_id)";
echo json_encode($return_data);
exit;
		    



  










