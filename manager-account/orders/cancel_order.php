
<?php

include "../sessions.php";
$return_data=array();

$user_id=$_SESSION['user_id'];

if(empty($user_id) || $_SESSION['user_type']!=1)
{
	$return_data["head"]="error";
  $return_data["body"]="You Have No Permission";
  echo json_encode($return_data);
  exit;
}



$return_data=array();


$order_id=intval($_POST['order_id']);
if(empty($order_id))
{
	$return_data["head"]="error";
  $return_data["body"]="must select order ID ";
  echo json_encode($return_data);
  exit;
}


//---------------------------------------------------------------------
$sql="UPDATE orders SET row_deleted=1 WHERE 1 AND id=$order_id AND user_id=$user_id";
$update = mysqli_query($connect, $sql);
if(!$update)
{
	$return_data['head']="error";
	$return_data['body']="error when canceled";
	echo json_encode($return_data);
	exit();
}
//--------------------------------------------------------------------

$return_data['head']="ok";
$return_data['body']="canceled successfully";
echo json_encode($return_data);
exit();


?>
























