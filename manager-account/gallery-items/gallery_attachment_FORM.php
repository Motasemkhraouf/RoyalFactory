
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

        
        
<script>


function do_function(element,action)
{

	var description=$("[name='description']").val();


	var item_id=$("[name='item_id']").val();


	
	var oldgallery_attachmentfile_name=$("[name='oldgallery_attachmentfile_name']").val();

	

	
	//var pass_data={};
	var pass_data = new FormData();
	pass_data.append('action',action);

	pass_data.append('description',description);

	pass_data.append('oldgallery_attachmentfile_name',oldgallery_attachmentfile_name);


	pass_data.append('item_id',item_id);


	//

	pass_data.append('gallery_attachmentfile_name',$("[name='gallery_attachmentfile_name']")[0].files[0]);/////



	if(name==0||name==''||name===undefined)
	{
		alert('must write title');
		return;
	}
	

	
	//alert(3);
	if(action=='update_data')
	{
		var row_id=$("#row_id").val();
		if(row_id==0||row_id==''||row_id===undefined)
		{
			alert('error in ID');
			return;
		}

		pass_data.append('row_id',row_id);
	}


	$.ajax({
		type:"POST",
		url:"gallery_attachment_FUNCTION.php",
		data:pass_data,
		contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
    	processData: false, // NEEDED, DON'T OMIT THIS
		success: function(response) {

			//alert(3);
			response=JSON.parse(response.trim());
		
			if(response.head=="ok")
			{
				$("#response-msg").css({color:"green",});
				$("#response-msg").text(response.body);	
				setTimeout(function(){ 
					if(action=='insert_data')window.history.back();
					else location.reload(); 
				}, 2000);
			}
			else if(response.head=="error")
			{
				//alert(response.body);
				$("#response-msg").css({color:"red",});
				$("#response-msg").text(response.body);	
			}
			
	 	}
	});
		
					


}

</script>






<?php


$row_id='';

$description = '';



$item_id = intval($_GET['item_id']);
//echo "---------$item_id---------";






$file_name = '';

$file_name_path = '../resources/images/empty.png';  




$action_function="insert_data";

if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'update_data' || $_REQUEST['action'] == 'view_data')) {

	
       if (isset($_SERVER['HTTP_REFERER'])) 
       {
       
			$row_id = intval($_REQUEST['row_id']);
			$sql="SELECT * FROM gallery_attachment WHERE gallery_attachment.id='$row_id'";
			
			//echo $sql;
	    $query = mysqli_query($connect, $sql);
	    $row = mysqli_fetch_array($query);

	    $description = htmlspecialchars($row['description']);

	    //$item_id = $row['item_id'];


	    
	    $file_name=$row['file_name'];
		      

          // Get the file extension
          $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

          // Define an array of allowed image and video extensions
          $allowed_image_extensions = ['jpg', 'jpeg', 'png', 'gif','webp'];
          $allowed_video_extensions = ['mp4', 'avi', 'mov', 'wmv','webm'];

          // Check if the file extension is in the list of image extensions
          $is_image = in_array(strtolower($file_extension), $allowed_image_extensions);

          // Check if the file extension is in the list of video extensions
          $is_video = in_array(strtolower($file_extension), $allowed_video_extensions);

          if($is_image)
          {
            $src="../../uploaded-files/$file_name";
		        if(!file_exists($src) || is_dir($src))
		        {
			        $src='../resources/images/empty.png';
		        }

		        $element='<img style="max-width: 111px;border-radius:5px;border:1px solid #aaa;" src="'.$src.'" />';
          }
          if($is_video)
          {
            $src="../../uploaded-files/$file_name";
		        if(!file_exists($src) || is_dir($src))
		        {
			        $src='../resources/images/empty.png';
		        }

		        $element="<a href='$src' target='_blank' >Video</a>";
          }

     
	  } else {
		    die("error permission");
		}
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_data') 
{
	$action_function="update_data";
}


if($action_function=="insert_data")
{
	$form_title="ادخال بيانات";
}
if($action_function=="update_data")
{
	$form_title="تعديل بيانات";
}




?>




<div align="middle">
<div class="title" style="width:50%;"><?php echo $form_title;?></div>


<table dir="rtl" width="50%" class="tablein" style="border:1px dashed #999;">

                <tr>
                    <td>Description</td>
                    <td><input type="text" name="description" class="cp_input " style="width:50%;" required="required" value='<?php echo $description; ?>' /></td>
                </tr>
                


                <tr>
                    <td>File</td>
                    <td>
                        <input type="file" name="gallery_attachmentfile_name" class=""/>
                        <div class="clear"></div>
                        <?php echo $element ?>
                        <input type="hidden" name="oldgallery_attachmentfile_name" value="<?php echo $file_name ?>"/>
                    </td>
                </tr>
                

                


				        <tr>
                    <td>item</td>
                    <td>
                    <?php 
                    //echo $item_id;
                    ?>
						        <select dir="rtl" class="stander_select_list"  name="item_id" id="item_id" style="width:50%;"  disabled>
						          <option></option>
							        <?php
							        $query = mysqli_query($connect, "SELECT * FROM `gallery_items`  WHERE 1 AND row_deleted=0  ORDER BY `id` ASC");
                      while ($row = mysqli_fetch_array($query)) 
                      {
                      ?>
                      <option value="<?php echo $row['id'];?>" <?php if($item_id==$row['id'])echo "selected";?>><?php echo $row['name'];?></option>
                      <?php
                      }
                      ?>
						        </select>
                    </td>
                </tr>
                     


                                  


                <tr class="control_showing" >
                		<?php 
		                if($action_function=="update_data")
		                {
		                ?>
		                	<input type='hidden' id='row_id' value='<?php echo $row_id;?>' />
		                	<td colspan=2>
		                	
		                		<button class="btn btn-success" type='submit' onclick="do_function(this,'update_data');" >Save </button>
		                	</td>
		                <?php
		                }
		                else if($action_function=="insert_data")
		                {
		                ?>
		                	<td colspan=2>
		                		<button class="btn btn-success" type='submit' onclick="do_function(this,'insert_data');" >Insert</button>
		                	</td>
		                <?php
		                }
		                ?>
                </tr>
                 <tr><td colspan=2 align="middle"><div id="response-msg"></div></td></tr>
     
</table>



