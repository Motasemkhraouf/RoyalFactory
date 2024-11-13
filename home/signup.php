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

    function signup(element)
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
	    if(password==''){alert('please enter password !');return;}
	    if(repassword==''){alert('please enter repassword !');return;}

      if(password!=repassword)
      {
        alert("two password not equal");
        return;
      }
      //alert(1);
      
	    $.ajax({
		    type:"POST",
		    url:"signup_fun.php",
		    data:{'fullname':fullname,'phone':phone, 'address':address,'username':username, 'password':password,},
		    success: function(response) {
		      //alert(response);
		      
			    response=JSON.parse(response.trim());
			    
			    if(response.head=="ok")
			    {
			    
				    $("[id=fullname]").val('');
				    $("[id=phone]").val('');
				    $("[id=address]").val('');
				    $("[id=username]").val('');
				    $("[id=password]").val('');
				    $("[id=repassword]").val('');
				    
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

    <!-- ***** About Us Page ***** -->
    <div class="page-heading-shows-events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Create New Customer Account </h2>
                </div>
            </div>
        </div>
    </div>
    
    <style>
      .signup-container {
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
      
      
       /* Customize the signup button */
      .btn-signup {
          background-color: #f0f0f0;
          color: #444;
          border: 1px solid #ddd;
          font-weight:bold;
      }

      .btn-signup:hover {
          background-color: #fff;
          color: #222;
      }
      label{
        font-weight:bold;
      }
    </style>
    
    <div class="container signup-container">
  
       
            <div class="form-group">
                <label for="username">Fullname</label>
                <input type="text" class="form-control" id="fullname" placeholder="Fullname">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="Phone">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="new-password" autofill="off">
            </div>
            <div class="form-group">
                <label for="repassword">rePassword</label>
                <input type="password" class="form-control" id="repassword" placeholder="rePassword" autocomplete="new-password" autofill="off">
            </div>
            <button type="submit" id="Signup" onclick="signup(this);" class="btn btn-signup btn-block">Signup</button>
            <div id="response"></div>
       
    </div>



    
    <!-- *** Footer *** -->
    <footer>
    <?php include "Footerr.php";?>

       
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
