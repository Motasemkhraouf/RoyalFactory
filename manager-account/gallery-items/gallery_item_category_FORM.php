
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
	var name=$("[name='name']").val();

	var category_name=$("[name='category_name']").val();

	
	//var pass_data={};
	var pass_data = new FormData();
	pass_data.append('action',action);

	pass_data.append('category_name',category_name);

	//
	if(category_name==0||category_name==''||category_name===undefined)
	{
		alert('must insert name');
		return;
	}
	

	
	//alert(3);
	if(action=='update_data')
	{
		var row_id=$("#row_id").val();
		if(row_id==0||row_id==''||row_id===undefined)
		{
			alert('ID error');
			return;
		}

		pass_data.append('row_id',row_id);
	}


	$.ajax({
		type:"POST",
		url:"gallery_item_category_FUNCTION.php",
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


$category_name = '';  


$action_function="insert_data";

if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'update_data' || $_REQUEST['action'] == 'view_data')) {

	
       if (isset($_SERVER['HTTP_REFERER'])) 
       {
       
			$row_id = intval($_REQUEST['row_id']);
			$sql="SELECT * FROM gallery_items_categories WHERE gallery_items_categories.id='$row_id'";
			
			//echo $sql;
	    $query = mysqli_query($connect, $sql);
	    $row = mysqli_fetch_array($query);


	    $category_name = $row['category_name'];
	    

     
	  } else {
		    die("dont try to play Your IP : " . getenv("REMOTE_ADDR") . "");
		}
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_data') 
{
	$action_function="update_data";
}





?>




<div align="middle">
<div class="title" style="width:50%;">Category</div>


<table dir="rtl" width="50%" class="tablein" style="border:1px dashed #999;">
   
                

                
                <tr>
                    <td>Name</td>
                    <td><input type="text" class="cp_input "  style="width:50%;" name="category_name" value="<?php echo $category_name; ?>" /></td>
                </tr>



                <tr class="control_showing" >
                		<?php 
		                if($action_function=="update_data")
		                {
		                ?>
		                	<input type='hidden' id='row_id' value='<?php echo $row_id;?>' />
		                	<td colspan=2>
		                	
		                		<button class="btn btn-success" type='submit' onclick="do_function(this,'update_data');" > Save</button>
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




