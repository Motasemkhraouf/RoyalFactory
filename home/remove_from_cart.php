
<?php
session_start();
require "../configuration.php";

$return_data=array();



$cart_row_id = intval($_POST['cart_row_id']);



$sql="DELETE FROM cart WHERE 1 AND id=$cart_row_id AND user_id=$_SESSION[user_id]";

$q = mysqli_query($connect, $sql);

if ($q) 
{
  $return_data["head"]="ok";
  $return_data["body"]="Deleted Successfully";
  echo json_encode($return_data);
  exit;
}
else
{
	$return_data["head"]="error";
	$return_data["body"]="error when remove";
	echo json_encode($return_data);
  exit;
}











