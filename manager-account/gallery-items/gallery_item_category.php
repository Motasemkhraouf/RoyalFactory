
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



<div class="title">Gallery Category</div>
<script>
function cancel_restore_row(element,action,row_id)
{

	var ok=confirm("sure delete?");
	if(!ok)return;
	
	var pass_data={
		'action':action,
		'row_id':row_id,
	}

	$.ajax({
		type:"POST",
		url:"gallery_item_category_FUNCTION.php",
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



<center>


<a href="gallery_item_category_FORM.php?action=insert_data" >
	<div align="left" class="btn btn-success" style="float:left;color:white;font-size:1.1em;margin:10px;height:25px;padding:3px;width:60px;">
		<span style="float:left;margin-left:10px;" >New</span>
	</div>
</a>





</center>
<table class="tablein" width="40%" >
    <tr class="firstTR">
        <th width="3%">#</th>
        <th width="3%">id</th>

        <th width="22%">Name</th>

        <th width="3%">Edit</th>
        <th width="3%">Delete</th>
 
    </tr>
    <?php
    

    
		$sql = "SELECT* FROM gallery_items_categories WHERE 1 AND gallery_items_categories.row_deleted=0 ORDER BY gallery_items_categories.id DESC"; 


 
    $query = mysqli_query($connect, $sql);
    $row_number=0;
    while ($row = mysqli_fetch_array($query)) {
          $id = $row['id'];
          $row_number=$row_number+1;


        ?>
        <tr>
            <td><?php echo $row_number; ?></td>
            <td><?php echo $id; ?></td>


            <td><?php echo $row['category_name']; ?></td>



            <td><a title="Edite" href="gallery_item_category_FORM.php?action=update_data&row_id=<?php echo $id; ?>"><img src="../resources/icons/update.png" width="22" title="update"/> </a></td>
            <td><a onclick="cancel_restore_row(this,'cancel_row',<?php echo $id; ?>)" title="Delete " ><img src="../resources/icons/delete.png" width="22" title="delete" /></a></td>

        </tr>
    <?php 
    }
    
    
    
     ?>
</table>





