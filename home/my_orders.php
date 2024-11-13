<!DOCTYPE html>
<?php
include "../configuration.php";
session_start();
if($_SESSION['user_type']!=2)
{
  header("Location : login.php");
  die("You Have No Permession");
}

?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Royal Factory</title>

    <link rel="icon" type="image/png" href="assets/images/logo.png">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/main.css">

    </head>
    
    <body>
    
   
 
    <?php include "header.php";?>
    
    <div class="rent-venue-tabs" style="">
    
    
    <hr>
        <?php include "customer_sub_header.php";?>
        
        <br>       
        <div class="container">


        <br>
          <div style="width:100%;color:#976F05;font-weight:bold;text-align:center;font-size:1.2em;">My Orders</div>
      <hr style="width:33%;min-width:200px;">
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






    
<table  style="width:99%;border:none !important;font-size:0.9em;text-align:center;font-weight:normal;">
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
            (SELECT SUM(`price` * `amount_op1`)
             FROM `order_detail`
             WHERE `order_detail`.`order_id` = `orders`.`id`
            ) as total_cost
        FROM
            `orders`
        LEFT JOIN
            `users` ON `users`.`id` = `orders`.`user_id`
        WHERE
            `orders`.`user_id` = $_SESSION[user_id]
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
            

            
            
            <td style="font-weight:bold"><?php echo array(0=>"Wait",1=>"Accepted",2=>"Rejected")[$row['response']]; ?></td>

            <td><?php echo $row['total_cost']; ?>₪</td>

            <td  ><img src="assets/icons/detail.png"  onclick="location.href='order_detail.php?order_id=<?php echo $id;?>'"   width="35" title="detail"/></td>
            
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


    <div class="rent-venue-application">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>


  

    <!-- *** Footer *** -->
    <footer>
    <?php include "footerr.php";?>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

  </body>
</html>
















