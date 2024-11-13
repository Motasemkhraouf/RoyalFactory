
<?php
session_start();
require "../configuration.php";

$return_data=array();



$cart_row_id = intval($_POST['cart_row_id']);
$amount = intval($_POST['amount']);


if($_POST['col']=="amount_op1")
{
  $sql="UPDATE cart SET amount_op1=$amount WHERE 1 AND id=$cart_row_id AND user_id=$_SESSION[user_id]";

  $q = mysqli_query($connect, $sql);

  if ($q) 
  {
    $return_data["head"]="ok";
    $return_data["body"]="updated Successfully";
    echo json_encode($return_data);
    exit;
  }
}
else if($_POST['col']=="amount_op2")
{
  $sql="UPDATE cart SET amount_op2=$amount WHERE 1 AND id=$cart_row_id AND user_id=$_SESSION[user_id]";

  $q = mysqli_query($connect, $sql);

  if ($q) 
  {
    $return_data["head"]="ok";
    $return_data["body"]="updated Successfully";
    echo json_encode($return_data);
    exit;
  }
}
  

$return_data["head"]="error";
$return_data["body"]="error when remove";
echo json_encode($return_data);
exit;












