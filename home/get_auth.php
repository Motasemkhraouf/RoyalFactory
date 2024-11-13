
<?php
session_start();
require "../configuration.php";

$return_data=array();

$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = MD5(sha1(@$_POST['password']));

$password = mysqli_real_escape_string($connect, $password);

if ($username && $password) 
{
	  $sql="SELECT * FROM users WHERE loginname='$username' AND password='$password' AND row_deleted=0";
    $is_found = mysqli_query($connect, $sql) or die("mysql error");

    if (mysqli_num_rows($is_found) != 0) 
    {
        while ($row = mysqli_fetch_object($is_found)) 
        {
            $username = $row->username;
            $password = $row->password;
            $user_id = $row->id;
            $user_type = $row->user_type;


        }
        


		    $_SESSION['user_id'] = $user_id;
		    $_SESSION['username'] = $username;
		    $_SESSION['password'] = $password;
		    $_SESSION['user_type'] = $user_type;


        $return_data["head"]="ok";
        $return_data["user_type"]=$user_type;
		    $return_data["body"]="correct_user_data";
		    echo json_encode($return_data);
        exit;
		    

				        
	}
	else
	{
		$return_data["head"]="error";
		$return_data["body"]="username_or_password_error";
		echo json_encode($return_data);
    exit;
	}
				    
} 
else 
{
	$return_data["head"]="error";
  $return_data["body"]="some_unknown_error";
  echo json_encode($return_data);
  exit;
}



  










