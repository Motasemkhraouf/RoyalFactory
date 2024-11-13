
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



                          
  <section class='content'>

      <div class="row" style="padding-right:13%;padding-left:13%;">
         <div class="col-lg-12" style="border:1px solid #888;background:#fff;padding:3%;">
          <h2 style="font-weight:bold;color:#aaa;">Order Detail</h2>
          <div class="mb-12" style="display: flex; flex-wrap: wrap;">
          
              <div align="left" class="col-lg-12" style="flex: 0 0 100%;">
                        

                        <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">
                            Name
                            
                        </div>
                        <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">
                            Description
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
              
              $sql = "SELECT * FROM `orders` WHERE 1 AND id=$_GET[order_id]";
              $query = mysqli_query($connect, $sql);
              $row = mysqli_fetch_array($query);
              $recipient_name=$row['recipient_name'];
              $recipient_phone=$row['recipient_phone'];
              $recipient_address=$row['recipient_address'];
              
              $sql = "SELECT order_detail.*,gallery_items.name, gallery_items.description, gallery_items.price FROM `order_detail` LEFT JOIN gallery_items ON gallery_items.id= order_detail.gallery_item_id WHERE 1 AND gallery_items.row_deleted=0 AND order_detail.order_id=$_GET[order_id]   ORDER BY order_detail.id DESC ";
              $query = mysqli_query($connect, $sql);
              $row_number = 0;

              while ($row = mysqli_fetch_array($query)) {
              ?>



                <div align="left" class="col-lg-12" style="flex: 0 0 100%;margin-top:15px;border-top: 1px solid #f0f0f0; text-align:center;">
                    <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">
                        <?php echo $row['name']; ?>
                    </div>
                    <div style="font-size: 0.8em; color: #aaa; padding-top: 5px;float:left;width:20%;">
                        <?php echo $row['description']; ?>
                    </div>
                    <div style="color: #666; font-size: 1.0em; font-weight: bold; text-align: left; padding-left: 22px; padding-bottom: 11px;float:left;width:10%;text-align:center;">
                        <span class="price"><?php echo $row['price']; ?></span>₪
                    </div>
                    <div style="font-size: 0.8em; color: #333; padding-top: 5px;float:left;width:20%;text-align:center;">
                        <input class="amount_op1" value="<?php echo $row['amount_op1']; ?>" type="text" onkeyup="update_order_detail_amount(this,'amount_op1',<?php echo $row['id']; ?>);" style="width:66px;text-align:center;" disabled> 
                    </div>
                    <div style="color: red; font-size: 1.2em; font-weight: bold; padding-top: 5px;float:left;width:20%;text-align:center;">
                        <span class="amount_price"><?php echo $row['price']*$row['amount_op1']; ?></span>
                    </div>
                    
                </div>
                                                          

              <?php
              }
              ?>
                <div align="left" class="col-lg-12" style="flex: 0 0 100%;margin-top:15px;border-top: 1px solid #f0f0f0; text-align:center;">
                        

                    <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;float:left;width:20%;text-align:center;">

                    </div>
                    
                    <div style="font-size: 0.8em; color: #aaa; padding-top: 5px;float:left;width:20%;">

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
                        Recipient Name  <br>
                        <input type="text" id="recipient_name" class="form-control" value="<?php echo $recipient_name;?>" style="width:333px;" disabled> 
                    </div>
                    
                    <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;width:90%;">
                        Recipient Phone <br>
                        <input type="text" id="recipient_phone" class="form-control" value="<?php echo $recipient_phone;?>" style="width:333px;" disabled> 
                    </div>
                    
                    <div style="font-weight: bold; font-size: 1.1em; color: #222; padding-top: 5px;width:90%;">
                        Recipient Address<br>
                        <input type="text" id="recipient_address" class="form-control" value="<?php echo $recipient_address;?>" style="width:333px;" disabled> 
                    </div>
                    <br>

              

                </div>
                    
                    
              </div>
              
              
          </div>
      </div>

  </section>



