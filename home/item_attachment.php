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

    <title>Pal Event</title>

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
                  <h1 style="color:#fff;">Attachment for <br><?php echo $_GET['item_name'];?></h1>
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
                            <section class='content'>

                                    <div class="row">
                                        
                                        <?php
                                        if(!empty($_GET['item_name']))
                                        {
                                        ?>
                                        <div class="col-lg-12" style="">
                                            <div class="heading" style="float:center;text-align:center;width:100% !important;margin:22px;"><h2><?php echo $_GET['item_name'];?></h2></div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        <div class="col-lg-12">

                                        <?php
                                        $where_item_id = "";
                                        if (!empty($_GET['item_id'])) $where_item_id = " AND gallery_attachment.item_id=" . intval($_GET['item_id']);

                                        $sql = "SELECT gallery_attachment.*,gallery_items.name FROM `gallery_attachment` LEFT JOIN gallery_items ON gallery_items.id=gallery_attachment.item_id WHERE 1 AND gallery_items.row_deleted=0 $where_item_id ORDER BY gallery_attachment.id DESC ";
                                        //echo $sql;
                                        
                                        $query = mysqli_query($connect, $sql);
                                        $row_number = 0;

                                        while ($row = mysqli_fetch_array($query)) {
                                            
                                            $file_path="../uploaded-files/".$row['file_name'];
                                            
                                            $file_name = $row['file_name']; // Assuming $row['file_name'] contains the file name

                                            // Get the file extension
                                            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                                            // Define an array of allowed image and video extensions
                                            $allowed_image_extensions = ['jpg', 'jpeg', 'png', 'gif','webp'];
                                            $allowed_video_extensions = ['mp4', 'avi', 'mov', 'wmv','webm'];

                                            // Check if the file extension is in the list of image extensions
                                            $is_image = in_array(strtolower($file_extension), $allowed_image_extensions);

                                            // Check if the file extension is in the list of video extensions
                                            $is_video = in_array(strtolower($file_extension), $allowed_video_extensions);



                                        ?>


                                              <div style="border:1px solid #aaa;background:#fff;text-align:center;margin:1%;width:100%;min-height:425px;">
                                                <br>
                                                <br>
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
                                                <br>
                                                <div style="font-size:1em;color:#666;min-height:37px;margin:3px;">
                                                  <?php
                                                  echo $row['description'];
                                                  ?>
                                                </div>

                                                                     
                                              </div>
                                              <?php
                                                if($_SESSION['user_type']==2)
                                                {
                                                ?>
                                                <span style="color:#fff;font-size:0.8em;font-weight:bold;right:0px;bottom:-11px;position:absolute;border:2px solid #ADD8B3;border-radius:11px;background:#6AA472cc;padding:7px;cursor:pointer;" onclick="add_item_to_cart(<?php echo $row['item_id'];?>);">
                                                add to cart  <i class="fa fa-cart-plus" style="font-size:1.6em;"></i>
                                                </span>
                                                <?php
                                                }
                                                ?>



                                        <?php
                                        }
                                        ?>


                                    </div>



                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
