<?php
session_start();
require "../configuration.php";
if($_GET['action']=="logout")
{
  ob_start();
  session_unset();
  ob_end_flush();
}
?>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">DafnaPaper<em>Factory</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.php" class="active">Home</a></li>
                            <li><a href="shopping.php">Shopping</a></li> 
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="address.php">Address</a></li> 
                            
                            <?php 
                            if($_SESSION['user_type']==2)
                            {
                            ?>
                            
                              <li style="pading:3px;background:#f7f7f7;"><a href="my_orders.php" style="font-weight:bold;"><i class="fa fa-user"></i>  My Account</a></li> 
                              <li style="pading:3px;"><a href="cart.php" style="font-weight:bold;"><i class="fa fa-cart-arrow-down" style="font-size:1.4em;"></i>  Cart</a></li> 
                              <li><a href="login.php?action=logout">Logout</a></li> 
                              
                            <?php
                            }
                            else
                            {
                            ?>

                              <li><a href="signup.php">Signup</a></li> 
                              <li><a href="login.php">Login</a></li> 
                              
                            <?php
                            }
                            ?>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    
