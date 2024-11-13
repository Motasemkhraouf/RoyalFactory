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
    <div id="response-div" onclick="$(this).hide();" class="js-preloader" style="background:transparent;display:none;" >
      <div class="preloader-inner" style="width:25%;min-width:300px;height:200px;background:#fff;border-radius:11px;box-shadow:1px 1px 6px 1px #000;text-align:center;font-weight:bold;font-size:1.6em;display: flex;justify-content: center;align-items: center;" id="response-msg">

      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    

  
    <script>

    function add_item_to_cart(gallery_item_id)
    {

	    $.ajax({
		    type:"POST",
		    url:"add_to_cart.php",
		    data:{'gallery_item_id':gallery_item_id},
		    success: function(response) {
		      //alert(response);
		      
			    response=JSON.parse(response.trim());
			    
			    if(response.head=="ok")
			    {
			      $("#response-div").show();
			      $("#response-msg").html("added successfully");
			      $("#response-msg").css("color","green");
			      
			    }
			    else if(response.head=="error")
			    {
			      $("#response-div").show();
			      $("#response-msg").html(response.body);
			      $("#response-msg").css("color","red");
			    }

	     	}
	    });
	     

    }
    </script>
    
    
    <?php include "header.php";?>

    <!-- ***** About Us Page ***** -->
    <div class="page-heading-shows-events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <h1 style="color:#000;">Add Items to Your Cart <br> Then Confirm Purchases</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="tabs">
                        <div class="col-lg-12">
                            <div class="heading-tabs">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <ul>
                                        <?php
                                        $sql = "SELECT * FROM `gallery_items_categories`
 WHERE 1 AND row_deleted=0 "; 
                                        //echo $sql;
                                        $query = mysqli_query($connect, $sql);
                                        $row_number=0;
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                          <li style="cursor:pointer;font-weight:bold;" onclick="location.href='?category_id=<?php echo $row['id'];?>&category_name=<?php echo $row['category_name'];?>';"><?php echo $row['category_name'];?></li>

                                        <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <section class='content'>

                                    <div class="row">
                                        
                                        <?php
                                        if(!empty($_GET['category_name']))
                                        {
                                        ?>
                                        <div class="col-lg-12" style="">
                                            <div class="heading" style="float:center;text-align:center;width:100% !important;margin:22px;"><h2><?php echo $_GET['category_name'];?></h2></div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        <div class="col-lg-12">

                                        <?php
                                        $where_category_id = "";
                                        if (!empty($_GET['category_id'])) $where_category_id = " AND gallery_items.category_id=" . intval($_GET['category_id']);

                                        $sql = "SELECT gallery_items.*,gallery_items_categories.category_name FROM `gallery_items` LEFT JOIN gallery_items_categories ON gallery_items_categories.id=gallery_items.category_id WHERE 1 AND gallery_items.row_deleted=0 $where_category_id ORDER BY gallery_items.id DESC ";
                                        $query = mysqli_query($connect, $sql);
                                        $row_number = 0;

                                        while ($row = mysqli_fetch_array($query)) {
                                            
                                            $file_path="../uploaded-files/".$row['file_name'];
                                            
                                            $file_name = $row['file_name']; // Assuming $row['file_name'] contains the file name

                                            // Get the file extension
                                            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                                            // Define an array of allowed image and video extensions
                                            $allowed_image_extensions = ['jpg', 'jpeg', 'png', 'gif','webp'];
                                            $allowed_video_extensions = ['mp4', 'avi', 'mov', 'wmv'];

                                            // Check if the file extension is in the list of image extensions
                                            $is_image = in_array(strtolower($file_extension), $allowed_image_extensions);

                                            // Check if the file extension is in the list of video extensions
                                            $is_video = in_array(strtolower($file_extension), $allowed_video_extensions);



                                        ?>

                                            <?php if ($row_number %4 == 0): ?>
                                           <div class="row mb-4" >
                                            <?php endif; ?>

                                            <div align="middle" class="col-lg-3"  ondblclick="location.href='item_attachment.php?item_id=<?php echo $row['id'];?>&item_name=<?php echo $row['name'];?>';">
                                              <div style="border:1px solid #aaa;background:#fff;text-align:center;margin:1%;width:100%;min-height:425px;">
                                                <?php
                                                if ($is_image || !$is_video) {
                                                if(!file_exists($file_path) || is_dir($file_path))
		                                            {
			                                            $file_path='assets/images/empty.png';
		                                            }
                                                ?>
                                                <img src="<?php echo $file_path; ?>" style="height:280px !important;float:center;"  alt="Image <?php echo $row_number; ?>" class="img-fluid">
                                                
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($is_video) {
                                                ?>
                                                <video width="100%" height="280px" style="float:center;" controls>
                                                    <source src="<?php echo $file_path; ?>" type="video/<?php echo pathinfo($file_name, PATHINFO_EXTENSION); ?>">
                                                </video>
                                                <?php
                                                }
                                                ?>
                                                <div style="font-weight:normal;font-size:-.9em;color:#555;position:absolute;top:33px;left:16px;border-top-right-radius:11px;border-bottom-right-radius:11px;background:#f7f7f7;border:1px solid #ddd;padding:4px;font-size:0.8em;font-weight:bold;">
                                                  <?php
                                                  echo $row['category_name'];
                                                  ?>
                                                </div>
                                                
                                                
                                                <div style="font-weight:bold;font-size:1.1em;color:#222;border-top:1px solid #f0f0f0;padding-top:5px;">
                                                  <?php
                                                  echo $row['name'];
                                                  ?>
                                                </div>
                                                <div style="font-size:0.8em;color:#000000;min-height:37px;">
                                                  <?php
                                                  echo $row['description'];
                                                  ?>
                                                </div>
                                                
                                                

                                                <div style="color:red;font-size:1.3em;font-weight:bold;text-align:left;padding-left:22px;padding-bottom:11px;">
                                                <?php
                                                echo $row['price'];
                                                ?>₪
                                                  
                                                </div>
                                                
                                                <?php
                                                if($_SESSION['user_type']==2)
                                                {
                                                ?>
                                                <span style="color:#fff;font-size:0.8em;font-weight:bold;right:0px;bottom:-11px;position:absolute;border:2px solid #ADD8B3;border-radius:11px;background:#6AA472cc;padding:7px;cursor:pointer;" onclick="add_item_to_cart(<?php echo $row['id'];?>);">
                                                add to cart  <i class="fa fa-cart-plus" style="font-size:1.6em;"></i>
                                                </span>
                                                <?php
                                                }
                                                ?>

                                                                     
                                              </div>
                                            </div>

                                            <?php if (($row_number + 1) %4 == 0): ?>
                                                </div>
                                            <?php endif; ?>

                                        <?php
                                            $row_number++;
                                        }
                                        ?>

                                        <?php if ($row_number %2 != 0): ?>
                                            </div>
                                        <?php endif; ?>

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
