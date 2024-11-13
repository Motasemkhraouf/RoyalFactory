
<?php
session_start();
require "../configuration.php";

$return_data=array();



$gallery_item_id = intval($_POST['gallery_item_id']);

$sql="SELECT * FROM `gallery_items` WHERE 1 AND id=$gallery_item_id";
$sel = mysqli_query($connect, $sql);
$price = mysqli_fetch_array($sel)['price'];


$sql="INSERT INTO cart(user_id,gallery_item_id,price) VALUES($_SESSION[user_id] , $gallery_item_id,$price)";

$insert = mysqli_query($connect, $sql);

if ($insert) 
{
  $return_data["head"]="ok";
  $return_data["body"]="Added Successfully";
  echo json_encode($return_data);
  exit;
}
else
{
	$return_data["head"]="error";
	$return_data["body"]="error when add";
	echo json_encode($return_data);
  exit;
}











