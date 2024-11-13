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
    $(document).ready(function(){
	    var element_username = document.getElementById("username");
	    element_username.addEventListener("keyup", function(event) {
		    if (event.keyCode === 13) {
		        event.preventDefault();
		        document.getElementById("LOGIN").click();
		    }
	    });
	    var element_password = document.getElementById("password");
	    element_password.addEventListener("keyup", function(event) {
		    if (event.keyCode === 13) {
		        event.preventDefault();
		        document.getElementById("LOGIN").click();
		    }
	    });
    });

    </script>


    <script>

    function login(element)
    {
      //$(element).attr("disabled","disabled");
      
	    var username=$("[id=username]").val();
	    var password=$("[id=password]").val();

	    if(username==''){alert('please enter username !');return;}
	    if(password==''){alert('please enter password !');return;}

      //alert(1);
      
	    $.ajax({
		    type:"POST",
		    url:"get_auth.php",
		    data:{'username':username,'password':password,},
		    success: function(response) {
		      //alert(response);
		      
			    response=JSON.parse(response.trim());
			    
			    if(response.head=="ok")
			    {
			    
				    $("[name=username]").empty();
				    $("[name=password]").empty();
				    
				    if(response.body=="correct_user_data")
				    {
              if(response.user_type==1)location.href = "../manager-account/index.php";
					    else if(response.user_type==2)location.href = "../home/index.php";
					   
				    }

			    }
			    else if(response.head=="error")
			    {
				    alert(response.body);	
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
                    <h2>Login To Your Account </h2>
                </div>
            </div>
        </div>
    </div>
    
    <style>
      .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }
        
      .form-control:focus {
          background-color: white;
          border-color: black; /* Change border color when focused */
          color: black; /* Change text color when focused */
      }
      
      
       /* Customize the login button */
      .btn-login {
          background-color: #f0f0f0;
          color: #444;
          border: 1px solid #ddd;
          font-weight:bold;
      }

      .btn-login:hover {
          background-color: #fff;
          color: #222;
      }
      label{
        font-weight:bold;
      }
    </style>
    
    <div class="container login-container">
  
       
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" id="LOGIN" onclick="login(this);" class="btn btn-login btn-block">Login</button>
       
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
