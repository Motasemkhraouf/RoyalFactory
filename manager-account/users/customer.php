
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

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {

    
    $user_id = intval($_GET['user_id']);
    
			$sel = mysqli_query($connect, "SELECT COUNT(*) FROM users WHERE 1");
			$count = mysqli_fetch_array($sel)['COUNT(*)'];
			if ($count<2) {
        echo "<div class='error'>we can't delete this master admin</div>";
        
      }
			else
			{
        $del1 = mysqli_query($connect, "DELETE FROM users WHERE id='$user_id' AND id!='1'");
			  

        if ($del1) {
            echo '<div class="ok">delete successfully</div>';
            echo '<meta http-equiv="Refresh" content="1;url=customer.php"/>';
            exit;
        }
      }
    
}



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
        <meta http-equiv="Refresh" content="1;url=customer.php"/>
        <?php
        exit;
    }
}






if (@$_REQUEST['action'] == 'edit') {
    $user_id = $_GET['user_id'];

    $sel = mysqli_query($connect, "SELECT * FROM users WHERE id='$user_id'");
    $row_user = mysqli_fetch_array($sel);
    

    ?>
    <form method="post">
		<table style="min-width:300px;float:left;" class="tablein" >
        
            <tr class="firstTR">
            	<td colspan="2">Edit <span style="color:red"><?php echo $row_user['fullname'] ?></span></td>
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
    <?php
    exit;
}
?>






<?php



if (isset($_POST['addUser']) && $_POST['addUser'] == 'new account') {
    $loginname = $_POST['loginname'];
    $userPass1 = MD5(sha1($_POST['userPass1']));
    $userPass2 = MD5(sha1($_POST['userPass2']));
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    
    
    if ($userPass1 != $userPass2) {
        echo '<div class="error">password not equal</div>';
    } else {

        $sql2 = mysqli_query($connect, "SELECT * FROM users WHERE loginname='$loginname'");
        $num = mysqli_num_rows($sql2);
        if ($num > 0) {
            echo "<div class='error'>username used for another</div>";
        } else {
        
        
					$insert = mysqli_query($connect, "INSERT INTO users "
						    . "(loginname,password,fullname,phone,address,user_type) "
						    . "VALUES "
						    . "('$loginname','$userPass1','$fullname','$phone','$address',2)"
						    . "");
        			$last_user_id = mysqli_insert_id($connect);


            if ($insert) {
                ?>
                <div class="ok">added successfully</div>
                <meta http-equiv="Refresh" content="1;url=customer.php"/>
                <?php
                exit;
            }
        }
    }
}
?>
<?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'addUser') { ?>
    <form method="post">
		<table style="direction:ltr !important;min-width:300px;float:left;" class="tablein" >

            <tr>
                <td>FullName</td>
                <td><input type="text" name="fullname" required="required"/></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input type="text" name="phone" required="required"/></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" name="address" required="required"/></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="loginname" required="required"/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="userPass1"  autocomplete="new-password" required="required"/></td>
            </tr>

            <tr>
                <td>rePassword</td>
                <td><input type="password" name="userPass2"  autocomplete="new-password" required="required"/></td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" name="addUser" value="new account"/></td>
            </tr>
        </table>
    </form>
    <?php
    exit;
}
?>






<div align="middle" style="width:88%;float:center;">
<center>
<a href="?action=addUser" style="text-decoration:none;">
	<div align="right" style="float:center;color:white;font-size:1.0em;margin:10px;width:133px;background:green;padding:6px;border-radius:4px;">

		<span style="float:center;margin-right:10px;" >New Customer</span>

	</div>
</a>

</center>


<table style="min-width:300px;float:center;" class="tablein" >
    <tr class="firstTR">
        <th></th>
        <th>FullName</th>
        
        <th>Phone</th>
        <th>Address</th>
        
        <th>Username</th>
        <th width=5%>Edit</th>
        <th width=15%>Delete</th>
    </tr>
    <?php
    $query = mysqli_query($connect, "SELECT * FROM users WHERE 1 AND user_type=2 AND row_deleted=0");
    $row_number=0;
    while ($row = mysqli_fetch_array($query)) {
    	  $row_number=$row_number+1;
        $user_id = $row['id'];

        $fun='<a href="?action=delete&user_id=' . $user_id . '"><img width=25 src="../resources/icons/delete.png" onclick=" return confirm(\'sure?\');"/></a>';

        echo '<tr>'
        . '<td>' . $row_number . '</td>'
        . '<td>' . $row['fullname']. '</td>'
        . '<td>' . $row['phone']. '</td>'
        . '<td>' . $row['address']. '</td>'
        . '<td>'.  $row['loginname']. '</td>'
        . '<td><a href="?action=edit&user_id=' . $user_id . '"><img width=25 src="../resources/icons/update.png"/></a></td>'
        . '<td>'.$fun.'</td>'
        . '</tr>';
    }
    ?>
</table>


