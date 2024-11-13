<?php
session_start();
require "../configuration.php";

if($_SESSION['user_type']!=2)
{
  die("You Have No Permession");
}
?>


<!DOCTYPE html>
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

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    </head>
    
    <body>
    



    <script>

    function save_info(element)
    {
      //$(element).attr("disabled","disabled");
      
	    var fullname=$("[id=fullname]").val();
	    var phone=$("[id=phone]").val();
	    var address=$("[id=address]").val();
	    var username=$("[id=username]").val();
	    var password=$("[id=password]").val();
	    var repassword=$("[id=repassword]").val();

	    if(fullname==''){alert('please enter your fullname !');return;}
	    if(phone==''){alert('please enter your phone !');return;}
	    if(address==''){alert('please enter your address !');return;}
	    if(username==''){alert('please enter username !');return;}



      if(password!=repassword)
      {
        alert("two password not equal");
        return;
      }
      //alert(1);
      
	    $.ajax({
		    type:"POST",
		    url:"my_account_back.php",
		    data:{'fullname':fullname,'phone':phone, 'address':address,'username':username, 'password':password,},
		    success: function(response) {
		      //alert(response);
		      
			    response=JSON.parse(response.trim());
			    
			    if(response.head=="ok")
			    {
			    
				    $("[id=fullname]").empty();
				    $("[id=phone]").empty();
				    $("[id=address]").empty();
				    $("[id=username]").empty();
				    $("[id=password]").empty();
				    
				    $("[id=response]").css("color","green");
				    $("[id=response]").html(response.body);	

			    }
			    else if(response.head=="error")
			    {
			      $("[id=response]").css("color","red");
				    $("[id=response]").html(response.body);	
			    }

	     	}
	    });
	     

    }
    </script>

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
  
    <?php include "header.php";?>


        <hr>
        <?php include "customer_sub_header.php";?>
            
    
    <style>
      .save_info-container {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            border:1px solid #f0f0f0;
            padding:20px;
            background:#fdfdfd;
            
            
        }
        
      .form-control:focus {
          background-color: white;
          border-color: black; /* Change border color when focused */
          color: black; /* Change text color when focused */
      }
      
      
       /* Customize the save_info button */
      .btn-save_info {
          background-color: #f0f0f0;
          color: #444;
          border: 1px solid #ddd;
          font-weight:bold;
      }

      .btn-save_info:hover {
          background-color: #fff;
          color: #222;
      }
      label{
        font-weight:bold;
      }
    </style>
    
    <div align="left" class="container">
      
      <div class="save_info-container">
        <div style="text-align:center;font-weight:bold;font-size:1.2em;color:#666;">Setting Account</div>
        <hr>
        <?php
        
        $sql="SELECT * FROM users WHERE user_type=2 AND id=$_SESSION[user_id]";  
        $query = mysqli_query($connect, $sql);
        if ($row= mysqli_fetch_array($query))
        {
          $fullname=$row['fullname'];
          $phone=$row['phone'];
          $address=$row['address'];
          $username=$row['loginname'];

        
        }
        
        ?>
   
        <div class="form-group">
            <label for="username">Fullname</label>
            <input type="text" class="form-control" id="fullname" placeholder="Fullname" value="<?php echo $fullname;?>">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" placeholder="Phone" value="<?php echo $phone;?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Address" value="<?php echo $address;?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $username;?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="new-password" autofill="off">

        </div>
        <div class="form-group">
            <label for="repassword">rePassword</label>
            <input type="password" class="form-control" id="repassword" placeholder="rePassword" autocomplete="new-password" autofill="off">
        </div>
        <button type="submit" id="save_info" onclick="save_info(this);" class="btn btn-save_info btn-block">Save Information</button>
        
        <div id="response"></div>
   
      </div>

    </div>

    
    <!-- *** Footer *** -->
    <footer>
    <?php include "footerr.php";?>
    </footer>

    <!-- jQuery -->


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
