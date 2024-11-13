<!DOCTYPE html>
<?php
include "../configuration.php";
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



    







    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    
    <script>

    function remove_item_from_cart(cart_row_id)
    {

	    $.ajax({
		    type:"POST",
		    url:"remove_from_cart.php",
		    data:{'cart_row_id':cart_row_id},
		    success: function(response) {
		      //alert(response);
		      
			    response=JSON.parse(response.trim());
			    
			    if(response.head=="ok")
			    {
			      location.reload();
			    }
			    else if(response.head=="error")
			    {
			      alert(response.body);
			    }

	     	}
	    });
	     

    }
    
    
    
    function update_cart_amount(e,col,cart_row_id)
    {

	    $.ajax({
		    type:"POST",
		    url:"update_cart_amount.php",
		    data:{'cart_row_id':cart_row_id,'col':col,'amount':$(e).val()},
		    success: function(response) {
		      //alert(response);
		      
			    response=JSON.parse(response.trim());
			    
			    if(response.head=="ok")
			    {
			      //location.reload();
			    }
			    else if(response.head=="error")
			    {
			      alert(response.body);
			    }

	     	}
	    });
	     

    }
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Calculate total price on document ready
            calculateTotalPrice();

            // Add event listeners for input fields
            var inputs = document.querySelectorAll(".amount_op1");
            inputs.forEach(function(input) {
                input.addEventListener("keyup", function() {
                    calculateSubtotal(input);
                    calculateTotalPrice();
                });
            });
        });

        function calculateSubtotal(input) {
            var container = input.closest('.col-lg-12');
            var amount_op1 = parseFloat(container.querySelector(".amount_op1").value);

            var price = parseFloat(container.querySelector(".price").innerText);
            var subtotal = amount_op1 * price;
            container.querySelector(".amount_price").innerText = subtotal.toFixed(2);
        }

        function calculateTotalPrice() {
            var subtotals = document.querySelectorAll(".amount_price");
            var total = 0;
            subtotals.forEach(function(subtotal) {
                total += parseFloat(subtotal.innerText);
            });
            document.getElementById("total_price").innerText = total.toFixed(2);
        }
        
    </script>
    
    
    <?php include "header.php";?>

    <script>

    function send_order(element) {
    
        
        var recipient_name=$("#recipient_name").val();
        var recipient_phone=$("#recipient_phone").val();
        var recipient_address=$("#recipient_address").val();
        
        if(recipient_name=="")
        {
          alert("must enter recipient name");
          return
        }
        if(recipient_phone=="")
        {
          alert("must enter recipient phone");
          return
        }
        if(recipient_address=="")
        {
          alert("must enter recipient address");
          return
        }
        
  	    $.ajax({
        type:"POST",
        url:"send_order.php",
        data:{ 'recipient_name':recipient_name, 'recipient_phone':recipient_phone, 'recipient_address':recipient_address},
        success: function(response) {
          //alert(response);
          
          response=JSON.parse(response.trim());
          //response.days
          if(response.head=="ok")
          {
              //alert(response.body);	
              $("#show_response").css("color","green");   
              $("#show_response").html(response.body); 
              $(element).hide();
         
                
          }
          else if(response.head=="error")
          {
            //alert(response.body);	
            $("#show_response").css("color","red"); 
            $("#show_response").html(response.body); 

          }
          

       	}
      });
        
        
    }
