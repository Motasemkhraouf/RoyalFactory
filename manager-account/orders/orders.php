
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



<div class="title">Orders</div>
<br>
      
    
    <script>


    function cancel_order(element,order_id)
    {
	    var ok=confirm("are you want to delete order?");if (!ok)return;
	    var pass_data={
		    'order_id':order_id,
	    }

	    var do_ajax=$.ajax({
	    type:'POST',
	    url:'cancel_order.php',
	    data:pass_data,
	    success: function(response) {
		    response=JSON.parse(response.trim());
		    if(response.head=="ok" )
		    {
			    alert(response.body);
			    location.reload();
		    }
		    else if(response.head=="error")
		    {
			    alert(response.body);
		    }	
		    else
		    {
			    alert('unknown error');
		    }	
					    
	    }
	    
	    });
	    do_ajax.error(function() { alert("error to detect ajax file"); });
	    
    }

    </script>
    
    
    <script>


    function send_response(element,order_id)
    {

	    var pass_data={
		    'order_id':order_id,
	    }

	    var do_ajax=$.ajax({
	    type:'POST',
	    url:'send_response.php',
	    data:pass_data,
	    success: function(response) {
		    response=JSON.parse(response.trim());
		    if(response.head=="ok" )
		    {
			    location.reload();
		    }
		    else if(response.head=="error")
		    {
			    alert(response.body);
		    }	
		    else
		    {
			    alert('unknown error');
		    }	
					    
	    }
	    
	    });
	    do_ajax.error(function() { alert("error to detect ajax file"); });
	    
    }

    </script>






    
<table  class="table">
    <tr style="border-bottom:1px solid #aaa;">
        <th width=3%>#</th>

        
        <th width=9% >Sent Time</th>
        
        <th width=9% >User Fullname</th>
        
        <th width=10% >recipient name</th>
        <th width=10% >recipient phone</th>
        <th width=11% >recipient address</th>

        <th width=10% >response</th>

        <th width=10% >Total Cost</th>
        
        <th  width=3% >Detail</th>
        
        <th  width=3% >Delete</th>
        
        
    </tr>
    <?php

    
    $sql = "
        SELECT
            `orders`.`id`,
            `orders`.`transaction_datetime`,
            `orders`.`recipient_name`,
            `orders`.`recipient_phone`,
            `orders`.`recipient_address`,
            `orders`.`response`,
            `users`.`fullname` as user_fullname,
            (SELECT SUM(`price` * `amount_op1` )
             FROM `order_detail`
             WHERE `order_detail`.`order_id` = `orders`.`id`
            ) as total_cost
        FROM
            `orders`
        LEFT JOIN
            `users` ON `users`.`id` = `orders`.`user_id`
        WHERE
            1
            AND `orders`.`row_deleted` = 0
        ORDER BY
            `orders`.`id` DESC
    ";

		//echo $sql;

    $query = mysqli_query($connect, $sql);
    $row_number=0;
    
    $all_total_cost=0;
    
    while ($row = mysqli_fetch_array($query)) {
    	$row_number+=1;
        $id =$row['id'];
        $all_total_cost+=$row['total_cost'];
        ?>
        <tr class="parentTR">
            <td><?php echo $row_number; ?></td>

            <td style="color:#aaa;"><?php echo $row['transaction_datetime']; ?></td>
            <td style="font-weight:bold"><?php echo $row['user_fullname']; ?></td>
            <td style="font-weight:bold"><?php echo $row['recipient_name']; ?></td>
            <td style="font-weight:bold"><?php echo $row['recipient_phone']; ?></td>
            <td style="font-weight:bold"><?php echo $row['recipient_address']; ?></td>
            

            
            
            <td style="font-weight:bold;cursor:pointer;" onclick="send_response(this,<?php echo $id;?>);"><?php echo array(0=>"Wait",1=>"Accepted",2=>"Rejected")[$row['response']]; ?></td>

            <td><?php echo $row['total_cost']; ?>₪</td>

            <td  ><i class="fa fa-external-link"  onclick="location.href='order_detail.php?order_id=<?php echo $id;?>'"   width="35" title="detail"/></td>
            
            <td  >
                        
              <?php
              if($row['response']==0)
              {
              ?>
                <i class="fa fa-close" style="font-size:1.4em;color:red;"  onclick="cancel_order(this, <?php echo $id; ?>)"   width="30" title="delete"></i>
              <?php
              }
              else
              {
              ?>
                <i class="fa fa-question" style="font-size:1.4em;color:#aaa;"  onclick="alert('You can not cancel request for services after accept or reject by Services  Manager');"   width="30" title="delete"></i>
              <?php
              }
              ?>   
              
           </td>         
        </tr>
    <?php 
    
    } 
    ?>
    <tr class="" style="background:#f0f0f0;" >
      <td style="font-weight:bold;font-size:1.1em;text-align:right;padding-right:22px;" colspan=7>Total Cost</td>

      <td style="font-weight:bold;font-size:1.1em;padding:3px;"><?php echo round($all_total_cost,2); ?>₪</td>
      <td colspan=2></td>
    </tr>
</table>

<br><br>








