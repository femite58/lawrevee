<?php
session_start();
include("connect.php");
  include("functions.php");
$order_id = $_SESSION["ordid"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; Make Payment</title>
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
            <h4 class="text-white mt-5 text-center">Make Payment</h4>
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
              <form action="paynow.php" method="POST">
				    <div class="form-group">
                  <label for="phone">Land Location: </label>
						<b> <?php echo genfetch("trading", genfetch("investments", $order_id, "property", "order_id"), "location"); ?></b>
                </div>
				
				  <div class="form-group">
                  <label for="phone">Estate: </label>
					  <b> <?php echo genfetch("trading", genfetch("investments", $order_id, "property", "order_id"), "estate"); ?></b>
                </div>
				
				  <div class="form-group">
                  <label for="phone">Size: </label>
					  <b> <?php echo genfetch("investments", $order_id, "qty", "order_id"); ?> Sq. Meters</b>
                </div>
				
				  <div class="form-group">
                  <label for="phone">Price: </label>
					  <b> N<?php echo number_format(genfetch("investments", $order_id, "price", "order_id"),2); ?></b>
                </div>
				
				  <div class="form-group">
                  <label for="phone">Duration: </label>
					  <b> <?php echo genfetch("investments", $order_id, "duration", "order_id"); ?></b>
                </div>
				  
 <input type="hidden" name="email_prepared_for_paystack" value="<?php echo genfetch("users", genfetch("investments", $order_id, "user", "order_id"), "email"); ?>"> 
 <input type="hidden" name="amount" value="<?php echo genfetch("investments", $order_id, "price", "order_id")*100; ?>"> 
 <input type="hidden" name="cartid" value="<?php echo $_SESSION["ordid"]; ?>">
							<button type="submit" class="btn btn-success">Pay Online</button>
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