</script>


    <div class="shows-events-tabs">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="tabs">

                        <div class="col-lg-12">
                        
                        
                        
                        
                                                    
                            <section class='content'>

                                <div class="row" style="padding:10%;">
                                   <div class="col-lg-12" style="border:1px solid #888;background:#fff;">
                                    <h2 style="font-weight:bold;color:#aaa;">Shopping Cart</h2>
                                    <div class="mb-12" style="display: flex; flex-wrap: wrap;padding:33px;">
                                    
                                        <div align="left" class="col-lg-12" style="flex: 0 0 100%;margin-top:15px;">
                                                  

                                                  <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                      Name
                                                      
                                                  </div>
                                                  
                                                  
                                                  <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:10%;text-align:center;">
                                                      Price
                                                  </div>
                                                  <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                      Amount
                                                  </div>
                                                  <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                      Total Price
                                                  </div>
                                                  

                                                  
                                                 
                                              </div>
                                              
                                              
                                        <?php
                                        $sql = "SELECT cart.*,gallery_items.name FROM `cart` LEFT JOIN gallery_items ON gallery_items.id=cart.gallery_item_id WHERE 1 AND gallery_items.row_deleted=0 AND cart.user_id=$_SESSION[user_id]  ORDER BY cart.id DESC ";
                                        $query = mysqli_query($connect, $sql);
                                        $row_number = 0;

                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>



                                          <div align="left" class="col-lg-12" style="flex: 0 0 100%;margin-top:15px;border-top: 1px solid #f0f0f0; text-align:center;">
                                              <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                  <?php echo $row['name']; ?>
                                              </div>
                                              
                                              
                                              <div style="color: #666; font-size: 1.0em; font-weight: bold; text-align: left; padding-left: 22px; padding-bottom: 11px;float:left;width:10%;text-align:center;">
                                                  <span class="price"><?php echo $row['price']; ?></span>₪
                                              </div>
                                              <div style="font-size: 0.8em; color: #333; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                  <input class="amount_op1" value="<?php echo $row['amount_op1']; ?>" type="text" onkeyup="update_cart_amount(this,'amount_op1',<?php echo $row['id']; ?>);" style="width:66px;text-align:center;"> 
                                              </div>
                                              <div style="color: red; font-size: 1.2em; font-weight: bold; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                  <span class="amount_price"><?php echo $row['price']*$row['amount_op1']; ?></span>
                                              </div>
                                              <span  onclick="remove_item_from_cart(<?php echo $row['id'];?>);">
                                                  <i class="fa fa-close" style="font-size: 1.4em;color:#D13260;margin:5px;"></i>
                                              </span>
                                          </div>
                                                                                    

                                        <?php
                                        }
                                        ?>
                                          <div align="left" class="col-lg-12" style="flex: 0 0 100%;margin-top:15px;border-top: 1px solid #f0f0f0; text-align:center;">
                                                  

                                              <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">

                                              </div>
                                              
                                              
                                              <div style="color: red; font-size: 1.3em; font-weight: bold; text-align: left; padding-left: 22px; padding-bottom: 11px;float:left;width:10%;text-align:center;">
                                                  
                                              </div>
                                              <div style="font-weight:bold;font-size: 1.4em; color: #333; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                  
                                                 Total
                                              </div>
                                              <div  style="font-weight:bold;font-size: 1.4em; color: #333; padding-top: 5px;float:left;width:20%;text-align:center;">
                                                  
                                                <span id="total_price"></span> ₪
                                              </div>
                                              

                                             
                                          </div>
                                    
                                        
                                        
                                          <div align="middle" class="col-lg-12" style="flex: 0 0 100%;margin-top:15px;border-top: 1px solid #f0f0f0;">
                                                  

                                              <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;width:90%;">
                                                  Recipient Name
                                                  <input type="text" id="recipient_name" class="form-control" value="" style="width:333px;"> 
                                              </div>
                                              
                                              <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;width:90%;">
                                                  Recipient Phone
                                                  <input type="text" id="recipient_phone" class="form-control" value="" style="width:333px;"> 
                                              </div>
                                              
                                              <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;width:90%;">
                                                  Recipient Address
                                                  <input type="text" id="recipient_address" class="form-control" value="" style="width:333px;"> 
                                              </div>
                                              <br><br>
                                              <div class="main-dark-button" style="color:#fff; cursor:pointer;" ><a onclick="send_order(this); ">Checkout</a></div>

                                              <div id="show_response"></div>



                                        

                                          </div>
                                              
                                              
                                        </div>
                                        
                                        
                                    </div>
                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer>
    <?php include "Footerr.php";?>

       
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
