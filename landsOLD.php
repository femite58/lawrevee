<?php
session_start();
include("connect.php");
  include("functions.php");

$queryland = "SELECT * FROM lands WHERE active=1";

		$resultland = mysqli_query($link,$queryland);
		 while($fchland = mysqli_fetch_assoc($resultland)){
             
             $landid[] = $fchland['id'];
           
         }

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; Lands</title>
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
      
    <style>
    .btn-blue{
        background:#000066; color:#ffcc00;
    }
    
    .btn-yellow{
        background:#ffcc00; color:#000066;
    }
    
    .btn-yellow:hover{
         background:#000066; color:#ffcc00;
    }
    
    .btn-blue:hover{
        background:#ffcc00; color:#000066;
    }
    </style>
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
           
            <h2 class="text-white">Lands</h2>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold"></strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
		 <div class="row mb-5">
			
			 <?php
		         if(isset($landid)){
                 $sn =1;
                 for($i=count($landid)-1; $i>=0; $i--){
					 $images = explode(",", genfetch("lands", $landid[$i], "images"));
                                             ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="propertydetails.php?l=<?php echo $landid[$i]; ?>" class="property-thumbnail">
                <div class="offer-type-wrap">
					<?php
					 if(genfetch("lands", $landid[$i], "promo")>0 && genfetch("lands", $landid[$i], "promo_end") > time() && genfetch("lands", $landid[$i], "promo_start")<time()){
						 ?>
                  <span class="offer-type bg-danger">Promo</span>
					<?php
					 }
					 ?>
                </div>
                <img src="img/<?php echo $images[0]; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <a href="propertydetails.php?l=<?php echo $landid[$i]; ?>" class="property-favorite"><span class="icon-shopping-cart"></span></a>
                <h2 class="property-title"><a href="propertydetails.php?l=<?php echo $landid[$i]; ?>"><?php echo genfetch("lands", $landid[$i], "name"); ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo genfetch("lands", $landid[$i], "location"); ?></span>
				  <?php
					 if(genfetch("lands", $landid[$i], "promo")>0 && genfetch("lands", $landid[$i], "promo_end") > time() && genfetch("lands", $landid[$i], "promo_start")<time()){
						 ?>
				  <strong class="property-price text-primary mb-3 d-block text-success">N<?php echo number_format(genfetch("lands", $landid[$i], "promo"),2); ?></strong>
				  
				  <del class="text-muted">N<?php echo number_format(genfetch("lands", $landid[$i], "price"),2); ?></del>
				  <?php
					 }else{
						 ?>
				    <strong class="property-price text-primary mb-3 d-block text-success">N<?php echo number_format(genfetch("lands", $landid[$i], "price"),2); ?></strong>
				  
				  <?php
					 }
					 ?>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Title</span>
                    <span class="property-specs-number"><?php echo genfetch("lands", $landid[$i], "title"); ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Use Type</span>
                    <span class="property-specs-number"><?php echo genfetch("lands", $landid[$i], "use_type"); ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Land Size</span>
                    <span class="property-specs-number"><?php echo genfetch("lands", $landid[$i], "size"); ?></span>
                    
                  </li>
                </ul>

    <a href="propertydetails.php?l=<?php echo $landid[$i]; ?>" class="btn btn-blue">View more</a>
    
              </div>
            </div>
          </div>
  <?php 
				 }
                   }?>
        </div>
       
        
      </div>
    </div>

    
       <?php include "footer.php"; ?>
       
       
<div style="width:80px; min-height:100px;  position:fixed; top: 150px; z-index:1000; right: 0px;">
    <a href="http://facebook.com/lawrevee.homes247" class="col-sm-12"><img src="lawrevee-fb.png" width="50%" class="mb-2"></a>
     <a href="https://instagram.com/lawrevee_homes" class="col-sm-12"><img src="lawrevee-ins.png" width="50%" class="mb-2"></a>
      <a href="" class="col-sm-12"><img src="lawrevee-tw.png" width="50%" class="mb-2"></a>
       <a href="https://linkedin.com/lawrevee homes" class="col-sm-12"><img src="lawrevee-lkd.png" width="50%" class="mb-2"></a>
</div>
<div style="width:200px; position:fixed; bottom: 0px; z-index:1000; right: 0px;">
    <a href="https://wa.me/+2349030587652" class="col-sm-12"><img src="lawrevee-chat.png" width="80%" class="mb-2 mr-5"></a>
    </div>
    

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