<?php

	include '../sessions.php';
	include '../file_upload.php';
	

	$return_data=array();



	if(!isset($_SESSION['user_id']))
	{
		$return_data['head']="error";
		$return_data['body']=" have no permission ";
		echo json_encode($return_data);
		exit();
	}


	if ($_REQUEST['action'] == 'cancel_row') 
	{
		$row_id = intval($_REQUEST['row_id']);

		$delete = mysqli_query($connect, "UPDATE `gallery_items` SET row_deleted=1 WHERE id='$row_id'");
		if (!$delete) 
		{	
			$return_data["head"]="error";
			$return_data["body"]="error when delete ";
			echo json_encode($return_data);
			exit();
		}
		$ok_msg="deleted";
		$return_data["head"]="ok";
		$return_data["body"]=$ok_msg;
		echo json_encode($return_data);
		exit();
		
		
	}



	if ($_POST['action'] == 'insert_data' || $_POST['action'] == 'update_data') 
	{
	
	
		$name = $_POST['name'];
		$name = mysqli_real_escape_string($connect, $name);
		if(!empty($name))$name="'$name'";
		else
		{
			$return_data["head"]="error";
			$return_data["body"]="must write name";
			echo json_encode($return_data);
			exit();
		}
		
		$price = $_POST['price'];
		$price = round(floatval( $price),2);

		
		$description = $_POST['description'];
		$description = mysqli_real_escape_string($connect, $description);
		if(!empty($description))$description="'$description'";
		else $description="NULL";

		
		if ($_POST['action'] == 'update_data') $and_whr=" AND id!=".$_POST['row_id'];
		
		
		
		$category_id = intval($_POST['category_id']);




		$gallery_item_file_name_dst="NULL";
		if (!empty($_FILES['gallery_itemfile_name']['name'])) 
		{
			#---------------------------------------------------------------------------
			$datafile=array();
			$datafile['element_name']='gallery_itemfile_name';
			$datafile['upload_folder_location']="../../uploaded-files/";
			$gallery_item_file_name_dst=file_upload($datafile);
			#---------------------------------------------------------------------------
			$gallery_item_file_name_dst_temp1=$gallery_item_file_name_dst;
			$gallery_item_file_name_dst="'$gallery_item_file_name_dst'";
		}
		

	
	}

	if ($_POST['action'] == 'insert_data') 
	{

		 $sql="
		 INSERT INTO gallery_items 
		        (name,price,description,category_id,file_name)
		 VALUES
		        ($name,$price,$description,$category_id,$gallery_item_file_name_dst)";

		//echo  $insert_sql;

		$insert1 = mysqli_query($connect, $sql);

		

		$last_gallery_item_id = mysqli_insert_id($connect);


		if (!$insert1) 
		{
			$return_data["head"]="error";
			$return_data["body"]="error in insert";
			echo json_encode($return_data);
			exit();

		}
	
		$ok_msg="saved";
	}



	if ($_POST['action'] == 'update_data') 
	{
		$row_id = intval($_POST['row_id']);
		

		$oldgallery_itemfile_name = $_POST['oldgallery_itemfile_name'];
		$oldgallery_itemfile_name = mysqli_real_escape_string($connect, $oldgallery_itemfile_name);
		

		
		if($gallery_item_file_name_dst=="NULL")$gallery_item_file_name_dst="'$oldgallery_itemfile_name'";
		else
		{
			if(!empty($oldgallery_itemfile_name))
			{
				if(file_exists("../../uploaded-files/$oldgallery_itemfile_name") && !is_dir("../../uploaded-files/$oldgallery_itemfile_name"))
				{
					unlink("../../uploaded-files/$oldgallery_itemfile_name");
				}
			}
		}
		

		
		$sql="UPDATE gallery_items SET 
				name=$name,
				price=$price,
				description=$description,
				
				category_id=$category_id,


				file_name=$gallery_item_file_name_dst

				WHERE id=$row_id ";

		$update = mysqli_query($connect, $sql);
		
		if (!$update)
		{
			$return_data["head"]="error";
			$return_data["body"]="error when update";
			echo json_encode($return_data);
			exit();
		   
		}

		$ok_msg="updated";
	}
	##################################################################
	
	
	
	$return_data["head"]="ok";
	$return_data["body"]=$ok_msg;
	echo json_encode($return_data);
	exit();











?>

