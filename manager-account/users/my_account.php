
<?php
include "../sessions.php";
?>
<html>
    <head>
    <meta charset="UTF-8"/>
        <title></title>
        <link rel='stylesheet' type='text/css' href='../resources/css/style1.css'/>
        <link rel='stylesheet' type='text/css' href='../resources/css/input_elements.css'/>
        <link rel='stylesheet' type='text/css' href="../resources/css/fontAwesome.css" rel="stylesheet">
        
      
        <link rel='stylesheet' type='text/css' href='../resources/css/jquery-ui.min.css'/>

        <script src="../resources/js/jquery-1.9.1.min.js"></script>



    </head>
    <body style="background-color:#F8F8FF;">


<?php
$user_id=$_SESSION['user_id'];
?>

<?php


if (isset($_POST['user_update_data']) && $_POST['user_update_data'] == 'save') {



    $user_id = $_POST['user_id'];
    $loginname = $_POST['loginname'];
    $userPass = $_POST['userPass'];
    $huserPass = $_POST['huserPass'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    
    if (!empty($userPass)) {

        $userPass = md5(sha1($userPass));
       
    } else {
        $userPass = $huserPass;
    }

    
    $updt = mysqli_query($connect, "UPDATE users SET
			loginname='" . $loginname . "',
			password='" . $userPass . "', 
			fullname='" . $fullname . "',
			phone='" . $phone . "',
			address='" . $address . "' 
			WHERE id=" . $user_id );
			
						
			
    if ($updt) {
        ?>
        <div class="ok">saved</div>
        <meta http-equiv="Refresh" content="1;url=hall_owner.php"/>
        <?php
        exit;
    }
}


$sel = mysqli_query($connect, "SELECT * FROM users WHERE id='$user_id'");
$row_user = mysqli_fetch_array($sel);


?>
<form method="post">
<table style="min-width:300px;float:center;" class="tablein" >
    
        <tr class="firstTR">
        	<td colspan="2" style="font-weight:bold;">Setting Your Account</span></td>
        </tr>
        
        <tr>
            <td>FullName</td>
            <td><input type="text" name="fullname" required="required" value="<?php echo $row_user['fullname'] ?>"/></td>
        </tr>
        
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone" required="required" value="<?php echo $row_user['phone'] ?>"/></td>
        </tr>
        
        <tr>
            <td>Address</td>
            <td><input type="text" name="address" required="required" value="<?php echo $row_user['address'] ?>"/></td>
        </tr>

       

        <tr>
            <td>Username</td>
            <td><input type="text" name="loginname" required="required" value="<?php echo $row_user['loginname'] ?>"/></td>
        </tr>
                    
        <tr>
            <td>Password</td>
            <td><input type="password" name="userPass" value="" autocomplete="new-password"/>
            <input type="hidden" name="huserPass" value="<?php echo $row_user['password'] ?>"/></td>
        </tr>


        <tr>
            <td colspan="2"> 
                <input type="submit" name="user_update_data" value="save"/>
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
            </td>
        </tr>
        
    </table>
</form>




