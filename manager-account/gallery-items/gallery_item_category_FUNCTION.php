<?php

	include '../sessions.php';

	

	$return_data=array();



	##########################################################
	if(!isset($_SESSION['user_id']))
	{
		$return_data['head']="error";
		$return_data['body']=" No have permission";
		echo json_encode($return_data);
		exit();
	}
	##########################################################
	



	##################################################################
	if ($_REQUEST['action'] == 'cancel_row') 
	{
		$row_id = intval($_REQUEST['row_id']);

		$delete = mysqli_query($connect, "UPDATE `gallery_items_categories` SET row_deleted=1 WHERE id='$row_id'");
		if (!$delete) 
		{	
			$return_data["head"]="error";
			$return_data["body"]="Error in delete ";
			echo json_encode($return_data);
			exit();
		}
		$ok_msg="Deleted";
		$return_data["head"]="ok";
		$return_data["body"]=$ok_msg;
		echo json_encode($return_data);
		exit();
		
		
	}
	##################################################################

			
	##################################################################

	if ($_POST['action'] == 'insert_data' || $_POST['action'] == 'update_data') 
	{
	
	
		$category_name = $_POST['category_name'];
		$category_name = mysqli_real_escape_string($connect, $category_name);
		if(!empty($category_name))$category_name="'$category_name'";
		else
		{
			$return_data["head"]="error";
			$return_data["body"]="must write name";
			echo json_encode($return_data);
			exit();
		}
		

		
		
		
		if ($_POST['action'] == 'update_data') $and_whr=" AND id!=".$_POST['row_id'];

		
		
	
	}

	if ($_POST['action'] == 'insert_data') 
	{

		 $sql="
		 INSERT INTO gallery_items_categories 
		        (category_name)
		 VALUES
		        ($category_name)";

		//echo  $insert_sql;

		$insert1 = mysqli_query($connect, $sql);

		
		//------------------------------------------------------------------------
		$last_gallery_item_id = mysqli_insert_id($connect);/////mean SELECT * FROM agent WHERE id = SCOPE_IDENTITY(); 
		//------------------------------------------------------------------------

		if (!$insert1) 
		{
			$return_data["head"]="error";
			$return_data["body"]="error when insert";
			echo json_encode($return_data);
			exit();

		}
	
		$ok_msg="Saved";
	}



	if ($_POST['action'] == 'update_data') 
	{
		$row_id = intval($_POST['row_id']);

		
		$sql="UPDATE gallery_items_categories SET 
				category_name=$category_name
				WHERE id=$row_id ";

		$update = mysqli_query($connect, $sql);
		
		if (!$update)
		{
			$return_data["head"]="error";
			$return_data["body"]="error when update";
			echo json_encode($return_data);
			exit();
		   
		}

		$ok_msg="Updated";
	}
	##################################################################
	
	
	
	$return_data["head"]="ok";
	$return_data["body"]=$ok_msg;
	echo json_encode($return_data);
	exit();











?>

