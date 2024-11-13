
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



$search_for_gallery_item="";





if(isset($_GET['search_for_gallery_item'])) $search_for_gallery_item = $_GET['search_for_gallery_item'];



if (!empty($search_for_gallery_item)) {
    $where_search_for_gallery_item = " AND (gallery_items.name LIKE '%$search_for_gallery_item%' )";
} 







?>



<div class="title">Control Gallery</div>
<script>
function cancel_restore_row(element,action,row_id)
{

	var ok=confirm("Sure؟");
	if(!ok)return;
	
	var pass_data={
		'action':action,
		'row_id':row_id,
	}

	$.ajax({
		type:"POST",
		url:"gallery_items_FUNCTION.php",
		data:pass_data,
		success: function(response) {

			response=JSON.parse(response.trim());
		
			if(response.head=="ok")
			{
				$(element).parent().parent().fadeOut('slow');
	
			}
			else if(response.head=="error")
			{
				alert(response.body);
			}

	 	}
	});
		
					


}

</script>

<form method="GET">
    <table class="barTab" style="font-weight: bold">

		<tr>
			
			<td width=35% >
						Title <br>
				<input type="text" class="cp_input" value="<?php echo $GLOBALS['search_for_gallery_item'];?>" name="search_for_gallery_item" placeholder="Title Search ..." style="padding-right:9px;"/>
				
			</td>
			
			<td width=25% align="middle">
				<br>
        	<input class="btn " style="width:99px;height:33px;font-weight:bold;" type="submit" name="" value="Search"/>
      </td>
            
		</tr>
		
    </table>
</form>



<center>


<a href="gallery_items_FORM.php?action=insert_data" >
	<div align="left" class="btn btn-success" style="float:left;color:white;font-size:1.1em;margin:10px;height:25px;padding:3px;width:88px;">
		<span style="float:left;margin-left:10px;" >New Item</span>
	</div>
</a>

<a href="gallery_item_category.php" >
	<div align="left" class="btn btn-danger" style="float:right;color:white;font-size:1.1em;margin:10px;height:25px;padding:3px;width:88px;">
		<span style="float:right;margin-left:10px;" >Categories</span>
	</div>
</a>



</center>
<table class="tablein" width="80%" >
    <tr class="firstTR">
        <th width="3%">#</th>
        <th width="3%">id</th>

        <th width="13%"> Image</th>

        <th width="20%">Name</th>
        <th width="14%">Price</th>
        
        <th width="30%">Description</th>
 
        <th width="11%">Category</th>
        
        <th width="11%">Attachement</th>
        
        <th width="3%">Edit</th>
        <th width="3%">Delete</th>
 
    </tr>
    <?php
    

    
		$sql = "SELECT gallery_items.id,gallery_items_categories.category_name , gallery_items.category_id, gallery_items.name,gallery_items.description,gallery_items.price, gallery_items.file_name FROM gallery_items LEFT JOIN gallery_items_categories ON gallery_items_categories.id=gallery_items.category_id WHERE 1 $where_search_for_gallery_item AND gallery_items.row_deleted=0 ORDER BY gallery_items.id DESC"; 

    //echo $sql;
 
    $query = mysqli_query($connect, $sql);
    $row_number=0;
    while ($row = mysqli_fetch_array($query)) {
          $id = $row['id'];
          $row_number=$row_number+1;

        
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

		        $element='<img style="max-width: 99px;border-radius:5px;border:1px solid #aaa;" src="'.$src.'" />';
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

        ?>
        <tr>
            <td><?php echo $row_number; ?></td>
            <td><?php echo $id; ?></td>
            <td><?php echo $element; ?></td>

            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?>₪</td>
            <td><?php echo $row['description']; ?></td>


       
			      <td><?php echo $row['category_name']; ?></td>
			      
			      
			      <td><a class="fa fa-link" style="text-decoration:none;font-size:1.5em;" href="gallery_attachment.php?item_id=<?php echo $id; ?>&item_name=<?php echo $row['name']; ?>"> </a></td>


            <td><a title="Edit" href="gallery_items_FORM.php?action=update_data&row_id=<?php echo $id; ?>"><img src="../resources/icons/update.png" width="22" title="update"/> </a></td>
            <td><a onclick="cancel_restore_row(this,'cancel_row',<?php echo $id; ?>)" title="Delete" ><img src="../resources/icons/delete.png" width="22" title="delete" /></a></td>

        </tr>
    <?php 
    }
    
    
    
     ?>
</table>





