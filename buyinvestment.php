<?php
session_start();
include("connect.php");
  include("functions.php");

$ld= sanitizeInput($_GET["i"]);

if(isset($_COOKIE["uid"])){
	$uid = $_COOKIE["uid"];
$authen = $_COOKIE["eml"];
}else {
	 header("location:login.php"); 

}

if(isset($_POST["qty"])){
	$user =$uid; 
	$property = $ld;
	$investment_type = "per_sq_meter";
	$qty= sanitizeInput($_POST["qty"]); 
	$price = genfetch("trading", $ld, "price_per_meter")*$qty; 
	$duration = sanitizeInput($_POST["duration"]); 
	if($duration=="6 Months"){
	$interest_rate = 30;
	}else if($duration=="12 Months"){
	$interest_rate = 60;
	}
	
	$due_date = strtotime($duration);
		
	for($i=0; $i<100; $i++){
		$order_id= mt_rand(1000000, 9999999);
		if(genfetch("investments", $order_id, "order_id", "order_id")==""){
			break;
		}
	}
	addInvestment($order_id, $user, $property, $investment_type, $qty, $price, $duration, $interest_rate, $due_date);
	$_SESSION["ordid"]= $order_id;
	
	header("location:makepayment.php");
}

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; Buy Investment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
<link rel="icon" href="lawrevee.png" type="image/x-icon">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/mediaelementplayer.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/fl-bigmug-line.css">
    
  
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
	
  </head>
  <body>
  <div class="site-loader"></div>
    
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

      <?php include "header.php"; ?>
    </div>
	  
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg); min-height:80px;" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row "  style=" min-height:80px;">
          <div class="col-md-12">
           <br><br><br>
            <h4 class="text-white mt-5 text-center">Buy Investment</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
		 <div class="row mb-5">
			 
		 
		 <div class="col-sm-8 offset-sm-2">
	
<div class="bg-white widget border rounded">

	<?php
			if(isset($rtn)){
				?>
			<div class="col-lg-12">
			<div class="alert alert-success text-center"><?php echo $rtn; ?></div>
			</div>
			<?php
			}
			?>
              <form action="" class="form-contact-agent" method="post">
               
				  <div class="form-group">
                  <label for="phone">Land Location</label>
                  <input type="text" id="phone" name="location" class="form-control" readonly value="<?php echo genfetch("trading", $ld, "location"); ?>">
                </div>
				
				  <div class="form-group">
                  <label for="phone">Estate</label>
                  <input type="text" id="phone" name="estate" class="form-control" readonly value="<?php echo genfetch("trading", $ld, "estate"); ?>">
                </div>
				
				  <div class="form-group">
                  <label for="phone">Price per Sq. Meter</label>
                  <input type="text" id="phone" name="price_per_meter" class="form-control" readonly value="<?php echo genfetch("trading", $ld, "price_per_meter"); ?>">
                </div>
				
				  <div class="form-group">
                  <label for="phone">Quantity</label>
                  <input type="number" id="phone" name="qty" class="form-control" required>
                </div>
				
				  <div class="form-group">
                  <label for="phone">Duration</label>
                  <select  name="duration" class="form-control" required>
					  <option value="6 Months">6 Months (30% Profit)</option>
					  <option value="12 Months">12 Months (60% Profit)</option>
					  </select>
                </div>
				
				
                <div class="form-group">
                  <input type="submit"  class="btn btn-primary" value="Submit">
					
                </div>
				
              </form>
			 </div>
			 </div>
			 
			 </div>
       
        
      </div>
    </div>

    
      <?php include "footer.php"; ?>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/mediaelement-and-player.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

  </body>
</html>