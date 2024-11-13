<?php
include "sessions.php";
?>
<html>
    <head>
    <meta charset="UTF-8"/>
        <title></title>


        <link rel='stylesheet' type='text/css' href="resources/css/fontAwesome.css" rel="stylesheet">
        
      
        <link rel='stylesheet' type='text/css' href='resources/css/jquery-ui.min.css'/>

        <script src="resources/js/jquery-1.9.1.min.js"></script>


    </head>
        <body style="background:#f7f7f7;">


        <style>
          body {
              margin: 0;
              padding: 0;
              display: flex;
              flex-direction: column;

          }

          .bottom-bbttnns {
              display: flex;
              align-items: center;
              justify-content: flex-start; /* Align buttons to the left */
              height: 88px;
              padding-left:22px;
              
          }

          .bbttnn {

              margin: 3px;
              background-color: #fff;
              color: white;
              border: none;
              border-radius: 1px;
              cursor: pointer;
              color:#BB8323;
              font-weight:bold;
              border:1px solid #BB8323;
              padding: 5px;
              margin-top:33px;
          }

          /* Additional styles for the "Wellcom" text */
          .welcome-text {
              text-align: left;
              padding-left: 20px;
              padding-top: 6px;
              font-weight:bold;
              font-size:1.4em;
              text-shadow:0px 0px 2px #BB8323;
              position:absolute;
              top:1px;
          }

        </style>

        
        <div align="left" class="bottom-bbttnns" style="box-shadow: 0px 4px 6px -3px #000;background-image:url('resources/images/header.png');background-size:cover;">
            <div class="welcome-text">
					     Services MAnager Account ... Welcome   
						      ( <?php echo mysqli_fetch_array(mysqli_query($connect,"SELECT fullname FROM users WHERE 1 AND id=".$_SESSION['user_id']))['fullname'];?> ) 
            </div>
            
            <a class="bbttnn" style="text-decoration:none;" href="users/my_account.php"  target='home'>My Account</a>
            <a class="bbttnn" style="text-decoration:none;" href="users/manager.php"  target='home'>Managers</a>
            
            <a class="bbttnn" style="text-decoration:none;" href="users/customer.php"  target='home'>Customers</a>
            
            
            
            <a class="bbttnn" style="text-decoration:none;"  href="orders/orders.php" target='home'> Orders</a>
            <a class="bbttnn" style="text-decoration:none;"  href="gallery-items/gallery_items.php" target='home'> Gallery</a>
            <a class="bbttnn btn-danger" style="text-decoration:none;" href='logout.php'  target='_parent'> Exit</a>
        </div>

         <hr style="box-shadow:1px 1px 4px 1px #000;">

