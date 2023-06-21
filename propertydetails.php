<?php
session_start();
include("connect.php");
  include("functions.php");

$ld= sanitizeInput($_GET["l"]);

$queryland = "SELECT * FROM lands WHERE id=".$ld;

		$resultland = mysqli_query($link,$queryland);
		 while($fchland = mysqli_fetch_assoc($resultland)){
             
             $landid[] = $fchland['id'];
           
         }

$queryland2 = "SELECT * FROM lands WHERE active=1";

		$resultland2 = mysqli_query($link,$queryland2);
		 while($fchland2 = mysqli_fetch_assoc($resultland2)){
             
             $landid2a[] = $fchland2['id'];
           
         }
$indx = array_search($ld, $landid2a);
unset($landid2a[$indx]);
$landid2 = array_merge($landid2a);
shuffle($landid2);


if(isset($_POST['inspectname'])){
	
	$land = $ld;
	$name = sanitizeInput($_POST["inspectname"]);
	$phone = sanitizeInput($_POST["inspectphone"]);
	$email = sanitizeInput($_POST["inspectemail"]);
	$date = strtotime(sanitizeInput($_POST["inspectdate"]));
	$time = sanitizeInput($_POST["inspecttime"]);
	
	addInspection($land, $name, $phone, $email, $date, $time);
	$rtn= "Booking Successful, we will contact you shortly.";
	
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; <?php echo genfetch("lands", $landid[0], "name"); ?></title>
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

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg); min-height:400px;" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center" style=" min-height:400px;">
          <div class="col-md-10">
            <span class="d-inline-block text-white px-3 mb-3 mt-5 property-offer-type rounded">Property Details of</span>
            <h1 class="mb-2"><?php echo genfetch("lands", $landid[0], "name"); ?></h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold"><?php
					 if(genfetch("lands", $landid[0], "promo")>0  && genfetch("lands", $landid[0], "promo_end") > time() && genfetch("lands", $landid[0], "promo_start")<time()){
						 ?>
				  N<?php echo number_format(genfetch("lands", $landid[0], "promo"),2); ?>
				  <?php
					 }else{
						 ?>
				N<?php echo number_format(genfetch("lands", $landid[0], "price"),2); ?>
				<?php
					 }
					 ?></strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm">
      <div class="container">
        <div class="row">
			<?php
			if(isset($rtn)){
				?>
			<div class="col-lg-12">
			<div class="alert alert-success text-center"><?php echo $rtn; ?></div>
			</div>
			<?php
			}
			?>
          <div class="col-lg-8">
            <div>
				 <?php
		         
					 $images = explode(",", genfetch("lands", $landid[0], "images"));
                                             ?>
              <div class="slide-one-item home-slider owl-carousel">
				  <?php
				  for($i=0; $i<count($images); $i++){
					  
				  ?>
                <div><img src="img/<?php echo $images[$i]; ?>" alt="Image" class="img-fluid"></div>
               <?php
				  }
				  ?>
              </div>
            </div>
            <div class="bg-white property-body border-bottom border-left border-right">
              <div class="row mb-5">
                <div class="col-md-6">
                  <strong class="text-success h1 mb-3"><?php
					 if(genfetch("lands", $landid[0], "promo")>0 && genfetch("lands", $landid[0], "promo_end") > time() && genfetch("lands", $landid[0], "promo_start")<time()){
						 ?>
				  N<?php echo number_format(genfetch("lands", $landid[0], "promo"),2); ?>
				  <?php
					 }else{
						 ?>
				N<?php echo number_format(genfetch("lands", $landid[0], "price"),2); ?>
				<?php
					 }
					 ?></strong>
                </div>
                <div class="col-md-6">
					<?php
					 if(genfetch("lands", $landid[0], "promo")>0 && genfetch("lands", $landid[0], "promo_end") > time() && genfetch("lands", $landid[0], "promo_start")<time()){
						 ?>
					<del class="text-muted">N<?php echo number_format(genfetch("lands", $landid[0], "price"),2); ?></del>
				  
                  <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                  <li>
                    <span class="property-specs">Promo Ends:</span>
                    <span class="property-specs-number"><?php echo secToHR2(genfetch("lands", $landid[0], "promo_end")-time()); ?></span>
                    
                  </li>
                  
                </ul>
					<?php
					 }
					 ?>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Location</span>
                  <strong class="d-block"><?php echo genfetch("lands", $landid[0], "location"); ?></strong>
                </div> 
				  <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Neighborhood</span>
                  <strong class="d-block"><?php echo genfetch("lands", $landid[0], "neighborhood"); ?></strong>
                </div>
                <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Use Type</span>
                  <strong class="d-block"><?php echo genfetch("lands", $landid[0], "use_type"); ?></strong>
                </div>
                <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Land Size</span>
                  <strong class="d-block"><?php echo genfetch("lands", $landid[0], "size"); ?></strong>
                </div>
              </div>
              <h2 class="h4 text-black">More Info</h2>
              <?php echo genfetch("lands", $landid[0], "description"); ?>

              <div class="row no-gutters mt-5">
                <div class="col-12">
                  <h2 class="h4 text-black mb-3">Gallery</h2>
                </div>
				   <?php
				  for($i=0; $i<count($images); $i++){
					  
				  ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-2 mr-2">
                  <a href="img/<?php echo $images[$i]; ?>" class="image-popup gal-item"><img src="img/<?php echo $images[$i]; ?>" alt="Image" class="img-fluid"></a>
                </div>
				   <?php
				  }
				  ?>
               
              </div>
            </div>
          </div>
          <div class="col-lg-4">

            <div class="bg-white widget border rounded">

              <h3 class="h4 text-black widget-title mb-3">Buy Now</h3>
             
                <div class="form-group">
					<a href="doc/<?php echo genfetch("lands", $landid[0], "form"); ?>" class="btn btn-primary" download>Download Form</a>
                </div>
              
            </div>

            <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3">Video</h3>
             <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo str_replace('https://youtu.be/','',genfetch("lands", $landid[0], "video")); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
			  
			   <div class="bg-white widget border rounded">

              <h3 class="h4 text-black widget-title mb-3">Book Inspection</h3>
              <form action="" class="form-contact-agent" method="post">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" id="name" name="inspectname" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="inspectemail" class="form-control">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" name="inspectphone" class="form-control">
                </div>
				  <div class="form-group">
                  <label for="date">Date</label>
                  <input type="date" id="date" name="inspectdate" class="form-control">
                </div>
				  <div class="form-group">
                  <label for="time">Time</label>
                  <select  id="time" name="inspecttime" class="form-control">
					  <option value="7:00am">7:00am</option>
					  <option value="7:30am">7:30am</option>
					  <option value="8:00am">8:00am</option>
					  <option value="8:30am">8:30am</option>
					  <option value="9:00am">9:00am</option>
					  <option value="9:30am">9:30am</option>
					  <option value="10:00am">10:00am</option>
					  <option value="10:30am">10:30am</option>
					  <option value="11:00am">11:00am</option>
					  <option value="11:30am">11:30am</option>
					  <option value="12:00pm">12:00pm</option>
					  <option value="12:30pm">12:30pm</option>
					  <option value="1:00pm">1:00pm</option>
					  <option value="1:30pm">1:30pm</option>
					  <option value="2:00pm">2:00pm</option>
					  <option value="2:30pm">2:30pm</option>
					  <option value="3:00pm">3:00pm</option>
					  <option value="3:30pm">3:30pm</option>
					  <option value="4:00pm">4:00pm</option>
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

    <div class="site-section site-section-sm bg-light">
      <div class="container">

        <div class="row">
          <div class="col-12">
            <div class="site-section-title mb-5">
              <h2>Related Properties</h2>
            </div>
          </div>
        </div>
      
        <div class="row mb-5">
			<?php
			     if(isset($landid2)){
                 $sn =1;
                 for($i=0; $i<count($landid2); $i++){
					 $images2 = explode(",", genfetch("lands", $landid2[$i], "images"));
                                             ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="propertydetails.php?l=<?php echo $landid2[$i]; ?>" class="property-thumbnail">
                <div class="offer-type-wrap">
					<?php
					 if(genfetch("lands", $landid2[$i], "promo")>0 && genfetch("lands", $landid2[$i], "promo_end") > time() && genfetch("lands", $landid2[$i], "promo_start")<time()){
						 ?>
                  <span class="offer-type bg-danger">Promo</span>
					<?php
					 }
					 ?>
                </div>
                <img src="img/<?php echo $images2[0]; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <a href="propertydetails.php?l=<?php echo $landid2[$i]; ?>" class="property-favorite"><span class="icon-shopping-cart"></span></a>
                <h2 class="property-title"><a href="propertydetails.php?l=<?php echo $landid2[$i]; ?>"><?php echo genfetch("lands", $landid2[$i], "name"); ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo genfetch("lands", $landid2[$i], "location"); ?></span>
				  <?php
					 if(genfetch("lands", $landid2[$i], "promo")>0 && genfetch("lands", $landid2[$i], "promo_end") > time() && genfetch("lands", $landid2[$i], "promo_start")<time()){
						 ?>
				  <strong class="property-price text-primary mb-3 d-block text-success">N<?php echo number_format(genfetch("lands", $landid2[$i], "promo"),2); ?></strong>
				  
				  <del class="text-muted">N<?php echo number_format(genfetch("lands", $landid2[$i], "price"),2); ?></del>
				  <?php
					 }else{
						 ?>
				    <strong class="property-price text-primary mb-3 d-block text-success">N<?php echo number_format(genfetch("lands", $landid2[$i], "price"),2); ?></strong>
				  
				  <?php
					 }
					 ?>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Title</span>
                    <span class="property-specs-number"><?php echo genfetch("lands", $landid2[$i], "title"); ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Use Type</span>
                    <span class="property-specs-number"><?php echo genfetch("lands", $landid2[$i], "use_type"); ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Land Size</span>
                    <span class="property-specs-number"><?php echo genfetch("lands", $landid2[$i], "size"); ?></span>
                    
                  </li>
                </ul>

    <a href="propertydetails.php?l=<?php echo $landid2[$i]; ?>" class="btn btn-blue">View more</a>
              </div>
            </div>
          </div>
  <?php 
			if($i >=2){
				break;
			}	 }
                   }?>
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
    <a href="https://wa.me/" class="col-sm-12"><img src="lawrevee-chat.png" width="80%" class="mb-2 mr-5"></a>
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
  <script src="js/circleaudioplayer.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>