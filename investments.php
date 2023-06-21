<?php
session_start();
include("connect.php");
  include("functions.php");


$querytrd = "SELECT * FROM trading WHERE active=1";

		$resulttrd = mysqli_query($link,$querytrd);
		 while($fchtrd = mysqli_fetch_assoc($resulttrd)){
             
             $trdid[] = $fchtrd['id'];
            
         }
		

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; Investments</title>
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
	  
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg); min-height:300px;" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center"  style=" min-height:400px;">
          <div class="col-md-10">
           
            <h2 class="text-white">Investments</h2>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold"></strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
		 <div class="row mb-5">
			 <div class="col-sm-12 mb-5">
				 <h3>HOW TO BECOME A REAL ESTATE BUSINESS OWNER WITH LAWREVEE </h3>
				 <ul>
					 <li>Pay 10,000  lawrevee homes to get your registration kit  </li><li>
					 Buy the property you are interested in on the exchange </li><li>
					 Land documents available for inspection ,the business is backed up by real verifiable assets </li><li>
					 Hold the property for a period of 6months or 12 months  </li><li>
					 6 months offers a reward of 30% profit,while 12 months offers a reward of 60% profit  </li><li>
					 At the expiration of the trading period ask the company to sell the property for you  </li><li>
					 The property is sold instantly and your account is credited with the principal and profit </li>
				 </ul>
			 </div>
			 
			<h3 class="text-center col-sm-12"> PROPERTIES CURRENTLY AVAILABLE FOR TRADING</h3>
			           
    <div class="col-sm-12 table-responsive">
         <table class="table table-striped table-hover" id="customers2">
                <thead>
             <th>S/N</th>
             <th>Land Location</th>
             <th>Estate</th>
             <th>Price per Plot</th>
             <th>Price per Square Meters</th>
             <th></th>
            
             
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($trdid)){
                 $sn =1;
                 for($i=count($trdid)-1; $i>=0; $i--){
					 
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                 <td><?php echo genfetch("trading", $trdid[$i], "location"); ?></td>
                 <td><?php echo genfetch("trading", $trdid[$i], "estate"); ?></td>
                
                 <td>N<?php echo number_format(genfetch("trading", $trdid[$i], "price_per_plot"),2); ?></td>
                 <td>N<?php echo number_format(genfetch("trading", $trdid[$i], "price_per_meter"),2); ?></td>
                 
                 <td><a class="btn btn-sm btn-info text-white" href="buyinvestment.php?i=<?php echo $trdid[$i]; ?>">Invest Now</a></td>
                 
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }
				 ?>
             </tbody>
                </table>
                    
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